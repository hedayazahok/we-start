<?php

namespace App\Http\Controllers;

use App\Events\CreateProposalEvent;
use App\Models\Message;
use App\Models\Proposal;
use App\Models\User;
use App\Notifications\CreateProposal;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;

class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id=Auth::guard('freelancer')->id();
        $proposals=Proposal::where('freelancer_id',$id)->orderBy('created_at','desc')->paginate(10);
        return view('freelancer.allProposal',compact('proposals','id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$id=Auth::guard('freelancer')->id();
        $request->validate([
            'desc' => 'required' ,
            'duration'=> 'required' ,
            'budget'=> 'required' ,
            'project_id' => Rule::unique('proposals')->where(function ($query) use ($request) {
                return $query->where('project_id', $request->project_id)
                   ->where('freelancer_id',Auth::guard('freelancer')->id());
                            })
               ],[
                'required'=>'this input is required',
            ]);

            $freelancer=Auth::guard('freelancer');
            if(  $freelancer->user()->bids>0 &&  $freelancer->user()->bids<=30){

            DB::beginTransaction();
            try{

  $dues=$request->budget * ((90) / 100);

        $proposal=Proposal::create([
            'desc'   => $request->desc,
            'duration'   => $request->duration,
            'budget'   => $request->budget,
            'freelancer_id'=>Auth::guard('freelancer')->id(),
            'project_id'=>$request->project_id,
            'status'=>'waiting',
            'dues'=>$dues
        ]);

        $proposal->freelancer->bids=$proposal->freelancer->bids-1;
        $proposal->freelancer->save();

        if($request->has('uploads')){
            foreach($request->uploads as $file) {

                $proposal->files()->create([
                    'path' => $file,
                ]);

           }
           }
           $user = User::whereId($proposal->project->user_id)->first();

           $user->notify(new CreateProposal($proposal->project));
           //event(new CreateProposalEvent($proposal));

          //

          //Notification::send($proposal->project->user, new CreateProposal($proposal->project->slug));
           //event(new CreateProposalEvent($proposal));


            DB::commit();
        }catch(Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }

        return redirect()->back()->with('message', 'proposal created successfullly');
    }

    return redirect()->back()->with('error','youre finished your bid');

    }


public function discountByPercent($price){

    return $price * ((90) / 100);


}
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proposal = Proposal::find($id);
        return response()->json([
           'status' =>200,
           'proposal' =>$proposal,
       ]);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id=$request->proposalId;
        $dues=$request->budget * ((90) / 100);

        $proposal = Proposal::find($id);
        $proposal->update([
            'duration'=>$request->duration,
            'desc'=>$request->desc,
            'budget'=>$request->budget,
            'dues'=>$dues,

        ]);
        if($request->hasFile('uploads')){
            if($proposal->files()->count!=0){
                foreach($proposal->files as $file){
                    unlink($file->path);
                    $file->delete();
                }

            }
            $request->file('uploads')->store('/uploads/propsals', 'custom');
            foreach($request->uploads as $file) {

                $proposal->files()->create([
                    'path' => $file,
                ]);

           }



        }
        return redirect()->back()->with('message','propsal updateed successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function fileUpload(Request $request){
        return $request->file('file')->store('/uploads/propsals', 'custom');


}
public function fileDestroy(Request $request){

    $filename =  $request->get('filename');
    $path=public_path().'/'.$filename;
    if (file_exists($path)) {

        unlink($path);
    }
    return $path;



}

public function delivery($id){


    $proposal=Proposal::find($id);
    return view('contract.deliver',compact('proposal'));

}


public function complete(Request $request,$id){


    $request->validate([
        'uploads' => 'required' ,
           ],[
            'required'=>'this input is required',
        ]);
        DB::beginTransaction();
        try{

        $proposal=Proposal::find($id);
        if($request->hasFile('uploads')){

            foreach($request->uploads as $file) {
               $path=$file->store('/uploads/propsals', 'custom');

                $proposal->files()->create([
                    'path' => $path,
                    'feature' =>1,
                    'updated_at'=>now()
                ]);

           }
           }


           $proposal->update([
               'status'=>'completed',
           ]);

           $proposal->contract()->update([
            'status'=>'suspended',
        ]);


           DB::commit();
        }catch(Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }

        return redirect()->back()->with('message','The project has been delivered');

}
}
