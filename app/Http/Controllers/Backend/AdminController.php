<?php

namespace App\Http\Controllers\backend;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }//end method

    public function AdminEditProfile()
    {
        $admin = User::find(Auth::user()->id);
        return view('Admin.pages.edit_profile', compact('admin'));
    } //End Method

    public function AdminUpdateProfile(Request $request){
            $id = Auth::user()->id;
            $admin = User::findOrFail($id);
            $admin->username = $request->username;
            $admin->email  = $request->email;
            $admin->updated_at  = Carbon::now();

            if($request->hasFile('profile_image')){

                $file = $request->file('profile_image');
                $imageName = "admin_".hexdec(uniqid()).'.'.$file->getClientoriginalExtension();
                $file->move(public_path('uploads/admin'), $imageName);
                $imagePath = 'uploads/admin/'. $imageName;
                $admin->photo = $imagePath;
            }

            $admin->save();

            

            $notification = [
                'message' => 'Profile Updated Successfully!',
                'alert-type' => 'info'
            ];

            return redirect()->back()->with($notification);
    } //End Method

    public function AdminChangePassword(){
        return view('admin.pages.change_password');

    } // End Method

    public function AdminUpdatePassword(Request $request){

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_new_password' => ['required', 'same:new_password']
        ]); 

        $admin = User::find(Auth::user()->id);
        if(!Hash::check($request->old_password, $admin->password)){
            $notification = [
                'message' => 'Old Password doesnot match!',
                'alert-type' => 'info'
            ];

            return redirect()->back()->with($notification);
        }

        $admin->password = Hash::make($request->new_password);
        $admin->save();

        $notification = [
                'message' => 'Password Updated Successfully!',
                'alert-type' => 'success'
            ];

            return redirect()->back()->with($notification);


    } // End Method
 
}
