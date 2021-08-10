<?php
$userId = session()->get("userId");
?>
@extends('yamba.app')
@section("mainContent")
<div class="container">
    <div class="row">
        <div class="col-lg-10">
            <div class="mt-4">
                @if($data["post"])
                <div class="card mt-2 mb-5">
                    <img class="card-img-top" src="{{asset('/storage/images/blogImage/'.$data['post']->blogImg)}}" alt="Card image cap">
                    <div class="card-body">
                        <h2 class="card-title">
                            {{$data["post"]->title}}
                        </h2>
                        <p class="muted small lead">{{$data["post"]->created_at}}</p>
                        @if(sizeof($data["postTags"]))
                        <p class="lead">Tags:
                            @foreach($data["postTags"] as $postTag)
                            <span><b><u>{{$postTag->name}}</u></b></span>
                            @endforeach
                        </p>
                        @endif
                        <p>{{ $data["post"]->body}}</p>
                    </div>
                </div>
                @endif
                @if(!$data["post"]->body))
                <div class="card mt-2 mb-5">
                    <div class="card-body">
                        <h2 class="card-title">
                            Sorry We don't have any post yet!
                        </h2>
                    </div>
                </div>
                @endif
            </div>
            <hr>
            <div class="mt-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="lead"> Posted Commnets</h4>
                    </div>
                    <div class="card-body">
                        @if(sizeof($data["postComment"]))
                        @foreach($data["postComment"] as $postComment)
                        <p>Email: <b><u>{{$postComment->email}}</u></b></p>
                        <p class="ml-5">{{$postComment->body}}</p>
                        @endforeach
                        @endif
                        @if(!sizeof($data["postComment"]))
                        <h3 class="text-danger text-center"> This Post doesn't have any comments</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 mt-5">
            <div class="row">
                <div class="col-lg-12 mt-5 mb-3">
                    <div class="card">
                        <div class="card-body  pt-5 pb-5 bg-success text-white">
                            <i class="fa fa-users"></i> Total Number Of user {{$data["userLength"]}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 mt-5 mb-3">
                    <div class="card">
                        <div class="card-body  pt-5 pb-5 bg-secondary text-white">
                            <i class="fa fa-edit"></i> Total Number Of Posts {{$data["postLength"]}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 mt-5 mb-3">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mt-4">
                <div class="card-header bg-danger  mb-4">
                    <h2 class="h2 text-center text-light"><u>Add new Comment</u></h2>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('Comment.save', [$userId, $data['post']->id])}}">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Email Address</label>
                            <input type="email" name="email" pattern="[A-Za-z_0-9]{3,}@[A-Za-z_0-9]{3,}[.][A-Za-z.]{2,}" autocomplete="off" minlength="5" maxlength="40" class="form-control" id="exampleInputPassword1" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="exampleFormControlTextarea1">Enter Comment Text</label>
                            <textarea class="form-control" name="body" id="exampleFormControlTextarea1" required rows="10"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection