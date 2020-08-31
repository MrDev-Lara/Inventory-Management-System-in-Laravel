<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SalaryController extends Controller
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

    public function salary(){
    	return view('add_salary');
    }

    public function insertSalary(Request $request)
    {
      $validatedData = $request->validate([
        'employee_id' => 'required',
        'month' => 'required',
        'year' => 'required',
        ]);


      	$empid = $request->employee_id;
      	$empmnth = $request->month;
      	$empyear = $request->year;

        $information = DB::table('salarys')
        		->where('employee_id',$empid)
        		->where('month',$empmnth)
        		->where('year',$empyear)
        		->first();

        if($information === NULL){
	        $data=array();
	        $data['employee_id']=$request->employee_id;
	        $data['month']=$request->month;
	        $data['year']=$request->year;
	        $data['advanced_salary']=$request->salary;

	        $success = DB::table('salarys')->insert($data);
	        if ($success) {
                 $notification=array(
                 'message'=>'salary successfully paid to the employee',
                 'alert-type'=>'success'
                  );
                return Redirect()->route('all-salary')->with($notification);                      
             }else{
              $notification=array(
                 'message'=>'error ',
                 'alert-type'=>'success'
                  );
                 return Redirect()->back()->with($notification);
             }    
        }else{
        	 $notification=array(
                 'message'=>'Cannot be paid.Already advanced paid to the selected employee for the given Month ' .$empmnth,
                 'alert-type'=>'warning'
                  );
              return Redirect()->back()->with($notification);
        }
    }

    // select salary list from database

    public function salarylist(){
    	$salarys = DB::table('salarys')
    				->join('employees','salarys.employee_id','employees.id')
    				->select('salarys.*','employees.name','employees.phone')
    				->get();
    	return view('all_salary',compact('salarys'));
    }

	// pay last month salary

    public function lastmonthsalary(){
    	$lastmonthsalary = DB::table('employees')->get();
    	return view('last_month_salary',compact('lastmonthsalary'));
    }
    public function paylastmonthsalary($id){
    	$pay = DB::table('employees')->where('id',$id)->first();
    	return view('pay_salary_of_last_month',compact('pay'));
    }
    public function lastmonthdone(Request $request){
    	$data = array();
    	$data['employ_id'] = $request->employ_id;
    	$data['salary_month'] = $request->month;
    	$data['total_salary'] = $request->total_salary_paid;

    	$done = DB::table('lastmonthsalary')->insert($data);

    	if ($done) {
                 $notification=array(
                 'message'=>'salary successfully paid',
                 'alert-type'=>'success'
                  );
                return Redirect()->route('last-month-salary')->with($notification);                      
             }else{
              $notification=array(
                 'message'=>'error ',
                 'alert-type'=>'success'
                  );
                 return Redirect()->back()->with($notification);
             }  
    }

     public function allsalarylist(){
    	$allsalarylist = DB::table('lastmonthsalary')
    					->join('employees','lastmonthsalary.employ_id','employees.id')
    					->select('lastmonthsalary.*','employees.name','employees.phone')
    					->orderBy('employ_id','asc')
    					->get();
    	return view('all_month_salary',compact('allsalarylist'));
    }
}
