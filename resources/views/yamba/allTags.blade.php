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
    <title>Tags List</title>
</head>

<body>
    <x-yamba.header />
    <div class="container">
        <div class="row">
            <div class="col-lg-10">
                <div class="card mt-4">
                    <div class="card-header">
                        <div class="col-lg-6">
                            <h2> <u><i>Welcome Admin</i></u></h2>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <h4> Here are the list of your Registered Tags </h4>
                </div>
                <div class="mt-3">
                    <div class="card mt-2 mb-5">
                        <div class="card-body">
                            @if(sizeof($allTags))
                            <table class="table table-striped table-dark">
                                <thead>
                                    <tr>
                                        <th scope="col">SNO</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <?php $sno = 0; ?>
                                <tbody>
                                    @foreach($allTags as $tag)
                                    <tr>
                                        <th scope="row" value="{{++$sno}}">{{$sno++}}</th>
                                        <td>{{$tag->name}}</td>
                                        <td><a href="deleteTag/{{$tag->id}}" class="btn btn-danger">Delete</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                            @if(!sizeof($allTags))
                            <h2 class="lead"> We don't have any categories yet!</h2>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 mt-5">
                <div class="row">
                    <div class="col-lg-12 mt-5 mb-3">
                        <div class="card">
                            <div class="card-body  pt-5 pb-5 bg-info text-white">
                                <i class="fa fa-comments"></i> Your number of Comments 05
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