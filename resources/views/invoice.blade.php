@extends('layouts.app')
@section('content')
<!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->                      
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="pull-left page-title">Invoice</h4>
                                <ol class="breadcrumb pull-right">
                                    <li><a href="#">Moltran</a></li>
                                    <li class="active">Invoice</li>
                                </ol>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <!-- <div class="panel-heading">
                                        <h4>Invoice</h4>
                                    </div> -->
                                    <div class="panel-body">
                                        <div class="clearfix">
                                            <div class="pull-left">
                                                <h4 class="text-right">Company Name</h4>
                                                
                                            </div>
                                            <div class="pull-right">
                                                <h4>Invoice # <br>
                                                    <strong>{{ date('d/m/Y') }}</strong>
                                                </h4>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                
                                                <div class="pull-left m-t-30">
                                                    <address>
                                                      <strong>{{ $cus_inform->name }}</strong><br>
                                                      Shop Name: {{ $cus_inform->shop_name }}<br>
                                                      Shop Location: {{ $cus_inform->shop_location }}<br>
                                                      <abbr title="Phone">Phone:</abbr> {{ $cus_inform->phone }}
                                                      </address>
                                                </div>
                                                <div class="pull-right m-t-30">
                                                    <p><strong>Order Date: </strong> Jun 15, 2015</p>
                                                    <p class="m-t-10"><strong>Order Status: </strong> <span class="label label-pink">Pending</span></p>
                                                    <p class="m-t-10"><strong>Order ID: </strong> #123456</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="m-h-50"></div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table m-t-30">
                                                        <thead>
                                                            <tr><th>#</th>
                                                            <th>Product</th>
                                                            <th>Quantity</th>
                                                            <th>Unit Cost</th>
                                                            <th>Total</th>
                                                        </tr></thead>
                                                        <tbody>
                                                        	@php
                                                            		$i = 0;
                                                            		foreach($content as $contents){
                                                            		$i++;
                                                            	@endphp
                                                            <tr>
	                                                                <td>{{ $i }}</td>
	                                                                <td>{{ $contents->name }}</td>
	                                                                <td>{{ $contents->qty }}</td>
	                                                                <td>{{ $contents->price }}</td>
	                                                                <td>{{ $contents->qty*$contents->price }}</td>
                                                            </tr>
                                                              @php } @endphp
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="border-radius: 0px;">
                                            <div class="col-md-3 col-md-offset-9">
                                                <p class="text-right"><b>Sub-total:</b> {{ Cart::subtotal() }}</p>
                                                <p class="text-right">VAT: {{ Cart::tax() }}</p>
                                                <hr>
                                                <h3 class="text-right">TK {{ Cart::total() }}</h3>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="hidden-print">
                                            <div class="pull-right">
                                                <a href="#" onclick="window.print()" class="btn btn-inverse waves-effect waves-light"><i class="fa fa-print"></i></a>
                                                <a href="" data-target="#con-close-modal" data-toggle="modal" class="btn btn-primary waves-effect waves-light">Submit</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>



            </div> <!-- container -->
                               
                </div> <!-- content -->
          </div>


<form method="post" action="{{ url('/order') }}">
	@csrf
          <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog"> 
                                                <div class="modal-content"> 
                                                    <div class="modal-header"> 
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                                        <h4 class="modal-title">Payment Gateway</h4> 
                                                        <h4 class="text-center" style="color:red;">Total TK <b>{{ Cart::total() }}</b></h4>
                                                    </div> 
                                                    <div class="modal-body"> 
                                                      
                                                          <input type="hidden" name="customer_id" value="{{ $cus_inform->id }}" /> 

                                                        <div class="row"> 
                                                            <div class="col-md-4"> 
                                                                <div class="form-group"> 
                                                                	 <label for="field-5" class="control-label">Select Payment</label> 
                                                                    <select name="payment_status" required class="form-control">
                                                                    	<option value="handcash">Hand Cash</option>
                                                                    	<option value="cashondelivery">Cash on Delivery</option>
                                                                    	<option value="cheque">Cheque</option>
                                                                    </select>
                                                                </div> 
                                                            </div> 
                                                            <div class="col-md-4"> 
                                                                <div class="form-group"> 
                                                                    <label for="field-5" class="control-label">Pay</label> 
                                                                    <input type="text" class="form-control" id="field-5" name="pay"> 
                                                                </div> 
                                                            </div> 
                                                            <div class="col-md-4"> 
                                                                <div class="form-group"> 
                                                                    <label for="field-6" class="control-label">Due</label> 
                                                                    <input type="text" class="form-control" id="field-6" name="due"> 
                                                                </div> 
                                                            </div> 
                                                     
                                                        
                                                    </div> 
                                                    <div class="modal-footer"> 
                                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
                                                        <button type="submit" class="btn btn-info waves-effect waves-light">Submit</button> 
                                                    </div> 
                                                </div> 
                                            </div>
                                        </div><!-- /.modal -->
    </form>

@endsection