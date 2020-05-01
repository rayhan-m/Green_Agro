<?php

namespace App\Http\Controllers;

use App\Milk;
use validation;
use App\SellMilk;
use App\MilkBuyer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class SellMilkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $milk_buyers = MilkBuyer::where('active_status', '=', 1)->get();
        
        $data = SellMilk::Join('milk_buyers', 'sell_milks.milk_buyer_id', '=', 'milk_buyers.id')
        ->select('sell_milks.id as sell_milk_id','sell_milks.milk_buyer_id','sell_milks.sell_date','sell_milks.price','sell_milks.quantity','sell_milks.total','sell_milks.status','sell_milks.payment_status','milk_buyers.name')
        ->get();
        return view('admin.sell_milk', compact('data','milk_buyers'));
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
            'milk_buyer_id' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $sell_milk = new SellMilk();
        $sell_milk->milk_buyer_id = $request->milk_buyer_id;
        $sell_milk->sell_date = Carbon::today()->toDateString();
        $sell_milk->price = $request->price;
        $sell_milk->quantity = $request->quantity;
        $sell_milk->total = $request->price * $request->quantity;
        $sell_milk->save();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SellMilk  $sellMilk
     * @return \Illuminate\Http\Response
     */
    public function show(SellMilk $sellMilk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SellMilk  $sellMilk
     * @return \Illuminate\Http\Response
     */
    public function edit(SellMilk $sellMilk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SellMilk  $sellMilk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // return $request;
    
        $validator = Validator::make($request->all(), [
            'milk_buyer_id' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $sell_milk =SellMilk::findOrfail($request->id);
        $sell_milk->milk_buyer_id = $request->milk_buyer_id;
        $sell_milk->sell_date = Carbon::today()->toDateString();
        $sell_milk->price = $request->price;
        $sell_milk->quantity = $request->quantity;
        $sell_milk->total = $request->price * $request->quantity;
        $sell_milk->save();
        Toastr::success('Operation successful', 'Success');
        return redirect()->route('sell_milk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SellMilk  $sellMilk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sell_milk = SellMilk::findOrfail($id);
        $sell_milk->delete();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }
    public function MilkStockReduce($id,$quantity)
    {
        
        // return $id;
        $milk_stock = Milk::findOrfail(1);
        if ($milk_stock->quantity < $quantity) {
            Toastr::error('Out Of Stock', 'Failed');
            return redirect()->back();
        } else {
            $sell_milk = SellMilk::findOrfail($id);
            $sell_milk->status = 1;
            $sell_milk->update();
            
            $milk_stock->quantity = $milk_stock->quantity - $quantity;
            $milk_stock->update();

            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        }
    }
}