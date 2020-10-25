<?php
$title = "Guest Dashboard";
$subtitle = "Manage your guest account here";
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
							
								
								<!-- Row -->
								<div class="row">
									<div class="col-lg-6 col-md-12">
										<div class="dashboard-gravity-list with-icons">
											<h4>Saved Payments</h4>
											<?php
											 if(count($sps) > 0)
											 {
											?>
											 <ul>
											<?php
											   foreach($sps as $s)
											   { 
											?>
												<li>
													<i class="dash-icon-box ti-layers"></i> Your booking <strong><a href="#">Shimla to Goa</a></strong> has been done!
													<a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
												</li>

											<?php
											 }
                                            ?>											 
											</ul>
											<?php
											 }
											 else
											 {
											?>
											<ul>
											<li>No payment methods added yet. Book an apartment to add one now.</li>
											</ul>
											<?php
											 }
											?>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-12">
										<div class="dashboard-gravity-list with-icons">
											<h4>Saved Apartments</h4>
											<?php
											 if(count($sapts) > 0)
											 {
												 $saptsLength = count($sapts) > 5 ? 5 : count($sapts);
											?>
											 <ul>
											<?php
											   for($i = 0; $i < $saptsLength; $i++)
											   { 
											   $sa = $sapts[$i];
											   $a = $sa['apartment'];
											   $au = url('apartment')."?xf=".$a['url'];
											   $title = $a['name'];
											   $cmedia = $a['cmedia'];
											   $imgs = $cmedia['images'];
											   $adata = $a['data'];
											   $address = $a['address'];
											   $location = $address['city'].", ".$address['state'];
											   $stars = $a['rating'];
											   $ratingClass = $stars > 3.5 ? "high" : "low";
											?>
												<li>
											   <i class="dash-icon-box ti-star"></i> <div class="numerical-rating {{$ratingClass}}" data-rating="{{$stars}}"></div> <strong><a href="{{$au}}" target="_blank">{{$title}}</a></strong> {{ucwords($location)}}
													<a href="javascript:void(0)" class="close-list-item"><i class="fa fa-close"></i></a>
												</li>

											<?php
											 }
                                            ?>											 
											</ul>
											<h4><center><a href="{{url('saved-apartments')}}" class="btn btn-theme">View more</a></center></h4>
											<?php
											 }
											 else
											 {
											?>
											<ul>
											<li>No apartments have been saved yet.</li>
											</ul>
											<?php
											 }
											?>
										</div>
									</div>	
								</div>
								
								<!-- Row -->
								<div class="row">
									<div class="col-lg-6 col-md-12">
										<div class="dashboard-gravity-list with-icons">
											<h4>Recent Activities</h4>
											<ul>
												<li>
													<i class="dash-icon-box ti-layers"></i> Your booking <strong><a href="#">Shimla to Goa</a></strong> has been done!
													<a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
												</li>

												<li>
													<i class="dash-icon-box ti-star"></i> Jodie Farrell left a review <div class="numerical-rating high" data-rating="5.0"></div> on <strong><a href="#">Burger Villa</a></strong>
													<a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
												</li>

												<li>
													<i class="dash-icon-box ti-heart"></i> your payment is pending for <strong><a href="#">Manali Trip</a></strong> tour!
													<a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
												</li>

												<li>
													<i class="dash-icon-box ti-star"></i> You have calceled <a href="#">Mumbai Trip</a> approved</strong>
													<a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
												</li>

												<li>
													<i class="dash-icon-box ti-heart"></i> Someone reply on your comment on <strong><a href="#">London Trip</a></strong> Tour!
													<a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
												</li>

												<li>
													<i class="dash-icon-box ti-star"></i> You have give a review <div class="numerical-rating high" data-rating="4.7"></div> on <strong><a href="#">Preet House</a></strong>
													<a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
												</li>

												<li>
													<i class="dash-icon-box ti-star"></i>You have give a review <div class="numerical-rating low" data-rating="2.8"></div> on <strong><a href="#">Shimla Trou Trip</a></strong>
													<a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
												</li>
											</ul>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-12">
										<div class="dashboard-gravity-list invoices with-icons">
											<h4>Recent Bookings</h4>
											<ul>
												<?php
												if(count($orders) > 0)
												{
												  $ordersLength = count($orders) > 5 ? 5 : count($orders);
												 for($i = 0; $i < $ordersLength; $i++)
												 {
													 $o = $ordersLength[$i];
													 $ref = $o['reference'];
													 
													 $s = ""; $liClass = ""; $ps = "";
										  
										  if($o['status'] == "paid")
										  {
											  $liClass = "paid";
											  $s = "Active";									
										  }
										  else if($o['status'] == "expired")
										  {
											  $liClass = "paid";
											  $s = "Expired";
										  }
										  else if($o['status'] == "cancelled")
										  {
											  $liClass = "unpaid";
											  $s = "Cancelled";
										  }
										  
										  $items = $o['items'];
										  $ii = $items['data'];
										  $ru = url('receipt')."?xf=".$ref;
												?>
												<li><i class="dash-icon-box ti-files"></i>
													<strong>Order #</strong>
													<ul>
														<li class="{{$liClass}}">{{$s}}</li>
														<li>Reference #: {{$ref}}</li>
														<li>Date: {{$o['date']}}</li>
													</ul>
													<div class="buttons-to-right">
														<a href="{{ru}}" class="button gray">View Receipt</a>
													</div>
												</li>
												<?php
												 }
												 ?>
												 <h4><center><a href="{{url('bookings')}}" class="btn btn-theme">View more</a></center></h4>
												 <?php
												}
												 else
												 {
												?>
										
												<li><i class="dash-icon-box ti-files"></i>
													<strong>No orders yet</strong>
													
												</li>
                                                <?php
												 }
												?>
											</ul>
										</div>
									</div>	
								</div>
								
							</div>
						</div>
						
					</div>
				</div>
			</section>
			<!-- ============================ Dashboard End ================================== -->

@stop