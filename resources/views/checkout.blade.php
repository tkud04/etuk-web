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

<!-- ============================ Checkout Start ================================== -->
			<section>
				<div class="container">
				
					<div class="row mb-4">
						
						<div class="col-lg-4 col-md-4">
							<div class="contact-box">
								<i class="ti-map-alt"></i>
								<h4>Head Offices</h4>
								810 Clis Road,<br>
								Indraprash NW11 0PU, India
							</div>
						</div>
						
						<div class="col-lg-4 col-md-4">
							<div class="contact-box">
								<i class="ti-email"></i>
								<h4>Drop a Mail</h4>
								virasat@gmail.com<br>
								my.virasat@gmail.com
							</div>
						</div>
						
						<div class="col-lg-4 col-md-4">
							<div class="contact-box">
								<i class="ti-headphone"></i>
								<h4>Call Us</h4>
								91+ 123 456 9857<br>
								91+ 258 548 5426
							</div>
						</div>
						
					</div>
					
					<div class="row mt-5 row align-items-center">
						
						<div class="col-lg-7 col-md-7">
							<div class="contact-form">
								<form>
									<div class="row">
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
											  <label>Name</label>
											  <input type="email" class="form-control" placeholder="Name">
											</div>
										</div>
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
											  <label>Email</label>
											  <input type="email" class="form-control" placeholder="Email">
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-lg-12 col-md-12">
											<div class="form-group">
												<label>Subject</label>
												<input type="text" class="form-control" placeholder="Subject">
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-lg-12 col-md-12">
											<div class="form-group">
												<label>Message</label>
												<textarea class="form-control" placeholder="Type Here..."></textarea>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-lg-12 col-md-12">
											<button type="submit" class="btn btn-primary">Send Request</button>
										</div>
									</div>
								</form>
							</div>
						</div>
						
						<div class="col-lg-5 col-md-5">
							<div class="row">
							  <div class="col-lg-12 col-md-12">
							   <h3>{{count($cartt)}} {{$ii}}</h3>
							   <p>Subtotal: &#8358;<span></span></p>
							  </div>
							</div>
						</div>
					</div>
					
				</div>
			</section>
			<div class="clearfix"></div>
			<!-- ============================ Checkout End ================================== -->
@stop