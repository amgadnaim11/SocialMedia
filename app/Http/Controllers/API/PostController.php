<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Validator;

class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::all();

        return $this->sendResponse($post->toArray(), 'post retrieved successfully.');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         
              $validator = Validator::make($request->all(), [
            'image' => 'image',
            'body' => 'required|max:255'
        ]);
   


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
         $post = new Post;
        $post->body = $request->body;

        $post->user_id = $request->user_id;
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


        return $this->sendResponse($post->save(), 'Post created successfully.');
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
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        $validator = Validator::make($request->all(), [
            'image' => 'image',
            'body' => 'required|max:255'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
         
      $post->body = $request->body;
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


        return $this->sendResponse($post->save(), 'Post Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return $this->sendResponse($post->toArray(), 'Post deleted successfully.');
    }
}
