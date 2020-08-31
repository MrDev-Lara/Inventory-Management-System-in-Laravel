<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CategoryController extends Controller
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

    public function category(){
    	return view('add_category');
    }

     //insert category
    public function insertCategory(Request $request)
    {
      $validatedData = $request->validate([
        'name' => 'required|max:255',
        ]);

      	$data=array();
        $data['name']=$request->name;

        $category = DB::table('categorys')->insert($data);

        if ($category) {
                 $notification=array(
                 'message'=>'Category Added',
                 'alert-type'=>'success'
                  );
                return Redirect()->route('all-category')->with($notification);                      
             }else{
              $notification=array(
                 'message'=>'error ',
                 'alert-type'=>'success'
                  );
                 return Redirect()->back()->with($notification);
             }      
    }

    // select category list from database

    public function allcategory(){
    	$allcategorys = DB::table('categorys')->get();
    	return view('all_category',compact('allcategorys'));
    }

    // delete category from database

    public function deletecategory($id){
    	$dltuser = DB::table('categorys')
    			->where('id',$id)
    			->delete();

    	if ($dltuser) {
                 $notification=array(
                 'message'=>'Category Deleted',
                 'alert-type'=>'warning'
                  );
                return Redirect()->route('all-category')->with($notification);                      
             }else{
              $notification=array(
                 'message'=>'error ',
                 'alert-type'=>'success'
                  );
                 return Redirect()->back()->with($notification);
        }     
    }

    //edit category

    public function editcaegory($id){
    	$edit =  DB::table('categorys')
    			->where('id',$id)
    			->first();
    	return view('editcategory', compact('edit'));
    }

    public function categoryedit(Request $request,$id){
    	$validatedData = $request->validate([
        'name' => 'required',
        ]);

        $data=array();
        $data['name']=$request->name;

        $category = DB::table('categorys')
                         ->where('id',$id)
                         ->update($data);
              if ($category) {
                 $notification=array(
                 'message'=>'Category Updated',
                 'alert-type'=>'info'
                  );
                return Redirect()->route('all-category')->with($notification);                      
             }else{
              $notification=array(
                 'message'=>'error ',
                 'alert-type'=>'success'
                  );
                 return Redirect()->back()->with($notification);
             }      
    }
}
