<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function ProductCategory()
    {
        $data = Category::where('active_status', '=', 1)->get();
        return view('admin.product_category', compact('data'));
    }

    public function ProductCategoryStore(Request $request)
    {
        //validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories|max:100',
        ]);

        if ($validator->fails()) {
            return redirect('product.category')
                ->withErrors($validator)
                ->withInput();
        }
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        Toastr::success('Operation successful', 'Success');
        return redirect()->route('product.category');
    }
}