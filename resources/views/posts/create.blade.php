@extends('layouts.main')

@section('title', 'Create Post')

@section('stylesheets')
	<link rel="stylesheet" href="{{ asset('css/parsley.css') }}">
	<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

	<script>
		tinymce.init({
			selector: 'textarea',
			plugins: 'link code',
			menubar: false
		});
	</script>
@stop


@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Create New Post</h1>
			<hr>
			<form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" data-parsley-validate>
				{{ csrf_field() }}
				
				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" name="title" id="title" class="form-control" required maxlength="255">
				</div>
				
				<div class="form-group">
					<label for="slug">Slug</label>
					<input type="text" id="slug" name="slug" class="form-control" required minlength="5" maxlength="255">
				</div>

				<div class="form-group">
					<label for="category_id">Category</label>
					<select name="category_id" id="category_id" class="form-control">
						@foreach($categories as $category)
						<option value="{{ $category->id }}">{{ $category->name }}</option>
						@endforeach
					</select> 	
				</div>

				<div class="form-group">
					<label for="tags">Tags</label>
					<select name="tags[]" id="tags" class="form-control tags-select" multiple>
						@foreach($tags as $tag)
							<option value="{{ $tag->id }}">{{ $tag->name }}</option>
						@endforeach
					</select>
				</div>

				<div class="form-group">
					<label for="cover_image">Cover Image</label>
					<input type="file" name="cover_image" id="cover_image" accept="image/*">
				</div>


				<div class="form-group">
					<label for="body">Body</label>
					<textarea name="body" id="body" rows="10" class="form-control"></textarea>
				</div>

				<input type="submit" value="Submit" class="btn btn-success btn-lg btn-block">
			</form>
		</div>
	</div>
	
@stop


@section('scripts')
	<script src="{{ asset('js/parsley.min.js') }}"></script>
	<script src="{{ asset('js/select2.min.js') }}"></script>

	<script>
		$('.tags-select').select2();

	</script>
@stop
