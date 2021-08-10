<?php
$userId = session("userId");
?>

@extends('yamba.app')
@section("mainContent")
<div class="container">
    <div class="row">
        <div class="col-lg-10">
            <div class="card mt-4">
                <div class="card-header">
                    <div class="col-lg-6">
                        <h2> <u><i>Welcome {{$userInfo['basicInfo']->name}}</i></u></h2>
                    </div>
                    <div class="col-lg-6 mt-4 ml-auto">
                        <a href="{{route('Author.logout')}}" class="btn btn-block btn-danger"> Logout</a>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <h4> Here are the list of your posted blogs </h4>
            </div>
            <div class="mt-3">
                <div class="card mt-2 mb-5">
                    <div class="card-body">
                        @if(sizeof($userInfo["userPosts"]))
                        <table class="table table-striped table-dark">
                            <thead>
                                <tr>
                                    <th scope="col">SNO</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sno = 0; ?>
                                @foreach($userInfo["userPosts"] as $value)
                                <tr>
                                    <th scope="row">{{++$sno}}</th>
                                    <td>{{$value->title}}</td>
                                    <td><a href="{{route('Post.edit', [$value->id])}}" class="btn btn-warning">Edit</a></td>
                                    <td><a href="{{route('Post.delete', [$value->id])}}" class="btn btn-danger">Delete</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                        @if(!sizeof($userInfo["userPosts"]))
                        <h4>You don't post any post yet!</h4>
                        @endif
                    </div>
                </div>
            </div>
            <hr>
            <br>
            <hr>
            <div class="mt-3">
                <div class="card mt-2 mb-5">
                    <div class="card-body">
                        @if(sizeof($userInfo["PostedVideos"]))
                        <table class="table table-striped table-dark">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sno = 0; ?>
                                @foreach($userInfo["PostedVideos"] as $value)
                                <tr>
                                    <th scope="row">{{$value->id}}</th>
                                    <td>{{$value->Title}}</td>
                                    <td><a href="{{ route('videoUpload.delete', [$value->id]) }}" class="btn btn-danger">Delete</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                        @if(!sizeof($userInfo["PostedVideos"]))
                        <h4>You don't post any Video yet!</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 mt-5">
            <div class="row">
                <div class="col-lg-12 mt-5 mb-3">
                    <div class="card">
                        <div class="card-body pt-5 pb-5 bg-danger text-white">
                            <a href="{{route('Author.delete', [$userId])}}" class="text-white btn btn-danger"><i class="fa fa-edit"></i> DELETE ACC </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 mt-5 mb-3">
                    <div class="card">
                        <div class="card-body  pt-5 pb-5 bg-info text-white">
                            <a href="{{route('Author.updatePage', [$userId])}}" class="text-white btn btn-info"><i class="fa fa-edit"></i> UPDATE </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 mt-5 mb-3">
                    <div class="card">
                        <div class="card-body  pt-5 pb-5 bg-info text-white">
                            <i class="fa fa-comments"></i> Your number of Comments {{sizeof($userInfo["userComments"])}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection