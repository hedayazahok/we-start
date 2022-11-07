<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {



        $count = 10;

        if($request->has('count')) {
            $count = $request->count;


        }
        $posts = Post::orderByDesc('id')->paginate($count);



        if($request->has('search')) {
       $posts = Post::where('title', 'like', '%'.$request->search.'%')->orderByDesc('id')->paginate($count);
        }


        return view('admin.posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');

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
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'required',
        ]);



        if($request->hasFile('image')) {

            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('assets/images/posts/'), $imageName);
            $imgePost='assets/images/posts/'.$imageName;


        }



        Post::create([
            'title' => $request->title,
            'image' => $imgePost,
            'content' => $request->content,
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Post Created Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admin\Post  $Post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post=Post::find($id);
        return view('singlePost')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin\Post  $Post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $Post)
    {
        return view('admin.posts.edit')->with('post',$Post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\admin\Post  $Post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // return $Categories if the request is from Axios or Ajax
        $id=$request->id;
        $Post=Post::find($id);


        if($request->hasFile('image')) {
        if(!filter_var($Post->image,FILTER_VALIDATE_URL)){
            $OldImage=public_path($Post->image);
            unlink($OldImage);

        }

            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('assets/images/posts/'), $imageName);

            $imgePost='assets/images/posts/'.$imageName;


        }else{

            $imgePost=$Post->image;
        }




            $Post->title =$request->title;
            $Post->content = $request->content;
            $Post->image = $imgePost;
            $Post->save();




        return redirect()->route('admin.posts.index')->with('success', 'Post updated Successfully');


    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin\Post  $Post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $Post)
    {
        $id=$Post->id;
        Post::destroy($id);

        if(!filter_var($Post->image,FILTER_VALIDATE_URL)){
            $OldImage=public_path($Post->image);
            unlink($OldImage);

        }
        $posts=Post::all();

        return response()->json(['posts' => $posts, 'success' => 'Post deleted Successfully']);
       }


       function getPage(){



       }


}
