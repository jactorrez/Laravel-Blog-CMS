@extends('layouts.main')

@section('title', 'Edit Tag')

@section('content')

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
		<h1>Edit Tag: {{ $tag->name }}</h1>
			<form action="{{ route('tags.update', $tag->id) }}" method="POST">
				{{ method_field('PUT') }}
				{{ csrf_field() }}
				<label for="name" class="form-top-space">Tag Name</label>
				<input type="text" id="name" name="name" value="{{ $tag->name }}" class="form-control">

				<input type="submit" value="Change" class="btn btn-success btn-block form-top-space">
			</form>	
		</div>
	</div>
@stop 