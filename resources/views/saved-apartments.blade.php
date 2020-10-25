<?php
$title = "Saved Apartments";
$subtitle = "List of your bookmarked apartments";
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
						
						@include('guest-dashboard-sidebar',['user' => $user])
						
						<div class="col-lg-9 col-md-8 col-sm-12">
							<div class="dashboard-wrapers">
							
								<div class="dashboard-gravity-list mt-0">
									<h4>Saved Apartments</h4>
									<ul>
                                       <?php
									    if(count($sapts) > 0)
										{
										  foreach($sapts as $sapt)
										   {
											   $a = $sapt['apartment'];
											   $name = $a['name'];
											   $address = $a['address'];
											   $reviews = $a['reviews'];
											   $uu = url('apartment')."?xf=".$a['url'];
											   $du = url('remove-saved-apartment')."?xf=".$a['id'];
											   
											   $imgs = $a['cmedia']['images'];
											   
									   ?>
										<li>
											<div class="list-box-listing">
												<div class="list-box-listing-img"><a href="{{$uu}}"><img src="{{$imgs[0]}}" alt="{{$name}}" style="width: 150px; height: 150px;"></a></div>
												<div class="list-box-listing-content">
													<div class="inner">
														<h3><a href="{{$uu}}">{{$name}}</a></h3>
														<span>{{$address['address'].", ".$address['city'].", ".$address['state']}}</span>
														<div class="star-rating">
															<div class="rating-counter">({{count($reviews)}} reviews)</div>
															<?php
															$rating = 8; $stars = $rating / 2;
															
															 for($u = 0; $u < $stars; $u++)
															 {
															?>
															   <span class="ti-star"></span>
															<?php
															 }
															?>
															
															<?php
															 for($v = 0; $v < (5 - $stars); $v++)
															 {
															?>
															   <span class="ti-star empty"></span>
															<?php
															 }
															?>
														</div>
														<h4>Saved: <em>{{$sapt['date']}}</em></h4>
													</div>
												</div>
											</div>
											<div class="buttons-to-right">
												<a href="{{$du}}" class="button gray"><i class="ti-trash"></i> Remove</a>
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