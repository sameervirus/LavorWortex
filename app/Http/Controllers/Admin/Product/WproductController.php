<?php

namespace App\Http\Controllers\Admin\Product;

use App\Admin\Wproduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Verot\Upload\Upload as UploadClass;
use Str;

class WproductController extends Controller
{
    public $postData;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        return view('admin.wproducts.products'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function category($slug)
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.wproducts.edit');
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
            'category'  => 'required',
            'model'     => 'required',
            'details'  => 'required'
        ]);

        $product = Wproduct::create([
            'category' => Str::slug($request->category),
            'category_ar' => $request->category_ar ?? $request->category,
            'slug' => Str::slug($request->model),
            'name' => $request->model,
            'name_ar' => $request->model_ar ?? $request->model,
            'details' => $request->details,
            'details_ar' => $request->details_ar
        ]);

        $this->postData = $request;

        if($product) {
          if($request->file('file')){
              $fileAdders = $product
              ->addMultipleMediaFromRequest(['file'])
              ->each(function ($fileAdder) {
                  $fileAdder->toMediaCollection('images');
              });
          }
          if($request->file('data_sheet')){
              $fileAdders = $product
              ->addMultipleMediaFromRequest(['data_sheet'])
              ->each(function ($fileAdder) {                  
                  $fileAdder->withCustomProperties(['code' => $this->postData->code, 'code_name' => $this->postData->code_name]);
                  $fileAdder->toMediaCollection('data_sheet');
              });
          }
            flash('Successfully Added')->overlay()->success();
        } else {
            flash('Something went worng please try again')->overlay()->success();
        }

        return redirect()->route('wproducts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($category)
    {
        return view('admin.products.products', [
            'products' => Product::where('category', $category)->orderBy('sort_order')->get()
        ]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Wproduct::findOrFail($id);
        return view('admin.wproducts.edit', ['item' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product)
    {
        $item = Wproduct::findOrFail($product);

        $request->validate([
            'category'  => 'required',
            'model'     => 'required',
            'details'  => 'required'
        ]);
        
        
        $item->category = Str::slug($request->category);
        $item->category_ar = $request->category_ar ?? $request->category;
        $item->slug = Str::slug($request->model);
        $item->name = $request->model;
        $item->name_ar = $request->model_ar;
        $item->details = $request->details;
        $item->details_ar = $request->details_ar;

        $this->postData = $request;

        if($item->save()) {
            if($request->file('file')){
                $fileAdders = $item
                ->addMultipleMediaFromRequest(['file'])
                ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('images');
                });
            }
            if($request->file('data_sheet')){
                  $fileAdders = $item
                  ->addMultipleMediaFromRequest(['data_sheet'])
                  ->each(function ($fileAdder) {                  
                      $fileAdder->withCustomProperties(['code' => $this->postData->code, 'code_name' => $this->postData->code_name]);
                      $fileAdder->toMediaCollection('data_sheet');
                  });
            }
            flash('Successfully Update')->overlay()->success();
        } else {
            flash('Something went worng please try again')->overlay()->success();
        }        

        return redirect()->route('wproducts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($product)
    {
        $item = Wproduct::findOrFail($product);

        if($item->delete()){
          flash('Successfully Deleted')->overlay();
        } else {
          flash('Something went worng please try again')->overlay()->success();
        }

        return redirect()->route('products.index');
    }

}