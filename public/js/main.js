$(function(){

	$('.comment-delete-btn').on('click', function(e){

		var currentElement = $(e.delegateTarget);
		var commentOwner = currentElement.parent().siblings("#name-row").text();
		
		$('#comment-owner').text(commentOwner);


		var currentId = currentElement.parent().siblings().parent().attr('data-comment-id');

		var newAction = 'http://blog.app/comments/' + currentId + '/delete';
		$('.form-delete-btn').attr('action', newAction);

	});

});