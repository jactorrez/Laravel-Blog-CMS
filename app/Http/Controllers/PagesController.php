<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Mail; 

use App\Mail\ContactMe;

use App\Post;

class PagesController extends Controller
{
    public function getHome(){
        $posts = Post::orderBy('id', 'desc')->limit(4)->get(); 

    	return view('pages.home')->withPosts($posts);
    }

    public function getAbout(){
    	return view('pages.about');
    }

    public function getContact(){
    	return view('pages.contact');	
    }

    public function postContact(Request $request){

        $this->validate($request, 
            ['email' => 'required|email',
            'subject' => 'required|min:2',
            'message' => 'required|min:10']
        );

        $subject = $request->subject;
        $content = $request->message;

        Mail::to('javierctorrez@gmail.com')->send(new ContactMe($subject, $content));

        return redirect()->route('home')->withSuccess("Thanks for the message, I'll get back to you as soon as I can!");
    }   

}
