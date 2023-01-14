<?php

namespace App\Http\Controllers\freelancer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contract;
use App\Models\Country;
use App\Models\Freelancer;
use App\Models\Portfolio;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FreelancerController extends Controller
{
    public function dashboard(){
        $freelancer =Auth::guard('freelancer')->user();
        $proposals_count=$freelancer->proposals->count();
        $portfolios_count=$freelancer->portfolios->count();
        $total_balance=$freelancer->contracts->where('status','suspend')->sum('payment_amount');
        $waiting_count=$freelancer->proposals->where('status','waiting')->count();
        $cancled_count=$freelancer->proposals->where('status','cancled')->count();
        $processing_count=$freelancer->proposals->where('status','processing')->count();
        $completed_count=$freelancer->proposals->where('status','completed')->count();
        $bids=30;
        $bids_avaliable=$freelancer->bids;

        return view('freelancer.dashboard',compact(['total_balance','freelancer','proposals_count','portfolios_count','waiting_count','cancled_count','processing_count','completed_count','bids','bids_avaliable']));

       }
    public function profile($id){
$freelancer=Freelancer::find($id);

$proposals_count=0;
$completed_count=0;
$contracts_count=0;
$contracts_count_rehiring=0;
$completion_rate=0;
$Rehiring_rate=0;
if($freelancer->proposals!=null){
$proposals_count=$freelancer->proposals->count();
$completed_count=$freelancer->proposals->where('status','completed')->count();
}
if($freelancer->contracts!=null){

$contracts_count=$freelancer->contracts->count();
if($contracts_count!=0){
$contracts_count_rehiring=Contract::select('id', DB::raw('COUNT(*) as count'))
    ->groupBy('freelancer_id','user_id')
     ->having('count', '>=' , 2)
     ->where('freelancer_id',$freelancer->id)
    ->inRandomOrder()->pluck('count');

    if(sizeof($contracts_count_rehiring)!=0){
    $Rehiring_rate=($contracts_count_rehiring[0]/$contracts_count)*100;
    }
}
}
if($freelancer->proposals->count()!=0){
$completion_rate=($completed_count/$proposals_count)*100;
}else{
    $completion_rate=0;
}
$skills=json_decode($freelancer->skills);
$portfolios= Portfolio::where('freelancer_id',$freelancer->id)->get();

     return view('freelancer.profile',compact('freelancer','skills','proposals_count','completion_rate','Rehiring_rate','completed_count','portfolios'));

    }
    public function setting_form(){
        $freelancer=Auth::guard('freelancer')->user();
        $countries=Country::all();
        $categories=Category::all();
        $skills=json_decode($freelancer->skills);

        return view('freelancer.setting',compact(['freelancer','countries','categories','skills']));

    }
    public function setting(Request $request,$id){
        //$id=Auth::id();

        $freelancer=Freelancer::find($id);
        $freelancer->update([
            'name' => $request->name,
            'email' => $request->email,
            'major' => $request->major,
            'country' => $request->country,
            'category_id' => $request->category_id,
            'updated_at' => now(),
            'bio'=> $request->bio,
            'skills'=>json_encode($request->skills),
        ]);


        if($request->hasFile('image')){
          if($freelancer->image!=null){
             unlink($freelancer->image->path);
             $path= $request->file('image')->store('/uploads/freelancers', 'custom');
             $freelancer->image()->update([
                'path' =>  $path,
            ]);


          }else{
            $path=$request->file('image')->store('/uploads/freelancers', 'custom');
            $freelancer->image()->create([
                'path' =>  $path,
            ]);
       }

        }

        return redirect()->route('freelancer.dashboard')->with('message', 'profile update sucessfullly');

    }
    public function logout(){
        Auth::guard('freelancer')->logout();
        return view('auth.freelancerLogin');
    }

}
