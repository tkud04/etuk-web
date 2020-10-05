<?php
$title = "My Apartments";
$subtitle = "Manage everything about your apartments here";
?>
@extends('layout')

@section('title',$title)

@section('top-header')
@include('top-header')
@stop

@section('content')
@include('banner-2',['title' => $title,'subtitle' => $subtitle])

	<!-- ============================ My Apartments Start ================================== -->
			<section class="gray">
				<div class="container-fluid">
					<div class="row">
						
						@include('host-dashboard-sidebar',['user' => $user])
						
						<div class="col-lg-9 col-md-8 col-sm-12">
							<div class="dashboard-wrapers">
							
								<div class="dashboard-gravity-list mt-0">
									<h4>My Apartments <a href="{{url('add-apartment')}}" class="btn btn-success btn-sm">Post New Apartment</a></h4>
									<ul>
                                       <?php
									    if(count($apartments) > 0)
										{
										  foreach($apartments as $a)
										   {
											   $name = $a['name'];
											   $address = $a['address'];
											   $reviews = $a['reviews'];
											   $uu = url('my-apartment')."?xf=".$a['apartment_id'];
											   $du = url('delete-apartment')."?xf=".$a['apartment_id'];
											   
									   ?>
										<li>
											<div class="list-box-listing">
												<div class="list-box-listing-img"><a href="{{$uu}}"><img src="assets/img/destination/des-2.jpg" alt=""></a></div>
												<div class="list-box-listing-content">
													<div class="inner">
														<h3><a href="{{$uu}}">{{$name}}</a></h3>
														<span>{{$address['address'].", ".$address['city'].", ".$address['state']}}</span>
														<div class="star-rating">
															<div class="rating-counter">({{count($reviews)}} reviews)</div>
															<?php
															$rating = 8;
															
															 for($u = 0; $u < $rating; $u++)
															 {
															?>
															   <span class="ti-star"></span>
															<?php
															 }
															?>
															
															<?php
															 for($v = 0; $v < (5 - ($rating / 2)); $v++)
															 {
															?>
															   <span class="ti-star empty"></span>
															<?php
															 }
															?>
														</div>
													</div>
												</div>
											</div>
											<div class="buttons-to-right">
												<a href="{{$uu}}" class="button gray"><i class="ti-pencil"></i> Edit</a>
												<a href="{{$du}}" class="button gray"><i class="ti-trash"></i> Delete</a>
											</div>
										</li>
										<?php
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
			<!-- ============================ My Apartments End ================================== -->

@stop