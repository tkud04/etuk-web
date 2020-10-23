<?php
$title = "My Bookings";
$subtitle = "List of bookings made by you";
?>
@extends('layout')

@section('title',$title)

@section('top-header')
@include('top-header')
@stop

@section('content')
@include('banner-2',['title' => $title,'subtitle' => $subtitle])
<!-- ============================ Dashboard Start ================================== -->
			<section class="gray">
				<div class="container-fluid">
					<div class="row">
						
						@include('guest-dashboard-sidebar',['user' => $user])
						
						<div class="col-lg-9 col-md-8 col-sm-12">
							<div class="dashboard-wrapers">
							
								<div class="dashboard-gravity-list">

									<h4>{{$title}}</h4>
									<ul>
                                       <?php
									   if(count($orders) > 0)
									   {
									    foreach($orders as $o)
										{
										  $ref = $o['reference'];
										  $s = ""; $liClass = ""; $ps = "";
										  
										  if($o['status'] == "paid")
										  {
											  $liClass = "approved-booking";
											  $s = "Active";									
										  }
										  else if($o['status'] == "expired")
										  {
											  $liClass = "pending-booking";
											  $s = "Expired";
											  $ps = " pending";
										  }
										  else if($o['status'] == "cancelled")
										  {
											  $liClass = "canceled-booking";
											  $s = "Cancelled";
										  }
										  
										  $items = $o['items'];
										  
										  foreach($items as $i)
										  {
											 
														 $apartment = $i['apartment'];
														 $au = $apartment['url'];
														 $cmedia = $apartment['cmedia'];
														 $imgs = $cmedia['images'];
														 $adata = $apartment['data'];
														 $terms = $apartment['terms'];
														 $host = $apartment['host'];
														 $amount = $adata['amount'];
														 $address = $apartment['address'];
														 $location = $address['city'].", ".$address['state'];
														 $checkin = $c['checkin'];
														 $checkout = $c['checkout'];
											  
									   ?>
										<li class="{{$liClass}}">
											<div class="list-box-listing bookings">
												<div class="list-box-listing-img"><img src="{{$imgs[0]}}" alt="{{$apartment['name']}}"></div>
												<div class="list-box-listing-content">
													<div class="inner">
														<h3>{{$apartment['name']}} <span class="booking-status{{$ps}}">{{$s}}</span></h3>

														<div class="inner-booking-list">
															<h5>Booking Date:</h5>
															<ul class="booking-list">
																<li class="highlighted">{{$checkin}} - {{$checkout}}</li>
															</ul>
														</div>
																	
														<div class="inner-booking-list">
															<h5>Booking Details:</h5>
															<ul class="booking-list">
																<li class="highlighted">{{$i['guests']}} Adults | {{$i['kids']}} Kids</li>
															</ul>
														</div>		
																	
														<div class="inner-booking-list">
															<h5>Price:</h5>
															<ul class="booking-list">
																<li class="highlighted">&#8358;{{number_format($amount,2)}}</li>
															</ul>
														</div>		

														<div class="inner-booking-list">
															<h5>Host:</h5>
															<ul class="booking-list">
																<li>{{$host['name']}}</li>
															</ul>
														</div>

														<a href="#small-dialog" class="rate-review"><i class="ti-email"></i> Send Message</a>

													</div>
												</div>
											</div>
											<div class="buttons-to-right">
												<a href="#" class="button gray reject"><i class="ti-printer"></i> Receipt</a>
												<a href="#" class="button gray approve"><i class="ti-trash"></i> Cancel</a>
											</div>
										</li>
                                        <?php
										  }
										}
										}
										?>
									
										
									</ul>
								</div>
								
							</div>
						</div>
						
					</div>
				</div>
			</section>
			<!-- ============================ Dashboard End ================================== -->
@stop