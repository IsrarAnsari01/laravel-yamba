 @extends('yamba.app')
 @section("mainContent")
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
 @endsection