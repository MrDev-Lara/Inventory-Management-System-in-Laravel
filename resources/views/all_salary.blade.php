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
                        <li><a href="{{ route('all-employee') }}">Product</a></li>
                        <li class="active">All Category</li>
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
                                        <h3 class="panel-title">All Categorys</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table id="datatable" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Serial No</th>
                                                            <th>Category Name</th>
                                                            <th>Action</th>
                                                          
                                                        </tr>
                                                    </thead>

                                             
                                                    <tbody>
                                                        @php 
                                                        $i=0;
                                                        foreach($salarys as $salary){
                                                             $i++;
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $i }}</td>
                                                            <td>{{ $salary->name }}</td>
                                                            <td>{{ $salary->month }}</td>
                                                            <td>{{ $salary->year }}</td>
                                                            <td>{{ $salary->advanced_salary }}</td>
                                                            <td>{{ $salary->phone }}</td>
                                                    
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