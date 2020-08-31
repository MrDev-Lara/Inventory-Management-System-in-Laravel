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
                        <li><a href="{{ route('all-salary') }}">Product</a></li>
                        <li class="active">Add Product</li>
                    </ol>
                </div>
            </div>

            <!-- Start Widget -->
            <div class="row">
	           <!-- Basic example -->
	           <div class="col-md-2"></div>
                <div class="col-md-8 ">
                    <div class="panel panel-default">
                        <div class="panel-heading"><h3 class="panel-title">Add Product</h3></div>
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
                            <form role="form" action="{{ url('insert-product') }}" method="post" enctype="multipart/form-data">
                            	@csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product Name</label>
                                    <input type="text" class="form-control" name="product_name" placeholder="Product Name" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Select Category</label>
                                    @php 
                                        $category = DB::table('categorys')->get();
                                    @endphp
                                        <select name="cat_id" class="form-control">
                                            @php 
                                             foreach($category as $categorys){
                                             @endphp
                                           <option value="{{ $categorys->id }}">{{ $categorys->name }}</option>
                                           @php } @endphp
                                        </select>   
                                </div>
                                <div class="form-group">
                                    <img id="image" src="#" />
                                    <label for="exampleInputPassword11">Product Image</label>
                                    <input type="file"  name="product_image" accept="image/*"  required onchange="readURL(this);">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword21">Product Route</label>
                                    <input type="text" class="form-control" name="product_route" placeholder="Product Route" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword19">Product Row</label>
                                    <input type="text" class="form-control" name="product_row" placeholder="Product Row">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword19">Buying Price</label>
                                    <input type="text" class="form-control" name="buying_price" placeholder="Buying Price">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword19">Selling Price</label>
                                    <input type="text" class="form-control" name="selling_price" placeholder="Selling Price">
                                </div>
                              
                                <button type="submit" class="btn btn-purple waves-effect waves-light">Add Product</button>
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