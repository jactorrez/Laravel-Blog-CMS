@extends('layouts.main')
@section('title', 'Contact')

@section('content')
   <div class="row">
       <div class="col-md-6 col-md-offset-3">
           <h1>Contact</h1>
               <form action="{{ route('contact.send') }}" method="POST">
                {{ csrf_field() }}
              	 <div class="form-group">
                 		<label for="email">Email:</label>
                 		<input type="text" name="email" id="email" class="form-control">
               	 </div>

               	 <div class="form-group">
               		  <label for="subject">Subject</label>
               		  <input type="text" name="subject" id="subject" class="form-control">
              	 </div>

               	 <div class="form-group">
               		  <label for="message">Message</label>
               		  <textarea type="text" name="message" id="message" rows="10" class="form-control" placeholder="Your message here..."></textarea>
               	 </div>
                 
               	<input type="submit" value="Send Message" class="btn btn-success btn-block">
           </form>
       </div>
   </div>
@stop