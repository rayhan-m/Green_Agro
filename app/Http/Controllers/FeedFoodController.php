<?php

namespace App\Http\Controllers;

use App\Food;
use App\Staff;
use App\FeedFood;
use App\FoodStock;
use Carbon\Carbon;
use App\FeedFoodItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class FeedFoodController extends Controller
{
    public function index()
    {
        $feed_foods=FeedFood::all();
        return view('admin.feed_food_list',compact('feed_foods'));
    }

    public function create()
    {
        $food_list = Food::where('active_status',1)->get();
        // return $food_list;
        return view('admin.add_feed_food',compact('food_list'));
    }

    public function getFoodItem()
    {

        try {
            $searchData = Food::where('active_status',1)->get();
            if (!empty($searchData)) {
                return json_encode($searchData);
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        // return $request;
        //validation
        $validator = Validator::make($request->all(), [
            'food_id' => "required",
            'quantity' => "required", 
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $feed_food = new FeedFood();
        $feed_food->feed_date = Carbon::today()->toDateString();
        $feed_food->save();

        $i = 0;
        foreach ($request->food_id as  $food_id) {
            if ($food_id != 'none') {
                $fed_food_item = new FeedFoodItem();
                $fed_food_item->feed_food_id = $feed_food->id;
                $fed_food_item->food_id = $request->food_id[$i];
                $fed_food_item->quantity = $request->quantity[$i];
                $fed_food_item->save();
            }
            $i++;
        }
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }

    public function FeedFoodDelete($id)
    {
        $feed_food_items = FeedFoodItem::where('feed_food_id', $id)->get();

			foreach ($feed_food_items as  $feed_food_item) {
				$feed_food_item = FeedFoodItem::findOrfail($feed_food_item->id);
				$feed_food_item->delete();
			}
        $feed_food = FeedFood::findOrfail($id);
        $feed_food->delete();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }

    public function FeedFoodStockUpdated($id)
    {
        DB::beginTransaction();
        $feed_food = FeedFood::findOrfail($id);
        $feed_food->active_status = 1;
        $feed_food->update();
        
        $feed_food_items = FeedFoodItem::where('feed_food_id',$id)->get();

        foreach ($feed_food_items as $key => $value) {
            $feed = FeedFoodItem::findOrfail($value->id);

            $food_stock = FoodStock::findOrfail($feed->food_id);
            if ($food_stock->quantity > $feed->quantity) {
                $food_stock->quantity = $food_stock->quantity - $feed->quantity;
                $food_stock->update();
                
            }else{
                DB::rollback();
                Toastr::error('Stock Unavailable', 'Failed');
                return redirect()->back();
            }
            $feed->active_status=1;
            $feed->save();
            DB::commit();
        
        }
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
        
    }
}