<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Download;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DownloadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.downloads.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.downloads.edit');
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
            'type' => 'required',
            'name' => 'required'
        ]);

        $add = Download::create([
            'type' => $request->type,
            'name' => $request->name,
            'name_ar' => $request->name_ar,
            'description' => $request->description,
            'description_ar' => $request->description_ar,
            'link' => $request->link
        ]);
        if($add) {
            if($request->has('data_sheet')) {
                $add->addMediaFromRequest('data_sheet')->toMediaCollection('download_file');
            }
            if($request->has('img')) {
                $add->addMediaFromRequest('img')->toMediaCollection('download_img');
            }
            flash('Successfully Added')->overlay()->success();
        } else {
            flash('Something went worng please try again')->overlay()->success();
        }

        return redirect()->route('downloads.show', $add->type);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Download  $download
     * @return \Illuminate\Http\Response
     */
    public function show($type)
    {
        return view('admin.downloads.index', [
            'items' => Download::where('type', $type)->orderBy('sort_order')->get()
        ]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Download  $download
     * @return \Illuminate\Http\Response
     */
    public function edit(Download $download)
    {
        return view('admin.downloads.edit', ['item' => $download]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Download  $download
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Download $download)
    {
        $request->validate([
            'type' => 'required',
            'name' => 'required'
        ]);

        $download->type = $request->type;
        $download->name = $request->name;
        $download->name_ar = $request->name_ar;
        $download->description = $request->description;
        $download->description_ar = $request->description_ar;
        $download->link = $request->link;

        if($download->save()) {
            if($request->has('data_sheet')) {
                $download->addMediaFromRequest('data_sheet')
                        ->toMediaCollection('download_file');
            }
            if($request->has('img')) {
                $download->addMediaFromRequest('img')
                        ->toMediaCollection('download_img');
            }
            flash('Successfully Added')->overlay()->success();
        } else {
            flash('Something went worng please try again')->overlay()->success();
        }

        return redirect()->route('downloads.show', $download->type);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Download  $download
     * @return \Illuminate\Http\Response
     */
    public function destroy(Download $download)
    {
        if($download->delete())
        {
            flash('Successfully Deleted')->overlay();
        } else {
            flash('Something went worng please try again')->overlay()->success();
        }

        return redirect()->route('posts.index');
    }
}
