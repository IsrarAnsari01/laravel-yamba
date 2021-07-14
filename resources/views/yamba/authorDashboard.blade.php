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
    <title>Dashboard</title>
</head>

<body>
    <x-yamba.header />
    <div class="container">
        <div class="row">
            <div class="col-lg-10">
                <div class="card mt-4">
                    <div class="card-header">
                        <h2> Welcome {{$userInfo['basicInfo']->name}} </h2>
                    </div>
                </div>
                <div class="mt-4">
                    <h4> Here are the list of your posted blogs </h4>
                </div>
                <div class="mt-3">
                    <div class="card mt-2 mb-5">
                        <div class="card-body">
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
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Rain In KRK</td>
                                        <td><a href="#" class="btn btn-warning">Edit</a></td>
                                        <td><a href="#" class="btn btn-danger">Delete</a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Rain In KRK</td>
                                        <td><a href="#" class="btn btn-warning">Edit</a></td>
                                        <td><a href="#" class="btn btn-danger">Delete</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 mt-5">
                <div class="row">
                    <div class="col-lg-12 mt-5 mb-3">
                        <div class="card">
                            <div class="card-body pt-5 pb-5 bg-danger text-white">
                                <a href="deleteUser/{{$userInfo['basicInfo']->id}}" class="text-white btn btn-danger"><i class="fa fa-edit"></i> DELETE ACC </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mt-5 mb-3">
                        <div class="card">
                            <div class="card-body  pt-5 pb-5 bg-info text-white">
                                <a href="updateInformation/{{$userInfo['basicInfo']->id}}" class="text-white btn btn-info"><i class="fa fa-edit"></i> UPDATE </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mt-5 mb-3">
                        <div class="card">
                            <div class="card-body  pt-5 pb-5 bg-info text-white">
                                <i class="fa fa-comments"></i> Your number of Comments 05
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