<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderItem;
use App\MilkPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{

    public function SellReportSearch(){
        return view('admin.sell_report_Search');
    }

    public function SellReport(Request $request){

        $from_date = date('Y-m-d', strtotime($request->from_date));
        $to_date = date('Y-m-d', strtotime($request->to_date));

        $sell_data= MilkPayment::join('milk_buyers','milk_payments.buyer_id','=','milk_buyers.id')
        ->select('milk_payments.id','milk_payments.buyer_id','milk_payments.from_date','milk_payments.to_date','milk_payments.pay_amount','milk_payments.payment_date','milk_payments.payment_status','milk_buyers.name')
        ->Where('milk_payments.payment_status',1)->where('milk_payments.payment_date','>=',$from_date)->where('milk_payments.payment_date','<=',$to_date)->get();

        $grand_total=0;
        foreach ($sell_data as $key => $value) {
            $grand_total=$grand_total + $value->pay_amount;
        }
        
        return view('admin.sell_report',compact('sell_data','grand_total'));
    }
    public function CowSellReportSearch(){
        return view('admin.cow_sell_report_Search');
    }

    public function CowSellReport(Request $request){

        $from_date = date('Y-m-d', strtotime($request->from_date));
        $to_date = date('Y-m-d', strtotime($request->to_date));

        $sell_data=  DB::table('cows')
            ->Join('breads', 'cows.bread_id', '=', 'breads.id')
            ->Join('buyers', 'cows.seller_id', '=', 'buyers.id')
            ->select('cows.id','cows.name as cow_name','cows.date_of_birth','cows.age','cows.weight','cows.buy_price','cows.sell_price','cows.purpose','cows.type','cows.image','cows.details','cows.active_status','breads.name as bread_name','buyers.name as buyer_name')
            ->where('cows.active_status','=',0)->where('cows.created_at','>=',$from_date)->where('cows.created_at','<=',$to_date)->get();

        $grand_total=0;
        foreach ($sell_data as $key => $value) {
            $grand_total = $grand_total + ($value->sell_price - $value->buy_price);
        }
        
        return view('admin.cow_sell_report',compact('sell_data','grand_total'));
    }
    
    public function ExpenseReportSearch(){

        return view('admin.expense_report_Search');
    }
    public function ExpenseReport(Request $request){
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $data=  DB::table('expenses')
        ->Join('expense_types', 'expenses.type_id', '=', 'expense_types.id')
        ->select('expenses.id','expenses.type_id','expenses.expense_date','expenses.amount','expenses.voucher','expenses.details','expenses.active_status','expense_types.name')
        ->where('expenses.expense_date', '>=', $from_date)
        ->where('expenses.expense_date', '<=', $to_date)
        ->get();

        $grand_total=0;
        foreach ($data as $key => $value) {
            $grand_total=$grand_total + $value->amount;
        }
        return view('admin.expense_report',compact('data','grand_total'));
    }
    public function IncomeSummerySearch(){

        return view('admin.income_summery_Search');
    }
    
    public function IncomeSummery(Request $request){
        // income 
        $from_date = date('Y-m-d', strtotime($request->from_date));
        $to_date = date('Y-m-d', strtotime($request->to_date));

        $sell_data_milk= MilkPayment::join('milk_buyers','milk_payments.buyer_id','=','milk_buyers.id')
        ->select('milk_payments.id','milk_payments.buyer_id','milk_payments.from_date','milk_payments.to_date','milk_payments.pay_amount','milk_payments.payment_date','milk_payments.payment_status','milk_buyers.name')
        ->Where('milk_payments.payment_status',1)->where('milk_payments.payment_date','>=',$from_date)->where('milk_payments.payment_date','<=',$to_date)->get();

        $grand_total_milk=0;
        foreach ($sell_data_milk as $key => $value) {
            $grand_total_milk=$grand_total_milk + $value->pay_amount;
        }

        $sell_data_cow=  DB::table('cows')
            ->Join('breads', 'cows.bread_id', '=', 'breads.id')
            ->Join('buyers', 'cows.seller_id', '=', 'buyers.id')
            ->select('cows.id','cows.name as cow_name','cows.date_of_birth','cows.age','cows.weight','cows.buy_price','cows.sell_price','cows.purpose','cows.type','cows.image','cows.details','cows.active_status','breads.name as bread_name','buyers.name as buyer_name')
            ->where('cows.active_status','=',0)->where('cows.created_at','>=',$from_date)->where('cows.created_at','<=',$to_date)->get();

        $grand_total_cow=0;
        foreach ($sell_data_cow as $key => $value) {
            $grand_total_cow = $grand_total_cow + ($value->sell_price - $value->buy_price);
        }
        // expense 
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $data=  DB::table('expenses')
        ->Join('expense_types', 'expenses.type_id', '=', 'expense_types.id')
        ->select('expenses.id','expenses.type_id','expenses.expense_date','expenses.amount','expenses.voucher','expenses.details','expenses.active_status','expense_types.name')
        ->where('expenses.expense_date', '>=', $from_date)
        ->where('expenses.expense_date', '<=', $to_date)
        ->get();

        $total_expenes=0;
        foreach ($data as $key => $value) {
            $total_expenes=$total_expenes + $value->amount;
        }
        $total_income=  $grand_total_milk + $grand_total_cow;
        $income_summery= $total_income - $total_expenes;
        
        return view('admin.income_summery',compact('total_income','total_expenes','income_summery','grand_total_milk','grand_total_cow'));
    }
}