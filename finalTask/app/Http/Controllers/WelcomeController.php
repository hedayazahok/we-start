<?php

namespace App\Http\Controllers;

use Barryvdh\Snappy\Facades\SnappyPdf as SnappyPdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\Snappy\Facades\SnappyImage as SnappyImage;
use Illuminate\Support\Facades\Mail as Mail;

class WelcomeController extends Controller
{
    public function index(){
        return view('welcome');

    }
    public function certificate (){
        return view('certificate');
    }

    public function genrate_certificate(Request $request){
        $certficate=[];
        $certficate['name']=$request->stdname;
        $certficate['course']=$request->course;
        $certficate['hour']=$request->hour;
//pdf generate
$pdf = SnappyPdf::loadView('certificate',compact('certficate')
)->setPaper('A4','Portrait')->setOrientation('portrait');
$pdfFile=rand().'.'.'pdf';
Storage::put('public/pdf/'.$pdfFile,$pdf->output());

//image generate
$img=SnappyImage::View('certificate', compact('certficate'));

    $imgFile=rand().'.'.'png';
    Storage::put('public/image/'.$imgFile,$img->output());
    $files = [
        storage_path("app\public\image\\".$imgFile),
        storage_path("app\public\pdf\\".$pdfFile),
    ];

    $data["email"] = "hyatzahok@gmail.com";
    $data["title"] = "Certificate Task";
    $data["body"] = "Finally,I have done the task you gave me ^_^ ";

$certficate;
    //send email with attachment
Mail::send('emails.certificate', $data, function($message)use($data, $files) {
    $message->to($data["email"], $data["email"])
            ->subject($data["title"]);

    foreach ($files as $file){
        $message->attach($file);
    }

});
return view('welcome')->with('succsses','Mail sent successfully');

}








}
