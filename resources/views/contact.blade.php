<?php
$title = "Contact Us";
$subtitle = "We'd like to hear from you";
?>
@extends('layout')

@section('title',"Contact Us")

@section('top-header')
@include('top-header')
@stop

@section('content')
@include('banner-2',['title' => $title,'subtitle' => $subtitle])

	<!-- ============================ Page Title End ================================== -->
			
			<!-- ============================ Who We Are Start ================================== -->
			<section>
				<div class="container">
				
					<div class="row mb-4">
						
						<div class="col-lg-12 col-md-12">
							<div class="contact-box">
								<i class="ti-map-alt"></i>
								<h4>Head Office</h4>
								Abuja,<br>
								Nigeria
							</div>
						</div>
						
						<?php
								$contacts = [
								  ['name' => "Olajide Tayo",'designation' => "Administrative/IT",'phone' => "08057318627", 'email' => "tayo.olajide@etuk.ng"],
								  ['name' => "Paul Adejoh",'designation' => "Sales & Marketing",'phone' => "07019982345", 'email' => "adejoh.paul@etuk.ng"],
								  ['name' => "Oje Adesola",'designation' => "Customer & Communications Officer",'phone' => "08168923876", 'email' => "adesola.oje@etuk.ng"],
								];
								
								foreach($contacts as $ct)
								{
								?>
						    <div class="col-lg-4 col-md-4">
							<div class="contact-box">
								
								
								<h4>{{$ct['designation']}}</h4>
								{{$ct['name']}}<br>
								<i class="ti-email"></i> <a style="margin-bottom: 10px;" href="mailto:{{$ct['email']}}">{{$ct['email']}}</a><br>
								<i class="ti-headphone"></i> <a style="margin-bottom: 10px;" href="tel:{{$ct['phone']}}">{{$ct['phone']}}</a>
							</div>
						</div>
						  <?php
								}
						  ?>
						
						
					</div>
					
					<div class="row mt-5 row align-items-center">
						
						<div class="col-lg-5 col-md-5">
							<img src="assets/img/about.png" class="img-fluid" alt="" />
						</div>
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
						
					</div>
					
				</div>
			</section>
			<div class="clearfix"></div>
			<!-- ============================ Who We Are End ================================== -->

@stop