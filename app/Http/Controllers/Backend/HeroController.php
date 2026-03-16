<?php

namespace app\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Hero;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class HeroController extends Controller
{
    public function HeroSection(){
        $hero =Hero::find(1);
        Return view('backend.hero.hero-section', compact('hero'));

    }// End Method

    public function UpdateHeroSection(Request $request){
        if($request->hasFile('photo')){
            $oldPhoto = Hero::find(1);
            $file = $request->file('photo');
            $imageName = 'Hero-'.hexdec(uniqid()).'.'.$file->getClientOriginalExtension();//Hero-453hsj.png
            $manager = new ImageManager(new Driver());
            $img = $manager->read($file);
            $img = $img->resize(437,475);
            $img = $img->toJpeg(80)->save(base_path('public/uploads/hero/'.$imageName));
            $imagePath = 'uploads/hero/'.$imageName;

            Hero::find(1)->update([
                'name' => $request->name,
                'profession' => $request->profession,
                'Short_description' => $request->Short_description,
                'photo' => $imagePath,
                'twitter_url' => $request->twitter_url,
                'tiktok_url' => $request->tiktok_url,
                'linkedin_url' => $request->linkedin_url,
                'github_url' => $request->github_url,
                'YOE' => $request->YOE,
                'PC' => $request->PC,
                'HC' => $request->HC,
                'updated_at' => Carbon::now(),

            ]);

            
            $notification = [
                'message' => 'Hero-Section Updated with Photo Successfully!',
                'alert-type' => 'info'
            ];


           if(!$request->hasFile('resume')){
                return redirect()->back()->with($notification);
           } 
           
        } elseif($request->hasFile('resume')){
            $resume = $request->file('resume');
            $resumeNewName = 'Resume_'.hexdec(uniqid()).'.'.$resume->getClientOriginalExtension();
            $resume->move(public_path('uploads/resume'),$resumeNewName);
            $resume_Path = 'uploads/resume/'.$resumeNewName;

             Hero::find(1)->update([
                'name' => $request->name,
                'profession' => $request->profession,
                'Short_description' => $request->Short_description,
                'resume' => $resume_Path,
                'twitter_url' => $request->twitter_url,
                'tiktok_url' => $request->tiktok_url,
                'linkedin_url' => $request->linkedin_url,
                'github_url' => $request->github_url,
                'YOE' => $request->YOE,
                'PC' => $request->PC,
                'HC' => $request->HC,
                'updated_at' => Carbon::now(),

            ]);

            
            $notification = [
                'message' => 'Hero-Section Updated with resume Successfully!',
                'alert-type' => 'info'
            ];

            return redirect()->back()->with($notification);
        }

        Hero::find(1)->update([
                'name' => $request->name,
                'profession' => $request->profession,
                'Short_description' => $request->Short_description,
                'twitter_url' => $request->twitter_url,
                'tiktok_url' => $request->tiktok_url,
                'linkedin_url' => $request->linkedin_url,
                'github_url' => $request->github_url,
                'YOE' => $request->YOE,
                'PC' => $request->PC,
                'HC' => $request->HC,
                'updated_at' => Carbon::now(),

            ]);

            
            $notification = [
                'message' => 'Hero-Section Updated without photo or resume Successfully!',
                'alert-type' => 'info'
            ];

            return redirect()->back()->with($notification);

    }// End Method
}
