<?php

namespace App\Http\Controllers;

use App\Models\Freelancer;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        return view('home');
    }

    public function browseProject()
    {
        $projects=Project::where('status','opened')->get();

        return view('browseProject',compact(['projects']));
    }


    public function showProject($slug){
      $project=  Project::where('slug',$slug)->first();
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

      $diffDayForClose=15-$from_date->diffInDays();

      return view('project',compact(['project','skills','diff','avgBid','diffDayForClose']));
    }

    public function hireFreelancer()
    {
        $freelancers=Freelancer::where('status','open')->paginate(10);

        return view('hireFreelancer',compact(['freelancers']));
    }

    public function showProjectByTag($tag){
        $projects=Project::where('status','opened')->where('skills','lIKE','%'.$tag.'%')->get();


        return view('browseProject',compact(['projects']));
    }

    public function filter(Request $request){
        if($request->has('budget')){
            $projects=Project::where('status','opened');

            $budget=explode('-',$request->budget);
            $projects= $projects->where(['budget_from'=>$budget[0],'budget_to'=>$budget[1]])->get();
            return response()->json([
                'projects' => $projects,
            ], Response::HTTP_OK);

        }


        if($request->has('duration')){
            $projects=Project::where('status','opened');


           switch ($request->duration) {
                case "1":
                   $projects= Project::where('status','opened')->where('duration','<',7)->get();
                break;
                case "2":
                    $projects= Project::where('status','opened')->whereBetween('duration', [8, 30])->get();
                break;
               case "3":
                $projects= Project::where('status','opened')->whereBetween('duration', [31, 93])->get();
                break;
                  case "4":
                    $projects= Project::where('status','opened')->whereBetween('duration', [93, 186])->get();
                    break;
                  case "5":
                    $projects= Project::where('status','opened')->where('duration','>',186)->get();
                  break;

                default:
                $projects= Project::where('status','opened')->where('duration','>',186)->get();
                break;
            }
            return response()->json([
                'projects' => $projects,
            ], Response::HTTP_OK);

        }
        }






}
