<?php
$title = "Checkout";
$subtitle = "Make payment or book for later";
$cartt = $cart['data'];
$ii = count($cartt) == 1 ? "item" : "items";
$subtotal = $cart['subtotal'];

 //for tests
			  $secureCheckout = "http://etukng.tobi-demos.tk/checkout";
			  $unsecureCheckout = url('checkout');
			  $securePay = "http://etukng.tobi-demos.tk/pay";
			  $unsecurePay = url('pay');
			  
			  $isSecure = (isset($secure) && $secure);
			  $pay = $isSecure ? $securePay : $unsecurePay;
			  $checkout = $isSecure ? $secureCheckout : $unsecureCheckout;

?>
@extends('layout')

@section('title',$title)

@section('top-header')
@include('top-header')
@stop

@section('content')
@include('banner-2',['title' => $title,'subtitle' => $subtitle])

 <script>
		    
								 mc = {"ref":"{{$ref}}",
								       "type":"checkout",
								       "email":"{{$user->email}}",
									   "notes":""
									  };
                        
$(document).ready(() => {
	$('.uc').hide();
});						
           </script>

                            	<input type="hidden" id="card-action" value="{{$pay}}">
                            	<input type="hidden" id="checkout-ref" value="{{$ref}}">
<!-- ============================ Checkout Start ================================== -->
			<section>
				<div class="container">
				
					
					<div class="row align-items-center">
						
						<div class="col-lg-7 col-md-7">
							<div class="contact-form">
								<form id="checkout-form" method="post">
								{!! csrf_field() !!}
									<div class="row">
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
											  <label>Name</label>
											  <input type="text" class="form-control" value="{{$user->fname.' '.$user->lname}}" placeholder="Name" readonly>
											</div>
										</div>
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
											  <label>Email</label>
											  <input type="email" class="form-control" value="{{$user->email}}" placeholder="Email" readonly>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-lg-6 col-md-6">
										<?php
										 if(count($sps) > 0)
										 {
										?>
											<div class="form-group">
												<label>Select saved payment</label>
												<select class="form-control" id="checkout-payment-type">
												  <option value="none">Select a card to pay with</option>
												  <?php
												   foreach($sps as $s)
												   {
													   $dt = $s['data'];
													   $n = $dt->bank." | **** ".$dt->last4." | Expires: ".$dt->exp_month."/".$dt->exp_year;
												  ?>
												    <option value="{{$s['id']}}">{{$n}}</option>
												  <?php
												   }
												  ?>
												  <option value="card">Use a different card</option>
												</select>
											</div>
											
										<?php
										 }
										 else
										 {
										?>
										<div class="form-group">
												<label>Payment type</label>
												<select class="form-control" id="checkout-payment-type">
												  <option value="none">Select payment type</option>
												  <option value="card" selected="selected">Card</option>
												</select>
											</div>
										<?php
										 }
										?>
                                        </div>
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<label>Save payment info?</label>
												<select class="form-control" name="sps" id="checkout-sps">
												  <option value="yes" selected="selected">Yes</option>
												  <option value="no">No</option>
												</select>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-lg-12 col-md-12">
											<div class="form-group">
												<label>Notes (optional)</label>
												<textarea class="form-control" id="notes" placeholder="Type Here..."></textarea>
											</div>
										</div>
									</div>
									
									 <!-- payment form -->
                            	<input type="hidden" name="email" value="{{$user->email}}"> {{-- required --}}
                            	<input type="hidden" name="quantity" value="1"> {{-- required --}}
                            	<input type="hidden" name="amount" value="{{$subtotal * 100}}"> {{-- required in kobo --}}
                            	<input type="hidden" name="metadata" id="nd" value="" > {{-- For other necessary things you want to add to your payload. it is optional though --}}
                            
                                <input type="hidden" id="meta-comment" value="">  
                            <!-- End payment form -->
									
								</form>
							</div>
						</div>
						
						<div class="col-lg-5 col-md-5 mt-5" style="overflow-y: scroll;">
							<div class="row">
							  <div class="col-lg-12 col-md-12">
							   <h3>{{count($cartt)}} {{$ii}}</h3><br>
							   <h4>Subtotal: &#8358;<span>{{number_format($subtotal,2)}}</span></h4><br>
							  </div><br>
							  <div class="col-lg-12 col-md-12">
							  <?php
							    foreach($cartt as $c)
													 {
														 $xf = $user->id;
														 $axf = $c['apartment_id'];
														 $apartment = $c['apartment'];
														 $au = $apartment['url'];
														 $cmedia = $apartment['cmedia'];
														 $imgs = $cmedia['images'];
														 $adata = $apartment['data'];
														 $amount = $adata['amount'];
														 $address = $apartment['address'];
														 $location = $address['city'].", ".$address['state'];
														 $checkin = new DateTime($c['checkin']);
														 $checkout = new DateTime($c['checkout']);
														 $c1 = new DateTime($checkin->format("jS F, Y"));
														 $c2 = new DateTime($checkout->format("jS F, Y"));
														 $cdiff = $c1->diff($c2);
														 $duration = $cdiff->format("%r%a");
														 $dtt = $duration == 1 ? "night" : "nights";
							 if($c != $cartt[0])
							 {
							 ?>
							 <hr style="margin-top: 10px;">
							 <?php
							 }
							 ?>
							   <h3><span class="label label-primary">{{$apartment['name']}}</span> <b>&#8358;{{number_format($amount,2)}}</b> <small>per night</small></h3>
							   <p>Check-in: <b>{{$checkin->format("jS F, Y")}}</b></p>
							   <p>Duration: <b>{{$duration." ".$dtt}}</b></p>
							   <p>Guests: <b>{{$c['guests']}}</b> | Kids: <b>{{$c['kids']}}</b></p>
							   <input type="hidden" id="{{$axf}}-vsb" value="h">
							   <div class="row uc" id="{{$axf}}-row">
							  
							     <div class="col-md-4">
								   <div class="form-group">
								     <label>Guests<i class="req">*</i></label>
									 <input type="number" class="form-control" placeholder="0" id="uc-{{$axf}}-guests">
								   </div>
								 </div>
								 <div class="col-md-4">
								   <div class="form-group">
								     <label>Kids<i class="req">*</i></label>
									 <input type="number" class="form-control" placeholder="0" id="uc-{{$axf}}-kids">
								   </div>
								 </div>
								 <div class="col-md-4">
								   <a class="btn btn-success btn-sm" href="javascript:void(0)" onclick="uc({axf: '{{$axf}}'}); return false;">Submit</a>
								 </div>
							   </div>
							   <span><a class="btn btn-info btn-sm" href="javascript:void(0)" onclick="tuc({axf: '{{$axf}}'}); return false;" id="{{$axf}}-update">Update</a></span>
							   <span><a class="btn btn-danger btn-sm" href="javascript:void(0)" onclick="rc({axf: '{{$axf}}'}); return false;">Remove</a></span>
							   <p></p>
							 <?php
													 }
							 ?>
							  </div>
							</div>
						</div>
					</div>
					<div class="row mt-5">
										<div class="col-lg-12 col-md-12">										
											<button id="checkout-book-btn" class="btn btn-primary">Book for later</button>
											<button id="checkout-pay-btn" class="btn btn-success">Pay now</button>
										</div>
									</div>
					
				</div>
			</section>
			<div class="clearfix"></div>
			<!-- ============================ Checkout End ================================== -->
@stop