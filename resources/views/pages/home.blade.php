@extends('layouts.main')

<!-- End Nav bar --> 
@section('title', 'Home')

@section('content')
    <div class="row">
        <div class="col-md-12">
              <div class="jumbotron">
                  <h1>Welcome to my blog!</h1>
                  <p class="lead">Thank you for stopping by</p>
                  <p><a class="btn btn-primary btn-lg" href="#" role="button">Popular Post</a></p>
              </div>
        </div>
    </div>

     <div class="row">
        <div class="col-md-8">
        @foreach($posts as $post)

           <div class="post">
               <h3>{{ $post->title }}</h3>
               <p>{{ str_limit(strip_tags($post->body), '200') }}</p>
               <a href="{{ route('blog.post', $post->slug)}}" class="btn btn-primary">Read More</a>
           </div>
            <hr>
        @endforeach
          
        </div>
        <div class="col-md-3 col-md-offset-1">
          <h1>Sidebar</h1>
        </div>
    </div>
@stop
