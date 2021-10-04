<?php

namespace App\Http\Controllers\Admin\SiteContent;

use App\Admin\SiteContent\Sitecontent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Classes\Upload;
use Illuminate\Support\Str;

class SitecontentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $lang = request()->lang;
        $sitecontent = Sitecontent::where('lang' , $lang)->orderBy('id')->get();

        return view('admin.sitecontent.sitecontent', [
            'sitecontent' => $sitecontent,
            'lang' => $lang
        ]);
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
        //
        $content = $request->content;

        $massage = 'Successfully Added';

        if($request->file('file')){

            $i = 1;
            if(Str::slug($request->code) == 'favicon') $i=10;
            
            $handle = new Upload($request->file('file'));
            
            if ($handle->uploaded) {
              $handle->image_resize         = true;
              $handle->image_ratio_x        = true;
              $handle->image_y              = 160 / $i;
              $handle->process('images');
              
              if ($handle->processed) {
                $massage = 'Successfully Added';
                $content=$handle->file_dst_name;
                $handle->clean();  
              } else {
                $massage = 'error : ' . $handle->error;
              }
            }
        }

        SiteContent::create([
            'content' => $content,
            'code' => Str::slug($request->code),
            'lang' => $request->lang
        ]);
        
        return back()->with('message', $massage);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\SiteContent\Sitecontent  $sitecontent
     * @return \Illuminate\Http\Response
     */
    public function show(Sitecontent $sitecontent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\SiteContent\Sitecontent  $sitecontent
     * @return \Illuminate\Http\Response
     */
    public function edit(Sitecontent $sitecontent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\SiteContent\Sitecontent  $sitecontent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sitecontent $sitecontent)
    {
        //
        \DB::transaction(function () use ($request) {
            $lang = $request->lang;

            if($request->file('logo')){
                $handle = new Upload($request->file('logo'));
            
                if ($handle->uploaded) {
                    $handle->image_resize         = true;
                    $handle->image_ratio_x        = true;
                    $handle->image_y              = 160;
                    $handle->process('images');
                    if ($handle->processed) {
                        $massage = 'Successfully Added';
                        SiteContent::where([
                                    ['code','=','logo'],
                                    ['lang', '=', $lang]
                                ])
                                    ->update(['content' => $handle->file_dst_name]);
                        $handle->clean();  
                    } 
                }

            }

            if($request->file('favicon')){
                $handle = new Upload($request->file('favicon'));
            
                if ($handle->uploaded) {
                    $handle->image_resize         = true;
                    $handle->image_ratio_x        = true;
                    $handle->image_y              = 16;
                    $handle->process('images');
                    if ($handle->processed) {
                        $massage = 'Successfully Added';
                        SiteContent::where([
                                        ['code','=','favicon'],
                                        ['lang', '=', $lang]
                                    ])->update(['content' => $handle->file_dst_name]);
                        $handle->clean();  
                    } 
                }

            }
            foreach ($request->all() as $key => $value) {
                
                if ($key == '_method' or $key == '_token' or $key == 'logo' or $key == 'favicon' or $key == 'healthcare' or $key == 'traveltours' or $key == 'shandalodge' or $key == 'egytat') continue;

                SiteContent::where([
                                    ['code','=', $key],
                                    ['lang', '=', $lang]
                                ])->update(['content' => $value]);
            }
        });

        return back()->with('message','Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\SiteContent\Sitecontent  $sitecontent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sitecontent $sitecontent)
    {
        //
    }
}
