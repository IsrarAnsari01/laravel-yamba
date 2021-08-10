@extends('yamba.app')
@section("mainContent")
<div class="container">
    <div class="row">
        <div class="col-lg-10">
            <div class="card bg-info mt-5 text-light">
                <div class="card-body">
                    <h2 class="card-title lead"><i class="fa fa-edit"></i> Welcome Admin Add Video Categories</h2>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{route('VideoCategory.add')}}">
                        @csrf
                        <div class="mb-3">
                            <label for="videoCat" class="form-label">Name</label>
                            <input type="text" pattern="[A-Za-z .]{2,30}" name="name" class="form-control" id="videoCat" autocomplete="off" required>
                        </div>
                        @error('name')
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