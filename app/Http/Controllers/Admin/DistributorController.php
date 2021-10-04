<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Distributor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DistributorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.distributors.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.distributors.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 'name','city', 'address', 'phone', 'location', 'name_ar','city_ar', 'address_ar', 'sort_order'
        $request->validate([
            'name' => 'required',
            'city' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'location' => 'required'
        ]);

        $add = Distributor::create([
            'name' => $request->name,
            'city' => $request->city,
            'address' => $request->address,
            'phone' => $request->phone,
            'location' => $request->location,
            'name_ar' => $request->name_ar,
            'city_ar' => $request->city_ar,
            'address_ar' => $request->address_ar
        ]);
        if($add) {            
            flash('Successfully Added')->overlay()->success();
        } else {
            flash('Something went worng please try again')->overlay()->success();
        }

        return redirect()->route('distributors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function show(Distributor  $distributor)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function edit(Distributor $distributor)
    {
        return view('admin.distributors.edit', ['item' => $distributor]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Distributor $distributor)
    {
        $request->validate([
            'name' => 'required',
            'city' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'location' => 'required'
        ]);

        $distributor->name = $request->name;
        $distributor->name_ar = $request->name_ar;
        $distributor->city = $request->city;
        $distributor->city_ar = $request->city_ar;
        $distributor->address = $request->address;
        $distributor->address_ar = $request->address_ar;
        $distributor->phone = $request->phone;
        $distributor->location = $request->location;

        if($distributor->save()) {            
            flash('Successfully Added')->overlay()->success();
        } else {
            flash('Something went worng please try again')->overlay()->success();
        }

        return redirect()->route('distributors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Distributor $distributor)
    {
        if($distributor->delete())
        {
            flash('Successfully Deleted')->overlay();
        } else {
            flash('Something went worng please try again')->overlay()->success();
        }

        return redirect()->route('posts.index');
    }
}
