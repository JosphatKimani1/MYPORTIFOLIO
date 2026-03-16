<?php

namespace App\Http\Controllers\Backend;

use App\Models\Service;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PortfolioController extends Controller
{
 
public function AllRecentWoks(){
    $works = Portfolio::Latest()->get();
    return view('backend.portfolio.all_recent_works', compact('works'));
} // End Method

public function AddWork(){
    $services = Service::all(); 
    return view('backend.portfolio.add_work', compact('services'));

} //End Method

public function StoreWork(Request $request){
    //584*500
    if($request->hasFile('photo')){
        $file = $request->file('photo');
            $imageName = 'work-'.hexdec(uniqid()).'.'.$file->getClientOriginalExtension();//work-453hsj.png
            $manager = new ImageManager(new Driver());
            $img = $manager->read($file);
            $img = $img->resize(584,500);
            $img = $img->toJpeg(80)->save(base_path('public/uploads/portfolio/'.$imageName));
            $imagePath = 'uploads/portfolio/'.$imageName;


            $work = new Portfolio();
            $work->title = $request->title;
            $work->sub_title = $request->sub_title;
            $work->photo = $imagePath;
            $work->service_cat_id = $request->service_cat;
            $work->url = $request->url;
            $work->save();

             $notification = [
                'message' => 'Work added with Photo Successfully!',
                'alert-type' => 'success'
            ];
            
            return redirect()->route('all.recent.works')->with($notification);
    }  

    $work = new Portfolio();
            $work->title = $request->title;
            $work->sub_title = $request->sub_title;
            $work->service_cat_id = $request->service_cat;
            $work->url = $request->url;
            $work->save();

             $notification = [
                'message' => 'Work added without Photo Successfully!',
                'alert-type' => 'success'
            ];
            
            return redirect()->route('all.recent.works')->with($notification);

} // End Method

public function EditWork($id){
    $work = Portfolio::find($id);
    $services = Service::all();
    return view('backend.portfolio.edit_work', compact('work', 'services')); 
} //End Method

public function UpdateWork(Request $request){
    $work = Portfolio::findOrFail($request->work_id);
    if($request->hasFile('photo')){
        $file = $request->file('photo');
            $imageName = 'work-'.hexdec(uniqid()).'.'.$file->getClientOriginalExtension();//work-453hsj.png
            $manager = new ImageManager(new Driver());
            $img = $manager->read($file);
            $img = $img->resize(584,500);
            $img = $img->toJpeg(80)->save(base_path('public/uploads/portfolio/'.$imageName));
            $imagePath = 'uploads/portfolio/'.$imageName;

            $work->title = $request->title;
            $work->sub_title = $request->sub_title;
            $work->photo = $imagePath;
            $work->service_cat_id = $request->service_cat;
            $work->url = $request->url;
            $work->save();

             $notification = [
                'message' => 'Work Updated with Photo Successfully!',
                'alert-type' => 'info'
            ];
            
            return redirect()->route('all.recent.works')->with($notification);
    }  

            $work->title = $request->title;
            $work->sub_title = $request->sub_title;
            $work->service_cat_id = $request->service_cat;
            $work->url = $request->url;
            $work->save();

             $notification = [
                'message' => 'Work added without Photo Successfully!',
                'alert-type' => 'success'
            ];
            
            return redirect()->route('all.recent.works')->with($notification);

} //End Method

public function DeleteWork($id){
    $work = Portfolio::findOrFail($id);
    unlink($work->photo);
    $work->delete();

      $notification = [
                'message' => 'Work deleted Successfully!',
                'alert-type' => 'info'
            ];

            return redirect()->back()->with($notification);
}

}
