<?php

namespace App\Http\Controllers\backend;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BlogPostController extends Controller
{
    public function AddPost(){
        return view('backend.blog.add_post');
    } //End Method

    public function StorePost(Request $request){
        //409*368
        $file = $request->file('post_photo');
        $imageName = 'post_'.hexdec(uniqid()).'.'.$file->getClientOriginalExtension();//work-453hsj.png
        $manager = new ImageManager(new Driver());
        $img = $manager->read($file);
        $img = $img->resize(409,368);
        $img = $img->toJpeg(80)->save(base_path('public/uploads/blog/'.$imageName));
        $imagePath = 'uploads/blog/'.$imageName;

        $post = new BlogPost();
        $post->user_id = Auth::user()->id;
        $post->post_title = $request->post_title;
        $post->post_slug = strtolower(str_replace(' ','-', $request->post_title));
        $post->post_photo = $imagePath;
        $post->post_tags = $request->post_tags;
        $post->post_description = $request->post_description;
        $post->save();

          $notification = [
                'message' => 'BlogPost Posted Successfully!',
                'alert-type' => 'success'
            ];

            return redirect()->back()->with($notification);

    } // End Method

    public function AllPost(){
        $posts = BlogPost::Latest()->get();
        return view('backend.blog.all_posts', compact('posts'));

    } // End Method

    public function EditPost($id){
        $post = BlogPost::findOrFail($id);
        return view('backend.blog.edit_post', compact('post'));

    } // End method

    // public function UpdatePost(Request $request){
    //     if($request->hasFile('post_photo')){

    //         $OldPostPhoto = BlogPost::findOrFail($request->id);
    //         unlink($OldPostPhoto->post_photo);
            
    //         $file = $request->file('post_photo');
    //         $imageName = 'post_'.hexdec(uniqid()).'.'.$file->getClientOriginalExtension();//work-453hsj.png
    //         $manager = new ImageManager(new Driver());
    //         $img = $manager->read($file);
    //         $img = $img->resize(409,368);
    //         $img = $img->toJpeg(80)->save(base_path('public/uploads/blog/'.$imageName));
    //         $imagePath = 'uploads/blog/'.$imageName;

    //         $post = BlogPost::findOrFail($request->id);
    //         $post->user_id = Auth::user()->id;
    //         $post->post_title = $request->post_title;
    //         $post->post_slug = strtolower(str_replace(' ','-', $request->post_title));
    //         $post->post_photo = $imagePath;
    //         $post->post_tags = $request->post_tags;
    //         $post->post_description = $request->post_description;
    //         $post->save();

    //         $notification = [
    //             'message' => 'BlogPost Updated Successfully!',
    //             'alert-type' => 'info'
    //         ];

    //         return redirect()->route('all.post')->with($notification);

    //     }

    // } //End Method 
    public function UpdatePost(Request $request)
{
    $post = BlogPost::findOrFail($request->id);

    // Update text fields
    $post->user_id = Auth::user()->id;
    $post->post_title = $request->post_title;
    $post->post_slug = strtolower(str_replace(' ', '-', $request->post_title));
    $post->post_tags = $request->post_tags;
    $post->post_description = $request->post_description;

    // If new photo uploaded
    if ($request->hasFile('post_photo')) {

        // Delete old image SAFELY
        if ($post->post_photo && file_exists(public_path($post->post_photo))) {
            unlink(public_path($post->post_photo));
        }

        $file = $request->file('post_photo');
        $imageName = 'post_' . hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();

        $manager = new ImageManager(new Driver());
        $img = $manager->read($file);
        $img->resize(409, 368);
        $img->toJpeg(80)->save(public_path('uploads/blog/' . $imageName));

        $post->post_photo = 'uploads/blog/' . $imageName;
    }

    $post->save();

    return redirect()->route('all.post')->with([
        'message' => 'BlogPost Updated Successfully!',
        'alert-type' => 'info'
    ]);
}


    // public function DeletePost($id){
    //     $OldPostPhoto = BlogPost::findOrFail($id);
    //     // unlink($OldPostPhoto->post_photo);
    //     BlogPost::findOrFail($id)->delete();

    //     $notification = [
    //             'message' => 'BlogPost Deleted Successfully!',
    //             'alert-type' => 'info'
    //         ];

    //         return redirect()->back()->with($notification);

    // }
    public function DeletePost($id)
{
    $post = BlogPost::findOrFail($id);

    // Delete photo safely
    if ($post->post_photo && file_exists(public_path($post->post_photo))) {
        unlink(public_path($post->post_photo));
    }

    $post->delete();

    return redirect()->back()->with([
        'message' => 'BlogPost Deleted Successfully!',
        'alert-type' => 'info'
    ]);
}

}
