<?php

namespace App\Http\Controllers;

use App\SellMilk;
use App\MilkBuyer;
use Carbon\Carbon;
use App\MilkPayment;
use App\MilkSellInfo;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class MilkPaymentController extends Controller
{
    public function MilkPayment(){
        $payments=MilkPayment::join('milk_buyers','milk_payments.buyer_id','=','milk_buyers.id')
        ->select('milk_payments.id','milk_payments.buyer_id','milk_payments.from_date','milk_payments.to_date','milk_payments.pay_amount','milk_payments.payment_date','milk_payments.payment_status','milk_buyers.name')
        ->get();
        return view('admin.milk_payment',compact('payments'));
    }

    public function MilkPaymentStore(Request $request)
    {   
        // return $request;
        //validation
        $validator = Validator::make($request->all(), [
            'buyer_id' => 'required',
            'payment_status' => 'required',
            'payable_amount' => 'required',
            'pay_amount' => 'required|same:payable_amount',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
       
        $payment = new MilkPayment();
        $payment->buyer_id = $request->buyer_id;
        $payment->payment_date = Carbon::now();
        $payment->from_date = $request->from_date;
        $payment->to_date = $request->to_date;
        $payment->pay_amount = $request->pay_amount;
        $payment->payment_status = $request->payment_status;
        if ($request->payment_status==1) {
            $sql=SellMilk::where('milk_buyer_id','=',$request->buyer_id)->where('sell_date','>=',$request->from_date)->where('sell_date','<=',$request->to_date)->where('status',1)->get();
            foreach ($sql as $key => $value) {
                $s= SellMilk::findorfail($value->id);
                $s->payment_status=1;
                $s->save();

                
            }
        }
        
        $payment->save();

        $sql=SellMilk::where('milk_buyer_id','=',$request->buyer_id)->where('sell_date','>=',$request->from_date)->where('sell_date','<=',$request->to_date)->where('status',1)->where('payment_status',0)->get();
        foreach ($sql as $key => $value) {
            $s= SellMilk::findorfail($value->id);
            $milk_sell_info= new MilkSellInfo();
            $milk_sell_info->milk_sell_id=$s->id;
            $milk_sell_info->payment_id=$payment->id;
            $milk_sell_info->save();
        }
        

        Toastr::success('Operation successful', 'Success');
        return redirect()->route('milk_payment');
    }
    public function MilkPaymentDelete($id)
    {
        // return $id;
        $payment = MilkPayment::findOrfail($id);
        $payment->delete();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }

    public function MilkPaymentActive($id)
    {
        $payment = MilkPayment::findOrfail($id);
        $payment->payment_status = 1;
        $payment->update();

        $sql=SellMilk::where('milk_buyer_id','=',$payment->buyer_id)->where('sell_date','>=',$payment->from_date)->where('sell_date','<=',$payment->to_date)->where('status',1)->get();

        foreach ($sql as $key => $value) {
            $s= SellMilk::findorfail($value->id);
            $s->payment_status=1;
            $s->save();
        }
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }
    // public function MilkPaymentDeactive($id)
    // {
    //     $payment = MilkPayment::findOrfail($id);
    //     $payment->payment_status = 0;
    //     $payment->update();

    //     Toastr::success('Operation successful', 'Success');
    //     return redirect()->back();
    // }
    public function MilkPaymentCreate(){
        // $orders=Order::all();
        $buyers=MilkBuyer::where('active_status', '=', 1)->get();
        return view('admin.milk_payment_create',compact('buyers'));
    }
    public function MilkInfo(Request $request){
        //validation
        // return $request;
        $validator = Validator::make($request->all(), [
            'buyer_id' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $from_date = date('Y-m-d', strtotime($request->from_date));
        $to_date = date('Y-m-d', strtotime($request->to_date));
        
        // return $to_date;
        $buyers=MilkBuyer::where('active_status', '=', 1)->get();
        $sellBuyer=SellMilk::join('milk_buyers','sell_milks.milk_buyer_id','=','milk_buyers.id')
        ->where('milk_buyer_id','=',$request->buyer_id)->first();

        $sql=SellMilk::where('milk_buyer_id','=',$request->buyer_id)->where('sell_date','>=',$from_date)->where('sell_date','<=',$to_date)->where('status',1)->where('payment_status',0)->get();
        $total_payable=0;
        foreach ($sql as $key => $value) {
            $total_payable= $total_payable + $value->total;
            // return $value->sell_date;
        }
        
        return view('admin.milk_payment_create',compact('total_payable','buyers','sellBuyer','from_date','to_date'));
    }

    public function Invoice($id){
        $milk_payment = MilkPayment::findorfail($id);
        $sellBuyer=SellMilk::join('milk_buyers','sell_milks.milk_buyer_id','=','milk_buyers.id')
        ->where('milk_buyer_id','=',$milk_payment->buyer_id)->first();

        $Sell_milk_info = MilkSellInfo::join('sell_milks','sell_milks.id','=','milk_sell_infos.milk_sell_id')->join('milk_payments','milk_payments.id','=','milk_sell_infos.payment_id')->where('milk_payments.id',$id)->get();

        $total_payable=0;
        foreach ($Sell_milk_info as $key => $value) {
            $total_payable= $total_payable + $value->total;
            // return $value->sell_date;
        }
        return view('admin.invoice',compact('milk_payment','sellBuyer','total_payable','sell_milks','Sell_milk_info'));
    }
}