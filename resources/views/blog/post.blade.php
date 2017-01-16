@extends('layouts.main')

@section('title', htmlspecialchars($post->title))

@section('content')

	<div class="row">
		 <div class="col-md-8 col-md-offset-2">
		 	<img src="{{ asset('images/'.$post->image) }}" alt="">
		 	<h1>{{ $post->title }}</h1>
		 	<p>{!! $post->body !!}</p>
		 	<hr>
		 	@if($post->category != null)
		 		<h5>Posted in: {{ $post->category->name }} </h5>
		 	@endif
		 </div>
	</div>
	
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
		<h3 class="comments-title"><span class="glyphicon glyphicon-comment"></span><b>{{ $post->comments()->count() }} Comments</b></h3>
			@foreach($post->comments as $comment)
			<div class="comment">
				<div class="author-info">
					<img src="{{ 'https://www.gravatar.com/avatar/'.md5(strtolower(trim($comment->email))).'?d=mm' }}"
					alt="" 
					class="author-image">

					<div class="author-name">
						<h4>{{ $comment->name }}</h4>
						<p><small>{{ $comment->created_at->toFormattedDateString()}}</small></p>
					</div>
					
				</div>
				<div class="comment-hold">
					<p>{{ $comment->comment }}</p>
				</div>
			</div>
			@endforeach
		</div>
	</div>


	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<form action="{{ route('comments.store', $post->id) }}" method="POST">
				{{ csrf_field() }}
				<div class="row">
					<div class="col-md-6">
						<label for="name">Your Name</label>
						<input type="text" name="name" id="name" class="form-control">
					</div>

					<div class="col-md-6">
						<label for="email">Your email</label>
						<input type="text" name="email" id="email" class="form-control">
					</div>

					<div class="col-md-12 form-top-space">
						<label for="comment">Comment</label>
						<textarea name="comment" id="comment" class="form-control" rows="10"></textarea>
						<input type="submit" value="Add Comment" class="btn btn-primary form-top-space btn-block">
					</div>
				</div>
			</form>
		</div>
	</div>
@stop

