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
    <title>Yamba</title>
</head>

<body>
    <x-yamba.header />
    <div class="container">
        <div class="row">
            <div class="col-lg-10">
                <div class="card mt-4">
                    <div class="card-header p-5 text-center">
                        <h2> <u>Welcome to Yamba</u> </h2>
                    </div>
                </div>
                <div class="mt-4">
                    <h4> Here are the list of blogs </h4>
                </div>
                <div class="mt-3">
                    @if(sizeof($data["posts"]))
                    @foreach($data["posts"] as $value)
                    <div class="card mt-2 mb-5">
                        <a href="{{route('Post.full', [$value->id])}}"><img class="card-img-top" src="{{asset('/storage/images/blogImage/'.$value->blogImg)}}" alt="Card image cap"></a>
                        <div class="card-body">
                            <h2 class="card-title">
                                <a href="{{route('Post.full', [$value->id])}}">{{$value->title}}</a> <br>
                            </h2>
                            <p class="muted lead">{{$value->created_at}}</p>
                            <p>{{strlen($value->body) > 300 ? substr($value->body, 0, 300) . '...' :$value->body }}</p>
                            <a href="{{route('Post.full', [$value->id])}}" class="btn btn-block btn-success">Read More >></a>
                        </div>
                    </div>
                    @endforeach
                    @endif
                    @if(!sizeof($data["posts"]))
                    <div class="card mt-2 mb-5">
                        <div class="card-body">
                            <h2 class="card-title">
                                Sorry we don't have any post yet
                            </h2>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-2 mt-5">
                <div class="row">
                    <div class="col-lg-12 mt-5 mb-3">
                        <div class="card">
                            <div class="card-body  pt-5 pb-5 bg-success text-white">
                                <i class="fa fa-users"></i> Total Number Of user {{sizeof($data["users"])}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mt-5 mb-3">
                        <div class="card">
                            <div class="card-body  pt-5 pb-5 bg-secondary text-white">
                                <i class="fa fa-edit"></i> Total Number Of Posts {{sizeof($data["posts"])}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mt-5 mb-3">
                        <div class="card">
                            <div class="card-body  pt-5 pb-5 bg-info text-white">
                                <i class="fa fa-comments"></i> Number Of Comments {{sizeof($data["comments"])}}
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