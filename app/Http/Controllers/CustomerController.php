<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CustomerController extends Controller
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

    public function customer(){
    	return view('add_customer');
    }

    //insert customer
    public function insertCustomer(Request $request)
    {
      $validatedData = $request->validate([
        'name' => 'required|max:255',
        'phone' => 'required|max:13',
        'photo' => 'required',
        'shop_name' => 'required',
        'shop_location' => 'required',
        ]);

        $data=array();
        $data['name']=$request->name;
        $data['phone']=$request->phone;
        $image=$request->file('photo');
 		$data['shop_name']=$request->shop_name;
        $data['shop_location']=$request->shop_location;
        $data['bank_account_name']=$request->bank_account_name;
       	$data['account_number']=$request->account_number;
        if ($image) {
            $image_name= str_random(5);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/customer/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if ($success) {
                $data['photo']=$image_url;
                $customer = DB::table('customers')
                         ->insert($data);
              if ($customer) {
                 $notification=array(
                 'message'=>'customer Added',
                 'alert-type'=>'success'
                  );
                return Redirect()->route('add-customer')->with($notification);                      
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

// select customer list from database

    public function customerlist(){
    	$customers = DB::table('customers')->get();
    	return view('all_customer',compact('customers'));
    }

// delete customer list from database

    public function deletecustomer($id){
    	$delete = DB::table('customers')
    			->where('id',$id)
    			->first();

    	$photo = $delete->photo;
    	unlink($photo);

    	$dltuser = DB::table('customers')
    			->where('id',$id)
    			->delete();

    	if ($dltuser) {
                 $notification=array(
                 'message'=>'customer Deleted',
                 'alert-type'=>'warning'
                  );
                return Redirect()->route('all-customer')->with($notification);                      
             }else{
              $notification=array(
                 'message'=>'error ',
                 'alert-type'=>'success'
                  );
                 return Redirect()->back()->with($notification);
        }     
    }
}
