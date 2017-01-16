@extends('layouts.main')

@section('title', 'View Post')

@section('content')

	<!-- Modal -->

	<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog modal-sm" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h3 class="modal-title" id="myModalLabel"><b>Are you sure you want to delete this comment?</b></h3>
	      </div>
	      <div class="modal-body">
	        By pressing 'Delete', you will delete this comment made by <span id="comment-owner"></span>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

	        <form class="form-delete-btn" method="POST">
	        	{{ csrf_field() }}
	        	{{ method_field('DELETE') }}

	        	<input type="submit" value="Delete" class="btn btn-danger">	
	        </form>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- End Modal --> 

	<!-- Start Left Column --> 
	<div class="row">

	<div class="col-md-8">

		<h1>{{ $post->title }}</h1>
		<p class="lead">{!! $post->body !!}</p>

		<div class="tags">
			@foreach($post->tags as $tag)
			<span class="label label-default">{{ $tag->name }}</span>
			@endforeach
		</div>

		<hr>
		
		<div id="backend-comments">
			<h3>Comments <small>{{ $post->comments()->count() }} total</small> </h3>
			<table class="table comments-table">
				<thead>
					<tr>
						<th id="col-name">Name</th>
						<th id="col-email">Email</th>
						<th id="col-comment">Comment</th>
						<th id="col-btn"></th>
					</tr>
				</thead>

				<tbody>
				@foreach($post->comments as $comment)
					<tr class="commentData" data-comment-id="{{ $comment->id }}">
						<td id="name-row">{{ $comment->name }}</td>
						<td>{{ $comment->email }}</td>
						<td>{{ $comment->comment }}</td>
						<td><a href="#/" class="btn btn-danger btn-xs comment-delete-btn" data-toggle="modal" data-target="#deleteModal"><span class="glyphicon glyphicon-trash"></span></a></td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>	
	<!-- End Left Column -->

	<!-- Start Right Column -->
	<div class="col-md-4">
		<div class="well">
		
			<div>
				<b>URL:</b>
				<p><a href="{{ url('blog/'.$post->slug) }}">{{ url('blog/'.$post->slug) }}</a></p>
			</div>

			<div>
				<b>Created At:</b>
				<p>{{ date('M j, Y h:i A', strtotime($post->created_at)) }}</p>
			</div>

			<div>
			    <b>Last updated:</b>
				<p>{{ date('M j, Y h:i A', strtotime($post->updated_at)) }}</p>
			</div>

			<div>
				<b class="bold-test">Category:</b>
				<p>@if($post->category !== null)
						{{ $post->category->name }}
					@else
						{{"Not in a category"}}
					@endif
				 </p>
			</div>
			<hr>
			<div class="row">
				<div class="col-sm-6">
					<a href="{{ route('posts.edit', array($post->id)) }}" class="btn btn-primary btn-block ">Edit</a>
				</div>
				<form action="{{ route('posts.destroy', $post->id) }}" method="POST">
					{{ method_field('DELETE') }}
					{{ csrf_field() }}
					<div class="col-sm-6">
						<input type="submit" class="btn btn-danger btn-block" value="Delete">
					</div>
				</form>
			</div>

			<div class="row">
				<div class="col-md-12">
					<a href="{{ route('posts.index') }}" class="btn btn-defaults btn-block">See All defaults</a>
				</div>
			</div>
		</div>
	</div>
</div>
	
@stop

@section('scripts')
<script src="{{ asset('js/main.js') }}"></script>

@stop
