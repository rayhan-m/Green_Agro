<?php

namespace App\Http\Controllers;

use App\Seller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Seller::where('active_status', '=', 1)->get();
        return view('admin.seller', compact('data'));
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
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $seller = new Seller();
        $seller->name = $request->name;
        $seller->phone = $request->phone;
        $seller->email = $request->email;
        $seller->address = $request->address;
        $image = "";
        if ($request->file('image') != "") {
            $file = $request->file('image');
            $image = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('backend/uploads/image/', $image);
            $image = 'backend/uploads/image/' . $image;
            $seller->image = $image;
        }
        $seller->save();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function show(Seller $seller)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function edit(Seller $seller)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seller $seller)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $seller =Seller::findOrfail($request->id);
        $seller->name = $request->name;
        $seller->phone = $request->phone;
        $seller->email = $request->email;
        $seller->address = $request->address;
        $image = "";
        if ($request->file('image') != "") {
            $file = $request->file('image');
            $image = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('backend/uploads/image/', $image);
            $image = 'backend/uploads/image/' . $image;
            $seller->image = $image;
        }
        $seller->save();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $seller = Seller::findOrfail($id);
        $seller->delete();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }
}