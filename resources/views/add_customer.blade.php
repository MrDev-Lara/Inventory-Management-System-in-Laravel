@extends('layouts.app')
@section('content')
<div class="content-page">
  <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="pull-left page-title">Customer Management</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('all-employee') }}">Customer</a></li>
                        <li class="active">Add Customer</li>
                    </ol>
                </div>
            </div>

            <!-- Start Widget -->
            <div class="row">
	           <!-- Basic example -->
	           <div class="col-md-2"></div>
                <div class="col-md-8 ">
                    <div class="panel panel-default">
                        <div class="panel-heading"><h3 class="panel-title">Add Customer</h3></div>
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
                            <form role="form" action="{{ url('insert-customer') }}" method="post" enctype="multipart/form-data">
                            	@csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Full Name"required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword21">Phone</label>
                                    <input type="text" class="form-control" name="phone" placeholder="phone"required>
                                </div>
                                <div class="form-group">
                                    <img id="image" src="#" />
                                    <label for="exampleInputPassword11">Photo</label>
                                    <input type="file"  name="photo" accept="image/*"  required onchange="readURL(this);">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword19">Shop Name</label>
                                    <input type="text" class="form-control" name="shop_name" placeholder="Shop Name"required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword18">Shop Location</label>
                                    <input type="text" class="form-control" name="shop_location" placeholder="SHop Location" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword17">Bank Account Name</label>
                                    <input type="text" class="form-control" name="bank_account_name" placeholder="Bank Account Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword17">Bank Account Number</label>
                                    <input type="text" class="form-control" name="account_number" placeholder="Bank Account Number">
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