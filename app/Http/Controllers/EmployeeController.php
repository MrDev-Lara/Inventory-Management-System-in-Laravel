<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Employee;

class EmployeeController extends Controller
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

    public function employee(){
    	return view('add_employee');
    }

     //insert employee
    public function insertEmployee(Request $request)
    {
      $validatedData = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|unique:employees|max:255',
        'nid_no' => 'required|unique:employees|max:255',
        'address' => 'required',
        'phone' => 'required|max:13',
        'photo' => 'required',
        'salary' => 'required',
        ]);

        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['address']=$request->address;
        $data['experiance']=$request->experiance;
        $data['nid_no']=$request->nid_no;
        $data['salary']=$request->salary;
        $data['vacation']=$request->vacation;
        $data['city']=$request->city;
        $image=$request->file('photo');

        if ($image) {
            $image_name= str_random(5);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/employee/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if ($success) {
                $data['photo']=$image_url;
                $employee = DB::table('employees')
                         ->insert($data);
              if ($employee) {
                 $notification=array(
                 'message'=>'Employee Added',
                 'alert-type'=>'success'
                  );
                return Redirect()->route('all-employee')->with($notification);                      
             }else{
              $notification=array(
                 'message'=>'error ',
                 'alert-type'=>'success'
                  );
                 return Redirect()->back()->with($notification);
             }      
                
            }else{

              return Redirect()->back();
            	
            }
        }else{
        	  return Redirect()->back();
        }
    }

// select employee list from database

    public function employeelist(){
    	$employees = Employee::all();
    	return view('all_employee',compact('employees'));
    }

// delete employee list from database

    public function deleteemployee($id){
    	$delete = DB::table('employees')
    			->where('id',$id)
    			->first();

    	$photo = $delete->photo;
    	unlink($photo);

    	$dltuser = DB::table('employees')
    			->where('id',$id)
    			->delete();

    	if ($dltuser) {
                 $notification=array(
                 'message'=>'Employee Deleted',
                 'alert-type'=>'warning'
                  );
                return Redirect()->route('all-employee')->with($notification);                      
             }else{
              $notification=array(
                 'message'=>'error ',
                 'alert-type'=>'success'
                  );
                 return Redirect()->back()->with($notification);
        }     
    }

//edit employee

    public function editemployee($id){
    	$edit =  DB::table('employees')
    			->where('id',$id)
    			->first();
    	return view('editemployee', compact('edit'));
    }

//update employee
    public function updateemployee(Request $request,$id){
    	$validatedData = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|max:255',
        'nid_no' => 'required|max:255',
        'address' => 'required',
        'phone' => 'required|max:13',
        'salary' => 'required',
        ]);

        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['address']=$request->address;
        $data['experiance']=$request->experiance;
        $data['nid_no']=$request->nid_no;
        $data['salary']=$request->salary;
        $data['vacation']=$request->vacation;
        $data['city']=$request->city;
        $image=$request->file('photo');

        if ($image) {
            $image_name= str_random(5);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/employee/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if ($success) {
                $data['photo']=$image_url;
                $img = DB::table('employees')->where('id',$id)->first();
                $img_path = $img->photo;
                unlink($img_path);
                $employee = DB::table('employees')
                         ->where('id',$id)
                         ->update($data);
              if ($employee) {
                 $notification=array(
                 'message'=>'Employee Updated',
                 'alert-type'=>'info'
                  );
                return Redirect()->route('all-employee')->with($notification);                      
             }else{
              $notification=array(
                 'message'=>'error ',
                 'alert-type'=>'success'
                  );
                 return Redirect()->back()->with($notification);
             }      
                
            }else{

              return Redirect()->back();
            	
            }
        }else{
        	  $employee = DB::table('employees')
                         ->where('id',$id)
                         ->update($data);
              if ($employee) {
                 $notification=array(
                 'message'=>'Employee Updated',
                 'alert-type'=>'info'
                  );
                return Redirect()->route('all-employee')->with($notification);                      
             }else{
              $notification=array(
                 'message'=>'error ',
                 'alert-type'=>'success'
                  );
                 return Redirect()->back()->with($notification);
             }  
        }
    }
}
