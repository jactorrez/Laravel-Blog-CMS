<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session; 
use App\Http\Requests;
use App\Post;
use App\Category;
use App\Tag;

use Purifier;
use Image;
use Storage; 

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(5);

        return view('posts.index')->withPosts($posts);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.create')->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, array(
            'title'       => 'required|max:255',
            'slug'        => 'required|alpha_dash|max:255|min:5|unique:posts,slug',
            'cover_image' => 'sometimes|image',
            'category_id' => 'required|integer',
            'body'        => 'required',
        ));

        $post = new Post;

        $post->title = $request->title;
        $post->body = Purifier::clean($request->body);
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;

        if($request->hasFile('cover_image')){
            $image = $request->cover_image;
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path("images/".$filename);
            Image::make($image)->resize(800, 400)->save($location);
            $post->image = $filename;
        }

        $post->save();

        $post->tags()->sync($request->tags, false);


        Session::flash('success', 'That blog post was successfully saved!');

        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.edit')->withPost($post)->withCategories($categories)->withTags($tags);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, array(
            'title' => 'required|max:255',
            'slug' => "required|min:5|max:255|alpha_dash|unique:posts,slug,$id",
            'cover_image' => 'sometimes|image',
            'category_id' => 'required|integer',
            'body' => 'required'
        ));
        

        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        $post->body = Purifier::clean($request->body);

        if($request->hasFile('cover_image')){

            $image = $request->cover_image;
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path("images/".$filename);
            Image::make($image)->resize(800, 400)->save($location);

            $oldFilename = $post->image;

            $post->image = $filename;

            Storage::delete($oldFilename);


        }
     
        $post->save(); 

        if(isset($request->tags)){
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->sync(array());
        }

        Session::flash('success', "Your post has been updated!");
        return redirect()->route('posts.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id); 

        $post->tags()->detach(); 

        $post->delete(); 

        Session::flash('success', 'The post was sucessfully deleted!');
        return redirect()->route('posts.index');

    }
}
