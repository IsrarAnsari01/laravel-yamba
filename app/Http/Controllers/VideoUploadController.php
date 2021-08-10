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
use Illuminate\Support\Facades\Mail;
use App\Mail\VideoNotification;

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
     * Extract users Id from user Array return ids of user
     * @param array $users
     * @return array Ids
     */

    public function filterUserIds($userArr)
    {
        $ids = array();
        if (sizeof($userArr)) {
            for ($i = 0; $i < sizeof($userArr); $i++) {
                if (!in_array($userArr[$i]->author_id, $ids)) {
                    array_push($ids, $userArr[$i]->author_id);
                }
            }
        }
        return $ids;
    }


    /**
     * Extract users Emails from user Array return emails of user
     * @param array $userIds
     * @return array user Emails
     */


    public function userEmails($userIds)
    {
        $userEmails = array();
        if (sizeof($userIds)) {
            foreach ($userIds as $userId) {
                $user = Author::find($userId);
                array_push($userEmails, $user->email);
            }
        }
        return $userEmails;
    }


    /**
     * Send Subscribed User email about new video
     * @param array $userEmails, array $data
     * @return NULL
     */

    public function sendMailsToUser($userEmails, $data)
    {
        if (sizeof($userEmails)) {
            foreach ($userEmails as $email) {
                Mail::to($email)->send(new VideoNotification($data));
            }
        }
    }

    /**
     * Store a newly uploaded video in storage.
     *
     * @param  \Illuminate\Http\Request  $request, integer $author_id
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
            $subscribedUsers = DB::table("author_videocetagories")->where(["subscription" => 1])->get();
            $userIds = $this->filterUserIds($subscribedUsers);
            $userEmails = $this->userEmails($userIds);
            $author = Author::find($author_id);
            $data = array("username" => $author, "title" => $video->title);
            $this->sendMailsToUser($userEmails, $data);
            return Redirect::to("allVideos");
        }
    }

    /**
     * Rediect for update Views
     *
     * @param  \App\Models\videoUpload  $videoUpload, integer $video_id
     * @return Redirect
     */

    public function show(videoUpload $videoUpload, $video_id)
    {
        if (!session()->get("userId")) {
            return Redirect::to('loginPage');
        }
        return redirect()->route('videoUpload.updateView', [$video_id]);
    }

    /**
     * Filter Videos and remove that specfic video from suggestions that are going to play
     *
     * @param  array $videoArray, integer $video_id that will remove
     * @return array Filtered videoArray
     */

    public function filterVideos($videoArray, $video_id)
    {
        foreach ($videoArray as $key => $video) {
            if ($video->id == $video_id) {
                unset($videoArray[$key]);
                break;
            }
        }
        return $videoArray;
    }

    /**
     * Extract Watch Category Ids for suggestions purpose
     *
     * @param  array $userWatchCatId
     * @return array $catIdsArray (Just Ids)
     */

    public function getCatId($userWatchCatId)
    {
        $catIdsArray = array();
        if (sizeof($userWatchCatId)) {
            foreach ($userWatchCatId as $cat_id) {
                array_push($catIdsArray, $cat_id->id);
            }
        }
        return $catIdsArray;
    }


    /**
     * Check Subscription of user via he subscribed or not
     *
     * @param  object $user, integer $cat_id
     * @return boolean $exist
     */

    public function checkSubscription($user, $cat_id)
    {
        $exist = false;
        $subscribed = DB::table("author_videocetagories")->where([['author_id', '=', $user->id], ['videocetagory_id', '=', $cat_id], ['subscription', '=', 1]])->get();
        if (sizeof($subscribed)) {
            $exist = true;
            return $exist;
        }
        return $exist;
    }

    /**
     * Play Single Video also show suggestions, comments also comment form
     *
     * @param  Model videoUpload, integer $cat_id,integer $video_id
     * @return Redirect
     */

    public function singleVideo(videoUpload $videoUpload, $video_id, $cat_id)
    {
        $singleVideo = videoUpload::find($video_id);
        $loggedUserId = session()->get("userId");
        $loggedUser = Author::find($loggedUserId);
        $videoComments = $singleVideo->Videocomment;
        $videoAuthor = $singleVideo->author;
        $videoCategory = $singleVideo->category;
        $watchVideoCatId = $loggedUser->watchCetagoryId;
        $checkSubs = $this->checkSubscription($loggedUser, $cat_id);
        $arrOfVideoCat = $this->getCatId($watchVideoCatId);
        $relatedVideos = DB::table('video_uploads')->whereIn('videocetagory_id', $arrOfVideoCat)->orderBy('created_at', 'desc')->limit(10)->get();
        if ($relatedVideos) {
            $filterArray = $this->filterVideos($relatedVideos, $video_id);
            $dataToBeSend = array("video" => $singleVideo, "videoComments" => $videoComments, "suggestedVideo" => $filterArray, "AuthorName" => $videoAuthor->name, "cat_id" => $videoCategory->id, "is_subs" => $checkSubs);
            return view("yamba/singleVideo")->with("data", $dataToBeSend);
        }
        $random10Videos = videoUpload::orderBy('created_at', 'desc')->take(10)->get();
        $filterArray = $this->filterVideos($random10Videos, $video_id);
        $dataToBeSend = array("video" => $singleVideo, "videoComments" => $videoComments, "suggestedVideo" => $filterArray, "AuthorName" => $videoAuthor->name, "cat_id" => $videoCategory->id, "is_subs" => $checkSubs);
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

    /**
     * Update the views of video
     * @param Model videoUpload, integer $video_id
     * @return Redirect
     */

    public function updateViews(videoUpload $videoUpload, $video_id)
    {
        $video = videoUpload::find($video_id);
        if ($video) {
            $video->views += 1;
            $video->save();
            return redirect()->route('Author.updateCatId', [$video->videocetagory_id, $video_id]);
        }
    }
}
