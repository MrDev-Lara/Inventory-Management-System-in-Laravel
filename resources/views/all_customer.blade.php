@extends('layouts.app')
@section('content')
<div class="content-page">
  <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="pull-left page-title">Employee Management</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="#">Employee</a></li>
                        <li class="active">Add Employee</li>
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
                                        <h3 class="panel-title">Customer List</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table id="datatable" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Serial No</th>
                                                            <th>Name</th>
                                                            <th>Phone</th>
                                                            <th>Photo</th>
                                                            <th>Shop Name</th>
                                                            <th>Shop Location</th>
                                                            <th>Bank Account Name</th>
                                                            <th>Account Number</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>

                                             
                                                    <tbody>
                                                        @php 
                                                        $i=0;
                                                        foreach($customers as $customer){
                                                             $i++;
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $i }}</td>
                                                            <td>{{ $customer->name }}</td>
                                                            <td>{{ $customer->phone }}</td>
                                                            <td><img src="{{ $customer->photo }}" style="height:60px;width:60px;"/></td>
                                                            <td>{{ $customer->shop_name }}</td>
                                                            <td>{{ $customer->shop_location }}</td>

                                                            @php
                                                            if($customer->bank_account_name == NULL){
                                                            @endphp
                                                            <td>No Entry</td>
                                                            @php
                                                            }else{
                                                            @endphp
                                                            <td>{{ $customer->bank_account_name }}</td>
                                                            @php 
                                                            } 
                                                            @endphp

                                                             @php
                                                            if($customer->account_number == NULL){
                                                            @endphp
                                                            <td>No Entry</td>
                                                            @php
                                                            }else{
                                                            @endphp
                                                            <td>{{ $customer->account_number }}</td>
                                                            @php 
                                                            } 
                                                            @endphp

                                                            <td>
                                                                <a href="{{ URL::to('deletecustomer/'.$customer->id) }}" class="btn btn-sm btn-warning" id="delete">Delete</a> 
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