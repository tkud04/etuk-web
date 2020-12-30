<?php
$title = "Plans";
$subtitle = "Our subscription plans";
?>
@extends('layout')

@section('title',$title)

@section('top-header')
@include('top-header')
@stop

@section('content')
@include('banner-2',['title' => $title,'subtitle' => $subtitle,'banner' => $banner])

<section class="min">
				<div class="container">
				
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="sec-heading center">
								<p>Host Subscription plans</p>
								<h2>View our packages</h2>
							</div>
						</div>
					</div>
					
					<div class="row">
						
						<!-- Single Tour Package -->
						<div class="col-lg-6 col-md-12 col-sm-12">
							<div class="tour-verticle">
							
								<div class="tour-verticle-thumb">
									<span class="theme-bg tv-cate"><i class="ti-car"></i></span>
									<img src="assets/img/destination/pac-3.jpg" class="img-responsive" alt="">
								</div>
								
								<div class="tour-verticle-caption">
									<div class="tv-date"><i class="ti-calendar"></i>27 Fab</div>
									<h4 class="tv-title"><a href="tour-detail.html">Machu Picchu, Peru</a></h4>
									<p>It's the 7 person trip in the green city in South Africa</p>
									<div class="tv-price-box">
										<a href="tour-detail.html" class="tv-btn btn-theme">Get Details</a>
										<h3 class="tv-price-title">$572</h3>
									</div>
								</div>
								
							</div>
						</div>
						
						<!-- Single Tour Package -->
						<div class="col-lg-6 col-md-12 col-sm-12">
							<div class="tour-verticle">
							
								<div class="tour-verticle-thumb">
									<span class="theme-bg tv-cate"><i class="ti-car"></i></span>
									<img src="assets/img/destination/pac-4.jpg" class="img-responsive" alt="">
								</div>
								
								<div class="tour-verticle-caption">
									<div class="tv-date"><i class="ti-calendar"></i>10 Fab</div>
									<h4 class="tv-title"><a href="tour-detail.html">The Great Barrier Reef</a></h4>
									<p>It's the 7 person trip in the green city in South Africa</p>
									<div class="tv-price-box">
										<a href="tour-detail.html" class="tv-btn btn-theme">Get Details</a>
										<h3 class="tv-price-title">$950</h3>
									</div>
								</div>
								
							</div>
						</div>
						
						<!-- Single Tour Package -->
						<div class="col-lg-6 col-md-12 col-sm-12">
							<div class="tour-verticle">
							
								<div class="tour-verticle-thumb">
									<span class="theme-bg tv-cate"><i class="ti-car"></i></span>
									<img src="assets/img/destination/pac-5.jpg" class="img-responsive" alt="">
								</div>
								
								<div class="tour-verticle-caption">
									<div class="tv-date"><i class="ti-calendar"></i>17 Fab</div>
									<h4 class="tv-title"><a href="tour-detail.html">British Virgin Islands</a></h4>
									<p>It's the 7 person trip in the green city in South Africa</p>
									<div class="tv-price-box">
										<a href="tour-detail.html" class="tv-btn btn-theme">Get Details</a>
										<h3 class="tv-price-title">$1200</h3>
									</div>
								</div>
								
							</div>
						</div>
						
						<!-- Single Tour Package -->
						<div class="col-lg-6 col-md-12 col-sm-12">
							<div class="tour-verticle">
							
								<div class="tour-verticle-thumb">
									<span class="theme-bg tv-cate"><i class="ti-car"></i></span>
									<img src="assets/img/destination/pac-6.jpg" class="img-responsive" alt="">
								</div>
								
								<div class="tour-verticle-caption">
									<div class="tv-date"><i class="ti-calendar"></i>27 Fab</div>
									<h4 class="tv-title"><a href="tour-detail.html">Pyramids of Giza, Egypt</a></h4>
									<p>It's the 7 person trip in the green city in South Africa</p>
									<div class="tv-price-box">
										<a href="tour-detail.html" class="tv-btn btn-theme">Get Details</a>
										<h3 class="tv-price-title">$1050</h3>
									</div>
								</div>
								
							</div>
						</div>
						
						<!-- Single Tour Package -->
						<div class="col-lg-6 col-md-12 col-sm-12">
							<div class="tour-verticle">
							
								<div class="tour-verticle-thumb">
									<span class="theme-bg tv-cate"><i class="ti-car"></i></span>
									<img src="assets/img/destination/pac-7.jpg" class="img-responsive" alt="">
								</div>
								
								<div class="tour-verticle-caption">
									<div class="tv-date"><i class="ti-calendar"></i>27 Fab</div>
									<h4 class="tv-title"><a href="tour-detail.html">The heritage of England</a></h4>
									<p>It's the 7 person trip in the green city in South Africa</p>
									<div class="tv-price-box">
										<a href="tour-detail.html" class="tv-btn btn-theme">Get Details</a>
										<h3 class="tv-price-title">$872</h3>
									</div>
								</div>
								
							</div>
						</div>
						
						<!-- Single Tour Package -->
						<div class="col-lg-6 col-md-12 col-sm-12">
							<div class="tour-verticle">
							
								<div class="tour-verticle-thumb">
									<span class="theme-bg tv-cate"><i class="ti-car"></i></span>
									<img src="assets/img/destination/pac-8.jpg" class="img-responsive" alt="">
								</div>
								
								<div class="tour-verticle-caption">
									<div class="tv-date"><i class="ti-calendar"></i>27 Fab</div>
									<h4 class="tv-title"><a href="tour-detail.html">The City of Lights </a></h4>
									<p>It's the 7 person trip in the green city in South Africa</p>
									<div class="tv-price-box">
										<a href="tour-detail.html" class="tv-btn btn-theme">Get Details</a>
										<h3 class="tv-price-title">$1050</h3>
									</div>
								</div>
								
							</div>
						</div>
						
					</div>
				
				</div>
			</section>
@stop
