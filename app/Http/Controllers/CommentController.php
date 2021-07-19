<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Author;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class CommentController extends Controller
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
    public function store(Request $request, $author_id, $post_id)
    {
        $validator = Validator::make($request->all(), [
            'email'     => "required|email|unique:users",
            'body'     => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            $author = Author::find($author_id);
            $post = Post::find($post_id);
            $comment = new Comment();
            $comment->email = $request->input("email");
            $comment->body = $request->input("body");
            $comment->author_id = $author->id;
            $comment->post_id = $post->id;
            $comment->save();
            return Redirect::to("fullPost/{$post_id}");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment, $postid)
    {
        $post_comments = Post::find($postid)->comment;
        return $post_comments;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment, $comment_id)
    {
        Comment::destroy(array("id", $comment_id));
        return redirect("/");
    }
}
