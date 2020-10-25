<?php
$title = "Apartment Preferences";
$subtitle = "Edit your apartment preferences";

$checkoutHead = <<<EOD
                                <div class="checkout-head">
									<ul>
										<li class="apartment-preference-active-1 active"><span class="apartment-preference-ticker-1">1</span>Preferences</li>
										<li></li>
										<li class="apartment-preference-active-2"><span class="apartment-preference-ticker-2">2</span>Preview</li>
									</ul>
								</div>
EOD;

$def = [
  'city' => "",
  'state' => "none",
  'amount' => "0",
  'rating' => "4",
  'id_required' => "yes",
  'children' => "none",
  'pets' => "no",
  'max_adults' => "4",
  'max_children' => "0",
  'facilities' => []
];

if(count($apf) > 0) $def = $apf;
?>
@extends('layout')

@section('title',$title)

@section('top-header')
@include('top-header')
@stop

@section('content')
@include('banner-2',['title' => $title,'subtitle' => $subtitle])
<script>
let selectedSide = "1", facilities = [];

$(document).ready(() => {
$('#apartment-preference-loading').hide();

 <?php
	foreach($def['facilities'] as $ff)
	  {
  ?>
    toggleFacility("{{$ff['facility']}}");
  <?php
	  }
  ?>

});
</script>
<!-- =================== Apartment Preference Search ==================== -->
			<section class="gray">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<input type="hidden" id="tk-apf" value="{{csrf_token()}}">
							<input type="hidden" id="tk-axf" value="{{url('apartment-preferences')}}">
							<!-- Apartment Preference Step 1 -->
							<div class="checkout-wrap" id="apartment-preference-side-1">
								
								{!! $checkoutHead !!}
								
								<div class="checkout-body">
									<div class="row">
								
										<div class="col-lg-12 col-md-12 col-sm-12">
											<h4 class="mb-3">Basic Information</h4>
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>City<i class="req">*</i></label>
												<input type="text" class="form-control" value="{{$def['city']}}" id="apartment-preference-city" placeholder="City">
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>State<i class="req">*</i></label>
												<select class="form-control" id="apartment-preference-state">
												  <option value="none">Select state</option>
												  <?php
												   foreach($states as $key => $value)
												   {
													   $ss = $def['state'] == $key ? " selected='selected'" : "";
												  ?>
												    <option value="{{$key}}"{{$ss}}>{{$value}}</option>
												  <?php
												   }
												  ?>
												</select>
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>Price per day(&#8358;)<i class="req">*</i></label>
												<input type="number" class="form-control" value="{{$def['amount']}}" id="apartment-preference-amount" placeholder="Enter amount in NGN">
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>Rating<i class="req">*</i></label>
												<input type="number" class="form-control" value="{{$def['rating']}}" id="apartment-preference-rating" max=5 placeholder="Rating">
											</div>
										</div>
										
										
										
										
										<div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: 20px;">
											<h4 class="mb-3">Terms & Conditions</h4>
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>Payment Type<i class="req">*</i></label>
												<select class="form-control">
												  <option value="card">Card</option>
												</select>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>ID Required on Check-in<i class="req">*</i></label>
												<select class="form-control" id="apartment-preference-id-required">
												   <?php
												   $ir = ['yes' => "Yes",'no' => "No"];
												   foreach($ir as $key => $value)
												   {
													   $ss = $def['id_required'] == $key ? " selected='selected'" : "";
												  ?>
												    <option value="{{$key}}"{{$ss}}>{{$value}}</option>
												  <?php
												   }
												  ?>
												</select>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>Children<i class="req">*</i></label>
												<select class="form-control" id="apartment-preference-children">
												  <option value="none"></option>
												   <?php
												   $ic = ['none' => "No children allowed",
												          '1-5yrs' => "1-5yrs",
														  '6-10yrs' => "6-10yrs",
														  '11-20yrs' => "11-20yrs",
														  '>20yrs' => ">20yrs",
														  'all' => "All children allowed",
														 ];
												   foreach($ic as $key => $value)
												   {
													   $ss = $def['children'] == $key ? " selected='selected'" : "";
												  ?>
												    <option value="{{$key}}"{{$ss}}>{{$value}}</option>
												  <?php
												   }
												  ?>
												</select>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>Pets<i class="req">*</i></label>
												<select class="form-control" id="apartment-preference-pets">
												<option value="none"></option>
												<?php
												   $ipt = ['yes' => "Pets allowed",
														  'no' => "No pets allowed",
														 ];
												   foreach($ipt as $key => $value)
												   {
													   $ss = $def['pets'] == $key ? " selected='selected'" : "";
												  ?>
												    <option value="{{$key}}"{{$ss}}>{{$value}}</option>
												  <?php
												   }
												  ?>
												  </select>
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>Max. adults<i class="req">*</i></label>
												<input type="number" class="form-control" value="{{$def['max_adults']}}" id="apartment-preference-max-adults" placeholder="The max number of adults allowed to check-in" value="4">
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6 col-sm-12">
											<div class="form-group">
												<label>Max. children<i class="req">*</i></label>
												<input type="number" class="form-control" value="{{$def['max_children']}}" id="apartment-preference-max-children" placeholder="The max number of children allowed to check-in" value="0">
											</div>
										</div>
										
                                        <div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: 20px;">
											<h4 class="mb-3">Facilities & Services</h4>
										</div>										
										
										<div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom: 20px;">
											<div class="form-group">
											   
												<div class="row">
												 <?php
											        foreach($services as $s)
													{
														$key = $s['tag'];
														$value = $s['name'];
											      ?>
												  <div class="col-lg-3 col-md-6 col-sm-12">
												   
 												    <a class="btn btn-primary btn-sm text-white apt-service" id="apt-service-{{$key}}" onclick="toggleFacility('{{$key}}')" data-check="unchecked">
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
												<a href="javascript:void(0)" id="apartment-preference-side-1-next" class="btn btn-theme">Next</a>
											</div>
										</div>
										
									</div>
								</div>
								
							</div>
							<!-- End of Apartment Preference Step 1 -->
							
							
							<!-- Apartment Preference Step 2 -->
							<div class="checkout-wrap" id="apartment-preference-side-2">
								
								{!! $checkoutHead !!}
								
								<div class="checkout-body">
									
									
									<div class="row">
										<div class="col-md-12 col-lg-12">
										
											<ul class="booking-detail-list" id="apartment-preference-final-preview">
												
											</ul>
											<hr>
											
											<h4>Final Notes</h4>
											<p>Take a moment to preview the information about your apartment to ensure there are no errors or mistypes as your request will be reviewed by an admin. If you are sure all your information is correct click on <b>Submit</b> below. To make changes click on <b>Back</b>.</p>
											
										</div>
										
										<div class="col-lg-12 col-md-12 col-sm-12">
											<div class="form-group text-center" id="apartment-preference-submit">
												<a href="javascript:void(0)" id="apartment-preference-side-2-prev" class="btn btn-theme">Back</a>
												<a href="javascript:void(0)" id="apartment-preference-side-2-next" class="btn btn-theme">Submit</a>
											</div>
											<div class="form-group text-center" id="apartment-preference-loading">
												 <h4>Saving your preference.. <img src="{{asset('img/loading.gif')}}" class="img img-fluid" alt="Adding apartment.."></h4><br>
											</div>
										</div>
									</div>
								</div>
								
							</div>
							<!-- End of Apartment Preference Step 2 -->
							
							
						</div>
						<!-- Sidebar End -->
		
					</div>
				</div>
			</section>
			<!-- =================== Apartment Preference Search ==================== -->
@stop