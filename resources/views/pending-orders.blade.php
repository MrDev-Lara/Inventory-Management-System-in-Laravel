@extends('layouts.app')
@section('content')
<div class="content-page">
  <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="pull-left page-title">Pending Orders</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="#">Orders</a></li>
                        <li class="active">Pending Order</li>
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
                                                            <th>Pending No</th>
                                                            <th>Customer Name</th>
                                                            <th>Customer Phone</th>
                                                            <th>Order Date</th>
                                                            <th>Total Amount</th>
                                                            <th>Pay Status</th>
                                                            <th>Order Status</th>
                                                            <th>Action</th>
                                                          
                                                        </tr>
                                                    </thead>

                                             
                                                    <tbody>
                                                        @php 
                                                        $i=0;
                                                        foreach($order as $orders){
                                                             $i++;
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $i }}</td>
                                                            <td>{{ $orders->name }}</td>
                                                            <td>{{ $orders->phone }}</td>
                                                            <td>{{ $orders->order_date }}</td>
                                                            <td>{{ $orders->total }}</td>
                                                            <td>{{ $orders->payment_status }}</td>
                                                            <td><span class="badge badge-danger">Pending</span></td>
                                                            <td><a href="{{ URL::to('vieworderbyid/'.$orders->id) }}" class="btn btn-sm btn-info">View</a>
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