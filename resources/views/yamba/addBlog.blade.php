<?php
$userId = session()->get("userId");
?>
@extends('yamba.app')
@section("mainContent")
<div class="container">
    <div class="row">
        <div class="col-lg-10">
            <div class="card bg-info mt-5 text-light">
                <div class="card-body">
                    <h2 class="card-title lead"><i class="fa fa-edit"></i> Welcome Back use add new blog</h2>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form method="post" action="submitPost/{{$userId}}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="studentName" class="form-label">Title</label>
                            <input type="text" pattern="[A-Za-z0-9 .]{3,}" name="title" class="form-control" id="studentName" autocomplete="off" required>
                        </div>
                        @error('title')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                        <div class="form-group mb-3">
                            <label for="category">Select Mulitple Tags</label>
                            <select id="category" class="form-control" name="tag_id[]" multiple required>
                                <option disabled selected>Choose one</option>
                                @if(sizeof($tagsAndCats["tags"]))
                                @foreach($tagsAndCats["tags"] as $key => $value)
                                <option value={{$value->id}}>{{$value->name}}</option>
                                @endforeach
                                @endif
                                @if(!sizeof($tagsAndCats["tags"]))
                                <option selected disabled value="null">We Don't have any tags write now</option>
                                @endif
                            </select>
                        </div>
                        @error('tag_id')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                        <div class="form-group mb-3">
                            <label for="category">Select Category</label>
                            <select id="category" class="form-control" name="category" required>
                                <option disabled selected>Choose one</option>
                                @if(sizeof($tagsAndCats["categories"]))
                                @foreach($tagsAndCats["categories"] as $key => $value)
                                <option value={{$value->id}}>{{$value->name}}</option>
                                @endforeach
                                @endif
                                @if(!sizeof($tagsAndCats["categories"]))
                                <option selected disabled value="null">We Don't have any Category write now</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Add Blog image</label>
                            <input type="file" name="image" required class="form-control-file" id="exampleFormControlFile1">
                        </div>
                        @error('category')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                        <div class="form-group mb-3">
                            <label for="exampleFormControlTextarea1">Enter Blog Text</label>
                            <textarea class="form-control" name="body" id="exampleFormControlTextarea1" required rows="10"></textarea>
                        </div>
                        @error('body')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-2 mt-5">
            <div class="row">
                <div class="col-lg-12 mt-5 mb-3">
                    <div class="card">
                        <div class="card-body  pt-5 pb-5 bg-success text-white">
                            <i class="fa fa-users"></i> Total Number Of user 02
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 mt-5 mb-3">
                    <div class="card">
                        <div class="card-body  pt-5 pb-5 bg-secondary text-white">
                            <i class="fa fa-edit"></i> Total Number Of Posts 02
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 mt-5 mb-3">
                    <div class="card">
                        <div class="card-body  pt-5 pb-5 bg-info text-white">
                            <i class="fa fa-comments"></i> Number Of Comments 02
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection