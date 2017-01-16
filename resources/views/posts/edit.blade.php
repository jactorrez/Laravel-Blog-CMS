@extends('layouts.main')

@section('title', 'Edit Post')

@section('stylesheets')
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
	<form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" >
	{{ method_field('PUT') }}
	{{ csrf_field() }}

		<div class="col-md-8">
				
			<label for="current_cover">Current Cover Image</label>
			<img src="{{ asset('images/'.$post->image) }}">
			
			<label for="title">Title</label>
			<input autofocus type="text" name="title" id="title" value="{{ $post->title }}" class="form-control input-lg">
			
			<label for="slug" class="form-top-space">Slug</label>
			<input type="text" name="slug" id="slug" value="{{ $post->slug }}" class="form-control input-lg">

			<label for="category_id" class="form-top-space">Category</label>

			<select name="category_id" id="category_id" class="form-control input-lg">
				@if($post->category == null)
					<option value="none" selected disabled="">Choose a Category</option>
				@endif
				@foreach($categories as $category)
					<option value="{{ $category->id }}" 
						@if($post->category == null)
							{{ "" }}
						@elseif($post->category->name == $category->name)
							{{ "selected" }}
						@endif
				    > {{ $category->name }}</option>	
				@endforeach
			</select>

			<div class="form-group">
				<label for="tags" class="form-top-space">Tags</label>
				<select name="tags[]" id="tags" class="form-control tags-select " multiple>
					@foreach($tags as $tag)
						<option value="{{ $tag->id }}">{{ $tag->name }}</option>
					@endforeach
				</select>
			</div>

			<div class="form-group">
				<label for="cover_image">Cover Image</label>
				<input type="file" name="cover_image" id="cover_image" accept="image/*">
			</div>


			<label for="body" class="form-top-space">Body</label>
			<textarea name="body" id="body" class="form-control" rows="10" >{{ $post->body }}</textarea>
		</div>

		<div class="col-md-4">
			<div class="well">
				<div class="text-center">
					<dl class="dl-horizontal">
						<dt>Created At:</dt>
						<dd>{{ date('M j, Y h:i A', strtotime($post->created_at)) }}</dd>
					</dl>

					<dl class="dl-horizontal">
					    <dt>Last updated:</dt>
						<dd>{{ date('M j, Y h:i A', strtotime($post->updated_at)) }}</dd>
					</dl>
				</div>
				<hr>

				<div class="row">
					<div class="col-sm-6">
						<input type="submit" value="Save" class="btn btn-success btn-block">
					</div>
					<div class="col-sm-6">
						<a href="{{ route('posts.show', array($post->id)) }}" class="btn btn-danger btn-block">Cancel</a>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
@stop

@section('scripts')
	<script src="{{ asset('js/select2.min.js') }}"></script>

	<script>
		$('.tags-select').select2();

		$('.tags-select').val({!! json_encode($post->tags()->getRelatedIds())!!}).trigger("change");

	</script>
@stop


