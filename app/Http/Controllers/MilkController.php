<?php

namespace App\Http\Controllers;

use App\Cow;
use App\Milk;
use Carbon\Carbon;
use App\CollectMilk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class MilkController extends Controller
{
    public function MilkStock()
    {
        $milk_stocks=Milk::where('active_status',1)->first();
        $toDay=Carbon::today()->toDateString();
        // return $toDay;
        $collect_milks=CollectMilk::where('active_status',1)->where('date_time','=',$toDay)->get();

        $total_collect=0;
        foreach ($collect_milks as $key => $value) {
            $total_collect=$total_collect + $value->quantity;
        }
        
        return view('admin.milk_stock',compact('milk_stocks','total_collect'));
    }
    public function CollectMilk()
    {
        $cows = Cow::where('active_status',1)->where('type',1)->get();
        $collect_milks=  DB::table('collect_milks')
        ->Join('cows', 'collect_milks.cow_id', '=', 'cows.id')
        ->select('collect_milks.id','collect_milks.cow_id','collect_milks.date_time','collect_milks.quantity','collect_milks.active_status','cows.name')
        ->get();
        

        return view('admin.collect_milk', compact('cows','collect_milks'));
    }
    public function CollectMilkStore(Request $request)
    {
        //validation
        $validator = Validator::make($request->all(), [
            'cow_id' => 'required',
            'quantity' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $collect_milk = new CollectMilk();
        $collect_milk->cow_id = $request->cow_id;
        $collect_milk->date_time = Carbon::today()->toDateString();
        $collect_milk->quantity = $request->quantity;
        $collect_milk->save();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }
    public function MilkStockUpdated($id,$quantity)
    {
        $collect_milk = CollectMilk::findOrfail($id);
        $collect_milk->active_status = 1;
        $collect_milk->update();

        $milk_stock = Milk::findOrfail(1);
        $milk_stock->quantity = $milk_stock->quantity + $quantity;
        $milk_stock->update();

        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }
    // public function StockUpdated($id, $product_id, $quantity)
    // {
    //     $stock = Stock::findOrfail($id);
    //     $stock->active_status = 1;
    //     $stock->update();
        
    //     $product = Product::findOrfail($product_id);

    //     $product->quantity = $product->quantity + $quantity;
    //     $product->update();
    //     Toastr::success('Operation successful', 'Success');
    //     return redirect()->back();
    // }
    public function CollectMilkUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cow_id' => 'required',
            'quantity' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $collect_milk =CollectMilk::findOrfail($request->id);
        $collect_milk->cow_id = $request->cow_id;
        $collect_milk->date_time = Carbon::today()->toDateString();
        $collect_milk->quantity = $request->quantity;
        $collect_milk->save();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $collect_milk = CollectMilk::findOrfail($id);
        $collect_milk->delete();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }
}