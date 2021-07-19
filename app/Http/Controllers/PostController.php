<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Author;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Home Page | Get Req 
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
     * Add Blog Page | Get Req 
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
     * Save New Blog | Post Req 
     */
    public function store(Request $request, $author_id)
    {
        $validator = Validator::make($request->all(), [
            'title'      => 'required|unique:posts|max:255',
            'tag_id'     => 'required',
            'category' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
            'body'     => 'required',

        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename . "_" . time() . "." . $extension;
            $path = $request->file('image')->storeAs("public/images/blogImage", $fileNameToStore);
            $post = new Post();
            $cat_id = $request->input("category");
            $post->title = $request->input("title");
            $post->body = $request->input("body");
            $post->blogImg = $fileNameToStore;
            $post->author_id = $author_id;
            $post->category_id = $cat_id;
            $post->save();
            $tagIds = $request->input("tag_id");
            $post->tag()->attach($tagIds);
            return Redirect::to("/addBlog");
        }
    }
    /**
     * Display All Posts | Get Req 
     */
    public function show(Post $post)
    {
        $allUsers = Author::all();
        $categories = Category::all();
        $registeredTags = Tag::all();
        $postAnduser = array("posts" => Post::all(), "userLength" => sizeof($allUsers), "catgories" => $categories, "registerTags" => $registeredTags, "flag" => false);
        return view("yamba/post")->with("retriveAllPost", $postAnduser);
    }

    /**
     * Edit Blog Page | Get Req 
     */

    public function edit(Post $post, $post_id)
    {
        $registeredCategories = Category::all();
        $allTags = Tag::all();
        $post = Post::find($post_id);
        $postTag = $post->tag;
        $tagsAndCategories = array("tags" => $postTag, "categories" => $registeredCategories, "post" => $post, "allTags" => $allTags);
        return view("yamba/edit")->with("singlePost", $tagsAndCategories);
    }

    /**
     * Save Updates | Get Req 
     */
    public function update(Request $request, Post $post, $post_id, $author_id)
    {
        $validator = Validator::make($request->all(), [
            'title'      => 'required|unique:posts|max:255',
            'tag_id'     => 'required',
            'category' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
            'body'     => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            $post = Post::find($post_id);
            $post->title = $request->input("title");
            $post->body = $request->input("body");
            $post->author_id = $author_id;
            $post->cetagory_id = $request->input("category");
            $post->save();
            $tagIds = $request->input("tag_id");
            $post->tag()->attach($tagIds);
            return Redirect::to("post");
        }
    }

    /**
     * Delete Post | Get Req 
     */
    public function destroy(Post $post, $post_id)
    {
        Post::destroy(array("id", $post_id));
        $userId = session()->get("userId");
        return Redirect::to("authorDashboard/{$userId}");
    }


    /**
     * Filter Post Through Category | Post Req 
     */

    public function filterPost(Request $request)
    {
        $filter = true;
        $allUsers = Author::all();
        $categories = Category::all();
        $registeredTags = Tag::all();
        $cat_id = $request->input("filterCat");
        $cat_posts = Category::find($cat_id)->post;
        $postAnduser = array("posts" => $cat_posts, "userLength" => sizeof($allUsers), "registerTags" => $registeredTags, "catgories" => $categories, "flag" => $filter);
        return view("yamba/post")->with("retriveAllPost", $postAnduser);
    }

    /**
     * Get Tags and return related Post 
     */

    public function sortingPosts($tags)
    {
        $filterPost = array();
        $tag_posts = array();
        foreach ($tags as $tag) {
            array_push($filterPost, $tag->posts);
        }
        foreach ($filterPost as $posts) {
            foreach ($posts as $singlePost) {
                array_push($tag_posts, $singlePost);
            }
        }
        return $tag_posts;
    }
    /**
     * Filter post through Tags | Post Req 
     */

    public function filterPostThroughTags(Request $request)
    {
        $filter = true;
        $allUsers = Author::all();
        $categories = Category::all();
        $registeredTags = Tag::all();
        $tag_ids = $request->input("tag_ids");
        $tags = Tag::find($tag_ids);
        $tag_posts = $this->sortingPosts($tags);
        $postAnduser = array("posts" => $tag_posts, "userLength" => sizeof($allUsers), "registerTags" => $registeredTags, "catgories" => $categories, "flag" => $filter);
        return view("yamba/post")->with("retriveAllPost", $postAnduser);
    }

    public function singlePost(Post $post, $post_id)
    {
        if (!session()->get("userId")) {
            return Redirect::to('loginPage');
        }
        $allUsers = Author::all();
        $posts = Post::all();
        $singlePost = Post::find($post_id);
        $postTags = $singlePost->tag;
        $postComment = $singlePost->comment;
        $post = array("post" => $singlePost, "postTags" => $postTags, "postComment" => $postComment, "userLength" => sizeof($allUsers), "postLength" => sizeof($posts));
        return view("yamba/singlePost")->with("data", $post);
    }
}
