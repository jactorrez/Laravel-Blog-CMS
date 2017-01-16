@extends('layouts.main')

@section('title', 'All Posts')


@section('content')

	<div class="row">
		<div class="col-md-10">
			<h1>All Posts</h1>
			
		</div>

		<div class="col-md-2">
			<a href="{{ route('posts.create') }}" class="btn btn-lg btn-primary btn-block btn-custom">Create Post</a>
		</div>
		<div class="col-md-12">
			<hr>
		</div>
		<hr>
	</div>

	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<thead>
					<th>#</th>
					<th>Title</th>
					<th>Body</th>
					<th>Created At</th>
					<th></th>
				</thead>

				<tbody>
				@foreach($posts as $post)
					<tr>
						<th>{{ $post->id }}</th>
						<td>{{ $post->title }}</td>
						<td>{{ str_limit(strip_tags($post->body), 80) }}</td>
						<td>{{ date('M d, Y h:i A', strtotime($post->created_at)) }}</td>
						<td><a href="{{ route('posts.show', $post->id) }} ">View</a> | <a href="{{ route('posts.edit', $post->id)}}">Edit</a></td>
					</tr>
				@endforeach
				</tbody>
			</table>

			<div class="text-center">
				{!! $posts->links() !!}
			</div>
		</div>
	</div>

@stop