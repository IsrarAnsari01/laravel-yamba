<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Videocetagory;
use App\Models\author_videocetagories;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (session()->get("userId")) {
            $userId = session()->get("userId");
            return Redirect::to("authorDashboard/{$userId}");
        }
        return view("yamba/login");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (session()->get("userId")) {
            $userId = session()->get("userId");
            return Redirect::to("authorDashboard/{$userId}");
        }
        return view("yamba/sigin");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|max:100',
            'email'     => "required|email|unique:users",
            'password'     => ['required', Password::min(4)->symbols()],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            $author = new Author();
            $author->name = $request->input("name");
            $author->email = $request->input("email");
            $author->password = $request->input("password");
            $author->save();
            return Redirect::to("/loginPage");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Author $author, $authorId)
    {
        if (!$request->session()->get('userId')) {
            return Redirect::to('loginPage');
        }
        $userComments = Author::find($authorId)->comment;
        $userPosts = Author::find($authorId)->post;
        $userPostedVideos = Author::find($authorId)->postedVideos;
        $userInformation = Author::find($authorId);
        $sendArray = array("basicInfo" => $userInformation, "userPosts" => $userPosts, "userComments" => $userComments, "PostedVideos" => $userPostedVideos);
        return view("yamba/authorDashboard")->with("userInfo", $sendArray);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author, $id)
    {
        return view("yamba/update")->with("UserInfo", Author::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        if (!$request->session()->get('userId')) {
            Redirect::to('loginPage');
        }
        $validator = Validator::make($request->all(), [
            'name'      => 'required|max:100',
            'email'     => "required|email|unique:users",
            'password'     => ['required', Password::min(4)->symbols()],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            $author = Author::find($request->id);
            $author->name = $request->input("name");
            $author->email = $request->input("email");
            $author->password = $request->input("password");
            $author->save();
            $updatedUser = Author::find($request->id);
            return redirect("authorDashboard/$updatedUser->id");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Author $author, $author_id)
    {
        Author::destroy(array("id", $author_id));
        $request->session()->flush();
        return  Redirect::to('/');
    }

    /**
     * Login User using their email and password
     *
     * @param  \Illuminate\Http\Request  $request 
     * @return Redirect
     */

    public function loginUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'     => "required|email|unique:users",
            'password'     => ['required', Password::min(4)->symbols()],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            $userEmail = $request->input("email");
            $userPassword = $request->input("password");
            $findUser = DB::table("authors")->where([["email", "=", $userEmail], ["password", "=", $userPassword]])->first();
            if ($findUser) {
                session(["userId" => $findUser->id]);
                return redirect("authorDashboard/{$findUser->id}");
            }
            return redirect("/loginPage");
        }
    }

    /**
     * Logout user 
     *
     * @param  \Illuminate\Http\Request  $request 
     * @return Redirect
     */
    
    public function logoutUser(Request $request)
    {
        $request->session()->flush();
        return Redirect::to('/');
    }

    /**
     * Check Send Video Category already exists or not
     *
     * @param  object author, integer $cat_id
     * @return boolean true / false
     */

    public function checkVideoCatId($author, $cat_id)
    {
        $flag = false;
        $exists = $author->watchCetagoryId->contains($cat_id);
        if ($exists) {
            $flag = true;
            return $flag;
        }
        return $flag;
    }

    /**
     * Add  Video Category Id crossponding to loggin user because of suggestion
     *
     * @param  object author, integer $cat_id, integer $video_id
     * @return Redirect
     */

    public function updateUserVideoCategory(Author $author, $cat_id, $video_id)
    {
        $loggedUserId = session()->get("userId");
        $loggedUserInfo = Author::find($loggedUserId);
        if ($this->checkVideoCatId($loggedUserInfo,  $cat_id)) {
            return redirect()->route("videoUpload.singleVideo", [$video_id, $cat_id]);
        }
        $loggedUserInfo->watchCetagoryId()->attach($cat_id);
        return redirect()->route("videoUpload.singleVideo", [$video_id, $cat_id]);
    }

    /**
     * Change the subscription value in many to many table for subscription purpose
     *
     * @param  object author, integer $cat_id, integer $video_id, integer $userId
     * @return Redirect
     */

    public function subcribeCategory(Author $author, $cat_id, $userId, $video_id)
    {
        $user = Author::find($userId);
        $user->watchCetagoryId()->attach($cat_id, ['subscription' => 1]);
        return redirect()->route("videoUpload.singleVideo", [$video_id, $cat_id]);
    }


    /**
     * Change the subscription value to 0 in many to many table for unsubscription purpose
     *
     * @param  object author, integer $cat_id, integer $video_id, integer $userId
     * @return Redirect
     */

    public function unSubcribeCategory(Author $author, $cat_id, $userId, $video_id)
    {
        $user = Author::find($userId);
        author_videocetagories::where([['author_id', '=', $user->id], ['videocetagory_id', '=', $cat_id]])->update(["subscription" => 0]);
        return redirect()->route("videoUpload.singleVideo", [$video_id, $cat_id]);
    }
}
