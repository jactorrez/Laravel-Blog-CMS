@extends('layouts.main')

@section('title', 'Tag: '.$tag->name)

@section('content')

<div class="row">
	<div class="col-md-8">	
		<h1>{{ $tag->name }} Tag <small>{{ $tag->posts()->count() }} Posts</small></h1>
	</div>

	<div class="col-md-2">
		<a href="{{ route('tags.edit', $tag->id)}}" class="btn btn-primary pull-right btn-block form-top-space">Edit</a>
	</div>

	<div class="col-md-2">
		<form class="form-top-space" action="{{ route('tags.destroy', $tag->id) }}" method="POST">
		 	{{ method_field('DELETE') }}
		 	{{ csrf_field() }}
			<input class="btn btn-danger btn-block" type="submit" value="Delete">
		</form>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Post Title</th>
					<th>Tags</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			@foreach($tag->posts as $post)
				<tr>
					<th>{{ $post->id }}</th>
					<td>{{ $post->title }}</td>
					<td>@foreach($post->tags as $tag)
							<span class="label label-default">{{ $tag->name }}</span>  
						@endforeach 
					</td>
					<td><a href="{{ route('posts.show', $post->id) }}">View Post</a></td>	
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
</div>

@stop 

