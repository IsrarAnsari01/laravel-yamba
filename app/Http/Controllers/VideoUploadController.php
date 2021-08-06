<?php

namespace App\Http\Controllers;

use App\Models\videoUpload;
use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Videocetagory;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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
        $allVideo = videoUpload::all();
        $arrToBeSend = array("posts" => $allPosts, "users" => $allUsers, "comments" => $allComments, "videos" => $allVideo);
        return view("yamba/videoDashboard")->with("data", $arrToBeSend);
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
        $allVideoCategories = Videocetagory::all();
        $videoCat = array("videoCat" => $allVideoCategories);
        return view("yamba/addNewVideo")->with("data", $videoCat);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $author_id)
    {
        $validator = Validator::make($request->all(), [
            'title'      => 'required|unique:posts|max:255',
            'category' => 'required',
            'video' => 'mimes:mp4,mpeg,quicktime|required|max:100000',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            $filenameWithExt = $request->file('video')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('video')->getClientOriginalExtension();
            $fileNameToStore = $filename . "_" . time() . "." . $extension;
            $path = $request->file('video')->storeAs("public/videos", $fileNameToStore);
            $video = new videoUpload();
            $cat_id = $request->input("category");
            $video->title = $request->input("title");
            $video->videoTitle = $fileNameToStore;
            $video->author_id = $author_id;
            $video->videocetagory_id = $cat_id;
            $video->save();
            // $tagIds = $request->input("tag_id");
            // $post->tag()->attach($tagIds);
            return Redirect::to("allVideos");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\videoUpload  $videoUpload
     * @return \Illuminate\Http\Response
     */
    public function show(videoUpload $videoUpload, $video_id)
    {
        if (!session()->get("userId")) {
            return Redirect::to('loginPage');
        }
        return redirect()->route('videoUpload.updateView', [$video_id]);
    }

    public function filterVideos($videoArray, $video_id) {
        foreach ($videoArray as $key => $video) {
            if($video->id == $video_id){
                unset($videoArray[$key]);
                break;
            }
        }
        return $videoArray;
    }
    public function singleVideo(videoUpload $videoUpload, $video_id) {
        $singleVideo = videoUpload::find($video_id);
        $loggedUserId = session()->get("userId");
        $loggedUser = Author::find($loggedUserId);
        $userWatchedCategoryId = $loggedUser->videoCat_id;
        $videoComments = $singleVideo->Videocomment;
        $relatedVideos = DB::table('video_uploads')->whereIn('videocetagory_id', $userWatchedCategoryId)->orderBy('created_at', 'desc')->limit(10)->get();
       if($relatedVideos){
        $filterArray = $this->filterVideos($relatedVideos, $video_id);
        $dataToBeSend = array("video" => $singleVideo, "videoComments" => $videoComments, "suggestedVideo" => $filterArray);
        return view("yamba/singleVideo")->with("data", $dataToBeSend);
       }
        $random10Videos = videoUpload::orderBy('created_at', 'desc')->take(10)->get();
        $filterArray = $this->filterVideos($random10Videos, $video_id);
        $dataToBeSend = array("video" => $singleVideo, "videoComments" => $videoComments, "suggestedVideo" => $filterArray );
        return view("yamba/singleVideo")->with("data", $dataToBeSend);
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
    public function destroy(videoUpload $video_id, $id)
    {
        videoUpload::destroy(array("id", $id));
        $userId = session()->get("userId");
        return Redirect::to("authorDashboard/{$userId}");
    }
    public function updateViews(videoUpload $videoUpload, $video_id) {
        $video = videoUpload::find($video_id);
        if($video) {
        $video->views += 1;
        $video->save();
        return redirect()->route('Author.updateCatId', [$video->videocetagory_id, $video_id]);
    }
    }
}
