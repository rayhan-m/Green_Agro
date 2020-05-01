<?php

namespace App\Http\Controllers;

use App\MilkBuyer;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class MilkBuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $data = MilkBuyer::where('active_status', '=', 1)->get();
        return view('admin.milk_buyer', compact('data'));
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
        $milk_buyer = new MilkBuyer();
        $milk_buyer->name = $request->name;
        $milk_buyer->phone = $request->phone;
        $milk_buyer->email = $request->email;
        $milk_buyer->address = $request->address;
        $image = "";
        if ($request->file('image') != "") {
            $file = $request->file('image');
            $image = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('backend/uploads/image/', $image);
            $image = 'backend/uploads/image/' . $image;
            $milk_buyer->image = $image;
        }
        $milk_buyer->save();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MilkBuyer  $milkBuyer
     * @return \Illuminate\Http\Response
     */
    public function show(MilkBuyer $milkBuyer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MilkBuyer  $milkBuyer
     * @return \Illuminate\Http\Response
     */
    public function edit(MilkBuyer $milkBuyer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MilkBuyer  $milkBuyer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MilkBuyer $milkBuyer)
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
        $milk_buyer =MilkBuyer::findOrfail($request->id);
        $milk_buyer->name = $request->name;
        $milk_buyer->phone = $request->phone;
        $milk_buyer->email = $request->email;
        $milk_buyer->address = $request->address;
        $image = "";
        if ($request->file('image') != "") {
            $file = $request->file('image');
            $image = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('backend/uploads/image/', $image);
            $image = 'backend/uploads/image/' . $image;
            $milk_buyer->image = $image;
        }
        $milk_buyer->save();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MilkBuyer  $milkBuyer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $milk_buyer = MilkBuyer::findOrfail($id);
        $milk_buyer->delete();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }
}