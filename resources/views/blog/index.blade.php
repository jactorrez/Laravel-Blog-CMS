@extends('layouts.main')

@section('title', 'Blog Posts')

@section('content')
	
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1><b>Blog Posts</b></h1>
		</div>
	</div>

	@foreach($posts as $post)
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h2>{{ $post->title }}</h2>
			<h5>Published on {{ $post->created_at->toFormattedDateString()  }}</h5>
			<p>{{ str_limit(strip_tags($post->body), 250) }}</p>
			<a href="{{ route('blog.post', $post->slug )}}" class="btn btn-primary">Read More</a>

			@unless($posts->last()->title == $post->title)
				<hr>
			@endunless
		</div>
	</div>
	@endforeach

	<div class="row">
		<div class="col-md-8 col-md-offset-2 text-center">
		{{ $posts->links() }}
		</div>	
	</div>
@stop