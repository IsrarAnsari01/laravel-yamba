<?php

namespace App\Http\Controllers;

use App\Models\videoUpload;
use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Comment;
use App\Models\Post;

class VideoUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allUsers = Author::all();
        $allComments = Comment::all();
        $allPosts = Post::all();
        $arrToBeSend = array("posts" => $allPosts, "users" => $allUsers, "comments" => $allComments);
        return view("yamba/videoDashboard")->with("data", $arrToBeSend);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\videoUpload  $videoUpload
     * @return \Illuminate\Http\Response
     */
    public function show(videoUpload $videoUpload)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\videoUpload  $videoUpload
     * @return \Illuminate\Http\Response
     */
    public function edit(videoUpload $videoUpload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\videoUpload  $videoUpload
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, videoUpload $videoUpload)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\videoUpload  $videoUpload
     * @return \Illuminate\Http\Response
     */
    public function destroy(videoUpload $videoUpload)
    {
        //
    }
}
