<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("yamba/home");
    }

    public function postPage()
    {
        return view("yamba/post");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("yamba/addBlog");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $author_id)
    {
        $author = Author::find($author_id);
        $cat_id = $request->input("category");
        $postCat = Category::find($cat_id);
        $post = new Post();
        $post->title = $request->input("title");
        $post->body = $request->input("body");
        $post->author_id = $author->id;
        $post->cetagory_id = $postCat->id;
        $post->save();
        $tagIds = $request->input("tag_id");
        // $tagIds = [1, 2, 3];
        $post->tag()->attach($tagIds);
        return redirect("/");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view("allPosts")->with("allPosts", Post::all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post, $post_id)
    {
        return view("editPost")->with("singlePost", Post::find($post_id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post, $post_id, $author_id, $cat_id)
    {
        $author = Author::find($author_id);
        $postCat = Category::find($cat_id);
        $post = Post::find($post_id);
        $post->title = $request->input("title");
        $post->body = $request->input("body");
        $post->author_id = $author->id;
        $post->cetagory_id = $postCat->id;
        $post->save();
        $tagIds = $request->input("tag_id");
        // $tagIds = [1, 2, 3];
        $post->tag()->attach($tagIds);
        return redirect("/");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, $post_id)
    {
        Post::destroy(array("id", $post_id));
        return redirect("/");
    }
}
