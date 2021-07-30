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
                    <h4> Here are the list of Videos </h4>
                </div>
                <div class="mt-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/DTjibK1z0Vo" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <div>
                                <p class="lead">Cetagory: <b><u>Sports</u></b> </p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/DTjibK1z0Vo" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <div>
                                <p class="lead">Cetagory: <b><u>Sports</u></b> </p>
                            </div>
                        </div>
                    </div>
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