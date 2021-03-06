@extends('yamba.app')
@section("mainContent")
<div class="container">
    <div class="row">
        <div class="col-lg-10">
            <div class="card bg-info mt-5 text-light">
                <div class="card-body">
                    <h2 class="card-title lead"><i class="fa fa-edit"></i> Welcome back {{$UserInfo->name}} Update your information</h2>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{route('Author.update', [$UserInfo->id])}}">
                        @csrf
                        <div class="mb-3">
                            <label for="studentName" class="form-label">Name</label>
                            <input type="text" pattern="[A-Za-z .]{2,30}" name="name" class="form-control" value="{{$UserInfo->name}}" id="studentName" autocomplete="off" required>
                        </div>
                        @error('name')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Email Address</label>
                            <input type="email" name="email" pattern="[A-Za-z_0-9]{3,}@[A-Za-z_0-9]{3,}[.][A-Za-z.]{2,}" value="{{$UserInfo->email}}" autocomplete="off" minlength="5" maxlength="40" class="form-control" id="exampleInputPassword1" required>
                        </div>
                        @error('email')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" pattern="[a-zA-Z0-9!@#$%^&*() ]{4,}" class="form-control" value="{{$UserInfo->password}}" autocomplete="off" id="stuNumber">
                        </div>
                        @error('password')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
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