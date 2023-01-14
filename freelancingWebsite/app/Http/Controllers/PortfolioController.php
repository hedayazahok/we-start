<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Freelancer;
use App\Models\Image;
use App\Models\Portfolio;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
       $Portfolios= Portfolio::where('freelancer_id',$id)->get();
       return view('portfolio.index',compact(['Portfolios']));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $categories=Category::all();
        $freelancer=Freelancer::find($id);
        return view('portfolio.create',compact(['categories','freelancer']));



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
            'desc' => 'required' ,
            'title'=> 'required' ,
            'skills'=> 'required' ,
            'category_id'=> 'required' ,
            'exec_date' => 'required',
            'image' => 'required|image'
               ],[
                'required'=>'this input is required',
                'image.image'=>'upload just image'
            ]);
            DB::beginTransaction();
            try{
                $portfolio=Portfolio::create([
                    'title'   => $request->title,
                    'desc'   => $request->desc,
                    'urls'   => $request->urls,
                    'skills'   => $request->skills,
                    'exec_date'   => $request->exec_date,
                    'freelancer_id'=>Auth::guard('freelancer')->id(),
                    'category_id'=>$request->category_id,
                ]);
                if($request->has('uploads')){
                    foreach($request->uploads as $file) {


                        $portfolio->files()->create([
                            'path' => $file,
                        ]);

                   }
                   }

                   if($request->hasFile('image')){
                    $path=$request->file('image')->store('/uploads/Portfolios', 'custom');
                    $portfolio->files()->create([
                        'path' => $path,
                        'feature'=>1

                    ]);
                   }
                    DB::commit();
                }catch(Exception $e) {
                    DB::rollBack();
                    throw new Exception($e->getMessage());
                }
                return redirect()->back()->with('message', 'portfolio created successfullly');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $portfolio=Portfolio::find($id);
        $freelancer=Freelancer::find($portfolio->freelancer_id);
       $skills=json_decode($portfolio->skills);
        return view('portfolio.details',compact('freelancer','portfolio','skills'));
        }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories=Category::all();
        $portfolio=Portfolio::find($id);
        $freelancer=Freelancer::find($portfolio->freelancer_id);
       $skills=json_decode($portfolio->skills);
        return view('portfolio.edit',compact('categories','freelancer','portfolio','skills'));
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
        $portfolio=Portfolio::find($id);
        DB::beginTransaction();
        try{
            $portfolio->update([
                'title'   => $request->title,
                'desc'   => $request->desc,
                'urls'   => $request->urls,
                'skills'   => $request->skills,
                'exec_date'   => $request->exec_date,
                'freelancer_id'=>Auth::guard('freelancer')->id(),
                'category_id'=>$request->category_id,
            ]);
            if($request->has('uploads')){
                foreach($request->uploads as $file) {


                    $portfolio->files()->create([
                        'path' => $file,
                    ]);

               }
               }

               if($request->hasFile('image')){
                $path=public_path().'/'.$portfolio->image->path;
                if (file_exists($path)) {

                 unlink($path);
             }
            Image::where('id',$portfolio->image->id)->delete();

                $path=$request->file('image')->store('/uploads/Portfolios', 'custom');
                $portfolio->files()->create([
                    'path' => $path,
                    'feature'=>1

                ]);
               }
                DB::commit();
            }catch(Exception $e) {
                DB::rollBack();
                throw new Exception($e->getMessage());
            }
            return redirect()->back()->with('message', 'portfolio updated successfullly');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try{
        $portfolio=Portfolio::find($id);
        $path=public_path().'/'.$portfolio->image->path;
        if (file_exists($path)) {

         unlink($path);
     }
     Image::where('id',$portfolio->image->id)->delete();

     foreach ($portfolio->files as $file){
        $path=public_path().'/'.$file->path;
        if (file_exists($path)) {

         unlink($path);
     }
     Image::where('id',$file->id)->delete();
     }

     $portfolio->delete();
     DB::commit();
    }catch(Exception $e) {
        DB::rollBack();
        throw new Exception($e->getMessage());
    }
    $freelancer=Auth::guard('freelancer')->user()->id;

    return redirect()->route('freelancer.profile',$freelancer)->with('message', 'portfolio deleted successfullly');

    }


    public function fileUpload(Request $request){
        return $request->file('file')->store('/uploads/Portfolios', 'custom');


}
public function fileDestroy(Request $request,$id=0){
    if($id==0){

    $filename =  $request->get('filename');
    $path=public_path().'/'.$filename;
    if (file_exists($path)) {

        unlink($path);
    }

    }else{
       $image= Image::find($id);
       $path=public_path().'/'.$image->path;
       if (file_exists($path)) {

        unlink($path);
    }

    $image->delete();
    }



    return $path;





}
}

