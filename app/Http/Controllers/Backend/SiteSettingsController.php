<?php

namespace app\Http\Controllers\Backend;

use App\Models\SiteSettings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SiteSettingsController extends Controller
{
    public function SiteSettings(){
        $sData = SiteSettings::find(1);
        return view('backend.settings.site_settings', compact('sData'));

    }// End Method

    public function UpdateSiteSettings(Request $request){
        //156*156
        if($request->hasFile('logo')){
             //Delete Old Logo
            $oldLogo = SiteSettings::find(1);
            if($oldLogo->logo){
                unlink($oldLogo->logo);
            }

             //Processing New Logo
            $file = $request->file('logo');
            $imageName = 'Logo_'.hexdec(uniqid()).'.'.$file->getClientOriginalExtension();//Hero-453hsj.png
            $manager = new ImageManager(new Driver());
            $img = $manager->read($file);
            $img = $img->resize(156,156);
            $img = $img->toJpeg(80)->save(base_path('public/uploads/logo/'.$imageName));
            $LogoPath = 'uploads/logo/'.$imageName;


            SiteSettings::find(1)->update([
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'logo' => $LogoPath,
                'footer_note' => $request->footer_note,
            ]);

            $notification = [
                'message' => 'Site Settings updated with Logo Successfully!',
                'alert-type' => 'info'
            ];

            return redirect()->back()->with($notification);

        }

        SiteSettings::find(1)->update([
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'footer_note' => $request->footer_note,
            ]);

            $notification = [
                'message' => 'Site Settings updated without Logo Successfully!',
                'alert-type' => 'info'
            ];

            return redirect()->back()->with($notification);


    }// End Methods
}
