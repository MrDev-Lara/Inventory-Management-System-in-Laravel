@extends('layouts.app')
@section('content')
<div class="content-page">
  <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="pull-left page-title">Salary Management</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('all-salary') }}">Salary</a></li>
                        <li class="active">Give Salary</li>
                    </ol>
                </div>
            </div>

            <!-- Start Widget -->
            <div class="row">
	           <!-- Basic example -->
	           <div class="col-md-2"></div>
                <div class="col-md-8 ">
                    <div class="panel panel-default">
                        <div class="panel-heading"><h3 class="panel-title">Give Salary</h3></div>
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
                            <form role="form" action="{{ url('insert-salary') }}" method="post">
                            	@csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Employee</label>
                                    @php 
                                        $employees = DB::table('employees')->get();
                                    @endphp
                                        <select name="employee_id" class="form-control">
                                            @php 
                                             foreach($employees as $employee){
                                             @endphp
                                           <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                           @php } @endphp
                                        </select>   
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword20">Month</label>
                                    <select name="month" class="form-control">
                                        <option value="january">January</option>
                                        <option value="february">February</option>
                                        <option value="march">March</option>
                                        <option value="april">April</option>
                                        <option value="may">May</option>
                                        <option value="june">June</option>
                                        <option value="july">July</option>
                                        <option value="august">August</option>
                                        <option value="september">September</option>
                                        <option value="october">October</option>
                                        <option value="novembor">Novembor</option>
                                        <option value="december">December</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword21">Year</label>
                                    <input type="text" class="form-control" name="year" placeholder="year" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword19">Advanced Salary</label>
                                    <input type="text" class="form-control" name="salary" placeholder="Amount of salary">
                                </div>
                              
                                <button type="submit" class="btn btn-purple waves-effect waves-light">Submit</button>
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