<?php

namespace App\Http\Controllers;

use App\Models\Videocomment;
use App\Models\videoUpload;
use Illuminate\Http\Request;
use App\Models\Author;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class VideocommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request,  $author_id, $video_id)
    {
        $validator = Validator::make($request->all(), [
            'email'     => "required|email",
            'body'     => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            $author = Author::find($author_id);
            $comment = new Videocomment();
            $comment->email = $request->input("email");
            $comment->body = $request->input("body");
            $comment->author_id = $author->id;
            $comment->videoUpload_id = $video_id;
            $comment->save();
            return Redirect::to("SingleVideo/{$video_id}");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Videocomment  $Videocomment
     * @return \Illuminate\Http\Response
     */
    public function show(Videocomment $Videocomment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Videocomment  $Videocomment
     * @return \Illuminate\Http\Response
     */
    public function edit(Videocomment $Videocomment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Videocomment  $Videocomment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Videocomment $Videocomment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Videocomment  $Videocomment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Videocomment $Videocomment, $comment_id)
    {
        Videocomment::destroy(array("id", $comment_id));
        return redirect("/");
    }
}
