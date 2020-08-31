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
                                        <h3 class="panel-title">Datatable</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table id="datatable" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Serial No</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Phone</th>
                                                            <th>Nid_no</th>
                                                            <th>Salary</th>
                                                            <th>Vacation</th>
                                                            <th>Photo</th>
                                                            <th>City</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>

                                             
                                                    <tbody>
                                                        @php 
                                                        $i=0;
                                                        foreach($employees as $employee){
                                                             $i++;
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $i }}</td>
                                                            <td>{{ $employee->name }}</td>
                                                            <td>{{ $employee->email }}</td>
                                                            <td>{{ $employee->phone }}</td>
                                                            <td>{{ $employee->nid_no }}</td>
                                                            <td>{{ $employee->salary }}</td>
                                                            <td>{{ $employee->vacation }}</td>
                                                            <td><img src="{{ $employee->photo }}" style="height:60px;width:60px;"/></td>
                                                            <td>{{ $employee->city }}</td>
                                                            <td><a href="{{ URL::to('editemployee/'.$employee->id) }}" class="btn btn-sm btn-info">Edit</a> |
                                                                <a href="{{ URL::to('deleteemployee/'.$employee->id) }}" class="btn btn-sm btn-warning" id="delete">Delete</a> 
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