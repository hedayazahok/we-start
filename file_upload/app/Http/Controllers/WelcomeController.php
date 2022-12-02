<?php

namespace App\Http\Controllers;

use App\Jobs\FileUpload;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    function index()
    {
        return view('welcome');
    }

    function upload(Request $request)
    {
        $file_name = time() . '.' . request()->video->getClientOriginalExtension();

         request()->video->move(public_path('videos'),$file_name);

         FileUpload::dispatch($file_name);

        $video_path = asset('videos/'. $file_name);
        $file = request()->file('video');
        $mime = $file->getClientMimeType();

        return response()->json(['video_path'=>$video_path,'type'=>$mime]);


    }
}
