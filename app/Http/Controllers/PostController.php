<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Author;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allPosts = Post::orderBy('created_at', 'desc')->limit(5)->get();
        $allUsers = Author::all();
        $allComments = Comment::all();
        $arrToBeSend = array("posts" => $allPosts, "users" => $allUsers, "comments" => $allComments);
        return view("yamba/home")->with("data", $arrToBeSend);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!session()->get("userId")) {
            return Redirect::to('loginPage');
        }
        $registeredTags = Tag::all();
        $registeredCategories = Category::all();
        $tagsAndCategories = array("tags" => $registeredTags, "categories" => $registeredCategories);
        return view("yamba/addBlog")->with("tagsAndCats", $tagsAndCategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $author_id)
    {
        $post = new Post();
        $cat_id = $request->input("category");
        $post->title = $request->input("title");
        $post->body = $request->input("body");
        $post->author_id = $author_id;
        $post->category_id = $cat_id;
        $post->save();
        $tagIds = $request->input("tag_id");
        $post->tag()->attach($tagIds);
        return Redirect::to("/addBlog");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $allUsers = Author::all();
        $categories = Category::all();
        $postAnduser = array("posts" => Post::all(), "userLength" => sizeof($allUsers), "catgories" => $categories);
        return view("yamba/post")->with("retriveAllPost", $postAnduser);
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
        $userId = session()->get("userId");
        return Redirect::to("authorDashboard/{$userId}");
    }

    public function filterPost(Request $request)
    {
        $filter = true;
        $allUsers = Author::all();
        $categories = Category::all();
        $cat_id = $request->input("filterCat");
        $cat_posts = Category::find($cat_id)->post;
        $postAnduser = array("posts" => $cat_posts, "userLength" => sizeof($allUsers), "catgories" => $categories, "flag" => $filter);
        return view("yamba/post")->with("retriveAllPost", $postAnduser);
    }
}
