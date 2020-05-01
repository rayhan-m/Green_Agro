<?php

namespace App\Http\Controllers;

use App\Food;
use App\FoodStock;
use App\FoodCategory;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class FoodController extends Controller
{
    public function FoodStock()
    {
        $food_stocks=FoodStock::join('foods','food_stocks.food_id','=','foods.id')->where('foods.active_status',1)->get();
        
        return view('admin.food_stock',compact('food_stocks'));
    }

    public function FoodList()
    {
        $data = Food::Join('food_categories', 'foods.category_id', '=', 'food_categories.id')
        ->select('foods.id','foods.category_id','foods.name','foods.details','foods.image','foods.active_status','food_categories.name as category_name')
        ->get();
        $categories = FoodCategory::where('active_status',1)->get();
        return view('admin.food_list', compact('data','categories'));
    }

    public function FoodStore(Request $request)
    {
        //validation
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $food = new Food();
        $food->name = $request->name;
        $food->category_id = $request->category_id;
        $food->details = $request->details;
        $image = "";
        if ($request->file('image') != "") {
            $file = $request->file('image');
            $image = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('backend/uploads/food/', $image);
            $image = 'backend/uploads/food/' . $image;
            $food->image = $image;
        }
        $food->save();

        $food_stocks= new FoodStock();
        $food_stocks->food_id= $food->id;
        $food_stocks->quantity=0;
        $food_stocks->save();
        
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }

    public function FoodActive($id)
    {
        $food = Food::findOrfail($id);
        $food->active_status = 1;
        $food->update();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }
    public function FoodDeactive($id)
    {
        $food = Food::findOrfail($id);
        $food->active_status = 0;
        $food->update();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }
    public function FoodDelete($id)
    {
        $food = Food::findOrfail($id);
        $food->delete();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }
    public function FoodUpdate(Request $request)
    {
        // return $request;
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $food = Food::findOrfail($request->id);
        $food->name = $request->name;
        $food->category_id = $request->category_id;
        $food->details = $request->details;
        $image = "";
        if ($request->file('image') != "") {
            $file = $request->file('image');
            $image = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('backend/uploads/food/', $image);
            $image = 'backend/uploads/food/' . $image;
            $food->image = $image;
        }
        $food->save();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }

}