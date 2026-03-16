<?php

namespace app\Http\Controllers\Backend;

use App\Models\Comment;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function UserComments(){
        $comments = Comment::all();
        return view('backend.comment.comments', compact('comments'));
    } // End Method

    public function CommentStatusUpdate(Request $request){
        $comment_id = $request->input('comment_id');
        $comment_status = $request->input('status', 0);

        $comment = Comment::find($comment_id);
        if($comment){
            $comment->status = $comment_status;
            $comment->save();
        }
        return response()->json(['status' => 200]);

    }// End Method

    public function ContactMessage(){
        $contactMessages = Contact::Latest()->get();
        return view('backend.contact.all_contact_messages', compact('contactMessages'));
    } //End Method

    public function DeleteContact($id){
        Contact::findOrFail($id)->delete();

        $notification = [
                'message' => 'Contact Deleted Successfully!',
                'alert-type' => 'success'
            ];
        return redirect()->back()->with($notification);

    }//End Method
}
