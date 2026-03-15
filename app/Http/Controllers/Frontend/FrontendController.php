<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Comment;
use App\Models\Contact;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function homepage(){
        return view('frontend.homepage');
    } //End Method
    

    public function BlogDetails($slug){
        $post = BlogPost::where('post_slug',$slug)->firstOrFail();
        $rposts = BlogPost::Latest()->limit(3)->get();
        return view('frontend.blog.post_details', compact('post', 'rposts'));

    } // End Method

    public function StoreComent(Request $request){

        $comment = new Comment();
        $comment->post_id = $request->post_id;
        $comment->user_name = $request->user_name;
        $comment->user_email = $request->user_email;
        $comment->comment = $request->comment;
        $comment->save();

        $notification = [
                'message' => 'Comment posted Successfully! Awaiting Admin Approval',
                'alert-type' => 'success'
            ];

        return redirect()->back()->with($notification);
        
    }// End method

    public function StoreContactMessage(Request $request){
        $message = new Contact();
        $message->first_name = $request->fname;
        $message->last_name = $request->lname;
        $message->email = $request->email;
        $message->phone = $request->phone;
        $message->service_id  = $request->service_id;
        $message->description  = $request->description;
        $message->save();

        $notification = [
                'message' => 'You Message has been received! I will get back to you soon.',
                'alert-type' => 'success'
            ];

        return redirect()->back()->with($notification);
    } //End Method
}
