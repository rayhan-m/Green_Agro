<?php

namespace App\Http\Controllers;

use App\Expense;
use App\ExpenseType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class ExpenseController extends Controller
{
    public function ExpenseType()
    {
        $data = ExpenseType::get();
        return view('admin.expense_type', compact('data'));
    }

    public function ExpenseTypeStore(Request $request)
    {
        //validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:expense_types|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $expense_type = new ExpenseType();
        $expense_type->name = $request->name;
        $expense_type->save();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }

    public function ExpenseTypeActive($id)
    {
        $expense_type = ExpenseType::findOrfail($id);
        $expense_type->active_status = 1;
        $expense_type->update();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }
    public function ExpenseTypeDeactive($id)
    {
        $expense_type = ExpenseType::findOrfail($id);
        $expense_type->active_status = 0;
        $expense_type->update();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }
    public function ExpenseTypeDelete($id)
    {
        $expense_type = ExpenseType::findOrfail($id);
        $expense_type->delete();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }
    public function ExpenseTypeUpdate(Request $request)
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
        $expense_type = ExpenseType::findOrfail($request->id);
        $expense_type->name = $request->name;
        $expense_type->save();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }

    // End Expense Type 

// Start Expenses 

    public function Expenses()
    {
        $expense_type = ExpenseType::get();
        // $data = Expense::get();

        $data=  DB::table('expenses')
        ->Join('expense_types', 'expenses.type_id', '=', 'expense_types.id')
        
        ->select('expenses.id','expenses.type_id','expenses.expense_date','expenses.amount','expenses.voucher','expenses.details','expenses.active_status','expense_types.name')
        ->get();

        return view('admin.expenses', compact('data','expense_type'));
    }

    public function ExpensesStore(Request $request)
    {
        //validation
        $validator = Validator::make($request->all(), [
            'type_id' => 'required',
            'expense_date' => 'required',
            'amount' => 'required',
            // 'voucher' => 'sometimes|required|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $expense = new Expense();
        $expense->type_id = $request->type_id;
        $expense->expense_date = $request->expense_date;
        $expense->amount = $request->amount;

        $voucher = "";
        if ($request->file('voucher') != "") {
            $file = $request->file('voucher');
            $voucher = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('backend/uploads/voucher/', $voucher);
            $voucher = 'backend/uploads/voucher/' . $voucher;
            $expense->voucher = $voucher;
        }
        $expense->details = $request->details;
        $expense->save();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }

    public function ExpensesActive($id)
    {
        $expense = Expense::findOrfail($id);
        $expense->active_status = 1;
        $expense->update();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }
    public function ExpensesDeactive($id)
    {
        $expense = Expense::findOrfail($id);
        $expense->active_status = 0;
        $expense->update();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }
    public function ExpensesDelete($id)
    {
        $expense = Expense::findOrfail($id);
        $expense->delete();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }
    public function ExpensesUpdate(Request $request)
    {
        // return $request;
        //validation
        $validator = Validator::make($request->all(), [
            'type_id' => 'required',
            'expense_date' => 'required',
            'amount' => 'required',
            // 'voucher' => 'sometimes|required|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $expense = Expense::findOrfail($request->id);
        $expense->type_id = $request->type_id;
        $expense->expense_date = $request->expense_date;
        $expense->amount = $request->amount;

        $voucher = "";
        if ($request->file('voucher') != "") {
            $file = $request->file('voucher');
            $voucher = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('backend/uploads/voucher/', $voucher);
            $voucher = 'backend/uploads/voucher/' . $voucher;
            $expense->voucher = $voucher;
        }
        $expense->details = $request->details;
        // dd($expense);
        $expense->save();
        Toastr::success('Operation successful', 'Success');
        return redirect()->back();
    }

    // End Expense Type 
}