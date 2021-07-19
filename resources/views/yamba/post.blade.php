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
                <div class="mt-4">
                    @if(sizeof($retriveAllPost["posts"]))
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card mt-4">
                                <div class="card-header bg-dark ">
                                    <h2 class="lead text-white">Filter Our Blogs Through Category And Tags</h2>
                                </div>
                            </div>
                        </div>
                        @if(sizeof($retriveAllPost["catgories"]))
                        <div class="col-lg-4">
                            <div class="card mt-2">
                                <div class="card-body">
                                    <p>Select Category</p>
                                    <form class="form-inline my-2 my-lg-0" method="post" action="{{route('Post.find')}}">
                                        @csrf
                                        <div class="form-group">
                                            <select name="filterCat" class="form-control" id="filterCat">
                                                <option value="NUll" disabled selected> Chose one</option>
                                                @foreach($retriveAllPost["catgories"] as $value)
                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(sizeof($retriveAllPost["registerTags"]))
                        <div class="col-lg-4">
                            <div class="card mt-2">
                                <div class="card-body">
                                    <p>Select Tags</p>
                                    <form class="form-inline my-2 my-lg-0" method="post" action="{{route('Post.findTags')}}">
                                        @csrf
                                        <div class="form-group">
                                            <select name="tag_ids[]" class="form-control" id="filterCat" multiple>
                                                <option value="NUll" disabled selected> Chose one</option>
                                                @foreach($retriveAllPost["registerTags"] as $value)
                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endif
                    @if($retriveAllPost["flag"])
                    <div class="row">
                        <a href="post" class="btn btn-block btn-danger"> Reset Now</a>
                    </div>
                    @endif
                </div>
                <div class="mt-4">
                    @if(sizeof($retriveAllPost["posts"]))
                    @foreach($retriveAllPost["posts"] as $key => $value)
                    <div class="card mt-2 mb-5">
                        <a href="{{route('Post.full', [$value->id])}}"><img class="card-img-top" src="{{asset('/storage/images/blogImage/'.$value->blogImg)}}" alt="Card image cap"></a>
                        <div class="card-body">
                            <h2 class="card-title">
                                <a href="{{route('Post.full', [$value->id])}}">{{$value->title}}</a> <br>
                            </h2>
                            <p class="muted lead">{{$value->created_at}}</p>
                            <p>{{strlen($value->body) > 250 ? substr($value->body, 0, 250) . '...' :$value->body }}</p>
                            <a href="{{route('Post.full', [$value->id])}}" class="btn btn-block btn-success">Read More >></a>
                        </div>
                    </div>
                    @endforeach
                    @endif
                    @if(!sizeof($retriveAllPost["posts"]))
                    <div class="card mt-2 mb-5">
                        <div class="card-body">
                            <h2 class="card-title">
                                Sorry We don't have any post yet!
                            </h2>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="mt-4 pt-4">
                    <a href="/addBlog" class="btn btn-block btn-info">Add new Blog</a>
                </div>
            </div>
            <div class="col-lg-2 mt-5">
                <div class="row">
                    <div class="col-lg-12 mt-5 mb-3">
                        <div class="card">
                            <div class="card-body  pt-5 pb-5 bg-success text-white">
                                <i class="fa fa-users"></i> Total Number Of user {{$retriveAllPost["userLength"]}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mt-5 mb-3">
                        <div class="card">
                            <div class="card-body  pt-5 pb-5 bg-secondary text-white">
                                <i class="fa fa-edit"></i> Total Number Of Posts {{sizeof($retriveAllPost["posts"])}}
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
    </div>
    <div class="mt-5">
        <div class=" pt-5">
            <x-yamba.footer />
        </div>
    </div>
</body>

</html>