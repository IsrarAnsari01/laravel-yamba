<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

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
        $author = new Author();
        $author->name = $request->input("name");
        $author->email = $request->input("email");
        $author->password = $request->input("password");
        $author->save();
        return Redirect::to("/loginPage");
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
        $userInformation = Author::find($authorId);
        $sendArray = array("basicInfo" => $userInformation, "userPosts" => $userPosts, "userComments" => $userComments);
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
        $author = Author::find($request->id);
        $author->name = $request->input("name");
        $author->email = $request->input("email");
        $author->password = $request->input("password");
        $author->save();
        $updatedUser = Author::find($request->id);
        return redirect("authorDashboard/$updatedUser->id");
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
        $userEmail = $request->input("email");
        $userPassword = $request->input("password");
        $findUser = DB::table("authors")->where(["email" => $userEmail, "password" => $userPassword])->first();
        if ($findUser) {
            session(["userId" => $findUser->id]);
            return redirect("authorDashboard/{$findUser->id}");
        }
        return redirect("/loginPage");
    }

    public function logoutUser(Request $request)
    {
        $request->session()->flush();
        return Redirect::to('/');
    }
}
