<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Exports\ProductsExport;
use Maatwebsite\Excel\facades\Excel;
use App\Imports\ProductsImport;

class ProductController extends Controller
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

    public function products(){
    	return view('add-product');
    }

    public function insertProduct(Request $request){
    	 $validatedData = $request->validate([
        'product_name' => 'required',
        'product_image' => 'required',
        'buying_price' => 'required',
        'selling_price' => 'required',
        ]);

    	$data=array();
        $data['product_name']=$request->product_name;
        $data['cat_id']=$request->cat_id;
        $image=$request->file('product_image');
 		$data['product_route']=$request->product_route;
        $data['product_row']=$request->product_row;
        $data['buying_price']=$request->buying_price;
       	$data['selling_price']=$request->selling_price;
        if ($image) {
            $image_name= str_random(5);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/products/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if ($success) {
                $data['product_image']=$image_url;
                $product = DB::table('products')
                         ->insert($data);
              if ($product) {
                 $notification=array(
                 'message'=>'Product Added',
                 'alert-type'=>'success'
                  );
                return Redirect()->route('add-product')->with($notification);                      
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
    public function allproduct(){
    	$allproducts = DB::table('products')
    				->join('categorys','products.cat_id','categorys.id')
    				->select('products.*','categorys.name')
    				->get();
    	return view('all_product',compact('allproducts'));
    }
    public function deleteproduct($id){
    	$delete = DB::table('products')
    			->where('id',$id)
    			->first();

    	$photo = $delete->product_image;
    	unlink($photo);

    	$dltuser = DB::table('products')
    			->where('id',$id)
    			->delete();

    	if ($dltuser) {
                 $notification=array(
                 'message'=>'Product Deleted',
                 'alert-type'=>'warning'
                  );
                return Redirect()->route('all-product')->with($notification);                      
             }else{
              $notification=array(
                 'message'=>'error ',
                 'alert-type'=>'success'
                  );
                 return Redirect()->back()->with($notification);
        }     
    }

    public function exportproducts(){
        return view('export_products');
    }

    public function export(){
        return Excel::download(new ProductsExport, 'products.xlsx');
    }
     public function import(Request $request) 
    {
        $done = Excel::import(new ProductsImport, $request->file('file_name'));
        if ($done) {
                 $notification=array(
                 'message'=>'Product Successfully Imported',
                 'alert-type'=>'success'
                  );
                return Redirect()->route('all-product')->with($notification);                      
             }else{
              $notification=array(
                 'message'=>'error ',
                 'alert-type'=>'success'
                  );
                 return Redirect()->back()->with($notification);
        }     
    }
}
