<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::paginate(10);
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


        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $request->file('upload')->move(public_path('images'), $fileName);
            $content = $request->input('content');
            $url = asset('assets/images/posts/'.$fileName);

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
    public function show(Post $Post)
    {
        $Post::where('id',$Post->id)->first();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin\Post  $Post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $Post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\admin\Post  $Post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $Post)
    {


        $post=Post::id($Post->id);


        if($request->hasFile('image')) {
            $OldImage=public_path($Post->image);

            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('assets/images/posts/'), $imageName);
            unlink($OldImage);
            $imgePost='assets/images/posts/'.$imageName;


        }else{

            $imgePost=$post->image;
        }


        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $request->file('upload')->move(public_path('images'), $fileName);
            $content = $request->input('content');
            $url = asset('assets/images/posts/'.$fileName);

        }
        $post->update([
            'title' => $request->title,
            'image' => $imgePost,
            'content' => $request->content,

        ]);



        $posts=Post::all();
        return response()->json(['posts' => $posts, 'success' => 'Post updated Successfully']);    }

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
        $posts=Post::all();
        return response()->json(['posts' => $posts, 'success' => 'Post deleted Successfully']);
       }

    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $request->file('upload')->move(public_path('images'), $fileName);
            $content = $request->input('content');
            $url = asset('images/'.$fileName);
            $msg = 'Image successfully uploaded';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($content, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }
}
