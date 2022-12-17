<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\Snappy\Facades\SnappyImage as SnappyImage;
use Illuminate\Support\Facades\Response;

class QrCodeController extends Controller
{
    public function add_image(Request $request)
    {
        return $request->file('file')->store('/uploads/logo', 'custom');
    }

    public function event_create(Request $request){
            $album= json_encode($request->album, JSON_UNESCAPED_UNICODE);
           $conference= Conference::create([
                'name'=>$request->name,
                'doe'=>$request->doe,
                'bio'=>$request->bio,
                'sponsor_comps_logo'=>$album,


            ]);
        /*   $image = QrCode::format('png')
            ->size(200)
            ->generate('http://127.0.0.1:8000/conference/'.$conference->id);
$output_file = 'img\qr-code\img-' . time() . '.png';

$image->store('/qr_code', 'custom');
//Storage::disk('local')->put($output_file, $image);
//$qr_path=storage_path("app\\".$output_file);*/
$logo=json_decode($conference->sponsor_comps_logo);

return view('converence',compact([ 'conference','logo']));

        }

        public function conference_register_form($id){


            $conference= Conference::find($id);

            return view('event',compact(['conference']));


        }

        public function conference_register (Request $request,$id){
            Register::create([
                'name'=>$request->name,
                'phone'=>$request->phone,
                'email'=>$request->email,
                'address'=>$request->address,
                'conference_id'=>$id,

            ]);

            return redirect()->back()->with('success','register done sucessfully!');


        }


        public function generate_image($id){
            $conference= Conference::find($id);
            $logo=json_decode($conference->sponsor_comps_logo);



            $imgFile=rand().'.'.'png';

            $img=SnappyImage::View('image',compact(['conference','logo']));
            $imgFile=rand().'.'.'png';
            Storage::put('public/image/'.$imgFile,$img->output());

            //Storage::put('public/qr_code/'.$imgFile,$img->output());

            $filepath = storage_path('app\public\image\\'). $imgFile;

            return Response::download($filepath);


        }




    }



