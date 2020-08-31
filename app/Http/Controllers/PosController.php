<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;

class PosController extends Controller
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

    public function POS(){
    	$products = DB::table('products')
    				->join('categorys','products.cat_id','categorys.id')
    				->select('products.*','categorys.name')
    				->get();
    	return view('pos',compact('products'));
    }

    public function addCart(Request $request){
    	$data = array();
    	$data['id'] = $request->product_id;
    	$data['name'] = $request->product_name;
    	$data['qty'] = $request->qty;
    	$data['price'] = $request->selling_price;
    	$done = Cart::add($data);
    	
    	if($done) {
                 $notification=array(
                 'message'=>'Product Added to the Cart',
                 'alert-type'=>'success'
                  );
                return Redirect()->back()->with($notification);                      
             }else{
              $notification=array(
                 'message'=>'error ',
                 'alert-type'=>'warning'
                  );
                 return Redirect()->back()->with($notification);
             }      
    }
    public function updateCart(Request $request,$rowId){
    	$data = $request->quantity;
    	$done = Cart::update($rowId,$data); 


    	if($done) {
                 $notification=array(
                 'message'=>'Product Updated',
                 'alert-type'=>'success'
                  );
                return Redirect()->back()->with($notification);                      
             }else{
              $notification=array(
                 'message'=>'error ',
                 'alert-type'=>'warning'
                  );
                 return Redirect()->back()->with($notification);
             }     
    }
    public function deleteItem($rowId){
    	$remove = Cart::remove($rowId);

    	if($remove) {
                 $notification=array(
                 'message'=>'Product Removed from the Cart',
                 'alert-type'=>'success'
                  );
                return Redirect()->back()->with($notification);                      
             }else{
              $notification=array(
                 'message'=>'Product Removed from the Cart ',
                 'alert-type'=>'warning'
                  );
                 return Redirect()->back()->with($notification);
             }     
    }

    public function invoice(Request $request){
    	$cus_id = $request->customer_id;
    	$cus_inform = DB::table('customers')->where('id',$cus_id)->first();
    	$content = Cart::content();;
    	return view('invoice',compact('cus_inform','content'));
    }

    public function Order(Request $request){
    	$data = array();	
    	$data['customer_id'] = $request->customer_id;
    	$data['order_date'] = date('d/m/Y');
    	$data['order_status'] = '0';
    	$data['sub_total'] = Cart::subtotal();
    	$data['vat'] = Cart::tax();
    	$data['total'] = Cart::total();
    	$data['payment_status'] = $request->payment_status;
    	$data['pay'] = $request->pay;
    	$data['due'] = $request->due;

    	$order_id = DB::table('orders')->insertGetId($data);
    	$content = Cart::content();

    	$value = array();
    	foreach($content as $cart){
    		$value['order_id'] = $order_id;
    		$value['product_id'] = $cart->id;
    		$value['quantity'] = $cart->qty;
    		$value['unit_cost'] = $cart->price;
    		$value['total'] = $cart->qty * $cart->price;

    	$success = DB::table('orderdetails')->insert($value);
    	}
    	if($success) {
                 $notification=array(
                 'message'=>'Successfully Created the order.Please deliver the products to your desired Customer',
                 'alert-type'=>'success'
                  );
                 cart::destroy();
                return Redirect()->home()->with($notification);                      
             }else{
              $notification=array(
                 'message'=>'Product Removed from the Cart ',
                 'alert-type'=>'warning'
                  );
                 return Redirect()->back()->with($notification);
             }     
    }

   public function Pending(){
   	$order = DB::table('orders')
   			->join('customers','orders.customer_id','customers.id')
   			->select('orders.*','customers.name','customers.phone')
   			->where('order_status','0')
   			->get();
   	return view('pending-orders',compact('order'));
   }

   public function ViewOrderById($id){
   			$orders = DB::table('orders')
   			->where('id',$id)
   			->first();

   			$order_details = DB::table('orderdetails')
   							->join('products','orderdetails.product_id','products.id')
   							->select('orderdetails.*','products.product_name')
				   			->where('order_id',$id)
				   			->get();

		              return view('vieworder',compact('orders','order_details'));
   }

  public function complete($id){
  	$update = DB::table('orders')->where('id',$id)->update(['order_status'=>'1']);

  	if($update) {
                 $notification=array(
                 'message'=>'Successfully Marked the Order As Completed',
                 'alert-type'=>'success'
                  );
                return Redirect()->back()->with($notification);                      
             }else{
              $notification=array(
                 'message'=>'Error ',
                 'alert-type'=>'warning'
                  );
                 return Redirect()->back()->with($notification);
             }     
  }

   public function CompletedOrders(){
   	$ordercompleted = DB::table('orders')
   			->join('customers','orders.customer_id','customers.id')
   			->select('orders.*','customers.name','customers.phone')
   			->where('order_status','1')
   			->get();
   	return view('completed-orders',compact('ordercompleted'));
   }
}
