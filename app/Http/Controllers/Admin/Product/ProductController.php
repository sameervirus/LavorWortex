<?php

namespace App\Http\Controllers\Admin\Product;

use App\Admin\Product\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Verot\Upload\Upload as UploadClass;
use Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        return view('admin.products.products'); 
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
    public function product($slug)
    {
        
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
            'features'  => 'required',
            'features_ar' => 'required'
        ]);

        $product = Product::create([
            'category' => $request->category,
            'category_ar' => $request->category_ar,
            'model' => Str::slug($request->model),
            'model_ar' => $request->model_ar,
            'features' => $request->features,
            'features_ar' => $request->features_ar,
            'technical_data' => $request->technical_data,
            'technical_data_ar' => $request->technical_data_ar,
            'accessories' => $request->accessories,
            'accessories_ar' => $request->accessories_ar,
            'optional' => $request->optional,
            'optional_ar' => $request->optional_ar
        ]);

        if($product) {
          if($request->file('file')){
              $fileAdders = $product
              ->addMultipleMediaFromRequest(['file'])
              ->each(function ($fileAdder) {
                  $fileAdder->withResponsiveImages();
                  $fileAdder->toMediaCollection('images');
              });
          }
          if($request->file('data_sheet')){
            $product->clearMediaCollection('data_sheet');
            $product->addMediaFromRequest('data_sheet')->toMediaCollection('sheets');
          }
            flash('Successfully Added')->overlay()->success();
        } else {
            flash('Something went worng please try again')->overlay()->success();
        }

        return redirect()->route('products.index');
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
        $product = Product::findOrFail($id);
        return view('admin.products.edit', ['item' => $product]);
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
        $item = Product::findOrFail($product);

        $request->validate([
            'category'  => 'required',
            'model'     => 'required',
            'features'  => 'required',
            'features_ar' => 'required'
        ]);
        
        
        $item->category = $request->category;
        $item->category_ar = $request->category_ar;
        $item->model = Str::slug($request->model);
        $item->model_ar = $request->model_ar;
        $item->features = $request->features;
        $item->features_ar = $request->features_ar;
        $item->technical_data = $request->technical_data;
        $item->technical_data_ar = $request->technical_data_ar;
        $item->accessories = $request->accessories;
        $item->accessories_ar = $request->accessories_ar;
        $item->optional = $request->optional;
        $item->optional_ar = $request->optional_ar;

        if($item->save()) {
            if($request->file('file')){
                $fileAdders = $item
                ->addMultipleMediaFromRequest(['file'])
                ->each(function ($fileAdder) {
                    $fileAdder->withResponsiveImages();
                    $fileAdder->toMediaCollection('images');
                });
            }
            if($request->file('data_sheet')){
              $item->clearMediaCollection('sheets');
              $item->addMediaFromRequest('data_sheet')->toMediaCollection('sheets');
            }
            flash('Successfully Update')->overlay()->success();
        } else {
            flash('Something went worng please try again')->overlay()->success();
        }        

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($product)
    {
        $item = Product::findOrFail($product);

        if($item->delete()){
          flash('Successfully Deleted')->overlay();
        } else {
          flash('Something went worng please try again')->overlay()->success();
        }

        return redirect()->route('products.index');
    }

}
