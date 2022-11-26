<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Chalet;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ChaletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chalets=Chalet::all();

        return view('admin.chalets.index',compact('chalets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        $chalet=Chalet::find($id);

        $images=null;
        if($chalet != null){
            $images=Image::where('chalet_id',$chalet->id)->get();

        }
        return view('admin.chalets.create',compact(['chalet','images']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $chalet=Chalet::create([
            'name'=>$request->name,
            'details'=>$request->details,
            'price'=>$request->price,
            'address'=>$request->address,

        ]);

        if(! is_null(request('images')))
        {
            $photos=request('images');
            foreach ($photos as $image)
             {
                $name=time().rand().$image->getClientOriginalName();
                $image->move(public_path('/uploads'), $name);

                $chalet->images()->create([
                    'path'=>'/uploads/'.$name,
                    'chalet_id'=>$chalet->id,
                    'main'=>1
                ]);







            }






    }
    return redirect()->route('admin.chalet.index')->with('message','the chalet created sucessfully');

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {

        $chalet=Chalet::find($id);
        $chalet->update([
            'name'=>$request->name,
            'details'=>$request->details,
            'price'=>$request->price,
            'address'=>$request->address,

        ]);

        if(! is_null(request('images')))
        {
            $images=Image::where('chalet_id',$id)->get();
            foreach ($images as $image) {
                File::delete(public_path($image->path));
                $images->each->delete();


            }




            $photos=request('images');

            foreach ($photos as $image)
             {
                $name=time().rand().$image->getClientOriginalName();
                $image->move(public_path('/uploads'), $name);

                $chalet->images()->create([
                    'path'=>'/uploads/'.$name,
                    'chalet_id'=>$chalet->id,
                    'main'=>1
                ]);







            }






    }
    return redirect()->route('admin.chalet.index')->with('message','the chalet updated sucessfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $chalet=Chalet::find($id);
       $chalet->delete();
       $chalet->images()->delete();

       return response()->json(['chalet'=>$chalet,'success'=>'chalet deleted successfully!']);



    }
}
