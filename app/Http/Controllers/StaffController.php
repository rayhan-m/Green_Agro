<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use App\Staff;
use App\Payment;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function CustomerList()
    {
        $customers=User::where('role_id','=',2)->get();
        return view('admin.customer_list',compact('customers'));
    }
    public function index()
    {
        $staffs=Staff::all();
        return view('admin.staff_list',compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.add_staff');
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
            'first_name' => "required",
            'email' => "required", 
            'mobile' => "required", 
        ]);

        if ($validator->fails()) {
            return redirect()->route('staff_create')
                ->withErrors($validator)
                ->withInput();
        }
        $staff = new Staff();
        $staff->first_name = $request->first_name;
        $staff->last_name = $request->last_name;
        $staff->full_name = $request->first_name . ' ' . $request->last_name;
        $staff->fathers_name = $request->fathers_name;
        $staff->mothers_name = $request->mothers_name;
        $staff->email = $request->email;
        
        $staff_photo = "";
        if ($request->file('staff_photo') != "") {
            $file = $request->file('staff_photo');
            $staff_photo = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('backend/uploads/staff/', $staff_photo);
            $staff_photo = 'backend/uploads/staff/' . $staff_photo;
            $staff->staff_photo = $staff_photo;
        }
        
        $staff->nid = $request->nid;
        $staff->gender_id = $request->gender_id;
        $staff->marital_status = $request->marital_status;
        $staff->date_of_birth = date('Y-m-d', strtotime($request->date_of_birth));
        $staff->date_of_joining = date('Y-m-d', strtotime($request->date_of_joining));
        $staff->mobile = $request->mobile;
        $staff->basic_salary = $request->basic_salary;
        $staff->emergency_mobile = $request->emergency_mobile;
        $staff->current_address = $request->current_address;
        $staff->permanent_address = $request->permanent_address; 
        $staff->qualification = $request->qualification;
        $staff->experience = $request->experience; 
        
        $staff->save();
        Toastr::success('Operation successful', 'Success');
        return redirect()->route('staff_list');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $staffDetails = Staff::find($id);
        return view('admin.view_staff',compact('staffDetails'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $editData = Staff::find($id);
        return view('admin.add_staff',compact('editData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //validation
        $validator = Validator::make($request->all(), [
            'first_name' => "required",
            'email' => "required", 
            'mobile' => "required", 
        ]);

        if ($validator->fails()) {
            return redirect()->route('staff_create')
                ->withErrors($validator)
                ->withInput();
        }
        $staff = Staff::find($request->id);
        $staff->first_name = $request->first_name;
        $staff->last_name = $request->last_name;
        $staff->full_name = $request->first_name . ' ' . $request->last_name;
        $staff->fathers_name = $request->fathers_name;
        $staff->mothers_name = $request->mothers_name;
        $staff->email = $request->email;
        
        $staff_photo = "";
        if ($request->file('staff_photo') != "") {
            $file = $request->file('staff_photo');
            $staff_photo = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('backend/uploads/staff/', $staff_photo);
            $staff_photo = 'backend/uploads/staff/' . $staff_photo;
            $staff->staff_photo = $staff_photo;
        }
        
        $staff->nid = $request->nid;
        $staff->gender_id = $request->gender_id;
        $staff->marital_status = $request->marital_status;
        $staff->date_of_birth = date('Y-m-d', strtotime($request->date_of_birth));
        $staff->date_of_joining = date('Y-m-d', strtotime($request->date_of_joining));
        $staff->mobile = $request->mobile;
        $staff->basic_salary = $request->basic_salary;
        $staff->emergency_mobile = $request->emergency_mobile;
        $staff->current_address = $request->current_address;
        $staff->permanent_address = $request->permanent_address; 
        $staff->qualification = $request->qualification;
        $staff->experience = $request->experience; 
        
        $staff->save();
        Toastr::success('Operation successful', 'Success');
        return redirect()->route('staff_list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $staff = Staff::find($id);
        $staff->delete();

        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }
}