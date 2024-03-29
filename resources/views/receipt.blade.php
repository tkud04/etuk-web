<?php
$title = "Receipt";
$subtitle = "Receipt for order #".$order['reference'];
$noFooter = true;
?>
@extends('layout')

@section('title',$title)


@section('content')
<!-- =================== Sidebar Search ==================== -->
			<section class="gray">
				<div class="container">
					<div class="row">
						<div class="col-lg-9 col-md-8">
							<div class="tr-single-box">
								<div class="tr-single-header">
									<h5 class="dashboard-title">View Invoice</h5>
								</div>
								<div class="tr-single-body">
										
									<div class="detail-wrapper padd-top-30 padd-bot-30">
							
										<div class="row text-center mb-4">
											<div class="col-md-12">
												<a href="javascript:window.print()" class="btn btn-theme">Print this receipt</a>
											</div>
										</div>
										
										<div class="row mrg-0">
											<div class="col-md-6">
												<div id="logo"><img src="assets/img/logo.png" class="img-fluid" alt=""></div>
											</div>

											<div class="col-md-6">	
												<p id="invoice-info">
													<strong>Order:</strong> #{{$order['reference']}} <br>
													<strong>Issued:</strong> {{$order['date']}} <br>
													
												</p>
											</div>
											
										</div>
										
										<div class="row  mrg-0 detail-invoice">
										
											<div class="col-md-12">
												<h2>RECEIPT</h2>
											</div>
											
											<div class="col-md-12">
												<div class="row">
												  <div class="col-lg-7 col-md-7 col-sm-7">
												  
													<h4>Etuk NG: </h4>
													<p>
														billing@etuk.ng<br>
														
														+234 801 234 5678<br>
														
														Victoria Island, Lagos
													</p>
													
												  </div>
												  <div class="col-lg-5 col-md-5 col-sm-5">
													<h4>Guest:</h4>
													<h6>{{$user->fname." ".$user->lname}}</h6>
													<p>
													   {{$user->email}}<br>
														
														{{$user->phone}}<br>
														
													</p>
												  </div>
												</div>
											</div>
											<hr>
											
											<div class="col-12 col-md-12">
												<strong>ITEM DESCRIPTION &amp; DETAILS :</strong>
											</div>
											<hr>
											
											<div class="col-lg-12 col-md-12 col-sm-12">
												<div class="invoice-table">
													<div class="table-responsive">
														<table class="table table-striped table-bordered">
															<thead>
																<tr>
																	<th>Status</th>
																	<th>Apartment</th>
																	<th>Duration</th>
																	<th>Price per day</th>
																	<th>Total charge</th>
																</tr>
															</thead>
															<tbody>
															<?php
															$items = $order['items'];
										  $ii = $items['data'];
										  $subtotal = $items['subtotal'];
										  
										  foreach($ii as $i)
										  {
											 
														 $apartment = $i['apartment'];
														 $au = $apartment['url'];
														 $cmedia = $apartment['cmedia'];
														 $imgs = $cmedia['images'];
														 $adata = $apartment['data'];
														 $terms = $apartment['terms'];
														 $host = $apartment['host'];
														 $hostName = $host['fname']." ".substr($host['lname'],0,1).".";
														 $amount = $adata['amount'];
														 $address = $apartment['address'];
														 $location = $address['city'].", ".$address['state'];
														 $checkin = $i['checkin'];
														 $checkout = $i['checkout'];
														 
														 $c1 = new DateTime($checkin);
														 $c2 = new DateTime($checkout);
														 $cdiff = $c1->diff($c2);
														 $duration = $cdiff->format("%r%a");
														 $dtt = $duration == 1 ? "night" : "nights";
														 
														 $is = $i['status']; $s = "";
											  
										  if($is == "")
										  {
											  $s = "Paid";									
										  }
										  else if($is == "booked")
										  {
											  $s = "Booked";
										  }
										  else if($is == "cancelled")
										  {
											  $s = "Cancelled";
										  }
														 
														 
															?>
																<tr>
																  <td><b>{{strtoupper($s)}}</b></td>
																	<td>
																	  <div class="row">
																	    <div class="col-md-5">
																		  <img src="{{$imgs[0]}}" alt="{{$apartment['name']}}" style="width: 100px; height: 100px;"/>
																		</div>
																	    <div class="col-md-7">
																		  <h4>{{$apartment['name']}}</h4>
																		  <h6>{{$location}}</h6>
																		</div>
																	  </div>
																	</td>
																	<td>{{$duration." ".$dtt}}</td>
																	<td>&#8358;{{number_format($amount,2)}}</td>
																	<td>&#8358;{{number_format($amount * $duration,2)}}</td>
																</tr>
															<?php
										  }
															?>
															</tbody>
														</table>
													</div>
													<hr>
													<div>
														<p>Subtotal : &#8358;{{number_format($subtotal,2)}} </p>
													</div>
													<hr>
													<div>
														<p>Taxes : &#8358;1,000.00 ( 20 % on Total Bill ) </p>
													</div>
													<hr>
													<div>
														<h4>Total : &#8358;{{number_format($order['amount'],2)}} </h4>
													</div>
												</div>
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>
						
						<div class="col-lg-3 col-md-4">
							<div class="invoice-vew-detail">
								
								<?php
								 foreach($ii as $i)
								 {
									  $apartment = $i['apartment'];
														 $au = $apartment['url'];
														 $cmedia = $apartment['cmedia'];
														 $imgs = $cmedia['images'];
														 $adata = $apartment['data'];
														 $terms = $apartment['terms'];
														 $host = $apartment['host'];
														 $hostName = $host['fname']." ".substr($host['lname'],0,1).".";
														 $amount = $adata['amount'];
														 $address = $apartment['address'];
														 $location = $address['city'].", ".$address['state'];
														 $checkin = $i['checkin'];
														 $checkout = $i['checkout'];
														 
														 $c1 = new DateTime($checkin);
														 $c2 = new DateTime($checkout);
														 $cdiff = $c1->diff($c2);
														 $duration = $cdiff->format("%r%a");
														 $dtt = $duration == 1 ? "night" : "nights";
								?>
								<h4>{{$apartment['name']}}</h4>
								<div class="booking-bio">
									<ul>
										<li><strong>Booking Date</strong>{{$order['date']}}</li>
										<li><strong>Check In</strong>{{$checkin}}</li>
										<li><strong>Check Out</strong>{{$checkout}}</li>
										<li><strong>Guests</strong>{{$i['guests']}}</li>
										<li><strong>Kids</strong>{{$i['kids']}}</li>
										<li><strong>Host</strong>{{$hostName}}</li>
									</ul>
								</div>
								<hr>
								<?php
								 }
								?>
							</div>							
						</div>
					</div>
				</div>
			</section>
			<!-- =================== Sidebar Search ==================== -->
@stop