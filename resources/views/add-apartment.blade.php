<?php
$title = "Add Apartment";
$subtitle = "Post a new apartment to your listings";

$checkoutHead = <<<EOD
                                <div class="checkout-head">
									<ul>
										<li class="add-apartment-active-1 active"><span class="add-apartment-ticker-1">1</span>Hotel Information</li>
										<li class="add-apartment-active-2"><span class="add-apartment-ticker-2">2</span>Location & Media</li>
										<li class="add-apartment-active-3"><span class="add-apartment-ticker-3">3</span>Preview</li>
									</ul>
								</div>
EOD;
?>
@extends('layout')

@section('title',$title)

@section('top-header')
@include('top-header')
@stop

@section('content')
@include('banner-2',['title' => $title,'subtitle' => $subtitle])
<script>
let selectedSide = "1";
</script>
<!-- =================== Add Apartment Search ==================== -->
			<section class="gray">
				<div class="container">
					<div class="row">
						<div class="col-lg-9 col-md-8">
							
							<!-- Add Apartment Step 1 -->
							<div class="checkout-wrap" id="add-apartment-side-1">
								
								{!! $checkoutHead !!}
								
								<div class="checkout-body">
									<div class="row">
								
										<div class="col-lg-12 col-md-12 col-sm-12">
											<h4 class="mb-3">Hotel Information</h4>
										</div>
										
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>First Name<i class="req">*</i></label>
												<input type="text" class="form-control" value="Shaurya">
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>Last Name<i class="req">*</i></label>
												<input type="text" class="form-control" value="Preet">
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>Email<i class="req">*</i></label>
												<input type="email" class="form-control" value="themezhub@gmail.com">
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>Phone</label>
												<input type="text" class="form-control" value="780 052 2177">
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>Country<i class="req">*</i></label>
												<select id="country" class="form-control">
													<option value="">&nbsp;</option>
													<option value="1">United State</option>
													<option value="2">United kingdom</option>
													<option value="3">India</option>
													<option value="4">Canada</option>
												</select>
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>City<i class="req">*</i></label>
												<select id="choose-city" class="form-control">
													<option value="">&nbsp;</option>
													<option value="1">Canada, USA</option>
													<option value="2">California</option>
													<option value="3">Newyork</option>
													<option value="4">Liverpool</option>
												</select>
											</div>
										</div>
										
										<div class="col-lg-12 col-md-12 col-sm-12">
											<div class="form-group">
												<label>Special Instruction</label>
												<textarea id="add-apartment-description" class="form-control"></textarea>
											</div>
										</div>										
										
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<input id="a-2" class="checkbox-custom" name="a-2" type="checkbox">
												<label for="a-2" class="checkbox-custom-label">Create An Account</label>
											</div>
										</div>
										
										<div class="col-lg-12 col-md-12 col-sm-12">
											<div class="form-group text-center">
												<a href="javascript:void(0)" id="add-apartment-side-1-next" class="btn btn-theme">Next</a>
											</div>
										</div>
										
									</div>
								</div>
								
							</div>
							<!-- End of Add Apartment Step 1 -->
							
							<!-- Add Apartment Step 2 -->
							<div class="checkout-wrap" id="add-apartment-side-2">
								
								{!! $checkoutHead !!}
								
								<div class="checkout-body">
									<div class="row mb-5">
								
										<div class="col-lg-12 col-md-12 col-sm-12">
											<h4 class="mb-3">Location & Media</h4>
										</div>
										
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="switchbtn paying">
												<input id="pay-2" class="switchbtn-checkbox" type="radio" value="2" name="pay-2" checked>
												<label class="switchbtn-label" for="pay-2">
													<img src="{{asset('img/card-pay.png')}}" alt="" />
													Pay with Credit card
												</label>
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="switchbtn paying">
												<input id="pay-3" class="switchbtn-checkbox" type="radio" value="2" name="pay-2">
												<label class="switchbtn-label" for="pay-3">
													<img src="{{asset('img/paypal.png')}}" alt="" />
													Pay with PayPal
												</label>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>Card Holder Name</label>
												<input type="text" class="form-control">
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>Card Number</label>
												<input type="text" class="form-control">
											</div>
										</div>									
									
										<div class="col-lg-5 col-md-5 col-sm-6">
											<div class="form-group">
												<label>Expire Month</label>
												<input type="text" class="form-control">
											</div>
										</div>
										
										<div class="col-lg-5 col-md-5 col-sm-6">
											<div class="form-group">
												<label>Expire Year</label>
												<input type="text" class="form-control">
											</div>
										</div>
										
										<div class="col-lg-2 col-md-2 col-sm-12">
											<div class="form-group">
												<label>CVC</label>
												<input type="text" class="form-control">
											</div>
										</div>										
										
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<input id="a-2" class="checkbox-custom" name="a-2" type="checkbox">
												<label for="a-2" class="checkbox-custom-label">By Continuing, you ar'e agree to conditions</label>
											</div>
										</div>
										
										<div class="col-lg-12 col-md-12 col-sm-12">
											<div class="form-group text-center">
												<a href="javascript:void(0)" id="add-apartment-side-2-prev" class="btn btn-theme">Back</a>
												<a href="javascript:void(0)" id="add-apartment-side-2-next" class="btn btn-theme">Next</a>
											</div>
										</div>
										
									</div>
								</div>
								
							</div>							
							<!-- End of Add Apartment Step 2 -->
							
							<!-- Add Apartment Step 3 -->
							<div class="checkout-wrap" id="add-apartment-side-3">
								
								{!! $checkoutHead !!}
								
								<div class="checkout-body">
									
									
									<div class="row">
										<div class="col-md-12 col-lg-12">
										
											<ul class="booking-detail-list">
												<li>Booking ID/Num.<span>#BK1254872</span></li>
												<li>First Name<span>Shaurya</span></li>
												<li>Last Name<span>Preet</span></li>
												<li>Email<span>themezhub@gmail.com</span></li>
												<li>Phone<span>91 235 458 7458</span></li>
												<li>City<span>California</span></li>
												<li>Contry<span>United State</span></li>
												<li>Location<span>New Besil, Liverpool</span></li>
												<li>Zip<span>215467</span></li>
											</ul>
											<hr>
											
											<h4>Payment Detail</h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit</p>
											
										</div>
										
										<div class="col-lg-12 col-md-12 col-sm-12">
											<div class="form-group text-center">
												<a href="javascript:void(0)" id="add-apartment-side-3-prev" class="btn btn-theme">Back</a>
												<a href="javascript:void(0)" id="add-apartment-side-3-next" class="btn btn-theme">Submit</a>
											</div>
										</div>
									</div>
								</div>
								
							</div>
							<!-- End of Add Apartment Step 3 -->
							
							
						</div>
						<!-- Sidebar End -->
							
						<div class="col-lg-3 col-md-4">
							<div class="checkout-side">
							
								<div class="booking-short">
									<img src="{{asset('img/des-5.jpg')}}" class="img-fluid" alt="" />
									<h4>Manali To Paris, London</h4>
									<span>5 Days Tour</span>
								</div>
								
								<div class="booking-short-side">
									<div class="accordion" id="accordionExample">
										<div class="card">
											<div class="card-header" id="bookinDet">
											  <h2 class="mb-0">
												<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#bookinSer" aria-expanded="true" aria-controls="bookinSer">
												  Booking Detail
												</button>
											  </h2>
											</div>

											<div id="bookinSer" class="collapse show" aria-labelledby="bookinDet" data-parent="#accordionExample">
												<div class="card-body">
													<ul class="booking-detail-list">
														<li>10 May 2020- 20 May 2020</li>
														<li>Tour Days<span>5 Days</span></li>
														<li>Adults<span>4</span></li>
														<li>Children<span>3</span></li>
													</ul>
												</div>
											</div>
										</div>
										
										<div class="card">
											<div class="card-header" id="extraFeat">
											  <h2 class="mb-0">
												<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#extraSer" aria-expanded="false" aria-controls="extraSer">
												  Extra Features
												</button>
											  </h2>
											</div>
											<div id="extraSer" class="collapse" aria-labelledby="extraFeat" data-parent="#accordionExample">
												<div class="card-body">
													<ul class="booking-detail-list">
														<li>Breakfast</li>
														<li>Rooms Service</li>
														<li>Wifi Free</li>
														<li>Car Driving</li>
													</ul>
												</div>
											</div>
										  </div>
										  
										  <div class="card">
											<div class="card-header" id="CouponCode">
											  <h2 class="mb-0">
												<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#couponcd" aria-expanded="false" aria-controls="couponcd">
												  Coupon Code
												</button>
											  </h2>
											</div>
											<div id="couponcd" class="collapse show" aria-labelledby="CouponCode" data-parent="#accordionExample">
												<div class="card-body">
													<div class="form-group">
														<input type="text" class="form-control" placeholder="Code">
														<button type="button" class="btn btn-black black full-width mt-2">Apply</button>
													</div>
												</div>
											</div>
										</div>
										
										<div class="card">
											<div class="card-header" id="PayMents">
											  <h2 class="mb-0">
												<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#payser" aria-expanded="false" aria-controls="payser">
												  Payment
												</button>
											  </h2>
											</div>
											<div id="payser" class="collapse" aria-labelledby="PayMents" data-parent="#accordionExample">
												<div class="card-body">
													<ul class="booking-detail-list">
														<li>Sub Total<span>$224</span></li>
														<li>Extra Price<span>$70</span></li>
														<li>Tax<span>$20</span></li>
														<li><b>Pay Ammount</b><span>$314</span></li>
													</ul>
												</div>
											</div>
										</div>
										
									</div>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- =================== Add Apartment Search ==================== -->
@stop