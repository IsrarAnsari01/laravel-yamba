<?php
$userId = session()->get('userId');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}>)}}">
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    <title>Single Video</title>
</head>

<body>
    <x-yamba.header />
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9">
                <div class="mt-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe src="{{ asset('/storage/videos/' . $data['video']->videoTitle) }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <div class="row">
                                <div class="col-lg-8 mt-5">
                                    <h4>Posted By <b><u>{{$data['AuthorName']}}</u></b></h4>
                                    <h4>Views: {{ $data['video']->views }} </h4>
                                </div>
                                <div class="col-lg-4 mt-5">
                                    <h5 class="mt-2">Posted Date: {{ $data['video']->created_at }}</h5>
                                    @if($data["is_subs"])
                                    <a href="{{route('Author.unSubscribeCat', [$data['cat_id'], $userId, $data['video']->id])}}" class="btn btn-danger unsubsBtn" id="unsubs"> Unsubscribe</a>
                                    @endif
                                    @if(!$data["is_subs"])
                                    <a href="{{route('Author.subscribeCat', [$data['cat_id'], $userId, $data['video']->id])}}" class="btn btn-success subsBtn" id="subs"> Subscribe Now</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="mt-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="lead"> Posted Commnets</h4>
                        </div>
                        <div class="card-body">
                            @if (sizeof($data['videoComments']))
                            @foreach ($data['videoComments'] as $videoComment)
                            <p>Email: <b><u>{{ $videoComment->email }}</u></b></p>
                            <p class="ml-5">{{ $videoComment->body }}</p>
                            @endforeach
                            @endif
                            @if (!sizeof($data['videoComments']))
                            <h4 class="text-danger text-center"> This Video doesn't have any comments</h4>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mt-5">
                <p>Suggestions</p>
                <hr>
                @if (sizeof($data['suggestedVideo']))
                @foreach ($data['suggestedVideo'] as $suggestedVideo)
                <div class="card">
                    <div class="header mt-4 ml-1">
                        <h5><b><i>Title:</i></b><a href="{{ route('videoUpload.single', [$suggestedVideo->id]) }}">
                                {{ $suggestedVideo->Title }}</a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="ml-3">Posted Date: <b>{{ Carbon\Carbon::parse($suggestedVideo->created_at)->diffForHumans(); }}</b><br>Views:
                            <b>{{ $suggestedVideo->views }}</b>
                        </p>
                    </div>
                </div>
                <hr>
                @endforeach
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9">
                <div class="card mt-4">
                    <div class="card-header bg-secondary  mb-4">
                        <h2 class="h2 text-center text-light"><u>Add new Comment</u></h2>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('VideoComment.save', [$userId, $data['video']->id, $data['cat_id']]) }}">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Email Address</label>
                                <input type="email" name="email" pattern="[A-Za-z_0-9]{3,}@[A-Za-z_0-9]{3,}[.][A-Za-z.]{2,}" autocomplete="off" minlength="5" maxlength="40" class="form-control" id="exampleInputPassword1" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="exampleFormControlTextarea1">Enter Comment Text</label>
                                <textarea class="form-control" name="body" id="exampleFormControlTextarea1" required rows="10"></textarea>
                            </div>
                            <button type="submit" class="btn btn-block btn-primary">Submit</button>
                        </form>
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
    <script src="{{asset('js/myOwnScript.js')}}"></script>
</body>

</html>