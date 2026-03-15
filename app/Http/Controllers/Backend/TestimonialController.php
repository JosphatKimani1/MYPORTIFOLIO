<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\Testimonial;


class TestimonialController extends Controller
{
    public function AddTestimony(){
        return view('backend.testimonial.add_testimony');
    } //End Method

    public function StoreTestimony(Request $request){
        //119*122
        $file = $request->file('photo');
        $imageName = 'testimonial_'.hexdec(uniqid()).'.'.$file->getClientOriginalExtension();//work-453hsj.png
        $manager = new ImageManager(new Driver());
        $img = $manager->read($file);
        $img = $img->resize(119,122);
        $img = $img->toJpeg(80)->save(base_path('public/uploads/testimonial/'.$imageName));
        $imagePath = 'uploads/testimonial/'.$imageName;

        $data = [
            'name' => $request->name,
            'occupation' => $request->occupation,
            'photo' => $imagePath,
            'testimony' => $request->testimony,
        ];

        Testimonial::create($data);

         $notification = [
                'message' => 'Testimony added Successfully!',
                'alert-type' => 'success'
            ];

            return redirect()->back()->with($notification);
    } // End Method

    public function AllTestimonies(){
        $testimonies = Testimonial::all();
        return view('backend.testimonial.all_testimonies', compact('testimonies'));
    }// End Method
    
    public function EditTestimony($id){
        $testimony = Testimonial::find($id);
        return view('backend.testimonial.edit_testimony', compact('testimony'));
    } //End Method

    public function UpdateTestimony(Request $request){
        if($request->hasFile('photo')){

        $oldPhoto = Testimonial::find($request->id);
        unlink($oldPhoto->photo);

            $file = $request->file('photo');
            $imageName = 'testimonial_'.hexdec(uniqid()).'.'.$file->getClientOriginalExtension();//work-453hsj.png
            $manager = new ImageManager(new Driver());
            $img = $manager->read($file);
            $img = $img->resize(119,122);
            $img = $img->toJpeg(80)->save(base_path('public/uploads/testimonial/'.$imageName));
            $imagePath = 'uploads/testimonial/'.$imageName;

            $data = [
                'name' => $request->name,
                'occupation' => $request->occupation,
                'photo' => $imagePath,
                'testimony' => $request->testimony,
            ];

            Testimonial::find($request->id)->update($data);

            $notification = [
                    'message' => 'Testimony Updated with photo Successfully!',
                    'alert-type' => 'info'
                ];

                return redirect()->route('all.testimonies')->with($notification);

        }

        $data = [
                'name' => $request->name,
                'occupation' => $request->occupation,
                'testimony' => $request->testimony,
            ];

            Testimonial::find($request->id)->update($data);

            $notification = [
                    'message' => 'Testimony Updated without photo Successfully!',
                    'alert-type' => 'info'
                ];

                return redirect()->route('all.testimonies')->with($notification);
        
    }//End Method

    public function DeleteTestimony($id){
        $oldPhoto = Testimonial::find($id);
        unlink($oldPhoto->photo);
        Testimonial::find($id)->delete();
        $notification = [
                    'message' => 'Testimony Deleted Successfully!',
                    'alert-type' => 'success'
                ];

                return redirect()->back()->with($notification);

    }//End Method
}
