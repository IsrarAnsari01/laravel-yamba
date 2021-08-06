<?php

namespace App\Http\Controllers;

use App\Models\Author;
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
        $sendArray = array("basicInfo" => $userInformation, "userPosts" => $userPosts, "userComments" => $userComments, "PostedVideos" => $userPostedVideos );
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
            $findUser = DB::table("authors")->where(["email" => $userEmail, "password" => $userPassword])->first();
            if ($findUser) {
                session(["userId" => $findUser->id]);
                return redirect("authorDashboard/{$findUser->id}");
            }
            return redirect("/loginPage");
        }
    }

    public function logoutUser(Request $request)
    {
        $request->session()->flush();
        return Redirect::to('/');
    }
    public function checkVideoCatId($catIdArr , $cat_id){
            $flag = false;
            if(sizeof($catIdArr)){
                foreach($catIdArr as $cat) {
                    if($cat == $cat_id){
                        $flag = true;
                        break;
                    }
                }
            }
            return $flag;
    }
    public function updateUserVideoCategory(Author $author, $cat_id, $video_id){
            $loggedUserId = session()->get("userId");
            $loggedUserInfo = Author::find($loggedUserId);
            $registeredCat_id = $loggedUserInfo->videoCat_id;
            if($this->checkVideoCatId($registeredCat_id,  $cat_id)){
                return redirect()->route("videoUpload.singleVideo", [$video_id]);
            }
            array_push($registeredCat_id,  $cat_id);
                $loggedUserInfo->videoCat_id = $registeredCat_id;
                $loggedUserInfo->save();
            return redirect()->route("videoUpload.singleVideo", [$video_id]);
    }
}
