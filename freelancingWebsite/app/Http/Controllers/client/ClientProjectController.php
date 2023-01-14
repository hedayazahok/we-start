<?php

namespace App\Http\Controllers\client;

use App\Events\NewProjectEvent;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contract;
use App\Models\Freelancer;
use App\Models\Message;
use App\Models\Project;
use App\Models\Proposal;
use App\Models\Skill;
use App\Models\User;
use App\Notifications\NewProject;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ClientProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects=Project::where('user_id',Auth::id())->paginate(10);


        return view('client.projects.allProjects',compact(['projects']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $skills=Skill::all();
        $categories=Category::all();

        return view('client.projects.createProject',compact(['skills','categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|unique:projects,title',
            'desc' => 'required' ,
            'category_id' => 'required' ,
            'duration'=> 'required' ,
            'skills'=> 'required' ,
            'budget'=> 'required' ,
               ],[
                'required'=>'this input is required',
                'unique'=>'change the title of the project its repeated ',
            ]);


        $budget=explode('-',$request->budget);
        DB::beginTransaction();
        try{
        $project=Project::create([
            'title'   => $request->title,
            'slug'=>'',
            'desc'   => $request->desc,
            'duration'   => $request->duration,
            'budget_from'   => $budget[0],
            'skills'   => $request->skills,
            'budget_to'   => $budget[1],
            'user_id'=>Auth::id(),
            'status'=>'underReview',
            'category_id'=>$request->category_id,

        ]);
       if($request->has('uploads')){
        foreach($request->uploads as $file) {

            $project->files()->create([
                'path' => $file,
            ]);

       }
       }
       $user=User::find(1);
       $user->notify(new NewProject($project));


        DB::commit();
    }catch(Exception $e) {
        DB::rollBack();
        throw new Exception($e->getMessage());
    }

    return redirect()->route('client.profile')->with('message', 'project created successfullly');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$name)
    {
        $project=Project::find($id)->load('proposals', 'files');
        $category=null;
        if($project->category!=null){
        $category=$project->category->name;
        }
        $skills=explode(',',$project->skills);

        $date = now();

        $to_date = Carbon::createFromFormat('Y-m-d H:s:i', $date);
        $from_date = Carbon::createFromFormat('Y-m-d H:s:i',$project->created_at);
        $diff = $from_date->diffForHumans();

        //avg budget for probosals
        if($project->proposals()->count()!=0){
            $sum=0;
            $avgBid=0;

            $count=$project->proposals()->count();

            foreach($project->proposals as $proposal){
                $sum= $sum+$proposal->budget;

            }
            $avgBid=$sum/$count;



        }else{
            $avgBid=0;

        }

        return view('client.projects.showProject',compact(['project','category','skills','diff','avgBid']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
            return $request->file('file')->store('/uploads/projects', 'custom');


    }
    public function fileDestroy(Request $request){

        $filename =  $request->get('filename');
        $path=public_path().'/'.$filename;
        if (file_exists($path)) {

            unlink($path);
        }
        return $path;



}
public function proposalCancled($id){
    $proposal=Proposal::find($id);
    $proposal->update([
        'status'=>'cancled'
    ]);
    if($proposal->freelancer->bids>30){
    $proposal->freelancer()->update([
        'bids'=>$proposal->freelancer->bids+1,
    ]);
}
    return response()->json([
        'proposal' => $proposal,
        'msg'=>'Propsal cancled Successfuly',
    ], Response::HTTP_OK);
}


public function proposalAccept($id){
    $proposal=Proposal::find($id);
    $proposal->update([
        'status'=>'processing'
    ]);

    $propsals=Proposal::where('id', '!=', $id);
    $propsals->update(array("status" => "cancled"));

    $proposal->project->update([
        'status'=>'ongoing'
    ]);
    $endDate = Carbon::now()->addDays($proposal->duration);

    $contract=Contract::create([
        'user_id'=>$proposal->project->user_id,
        'proposal_id'=>$proposal->id,
        'freelancer_id'=>$proposal->freelancer_id,
        'end_time'=>$endDate

    ]);




    $client=User::find($proposal->project->user_id);
    $freelancer=Freelancer::find($proposal->freelancer_id);
    $project=$proposal->project;
    $messages=Message::where('project_id',$proposal->project_id)->orderBy('created_at','desc')->get();
    $duration=$proposal->duration;
    $to_date = $contract->end_time;
    $from_date = $contract->start_time;

    return view('contract.discussion',compact(['to_date','from_date','duration','project','contract','client','freelancer','messages']));


}
}








