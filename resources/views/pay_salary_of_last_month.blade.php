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
                        <li class="active">Edit Employee</li>
                    </ol>
                </div>
            </div>

            <!-- Start Widget -->
            <div class="row">
	           <!-- Basic example -->
	           <div class="col-md-2"></div>
                <div class="col-md-8 ">
                    <div class="panel panel-default">
                        <div class="panel-heading"><h3 class="panel-title">Pay Salary Of Last Month</h3></div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="panel-body">
                            <form role="form" action="{{ url('last_month') }}" method="post">
                            	@csrf
                                <input type="hidden" class="form-control" name="employ_id" value="{{ $pay->id }}" readonly required>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Employee</label>
                                    <input type="text" class="form-control" value="{{ $pay->name }}" readonly required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Month</label>
                                    <input type="text" class="form-control" name="month" value="{{ date("F", strtotime('-1 months'))}}" readonly required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Salary</label>
                                    <input type="text" readonly class="form-control" name="total_salary_paid" value="{{ $pay->salary }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Advanced Paid </label>
                                @php
                                $none = 0;
                                $previousmonth = date("F", strtotime('-1 months')); 
                                $sal = $pay->id;
                                $employee = DB::table('salarys')->where('employee_id',$sal)->where('month',$previousmonth)->first();

                                if($employee === NULL){
                            @endphp
                           <input type="text" readonly class="form-control" value="{{ $none }}" required readonly>
                           @php }else{ @endphp
                           <input type="text" readonly class="form-control" value="{{ $employee->advanced_salary }}" required readonly>
                           @php } @endphp

                           <div class="form-group">
                                    <label for="exampleInputEmail1"> Payable </label>
                                @php
                                $previousmonth = date("F", strtotime('-1 months')); 
                                $sal = $pay->id;
                                $employee = DB::table('salarys')->where('employee_id',$sal)->where('month',$previousmonth)->first();

                                if($employee === NULL){
                            @endphp
                           <input type="text" readonly class="form-control" value="{{ $pay->salary }}" required readonly>
                           @php }else{ @endphp
                           <input type="text" readonly class="form-control" value="{{ $pay->salary-$employee->advanced_salary }}" required readonly>
                           @php } @endphp
                                <button type="submit" class="btn btn-danger waves-effect waves-light">Pay Salary</button>
                            </form>
                        </div><!-- panel-body -->
                    </div> <!-- panel -->
                </div> <!-- col-->

            </div>
        </div> <!-- container -->
                   
    </div> <!-- content -->
</div>

<script type="text/javascript">
	function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#image')
                  .attr('src', e.target.result)
                  .width(80)
                  .height(80);
          };
          reader.readAsDataURL(input.files[0]);
      }
   }
</script>
@endsection