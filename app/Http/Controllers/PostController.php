<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->get();
        return view('post.create', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'image',
            'body' => 'required|max:255'
        ]);
        $post = new Post;
        $post->body = $request->body;

        $post->user_id = Auth::user()->id;
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $image_name = str_random(20);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . "." . $ext;
            $uploadpath = 'PostImg/';
            $image_url = $uploadpath . $image_full_name;
            $success = $image->move($uploadpath, $image_full_name);

            $post->image = $image_url;
        }
        $post->save();


        Session::flash('success', 'Post added successfully ');
        return redirect('/post');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function showall()
    {
        $posts = Post::orderBy('id', 'desc')->get();
        return view('post.ShowAllPosts', compact('posts'));
    }

    public function YourPosts()
    {

        return view('post.yourposts');

    }


    public function show($id)
    {

        $postcomment = Post::find($id);
        return view('post.comment', compact('postcomment'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editpost = Post::find($id);

        return view('post.edit', compact('editpost'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $post = Post::find($id);
        $this->validate($request, [
            'image' => 'image',
            'body' => 'required|max:255'
        ]);

        $post->body = $request->body;

        $post->user_id = Auth::user()->id;
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $image_name = str_random(20);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . "." . $ext;
            $uploadpath = 'PostImg/';
            $image_url = $uploadpath . $image_full_name;
            $success = $image->move($uploadpath, $image_full_name);
            $post->image = $image_url;
        }
        $post->save();


        Session::flash('success', 'Post Edit successfully ');
        return redirect('/post');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        Session::flash('success', 'Post deleted succesfully');
        return redirect('/post');
    }
}
