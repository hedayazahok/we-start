<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contract;
use App\Models\Country;
use App\Models\Freelancer;
use App\Models\Image;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard(){
        $users=User::all()->except(Auth::id());
        $freelancers=Freelancer::all();
        $projects=Project::all();
        $project_completed=Project::where('status','completed')->get();
        $projects_underReview=Project::where('status','underReview')->get();
        $project_cancled=Project::where('status','completed')->get();
        $categories=Category::all();
        // Change the first part of the query below as required
$users_perMonth = User::get()->groupBy(function($user) {
    return Carbon::parse($user->created_at)->format('m');
});

$freelancers_perMonth = Freelancer::get()->groupBy(function($freelancer) {
    return Carbon::parse($freelancer->created_at)->format('m');
});

$contractsCompleted_perMonth = Contract::where('status','completed')->get()->groupBy(function($contract) {
    return Carbon::parse($contract->created_at)->format('m');
});



        return view('admin.dashboard',compact('projects_underReview','users','freelancers','project_completed','projects','project_cancled','users_perMonth','freelancers_perMonth','contractsCompleted_perMonth','categories'));
    }


    public function  users(){
        $users=User::where('id','<>',Auth::id())->paginate(10);
return view('admin.user',compact('users'));

    }

    public function changeStatus(Request $request){
        if($request->type=='user'){
            $user=User::find($request->id);
            $user->update(['status'=>$request->status]);

        }
        if($request->type=='freelancer'){
            $freelancer=Freelancer::find($request->id);
            $freelancer->update(['status'=>$request->status]);

        }

        return redirect()->back()->with('message','you change the status of user to '.$request->status);



    }
    public function projects(){
        $projects=Project::where('status','underReview')->paginate();
        return view('admin.newProjects',compact('projects'));
    }

    public function openProject($id){
        $project=Project::where('id',$id);
        $project->update(['status'=>'opened']);
        return redirect()->back()->with('message','open project with id= '.$id);


    }



    public function  freelancers(){
        $freelancers=Freelancer::paginate(5);
return view('admin.freelancer',compact('freelancers'));

    }

    public function setting_form(){
        $admin=Auth::user();
        $countries=Country::all();
        return view('admin.setting',compact('admin','countries'));

    }

    public function  setting(Request $request){
       $user=User::where('type','admin')->first();
       $user->update([
        'name'=>$request->name,
        'email'=>$request->email,
        'country'=>$request->country,
        ] );
        if($request->hasFile('logo')){
            if($user->image!=null){
                $path=public_path().'/'.$user->image->path;
                if (file_exists($path)) {

                 unlink($path);
             }
            Image::where('id',$user->image->id)->delete();
            }
                $path=$request->file('logo')->store('/uploads/company', 'custom');
                $user->image()->create([
                    'path' => $path,


                ]);


        }
        return redirect()->back()->with('message','its done successfuly!');

    }




}
