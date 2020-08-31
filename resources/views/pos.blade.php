@extends('layouts.app')
@section('content')
<div class="content-page">
  <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="pull-left page-title">POS Management</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="#">POS</a></li>
                        <li class="active">Point Of Sale</li>
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
                                        <h3 class="panel-title">POS</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-7 col-sm-7 col-xs-7">
                                                <table id="datatable" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Serial No</th>
                                                             <th>Product Image</th>
                                                            <th>Poduct Name</th>
                                                            <th>Product Category</th>
                                                           <th>Action</th>
                                                        </tr>
                                                    </thead>

                                             
                                                    <tbody>
                                                         @php 
                                                        $i=0;
                                                        foreach($products as $product){
                                                             $i++;
                                                        @endphp
                                                        <tr>
                                                            <form action="{{ url('/add-cart') }}" method="post">
                                                                @csrf
                                                                 <input type="hidden" name="product_id" value="{{ $product->id }}"/>
                                                                <input type="hidden" name="product_name" value="{{ $product->product_name }}"/>
                                                                <input type="hidden" name="qty" value="1"/>
                                                                <input type="hidden" name="selling_price" value="{{ $product->selling_price }}"/>
                                                                <td>{{ $i }}</td>
                                                                <td>
                                                                   <img src="{{ $product->product_image }}" style="height:60px;width:60px;"/>
                                                                </td>
                                                                <td>{{ $product->product_name }}</td>
                                                                <td>{{ $product->name }}</td>
                                                                 <td> <button type="submit" class="btn btn-sm btn-info"><i class="fa fa-plus-square"></i></button></td>
                                                            </form>
                                                    
                                                        </tr>
                                                       @php }
                                                       @endphp
                                                    </tbody>
                                                </table>

                                            </div>

                                            <div class="col-md-5 col-sm-5 col-xs-5">
                                               <h3 class="text-center"> All Product</h3>

                                               
                                                <ul class="price-features">
                                                    <table class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                             <th>QTY</th>
                                                            <th>Price</th>
                                                            <th>Total</th>
                                                           <th>Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @php $show_cart = Cart::content(); @endphp
                                                        @foreach ($show_cart as $cart)
                                                        <tr>
                                                            <td>{{ $cart->name }}</td>
                                                            <td>
                                                                <form action="{{ url('/update-cart/'.$cart->rowId) }}" method="post">
                                                                    @csrf
                                                                    <input type='number' value='{{ $cart->qty }}' name="quantity" style="width:40px;"/>
                                                                    <button class="btn btn-sm btn-warning"><i class="fa fa-check"></i></button>
                                                                </form>
                                                            </td>
                                                            <td>{{ $cart->price }}</td>
                                                            <td>{{ $cart->price*$cart->qty }}</td>
                                                             <td><a href="{{ URL::to('/delete-item/'.$cart->rowId) }}"><i class="fa fa-trash"></i></a></td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    </table>
                                                </ul>
                                                <div class="price_card text-center">
                                                    <div class="pricing-header bg-success" style="padding-top:20px;padding-bottom:20px;">
                                                    <h5 style="color:white;">Quantity : {{ Cart::count() }}</h5>
                                                    <h5 style="color:white;">Product : {{ Cart::subtotal() }}</h5>
                                                    <h5 style="color:white;">VAT : {{ Cart::tax() }}</h5>
                                                    <hr>
                                                    <h3 style="color:white;">Total : {{ Cart::total() }}</h5>
                                                </div> </br>
                                                    @php
                                                        $customers = DB::table('customers')->get();
                                                    @endphp
                                                    <form action="{{ route('/invoice') }}" method="post">
                                                        @csrf
                                                        <select class="form-control" name="customer_id" required>
                                                            <option disabled selected="">Select Customer first before creating Invoice</option>
                                                            @foreach($customers as $customer)
                                                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <button class="btn btn-success w-md waves-effect waves-light">Create Invoice</button>
                                                    </form>
                                                </div> <!-- end Pricing_card -->

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