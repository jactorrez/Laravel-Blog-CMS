@extends('layouts.main')

@section('title', 'Categories')

@section('content')


	<div class="row">
		<div class="col-md-8">
			<h1>Categories</h1>
			<table class="table">

				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
					</tr>
				</thead>

				<tbody>
				@foreach($categories as $category)
					<tr>
						<th>{{ $category->id }}</th>
						<td>{{ $category->name }}</td>
					</tr>
				@endforeach
				</tbody>

			</table>
			
		</div>

		<div class="col-md-4">
			<div class="well form-top-space">
				<form action="{{ route('categories.store')}}" method="POST">
				{{ csrf_field() }}
				<h2>Add New Category</h2>
					<div class="form-group">
						<label for="name">Category Name</label>
						<input type="text" name="name" id="name" class="form-control">
					</div>
					<input type="submit" value="Add Category" class="btn btn-primary btn-block">

				</form>
			</div>
		</div>
	</div>

@stop