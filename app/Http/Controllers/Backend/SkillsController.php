<?php

namespace App\Http\Controllers\backend;

use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SkillsController extends Controller
{
    public function AddSkill(){
        return view('backend.skills.add_skills');
    } //End Method

    public function StoreSkill(Request $request){

        $file = $request->file('icon');
        $iconName = 'tech_'.hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads/skills/'), $iconName);
        $iconPath = 'uploads/skills/'.$iconName;

        $skill = new Skill();
        $skill->icon = $iconPath;
        $skill->exp_level = $request->exp_level;
        $skill->technology_name  = $request->techonology;

        $skill->save();

        $notification = [
                'message' => 'Skill Added Successfully!',
                'alert-type' => 'success'
            ];

            return redirect()->route('all.skills')->with($notification);
    } // End Method

    public function AllSkills(){
        $allskills = Skill::all();
        return view('backend.skills.all_skills', compact('allskills')); 

    } // End Method

    public function EditSkill($id){
        $skill = Skill::findOrFail($id);
        return view('backend.skills.edit_skill', compact('skill'));
    } //End Method

    public function UpdateSkill(Request $request){
        if($request->hasFile('icon')){
            $oldIcon = Skill::find($request->id)->icon;
            unlink($oldIcon);

        $file = $request->file('icon');
        $iconName = 'tech_'.hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads/skills/'), $iconName);
        $iconPath = 'uploads/skills/'.$iconName;

        $skill = Skill::find($request->id);
        $skill->icon = $iconPath;
        $skill->exp_level = $request->exp_level;
        $skill->technology_name  = $request->techonology;

        $skill->save();

        $notification = [
                'message' => 'Skill Updated with icon Successfully!',
                'alert-type' => 'info'
            ];

            return redirect()->route('all.skills')->with($notification);
        }

        $skill = Skill::find($request->id);
        $skill->exp_level = $request->exp_level;
        $skill->technology_name  = $request->techonology;

        $skill->save();

        $notification = [
                'message' => 'Skill Updated without icon Successfully!',
                'alert-type' => 'info'
            ];

            return redirect()->route('all.skills')->with($notification);
        

    } //End Method

    public function DeleteSkill($id){
        $oldIcon = Skill::find($id)->icon;
        unlink($oldIcon);
        Skill::find($id)->delete();

        $notification = [
                'message' => 'Skill Deleted Successfully!',
                'alert-type' => 'success'
            ];

            return redirect()->back()->with($notification);

    } //End Method
}
