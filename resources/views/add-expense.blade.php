@extends('layouts.app')
@section('content')
<div class="content-page">
  <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="pull-left page-title">Expense Management</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('all-salary') }}">Product</a></li>
                        <li class="active">Add Expense</li>
                    </ol>
                </div>
            </div>
            <!-- Start Widget -->
            <div class="row">
	           <!-- Basic example -->
	           <div class="col-md-2"></div>
                <div class="col-md-8 ">
                    <div class="panel panel-default">
                        <div class="panel-heading"><h3 class="panel-title">Add Expense</h3></div>
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
                            <form role="form" action="{{ url('insert-expense') }}" method="post">
                            	@csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Expense Details</label>
                                    <input type="text" class="form-control" name="details" placeholder="Expense Details" required>
                                </div>

                                
                                <div class="form-group">
                                    <label for="exampleInputPassword21">Amount</label>
                                    <input type="text" class="form-control" name="amount" placeholder="Expenses Price" required>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="month" value="{{ date('F') }}">
                                </div>

                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="date" value="{{ date('d/m/y') }}">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="year" value="{{ date('Y') }}">
                                </div>
                              
                                <button type="submit" class="btn btn-purple waves-effect waves-light">Add Expense</button>
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