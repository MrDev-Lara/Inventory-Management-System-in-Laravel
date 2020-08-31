@extends('layouts.app')
@section('content')
<div class="content-page">
  <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="pull-left page-title">Attendance Management</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="#">Attendance</a></li>
                        <li class="active">All Attendance</li>
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
                                        <h3 class="panel-title">Datatable</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table id="datatable" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Action</th>
                                                          
                                                        </tr>
                                                    </thead>

                                             
                                                    <tbody>
                                                        @php 
                                                        foreach($select as $attend){
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $attend->edit_date }}</td>
                                                            <td>
                                                                <a href="{{ URL::to('viewattendance/'.$attend->edit_date) }}" class="btn btn-sm btn-info">View</a>
                                                                <a href="{{ URl::to('editattendance/'.$attend->edit_date) }}" class="btn btn-sm btn-danger">Edit</a>
                                                                <a href="{{ URL::to('deleteattendance/'.$attend->edit_date) }}" class="btn btn-sm btn-warning" id="delete">Delete</a> 
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