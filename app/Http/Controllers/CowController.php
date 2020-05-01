<?php

namespace App\Http\Controllers;

use App\Cow;
use App\Bread;
use App\Buyer;
use App\Seller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class CowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $cows=Cow::where('active_status',1)->get();

        $cows=  DB::table('cows')
            ->Join('breads', 'cows.bread_id', '=', 'breads.id')
            ->Join('sellers', 'cows.seller_id', '=', 'sellers.id')
            ->select('cows.id','cows.name as cow_name','cows.date_of_birth','cows.age','cows.weight','cows.buy_price','cows.purpose','cows.type','cows.image','cows.details','cows.active_status','breads.name as bread_name','sellers.name as seller_name')
            ->where('cows.active_status','=',1)->get();
            
        $sold_cows=  DB::table('cows')
            ->Join('breads', 'cows.bread_id', '=', 'breads.id')
            ->Join('sellers', 'cows.seller_id', '=', 'sellers.id')
            ->select('cows.id','cows.name as cow_name','cows.date_of_birth','cows.age','cows.weight','cows.buy_price','cows.sell_price','cows.purpose','cows.type','cows.image','cows.details','cows.active_status','breads.name as bread_name','sellers.name as seller_name')
            ->where('cows.active_status','=',0)->get();

        return view('admin.cow_list',compact('cows','sold_cows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breads=Bread::where('active_status',1)->get();
        $sellers=Seller::where('active_status',1)->get();
        return view('admin.add_cow',compact('breads','sellers'));
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
            'name' => 'required|max:200',
            'bread_id' => 'required',
            'seller_id' => 'required',
            'type' => 'required',
            'purpose' => 'required',
            'weight' => 'required',
            'buy_price' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $cow = new Cow();
        $cow->name = $request->name;
        $cow->bread_id = $request->bread_id;
        $cow->seller_id = $request->seller_id;
        $cow->date_of_birth = $request->date_of_birth;
        $cow->type = $request->type;
        $cow->purpose = $request->purpose;
        $dob = date('Y-m-d', strtotime($request->date_of_birth));
        $cow->age = Carbon::parse($dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
        $cow->weight = $request->weight;
        $cow->buy_price = $request->buy_price;
        $cow->details = $request->details;
        $image = "";
        if ($request->file('image') != "") {
            $file = $request->file('image');
            $image = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('backend/uploads/cow/', $image);
            $image = 'backend/uploads/cow/' . $image;
            $cow->image = $image;
        }
        $cow->save();
        Toastr::success('Operation successful', 'Success');
        return redirect()->route('cow_list');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cow  $cow
     * @return \Illuminate\Http\Response
     */
    public function showActiveCow( $id)
    {
        
        // $CowInfo = Cow::find($id);
        $CowInfo = DB::table('cows')
            ->Join('breads', 'cows.bread_id', '=', 'breads.id')
            ->Join('sellers', 'cows.seller_id', '=', 'sellers.id')
            ->select('cows.id','cows.name as cow_name','cows.date_of_birth','cows.age','cows.weight','cows.buy_price','cows.purpose','cows.type','cows.image','cows.details','cows.active_status','breads.name as bread_name','sellers.name as seller_name')
            ->where('cows.id','=',$id)->first();
            // return $CowInfo;
            // dd($CowInfo);
        return view('admin.view_cow',compact('CowInfo'));
    }
    public function showSoldCow( $id)
    {
        
        // $CowInfo = Cow::find($id);
        $CowInfo = DB::table('cows')
            ->Join('breads', 'cows.bread_id', '=', 'breads.id')
            ->Join('sellers', 'cows.seller_id', '=', 'sellers.id')
            ->Join('buyers', 'cows.buyer_id', '=', 'buyers.id')
            ->select('cows.id','cows.name as cow_name','cows.date_of_birth','cows.age','cows.weight','cows.buy_price','cows.purpose','cows.type','cows.image','cows.details','cows.active_status','breads.name as bread_name','sellers.name as seller_name','buyers.name as buyer_name')
            ->where('cows.id','=',$id)->first();
            // return $CowInfo;
            // dd($CowInfo);
        return view('admin.view_cow',compact('CowInfo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cow  $cow
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $breads=Bread::where('active_status',1)->get();
        $sellers=Seller::where('active_status',1)->get();
        $editData = Cow::find($id);
        return view('admin.add_cow',compact('editData','breads','sellers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cow  $cow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cow $cow)
    {
        //validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:200',
            'bread_id' => 'required',
            'seller_id' => 'required',
            'type' => 'required',
            'purpose' => 'required',
            'weight' => 'required',
            'buy_price' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $cow = Cow::find($request->id);
        $cow->name = $request->name;
        $cow->bread_id = $request->bread_id;
        $cow->seller_id = $request->seller_id;
        $cow->date_of_birth = $request->date_of_birth;
        $cow->type = $request->type;
        $cow->purpose = $request->purpose;
        
        $dob = date('Y-m-d', strtotime($request->date_of_birth));
        $cow->age = Carbon::parse($dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
        // $cow->age = Carbon::parse($request->date_of_birth)->age;
        $cow->weight = $request->weight;
        $cow->buy_price = $request->buy_price;
        $cow->details = $request->details;
        $image = "";
        if ($request->file('image') != "") {
            $file = $request->file('image');
            $image = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('backend/uploads/cow/', $image);
            $image = 'backend/uploads/cow/' . $image;
            $cow->image = $image;
        }
        $cow->save();
        Toastr::success('Operation successful', 'Success');
        return redirect()->route('cow_list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cow  $cow
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cow = Cow::find($id);
        $cow->delete();

        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }


    // Sell Cow 
    public function sellCow()
    {
        $breads=Bread::where('active_status',1)->get();
        $cows=Cow::where('active_status',1)->get();
        $sellers=Seller::where('active_status',1)->get();
        $buyers=Buyer::where('active_status',1)->get();
        return view('admin.sell_cow',compact('breads','sellers','cows','buyers'));
    }

    public function CowInfo(Request $request){
        //validation
        // return $request;
        $validator = Validator::make($request->all(), [
            'cow_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $cows=Cow::where('active_status',1)->get();
        $breads=Bread::where('active_status',1)->get();
        $sellers=Seller::where('active_status',1)->get();
        $buyers=Buyer::where('active_status',1)->get();
        $editData = Cow::where('id','=',$request->cow_id)->first();
        return view('admin.sell_cow',compact('editData','breads','sellers','cows','buyers'));
    }

    public function sellCowSubmit(Request $request, Cow $cow)
    {
        //validation
        $validator = Validator::make($request->all(), [
            
            'buyer_id' => 'required',
            'sell_price' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $cow = Cow::find($request->id);
        $cow->buyer_id = $request->buyer_id;
        $cow->sell_price = $request->sell_price;
        if ($request->details !="") {
            $cow->details = $request->details;
        }
        
        $image = "";
        if ($request->file('image') != "") {
            $file = $request->file('image');
            $image = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('backend/uploads/cow/', $image);
            $image = 'backend/uploads/cow/' . $image;
            $cow->image = $image;
        }
        $cow->active_status = 0;
        $cow->save();
        Toastr::success('Operation successful', 'Success');
        return redirect()->route('cow_list');
    }
}