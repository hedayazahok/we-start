<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;

class ClientController extends Controller
{
    public function profile(){

        //$status;
        $projects_count=Auth::user()->projects->count();
        $rejected_count=Auth::user()->projects->where('status','rejected')->count();
        $underReview_count=Auth::user()->projects->where('status','underReview')->count();
        $opened_count=Auth::user()->projects->where('status','opened')->count();
        $closed_count=Auth::user()->projects->where('status','closed')->count();
        $cancled_count=Auth::user()->projects->where('status','cancled')->count();
        $ongoing_count=Auth::user()->projects->where('status','ongoing')->count();
        $completed_count=Auth::user()->projects->where('status','completed')->count();

        return view('client.profile',compact(['projects_count','rejected_count','underReview_count','opened_count','closed_count','cancled_count','ongoing_count','completed_count']));
    }
    public function logout(){
        Auth::logout();

        return redirect('login');

    }
    public function setting_form(){
        $user=Auth::user();
        $countries=Country::all();
        return view('client.setting',compact(['user','countries']));

    }
    public function setting(Request $request,$id){
        //$id=Auth::id();
        $user=User::find($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'country' => $request->country,
            'updated_at' => now()
        ]);


        if($request->hasFile('image')){
          if($user->image!=null){
             unlink($user->image->path);
             $path= $request->file('image')->store('/uploads/users', 'custom');
             $user->image()->update([
                'path' =>  $path,
            ]);


          }else{
            $path=$request->file('image')->store('/uploads/users', 'custom');
            $user->image()->create([
                'path' =>  $path,
            ]);
       }

        }

        return redirect()->route('client.profile')->with('message', 'profile update sucessfullly');

    }

    public function notifications()
    {
        $user=Auth::user();
        return  $this->unreadNotifications()->limit(5)->get()->toArray();
    }



}
