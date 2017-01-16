<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Comment;

use App\Post;

class CommentsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $postId)
    {
     
         $this->validate($request, [
            'name'    => 'required|max:255',
            'email'   => 'required|email|max:255',
            'comment' => 'required|min:5|max:2000'
         ]);

         $post = Post::findOrFail($postId);

         $comment = new Comment();
         $comment->name = $request->name;
         $comment->email = $request->email;
         $comment->comment = $request->comment; 
         $comment->approved = true;
         $comment->post()->associate($post);

         $comment->save();

         return redirect()->route('blog.post', $post->slug)->withSuccess("Your comment has been added!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete($commentId)
    {
        $comment = Comment::findOrFail($commentId);

        $postId = $comment->post->id;
        
        dd($postId);

        // $comment->delete();

        return redirect()->route('posts.show', $postId)->withSuccess("Your comment has successfully been deleted");
    }
}
