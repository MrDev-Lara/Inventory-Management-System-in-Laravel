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
                        <li><a href="#">Edit Attendance</a></li>
                        <li class="active">Employee Attendance</li>
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
                                        <h3 >Edit Attendance {{ $date->attend_date }}</h3>
                                        
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
                                                         <form role="form" action="{{ url('update-attendance') }}" method="post" >
                                                        @csrf
                                                        @php 
                                                        $i=0;
                                                        foreach($edit as $edits){
                                                             $i++;
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $i }}</td>
                                                            <td>{{ $edits->name }}</td>
                                                            <input type="hidden" name="id[]" value="{{ $edits->id }}" />
                                                            <td><img src="{{ URL::to($edits->photo) }}" style="height:60px;width:60px;"/></td>
                                                            <td>
                                                                <input type="radio" name="attend[{{ $edits->id }}]" value="present" <?php if($edits->attend == 'present'){echo 'checked';} ?> /> Present
                                                                <input type="radio" name="attend[{{ $edits->id }}]" value="absent" <?php if($edits->attend == 'absent'){echo 'checked';} ?> /> Absent
                                                            </td>
                                                            <input type="hidden" name="attend_date" value="{{ $edits->attend_date }}"/>
                                                            <input type="hidden" name="attend_year" value="{{ $edits->attend_year }}"/>
                                                            <input type="hidden" name="edit_date" value="{{ $edits->edit_date }}"/>

                                                        </tr>
                                                       @php }
                                                       @endphp

                                                    </tbody>
                                                </table>
                                                    <button type="submit" class="btn btn-primary">Update Attendance</button>
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