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
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="mt-5 p-5">
                    <div class="card bg-light">
                        <div class="card-header text-white bg-info mt-1">
                            <h2><i class="fa fa-edit"></i>Login</h2>
                        </div>
                        <div class="card-body">
                            <form method="post" action="loginUser">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Email Address</label>
                                    <input type="email" name="email" pattern="[A-Za-z_0-9]{3,}@[A-Za-z_0-9]{3,}[.][A-Za-z.]{2,}" autocomplete="off" minlength="5" maxlength="40" class="form-control" id="exampleInputPassword1" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Passwrod</label>
                                    <input type="password" name="password" pattern="[a-zA-Z0-9!@#$%^&*()- ]{4, }" class="form-control" autocomplete="off" id="password">
                                </div>
                                <button type="submit" class="btn btn-info">Login</button>
                            </form>
                            <div>
                                <a href="signPage"> If you wan't Account Lets! Signin</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>