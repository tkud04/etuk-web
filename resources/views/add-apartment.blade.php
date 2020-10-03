<?php
$title = "Add Apartment";
$subtitle = "Post a new apartment to your listings";

$checkoutHead = <<<EOD
                                <div class="checkout-head">
									<ul>
										<li class="add-apartment-active-1 active"><span class="add-apartment-ticker-1">1</span>Apartment Information</li>
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
let selectedSide = "1", facilities = [], aptImages = [], aptImgCount = 1;
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
											<h4 class="mb-3">Basic Information</h4>
										</div>
										
										<div class="col-lg-12 col-md-12 col-sm-12">
											<div class="form-group">
												<label>Apartment ID<i class="req">*</i></label>
												<input type="text" class="form-control" value="Will be generated" readonly>
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>Friendly Name<i class="req">*</i></label>
												<input type="text" class="form-control" id="add-apartment-name" placeholder="Give your apartment a name e.g Royal Hibiscus">
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>Price per day(&#8358;)<i class="req">*</i></label>
												<input type="number" class="form-control" id="add-apartment-amount" placeholder="Enter amount in NGN">
											</div>
										</div>
										
										<div class="col-lg-12 col-md-12 col-sm-12">
											<div class="form-group">
												<label>Description</label>
												<textarea id="add-apartment-description" class="form-control"></textarea>
											</div>
										</div>
										
										<div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: 20px;">
											<h4 class="mb-3">Terms & Conditions</h4>
										</div>
										<?php
										  $times = ['12pm' => "12:00 pm",
										            '1pm' => "1:00 pm",
										            '2pm' => "2:00 pm",
										            '3pm' => "3:00 pm",
										            '4pm' => "4:00 pm",
										            '5pm' => "5:00 pm",
										            '6pm' => "6:00 pm",
										            '7pm' => "7:00 pm"
												   ];
										?>
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>Check In<i class="req">*</i></label>
												<select class="form-control" id="add-apartment-checkin">
												  <option value="none">Select check-in time</option>
												  <?php
												  foreach($times as $key => $value)
												  {
												  ?>
												  <option value="{{$key}}">From {{$value}}</option>
												  <?php
												  }
												  ?>
												</select>
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>Check Out<i class="req">*</i></label>
												<select class="form-control" id="add-apartment-checkout">
												  <option value="none">Select check-out time</option>
												  <?php
												  foreach($times as $key => $value)
												  {
												  ?>
												  <option value="{{$key}}">By {{$value}}</option>
												  <?php
												  }
												  ?>
												</select>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>Payment Type<i class="req">*</i></label>
												<select class="form-control">
												  <option value="none">Card</option>
												</select>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>ID Required on Check-in<i class="req">*</i></label>
												<select class="form-control" id="add-apartment-id-required">
												  <option value="yes">Yes</option>
												  <option value="no">No</option>
												</select>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>Children<i class="req">*</i></label>
												<select class="form-control" id="add-apartment-children">
												  <option value="none">No children allowed</option>
												  <option value="1-5yrs">1-5yrs</option>
												  <option value="6-10yrs">6-10yrs</option>
												  <option value="11-20yrs">11-20yrs</option>
												  <option value=">20yrs">20yrs above</option>
												  <option value="all">All children allowed</option>
												</select>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>Pets<i class="req">*</i></label>
												<select class="form-control" id="add-apartment-pets">
												  <option value="yes">Yes</option>
												  <option value="no" selected="selected">No</option>
												</select>
											</div>
										</div>
										
                                        <div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: 20px;">
											<h4 class="mb-3">Facilities & Services</h4>
										</div>										
										<?php
										$services = [
										  'air-conditioning' => "Air Conditioning",
										  'adequate-parking' => "Adequate Parking",
										  'bar' => "Bar",
										  'game-room' => "Game Room",
										  'inhouse-dining' => "In-house Dining",
										  'drycleaning' => "Drycleaning",
										  'iron' => "Clothing Iron",
										  'kitchen' => "Kitchen",
										  'pool' => "Swimming Pool",
										  'fitness-facilities' => "Fitness Facilities",
										  'room-service' => "Room Service",
										  'tv' => "TV",
										  'concierge' => "Concierge",
										  'security' => "Luggage Storage",
										  'electricity' => "24hrs Electricity",
										  'king-sized-bed' => "King-sized Bed"
										];
										?>
										<div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom: 20px;">
											<div class="form-group">
											   
												<div class="row">
												  <?php
											        foreach($services as $key => $value)
													{
											      ?>
												  <div class="col-lg-3 col-md-6 col-sm-12">
												   
 												    <a class="btn btn-primary btn-sm text-white" id="apt-service-{{$key}}" onclick="toggleFacility('{{$key}}')" data-check="unchecked">
													  <center><i id="apt-service-icon-{{$key}}" class="ti-control-stop"></i></center>
													</a>
													 <label>{{$value}}</label>
												  </div>
												  <?php
													}
												  ?>
												</div>
												
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
																			
										<div class="col-lg-12 col-md-12 col-sm-12">
											<div class="form-group">
												<label>Address<i class="req">*</i></label>
												<input type="text" class="form-control" id="add-apartment-address" placeholder="House address">
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>City<i class="req">*</i></label>
												<input type="text" class="form-control" id="add-apartment-city" placeholder="City">
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>State<i class="req">*</i></label>
												<select class="form-control" id="add-apartment-state">
												  <option value="none">Select state</option>
												  <?php
												   foreach($states as $key => $value)
												   {
												  ?>
												    <option value="{{$key}}">{{$value}}</option>
												  <?php
												   }
												  ?>
												</select>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>Video<i class="req">*</i></label>
												<input type="file" class="form-control" id="add-apartment-video">
											</div>
											<div class="form-group">
											    <ol class="form-control-plaintext">
												  <li>Requirements and recommendations will be displayed here</li>
												  <li>Requirements and recommendations will be displayed here</li>
												</ol>
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>Images<i class="req">*</i></label>
												<div id="add-apartment-images">
												<div id="add-apartment-image-div-0" class="row">
												  <div class="col-md-7">
												    <input type="file" class="form-control" onchange="readURL(this,'0')" id="add-apartment-image-0" name="add-apartment-images[]">												    
												  </div>
												  <div class="col-md-5">
												    <img id="add-apartment-preview-0" src="#" alt="preview" style="width: 50px; height: 50px;"/>
													<a href="javascript:void(0)" onclick="aptSetCoverImage(0)" class="btn btn-theme btn-sm">Set as cover image</a>
												    <a href="javascript:void(0)" onclick="aptRemoveImage(0)"class="btn btn-warning btn-sm">Remove</a>
												  </div>
												</div>
												</div>
											</div>
											<div class="form-group">
											    <a href="javascript:void(0)" onclick="aptAddImage()" class="btn btn-warning btn-sm">Add image</a>
											    <ol class="form-control-plaintext">
												  <li>Requirements and recommendations will be displayed here</li>
												  <li>Requirements and recommendations will be displayed here</li>
												</ol>
											</div>
										</div>									
												
										
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<input id="a-2" class="checkbox-custom" name="a-2" type="checkbox">
												<label for="a-2" class="checkbox-custom-label">By Continuing, you agree to conditions</label>
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
										
											<ul class="booking-detail-list" id="add-apartment-final-preview">
												
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