<?php

namespace App\Http\Controllers;

use App\Bread;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class BreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Bread::where('active_status', '=', 1)->get();
        return view('admin.bread', compact('data'));
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
        //validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $bread = new Bread();
        $bread->name = $request->name;
        $bread->save();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bread  $bread
     * @return \Illuminate\Http\Response
     */
    public function show(Bread $bread)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bread  $bread
     * @return \Illuminate\Http\Response
     */
    public function edit(Bread $bread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bread  $bread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bread $bread)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $bread =Bread::findOrfail($request->id);
        $bread->name = $request->name;
        $bread->save();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bread  $bread
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bread = Bread::findOrfail($id);
        $bread->delete();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }
}