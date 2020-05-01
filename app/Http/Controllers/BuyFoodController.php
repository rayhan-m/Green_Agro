<?php

namespace App\Http\Controllers;

use App\Food;
use App\BuyFood;
use App\FoodStock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class BuyFoodController extends Controller
{
     public function BuyFoodList()
    {
        $foods = Food::where('active_status',1)->get();
        // $buy_foods = BuyFood::join('foods', 'buy_foods.food_id','=','foods.id')->get();
        $buy_foods=  DB::table('buy_foods')
        ->Join('foods', 'buy_foods.food_id','=','foods.id')
        ->select('buy_foods.id','buy_foods.food_id','buy_foods.price','buy_foods.buy_date','buy_foods.quantity','buy_foods.total','buy_foods.voucher','buy_foods.active_status','foods.name')
        ->get();
        return view('admin.buy_food_list', compact('foods','buy_foods'));
    }

    public function BuyFoodStore(Request $request)
    {
        // return $request;
        //validation
        $validator = Validator::make($request->all(), [
            'food_id' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $buy_food = new BuyFood();
        $buy_food->food_id = $request->food_id;
        $buy_food->buy_date = Carbon::today()->toDateString();
        $buy_food->price = $request->price;
        $buy_food->quantity = $request->quantity;
        $buy_food->total = $request->price * $request->quantity;
        $voucher = "";
        if ($request->file('voucher') != "") {
            $file = $request->file('voucher');
            $voucher = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('backend/uploads/voucher/', $voucher);
            $voucher = 'backend/uploads/voucher/' . $voucher;
            $buy_food->voucher = $voucher;
        }
        $buy_food->save();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }
    public function BuyFoodUpdate(Request $request)
    {
        // return $request;
        $validator = Validator::make($request->all(), [
            'food_id' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $buy_food = BuyFood::findOrfail($request->id);
        $buy_food->food_id = $request->food_id;
        $buy_food->buy_date = Carbon::today()->toDateString();
        $buy_food->price = $request->price;
        $buy_food->quantity = $request->quantity;
        $buy_food->total = $request->price * $request->quantity;
        $voucher = "";
        if ($request->file('voucher') != "") {
            $file = $request->file('voucher');
            $voucher = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('backend/uploads/voucher/', $voucher);
            $voucher = 'backend/uploads/voucher/' . $voucher;
            $buy_food->voucher = $voucher;
        }
        $buy_food->save();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }
    public function BuyFoodDelete($id)
    {
        $buy_food = BuyFood::findOrfail($id);
        $buy_food->delete();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }

    public function FoodStockUpdated($id, $food_id, $quantity)
    {
        $stock = BuyFood::findOrfail($id);
        $stock->active_status = 1;
        $stock->update();
        
        $food_stock = FoodStock::findOrfail($food_id);

        $food_stock->quantity = $food_stock->quantity + $quantity;
        $food_stock->update();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }
}