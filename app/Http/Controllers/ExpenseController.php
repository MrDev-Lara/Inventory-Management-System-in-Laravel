<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ExpenseController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function expense(){
    	return view('add-expense');
    }

    //insert Expense

    public function insertExpense(Request $request)
    {
      $validatedData = $request->validate([
        'details' => 'required',
        'amount' => 'required',
        ]);

      	$data=array();
        $data['details']=$request->details;
        $data['amount']=$request->amount;
        $data['month']=$request->month;
        $data['date']=$request->date;
        $data['year']=$request->year;

        $expense = DB::table('expenses')->insert($data);

        if ($expense) {
                 $notification=array(
                 'message'=>'Expense Added',
                 'alert-type'=>'success'
                  );
                return Redirect()->route('today-expense')->with($notification);                      
             }else{
              $notification=array(
                 'message'=>'error ',
                 'alert-type'=>'success'
                  );
                 return Redirect()->back()->with($notification);
             }      
    }

    //Today Expense

    public function todayexpense(){
    	$today = date('d/m/y');
    	$todayexpense = DB::table('expenses')->where('date',$today)->get();
    	return view('today-expense',compact('todayexpense'));
    }

    public function monthlyexpense(){
    	$month = date('F');
    	$monthexpense = DB::table('expenses')->where('month',$month)->get();
    	return view('monthly-expense',compact('monthexpense'));
    }
}
