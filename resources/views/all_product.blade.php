@extends('layouts.app')
@section('content')
<div class="content-page">
  <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="pull-left page-title">Product Management</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="#">Product</a></li>
                        <li class="active">All Product</li>
                    </ol>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->                     

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Product List</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table id="datatable" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Serial No</th>
                                                            <th>Product Name</th>
                                                            <th>Product Category</th>
                                                            <th>Product Image</th>
                                                            <th>Product Route</th>
                                                            <th>Product Row</th>
                                                            <th>Buying Price</th>
                                                            <th>Selling Price</th>
                                                            <th>Action</th>
                                                          
                                                        </tr>
                                                    </thead>

                                             
                                                    <tbody>
                                                        @php 
                                                        $i=0;
                                                        foreach($allproducts as $product){
                                                             $i++;
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $i }}</td>
                                                            <td>{{ $product->product_name }}</td>
                                                            <td>{{ $product->name }}</td>
                                                            <td><img src="{{ $product->product_image }}" style="height:60px;width:60px;"/></td>
                                                            <td>{{ $product->product_route }}</td>
                                                            <td>{{ $product->product_row }}</td>
                                                            <td>{{ $product->buying_price }}</td>
                                                            <td>{{ $product->selling_price }}</td>
                                                            <td>
                                                                <a href="{{ URL::to('deleteproduct/'.$product->id) }}" class="btn btn-sm btn-warning" id="delete">Delete</a> 
                                                            </td>
                                                    
                                                        </tr>
                                                       @php }
                                                       @endphp
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div> <!-- End Row -->
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->
        </div> <!-- container -->         
    </div> <!-- content -->
</div>

@endsection