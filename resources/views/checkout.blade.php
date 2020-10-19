<?php
$title = "Checkout";
$subtitle = "Make payment or book for later";

$checkoutHead = <<<EOD
                                <div class="checkout-head">
									<ul>
									    <li></li>
										<li class="active"><span class="add-apartment-ticker-1">1</span>CHECKOUT</li>
										<li></li>
									</ul>
								</div>
EOD;

 //for tests
			  $secureCheckout = "http://etukng.tobi-demos.tk/checkout";
			  $unsecureCheckout = url('checkout');
			  $securePay = "http://etukng.tobi-demos.tk/pay";
			  $unsecurePay = url('pay');
			  
			  $isSecure = (isset($secure) && $secure);
			  $pay = $isSecure ? $securePay : $unsecurePay;
			  $checkout = $isSecure ? $secureCheckout : $unsecureCheckout;
			  
$name = $apartment['name'];
$terms = $apartment['terms'];
$adata = $apartment['data'];
$address = $apartment['address'];
$location = $address['city'].", ".$address['state'];
$facilities = $apartment['facilities'];
$cmedia = $apartment['cmedia'];
$imgs = $cmedia['images'];
?>
@extends('layout')

@section('title',$title)

@section('top-header')
@include('top-header')
@stop

@section('content')
@include('banner-2',['title' => $title,'subtitle' => $subtitle])
<script>
let selectedSide = "1", facilities = [], aptImages = [], aptImgCount = 1, aptCover = "none";

$(document).ready(() => {
checkoutPreview();	
});

</script>
<!-- =================== Add Apartment Search ==================== -->
			<section class="gray">
				<div class="container">
					<div class="row">
						<div class="col-lg-9 col-md-8">
							<input type="hidden" id="tk-apt" value="{{csrf_token()}}">
							<input type="hidden" id="tk-axf" value="{{url('apartments')}}">
							
							<!-- Add Apartment Step 3 -->
							<div class="checkout-wrap">
								
								{!! $checkoutHead !!}
								
								<div class="checkout-body" id="checkout-div">
									
									
									<div class="row">
										<div class="col-md-12 col-lg-12">
										
											<ul class="booking-detail-list" id="checkout-preview">
												<li>Apartment name<span>{{$name}}</span></li>
												<li>Adults<span>{{$a}}</span></li>
												<li>Children<span>${aptMaxChildren}</span></li>
												<li>Check in<span>${aptCheckin}</span></li>
												<li>Check out<span>${aptCheckout}</span></li>
												<li>Price per day<span>&#8358;${aptAmount}</span></li>
												<li>Total<span>&#8358;${dt.total}</span></li>
												<li>Payment type<span>Card</span></li>
												<li>ID required on check-in<span>${dt.aptIdRequired}</span></li>
												<li>Children<span>${aptChildren}</span></li>
												<li>Facilities & services<span>${ff}</span></li>
											</ul>
											<hr>
											
											<h4>Final Notes</h4>
											<p>Take a moment to preview the information about your apartment to ensure there are no errors or mistypes as your request will be reviewed by an admin. If you are sure all your information is correct click on <b>Submit</b> below. To make changes click on <b>Back</b>.</p>
											
										</div>
										
										<div class="col-lg-12 col-md-12 col-sm-12">
											<div class="form-group text-center" id="add-apartment-submit">
												<a href="javascript:void(0)" id="add-apartment-side-3-prev" class="btn btn-theme">Back</a>
												<a href="javascript:void(0)" id="add-apartment-side-3-next" class="btn btn-theme">Submit</a>
											</div>
											<!--
											<div class="form-group text-center" id="add-apartment-loading">
												 <h4>Adding apartment.. <img src="{{asset('img/loading.gif')}}" class="img img-fluid" alt="Adding apartment.."></h4><br>
											</div>
											-->
										</div>
									</div>
								</div>
								
							</div>
							<!-- End of Add Apartment Step 3 -->
							
							
						</div>
						<!-- Sidebar End -->
							
						<div class="col-lg-3 col-md-4">
							@include('apt-sidebar',['cmedia' => [],'media' => []])
						</div>
					</div>
				</div>
			</section>
			<!-- =================== Add Apartment Search ==================== -->
@stop