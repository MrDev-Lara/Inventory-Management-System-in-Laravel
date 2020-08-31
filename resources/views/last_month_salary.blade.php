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
                        <li><a href="#">Salary</a></li>
                        <li class="active">All Salary</li>
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
                                        <h1 class="panel-title">Pay last month salary <span class="pull-right text-danger">{{ date("F Y") }}</span></h1>

                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table id="datatable" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Serial No</th>
                                                            <th>Employee</th>
                                                            <th>Month</th>
                                                            <th>Year</th>
                                                            <th>Salary</th>
                                                            <th>Advanced Paid</th>
                                                            <th>Payable</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                          @php 
                                                        $i=0;
                                                        foreach($lastmonthsalary as $salarys){
                                                             $i++;
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $i }}</td>
                                                            <td>{{ $salarys->name }}</td>
                                                            <td>{{ date("F", strtotime('-1 months')) }}</td>
                                                            <td>{{ date("Y") }}</td>
                                                            <td>{{ $salarys->salary }}</td>
                                                            @php
                                                                $none = 0;
                                                                $previousmonth = date("F", strtotime('-1 months')); 
                                                                $sal = $salarys->id;
                                                                $employee = DB::table('salarys')->where('employee_id',$sal)->where('month',$previousmonth)->first();

                                                                if($employee === NULL){
                                                            @endphp
                                                           <td> {{ $none }} </td>
                                                           @php }else{ @endphp
                                                           <td>{{ $employee->advanced_salary }}</td>
                                                           @php } @endphp

                                                           @php
                                                                $previousmonth = date("F", strtotime('-1 months')); 
                                                                $sal = $salarys->id;
                                                                $employee = DB::table('salarys')->where('employee_id',$sal)->where('month',$previousmonth)->first();

                                                                if($employee === NULL){
                                                            @endphp
                                                           <td> {{ $salarys->salary }} </td>
                                                           @php }else{ @endphp
                                                           <td>{{ $salarys->salary-$employee->advanced_salary }}</td>
                                                           @php } @endphp


                                                            @php 
                                                            $sal = $salarys->id;
                                                            $previousmonth = date("F", strtotime('-1 months'));

                                                            $salarydone = DB::table('lastmonthsalary')->where('employ_id',$sal)->where('salary_month',$previousmonth)->first();

                                                            if($salarydone == NULL){
                                                            @endphp
                                                            <td><a href="{{ URL::to('pay_last_month').$salarys->id }}" class="btn btn-sm btn-warning">PAY NOW</a></td>
                                                            </td>
                                                            @php }else{ @endphp
                                                            <td class="badge badge-success">Salary Paid</td>
                                                            @php } @endphp
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