<?php

namespace App\Http\Controllers;

use App\FoodCategory;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class FoodCategoryController extends Controller
{
    public function FoodCategory()
    {
        $data = FoodCategory::get();
        return view('admin.food_category', compact('data'));
    }

    public function FoodCategoryStore(Request $request)
    {
        //validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $food_category = new FoodCategory();
        $food_category->name = $request->name;
        $food_category->save();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }

    public function FoodCategoryActive($id)
    {
        $food_category = FoodCategory::findOrfail($id);
        $food_category->active_status = 1;
        $food_category->update();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }
    public function FoodCategoryDeactive($id)
    {
        $food_category = FoodCategory::findOrfail($id);
        $food_category->active_status = 0;
        $food_category->update();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }
    public function FoodCategoryDelete($id)
    {
        $food_category = FoodCategory::findOrfail($id);
        $food_category->delete();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }
    public function FoodCategoryUpdate(Request $request)
    {
        // return $request;
        //validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $food_category = FoodCategory::findOrfail($request->id);
        $food_category->name = $request->name;
        $food_category->save();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }
}