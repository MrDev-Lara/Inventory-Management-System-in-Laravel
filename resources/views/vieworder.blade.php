@extends('layouts.app')
@section('content')
<div class="content-page">
  <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="pull-left page-title">Order Management</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="#">Orders</a></li>
                        <li class="active">Order Confirmation</li>
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
                                        <h3 class="panel-title">Orders</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table id="datatable" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Serial No</th>
                                                            <th>Product Name</th>
                                                            <th>Quantity</th>
                                                            <th>Unit Cost</th>
                                                            <th>Total</th>
                                                          
                                                        </tr>
                                                    </thead>

                                             
                                                    <tbody>
                                                        @php 
                                                        $i=0;
                                                        foreach($order_details as $done){
                                                             $i++;
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $i }}</td>
                                                            <td>{{ $done->product_name }}</td>
                                                            <td>{{ $done->quantity }}</td>
                                                            <td>{{ $done->unit_cost }}</td>
                                                            <td>{{ $done->total }}</td>
                                                        </tr>
                                                       @php }
                                                       @endphp
                                                    </tbody>
                                                </table>
                                                  <div class="row" style="border-radius: 0px;">
                                                        <div class="col-md-3 col-md-offset-9">
                                                            <p class="text-right"><b>Sub-total:</b> {{ $orders->sub_total }}</p>
                                                            <p class="text-right">VAT: {{ $orders->vat }}</p>
                                                            <hr>
                                                            <h3 class="text-right">TK {{ $orders->total }}</h3>
                                                             <a href="{{ URL::to('completeorder/'.$orders->id) }}" class="btn btn-primary waves-effect waves-light">Mark As Complete</a>
                                                        </div>
                                                   </div>
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