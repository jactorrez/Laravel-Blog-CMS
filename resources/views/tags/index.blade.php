@extends('layouts.main')

@section('title', 'Tags')

@section('content')
	
	<div class="row">
		<div class="col-md-8">
			<h1>Tags</h1>
			<table class="table">

				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Options</th>
					</tr>
				</thead>

				<tbody>
				@foreach($tags as $tag)
					<tr>
						<th>{{ $tag->id }}</th>
						<td>{{ $tag->name }}</td>
						<td><a href="{{ route('tags.show', $tag->id) }}">View</a> | <a href="{{ route('tags.edit', $tag->id) }}">Edit</a></td>
					</tr>
				@endforeach
				</tbody>

			</table>
			
		</div>

		<div class="col-md-4">
			<div class="well form-top-space">
				<form action="{{ route('tags.store')}}" method="POST">
				{{ csrf_field() }}
				<h2>Add New Tag</h2>
					<div class="form-group">
						<label for="name">Tag Name</label>
						<input type="text" name="name" id="name" class="form-control">
					</div>
					<input type="submit" value="Add Tag" class="btn btn-primary btn-block">

				</form>
			</div>
		</div>
	</div>

@stop

