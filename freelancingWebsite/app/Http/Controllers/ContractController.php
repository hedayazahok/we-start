<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Financial_transaction;
use App\Models\Freelancer;
use App\Models\Message;
use App\Models\Proposal;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use ZipArchive;

class ContractController extends Controller
{


    public function contract_page($id){
        $proposal  =Proposal::find($id);
        $client=User::find($proposal->project->user_id);
        $freelancer=Freelancer::find($proposal->freelancer_id);
        $project=$proposal->project;
        $messages=Message::where('project_id',$proposal->project_id)->orderBy('created_at','desc')->get();
        $contract=$proposal->contract;
        $duration=$proposal->duration;
        $to_date = $contract->end_time;
        $from_date = $contract->start_time;
        return view('contract.discussion',compact(['to_date','from_date','duration','project','contract','client','freelancer','messages']));

    }


    public function message(Request $request){
        $request->validate([
             'message' => 'required' ,
                ],[
                 'required'=>'this input is required',
             ]);
             Message::create([
         'user_id'=>$request->user_id,
         'project_id'=>$request->project_id,
         'message'=>$request->message,
         'type'=>$request->type,

             ]);

         return redirect()->back();

     }


     public function download_files($id)
     {



         $zip = new ZipArchive;

         $fileName = time().'.zip';
         $proposal=Proposal::find($id);
         $files=$proposal->files_proposal_completed;



         if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE)
         {
             // Folder files to zip and download
             // files folder must be existing to your public folder

                // loop the files result

             foreach ($files as $key => $value) {


                 $relativeNameInZipFile = basename($value->path);
                 $zip->addFile($value->path, $relativeNameInZipFile);
             }
             $zip->close();
         }

         // Download the generated zip
         return response()->download(public_path($fileName));
     }


     public function complete($id){


         DB::beginTransaction();
         try{
            $contract=Contract::find($id);
            $user=$contract->user;

            $freelancer=$contract->freelancer;
            $proposal=$contract->proposal;

            $project=$proposal->project;

            $project->update([
                'status'=>'completed'
            ]);
            $user->update([
                'wallet'=>$user->wallet-$proposal->budget,
            ]);
           $admin= User::where('type','admin')->first();
           $dues=$proposal->budget * ((90) / 100);

           $admin->update([
                'wallet'=>$admin->wallet+$proposal->budget-$dues,
            ]);

           /* Financial_transaction::create([
                'user_id'=>$id,
                "amount" => -$proposal->budget,

            ]);
*/
            $freelancer->update([
                'wallet'=>$proposal->dues,

            ]);


            $contract->update([
                'status'=>'completed',
                'payment_amount'=>$proposal->budget
            ]);

            DB::commit();


        }catch(Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }




return redirect()->back()->with('message','The project has been received');


     }

public function reject_receipt($id){


}



     }
