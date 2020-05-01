<?php

namespace App\Http\Controllers;

use App\Cow;
use App\Milk;
use App\Staff;
use App\MilkBuyer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BackEndController extends Controller
{
    public function Dashboard(){

        $data=  DB::table('expenses')
        ->Join('expense_types', 'expenses.type_id', '=', 'expense_types.id')
        ->select('expenses.id','expenses.type_id','expenses.expense_date','expenses.amount','expenses.voucher','expenses.details','expenses.active_status','expense_types.name')
        ->where('expenses.active_status',1)
        ->get();

        $total_expense=0;
        foreach ($data as $key => $value) {
            $total_expense=$total_expense + $value->amount;
        }

        $total_cows= Cow::where('active_status',1)->count();
        $total_staff= Staff::where('active_status',1)->count();
        $milk_stocks=Milk::where('active_status',1)->first();
        $milk_buyers= MilkBuyer::where('active_status',1)->take(5)->get();
        $cows= Cow::where('active_status',1)->take(5)->get();
        return view('admin.dashboard',compact('milk_buyers','cows','total_cows','milk_stocks','total_expense','total_staff'));
    }
}