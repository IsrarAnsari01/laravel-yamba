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
    <title>Yamba</title>
</head>

<body>
    <x-yamba.header />
    <div class="container">
        <div class="row">
            <div class="col-lg-10">
                <div class="mt-4">
                    <h4 class="display-5"> <b><u>Here are the list of Videos</u></b></h4>
                </div>
                <div class="mt-1">
                    @if (sizeof($data['videos']))
                        @foreach ($data['videos'] as $video)
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="text-center"><b><i>Title:</i></b><a
                                            href="{{ route('videoUpload.single', [$video->id]) }}">
                                            {{ $video->Title }}</a></h3>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <p class="lead text-center">Posted Date:
                                                <b><u>{{ $video->created_at }}</u></b>
                                            </p>
                                        </div>
                                        <div class="col-lg-6">
                                            <p class="lead text-center">Views: <b><u>{{ $video->views }}</u></b> </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    @endif
                    @if (!sizeof($data['videos']))
                        <div class="card">
                            <div class="card-body">
                                <h2 class="text-center">
                                    Right Now we Don't have any Video
                                </h2>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="card mt-3">
                    <a href="{{ route('videoUpload.upload') }}" class="btn btn-dark btn-blog"> Post New Video</a>
                </div>
            </div>
            <div class="col-lg-2 mt-5">
                <div class="row">
                    <div class="col-lg-12 mt-5 mb-3">
                        <div class="card">
                            <div class="card-body  pt-5 pb-5 bg-success text-white">
                                <i class="fa fa-users"></i> Total Number Of user {{ sizeof($data['users']) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mt-5 mb-3">
                        <div class="card">
                            <div class="card-body  pt-5 pb-5 bg-secondary text-white">
                                <i class="fa fa-edit"></i> Total Number Of Posts {{ sizeof($data['posts']) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mt-5 mb-3">
                        <div class="card">
                            <div class="card-body  pt-5 pb-5 bg-info text-white">
                                <i class="fa fa-comments"></i> Number Of Comments {{ sizeof($data['comments']) }}
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
