<?php

namespace App\Http\Controllers;

use App\Staff;
use Carbon\Carbon;
use App\StaffPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class StaffPaymentController extends Controller
{
    public function StaffPayment(){
        $payments=  DB::table('staff_payments')
        ->Join('staff', 'staff_payments.staff_id', '=', 'staff.id')
        ->select('staff_payments.id','staff_payments.staff_id','staff_payments.payment_date','staff_payments.payment_month','staff_payments.pay_amount','staff_payments.payment_status','staff.full_name','staff.basic_salary')
        ->get();
        // $payments=StaffPayment::all();
        return view('admin.staff_payment',compact('payments'));
    }

    public function StaffPaymentStore(Request $request)
    {   
        // return $request;
        //validation
        $validator = Validator::make($request->all(), [
            'payment_month' => 'required',
            'payment_status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
       
        $payment = new StaffPayment();
        $payment->staff_id = $request->staff_id;
        $payment->payment_date = Carbon::now();
        $payment->payment_month = $request->payment_month;
        $payment->pay_amount = $request->pay_amount;
        $payment->payment_status = $request->payment_status;
        // return $payment;
        $payment->save();
        Toastr::success('Operation successful', 'Success');
        return redirect()->route('staff_payment');
    }
    public function StaffPaymentDelete($id)
    {
        // return $id;
        $payment = StaffPayment::findOrfail($id);
        $payment->delete();
        Toastr::success('Operation successful', 'Success');
        return redirect()->route('staff_payment');
    }

    public function StaffPaymentActive($id)
    {
        $payment = StaffPayment::findOrfail($id);
        $payment->payment_status = 1;
        $payment->update();

        Toastr::success('Operation successful', 'Success');
        return redirect()->route('staff_payment');
    }
    public function StaffPaymentDeactive($id)
    {
        $payment = StaffPayment::findOrfail($id);
        $payment->payment_status = 0;
        $payment->update();

        Toastr::success('Operation successful', 'Success');
        return redirect()->route('staff_payment');
    }
    public function StaffPaymentCreate(){
        // $orders=Order::all();
        $staff=Staff::where('active_status', '=', 1)->get();
        return view('admin.staff_payment_create',compact('staff'));
    }
    public function StaffInfo(Request $request){
        //validation
        // return $request;
        $validator = Validator::make($request->all(), [
            'staff_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $staff=Staff::where('active_status', '=', 1)->get();
        $staffInfo=Staff::where('active_status', '=', 1)->where('id','=',$request->staff_id)->first();
        return view('admin.staff_payment_create',compact('staffInfo','staff'));
    }
}