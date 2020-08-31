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
                        <li class="active">Attendance</li>
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
                                        <h3 class="panel-title">Take Attendance</h3>
                                        <h2>{{ date('d/m/y') }}</h2>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Serial No</th>
                                                            <th>Employee Name</th>
                                                            <th>Employee Photo</th>
                                                            <th>Attendance</th>
                                                          
                                                        </tr>
                                                    </thead>

                                             
                                                    <tbody>
                                                         <form role="form" action="{{ url('insert-attendance') }}" method="post" >
                                                        @csrf
                                                        @php 
                                                        $i=0;
                                                        foreach($employee as $employees){
                                                             $i++;
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $i }}</td>
                                                            <td>{{ $employees->name }}</td>
                                                            <input type="hidden" name="employee_id[]" value="{{ $employees->id }}" />
                                                            <td><img src="{{ $employees->photo }}" style="height:60px;width:60px;"/></td>
                                                            <td>
                                                                <input type="radio" name="attend[{{ $employees->id }}]" value="present" /> Present
                                                                <input type="radio" name="attend[{{ $employees->id }}]" value="absent" /> Absent
                                                            </td>
                                                            <input type="hidden" name="attend_date" value="{{ date('d/m/y') }}"/>
                                                            <input type="hidden" name="attend_year" value="{{ date('Y') }}"/>
                                                            <input type="hidden" name="edit_date" value="{{ date('d_m_y') }}"/>

                                                        </tr>
                                                       @php }
                                                       @endphp

                                                    </tbody>
                                                </table>
                                                    <button type="submit" class="btn btn-primary">Take Attendance</button>
                                                </form>
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