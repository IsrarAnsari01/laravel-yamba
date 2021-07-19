<?php
$userId = session()->get("userId");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/app.css')}}>)}}">
    <script src="{{asset('js/bootstrap.bundle.js')}}"></script>
    <title>Edit Blog Form</title>
</head>

<body>
    <x-yamba.header />
    <div class="container">
        <div class="row">
            <div class="col-lg-10">
                <div class="card bg-info mt-5 text-light">
                    <div class="card-body">
                        <h2 class="card-title lead"><i class="fa fa-edit"></i> Welcome Back edit {{$singlePost["post"]->title}}</h2>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{route('Post.update', [$singlePost['post']->id,$userId ])}}">
                            @csrf
                            <div class="mb-3">
                                <label for="studentName" class="form-label">Title</label>
                                <input type="text" pattern="[A-Za-z0-9 .]{3,}" value="{{$singlePost['post']->title}}" name="title" class="form-control" id="studentName" autocomplete="off" required>
                            </div>
                            @error('title')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                            <div class="form-group mb-3">
                                <label for="category">Select Mulitple Tags</label>
                                <select id="category" class="form-control" name="tag_id[]" multiple required>
                                    @if(sizeof($singlePost["tags"]))
                                    @foreach($singlePost["tags"] => $value)
                                    <option value={{$value->id}} selected>{{$value->name}}</option>
                                    @endforeach
                                    @endif
                                    @if(sizeof($singlePost["allTags"]))
                                    @foreach($singlePost["allTags"] => $value)
                                    <option value={{$value->id}} >{{$value->name}}</option>
                                    @endforeach
                                    @endif
                                    @if(!sizeof($singlePost["tags"]) || !sizeof($singlePost["allTags"]))
                                    <option selected disabled value="null">You Don't Select any tags</option>
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
                                    <option value="#">Select Category</option>
                                    @if(sizeof($singlePost["categories"]))
                                    @foreach($singlePost["categories"] as $key => $value)
                                    <option value={{$value->id}}>{{$value->name}}</option>
                                    @endforeach
                                    @endif
                                    @if(!sizeof($singlePost["categories"]))
                                    <option selected disabled value="null">We Don't have any Category write now</option>
                                    @endif
                                </select>
                            </div>
                            @error('category')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                            <div class="form-group mb-3">
                                <label for="exampleFormControlTextarea1">Enter Blog Text</label>
                                <textarea class="form-control" name="body" value="{{$singlePost['post']->body}}" id="exampleFormControlTextarea1" required rows="10"></textarea>
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
    <div class="mt-5">
        <div class=" pt-5">
            <x-yamba.footer />
        </div>
    </div>
</body>

</html>