<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Attendance;

class AttendanceController extends Controller
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

    public function attendance(){
    	$employee = DB::table('employees')->get();
    	return view('take-attendance',compact('employee'));
    }

    public function insertAttendance(Request $request){
    	$date = date('d/m/y');
    	$select = DB::table('attendances')->where('attend_date',$date)->first();
    	if($select){
    		$notification=array(
                 'message'=>'Attendance already Taken',
                 'alert-type'=>'warning'
                  );
                return Redirect()->back()->with($notification);
    	}else{
    		foreach($request->employee_id as $row){
    		$data[] = [
    			'employee_id'=>$row,
    			'attend'=>$request->attend[$row],
    			'attend_date'=>$request->attend_date,
    			'attend_year'=>$request->attend_year,
    			'edit_date'=>$request->edit_date,
    		];
    	}
    $done = DB::table('attendances')->insert($data);

    if ($done) {
                 $notification=array(
                 'message'=>'Attendance Taken successfully',
                 'alert-type'=>'success'
                  );
                return Redirect()->back()->with($notification);                      
             }else{
              $notification=array(
                 'message'=>'error ',
                 'alert-type'=>'success'
                  );
                 return Redirect()->back()->with($notification);
             }      
    	}
     }

     public function allattendance(){
     	$select = DB::table('attendances')->select('edit_date')->groupBy('edit_date')->get();
     	return view('all-attendance',compact('select'));
     }

     public function viewbydate($edit_date){
     	$view = DB::table('attendances')
     			->join('employees','attendances.employee_id','employees.id')
     			->where('edit_date',$edit_date)
     			->select('attendances.*','employees.name','employees.phone')
     			->get();

     	return view('view_by_date',compact('view'));
     }

     public function deletebydate($edit_date){
     	$delete = DB::table('attendances')->where('edit_date',$edit_date)->delete();
     	if ($delete) {
                 $notification=array(
                 'message'=>'Deleted',
                 'alert-type'=>'warning'
                  );
                return Redirect()->route('all-attendance')->with($notification);                      
             }else{
              $notification=array(
                 'message'=>'error ',
                 'alert-type'=>'success'
                  );
                 return Redirect()->back()->with($notification);
        }     
     }
     public function editbydate($edit_date){

     	$date = DB::table('attendances')->where('edit_date',$edit_date)->first();

     	$edit = DB::table('attendances')
     			->join('employees','attendances.employee_id','employees.id')
     			->where('edit_date',$edit_date)
     			->select('attendances.*','employees.name','employees.photo')
     			->get();

     	return view('edit_by_date',compact('date','edit'));
     }

     public function updateAttendance(Request $request){
     	foreach($request->id as $row){
    		$data = [
    			'attend'=>$request->attend[$row],
    			'attend_date'=>$request->attend_date,
    			'attend_year'=>$request->attend_year,
    		];
    	// $done = DB::table('attendances')->where('attend_date',$request->attend_date)->where('id',$request->id)->update($data);
    	$ok = Attendance::where(['attend_date' => $request->attend_date, 'id' => $row])->first();
    	$done = $ok->update($data);
     	}
     	if($done) {
                 $notification=array(
                 'message'=>'Attendance Updated successfully',
                 'alert-type'=>'success'
                  );
                return Redirect()->route('all-attendance')->with($notification);                      
             }else{
              $notification=array(
                 'message'=>'error',
                 'alert-type'=>'error'
                  );
                 return Redirect()->back()->with($notification);
             }      
    	}
   }
