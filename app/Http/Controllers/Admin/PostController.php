<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Post;
use Illuminate\Http\Request;
use App\Classes\Upload as UploadClass;
use App\Http\Controllers\Controller;
use Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sort_order = Post::max('sort_order') + 1 ;
        $item = new Post;

        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'img' => 'required',
        ]);
        
        $item->title = $request->title;
        $item->title_ar = $request->title_ar ?? $request->title;
        $item->slug = Str::slug($request->title);
        $item->body = $request->body;
        $item->body_ar = $request->body_ar ?? $request->body;
        $item->sort_order = $sort_order;

        if($item->save()) {
            if($request->has('img')) {
                $fileAdders = $item
                  ->addMultipleMediaFromRequest(['img'])
                  ->each(function ($fileAdder) {
                      $fileAdder->toMediaCollection('post_img');
                  });
            }
            flash()->overlay('Successfully Added','Success');
        } else {
            flash()->overlay('Something went worng please try again','Error');
        }

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('post',['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', ['item' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        
        $post->title = $request->title ?? $request->title;
        $post->title_ar = $request->title_ar;
        $post->slug = Str::slug($request->title);
        $post->body = $request->body;
        $post->body_ar = $request->body_ar;

        if($post->save()) {
            if($request->has('img')) {
                $fileAdders = $post
                  ->addMultipleMediaFromRequest(['img'])
                  ->each(function ($fileAdder) {
                      $fileAdder->toMediaCollection('post_img');
                  });
            }
            flash()->overlay('Successfully Updated','Success');
        } else {
            flash()->overlay('Something went worng please try again','Error');
        }

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        if($post->delete()) {
            flash('Successfully Deleted')->overlay();
        } else {
            flash('Something went worng please try again')->overlay()->success();
        }        

        return redirect()->route('posts.index');
    }
}
