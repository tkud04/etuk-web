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
																	<th>S. No.</th>
																	<th>Name</th>
																	<th>Duration</th>
																	<th>Charges</th>
																	<th>Sub Total</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td>1</td>
																	<td>Manali to Goa</td>
																	<td>5 days</td>
																	<td>622 USD</td>
																	<td>547 USD</td>
																</tr>
																<tr>
																	<td>2</td>
																	<td>Paris to London</td>
																	<td>4 Days</td>
																	<td>658 USD</td>
																	<td>325 USD</td>
																</tr>
															</tbody>
														</table>
													</div>
													<hr>
													<div>
														<p>Total : 700 USD </p>
													</div>
													<hr>
													<div>
														<p>Taxes : 220 USD ( 20 % on Total Bill ) </p>
													</div>
													<hr>
													<div>
														<p>GST : 220 USD ( 20 % on Total Bill ) </p>
													</div>
													<hr>
													<div>
														<h4>Bill Amount : 920 USD </h4>
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
								<h4>Booking Detail</h4>
								<div class="booking-bio">
									<ul>
										<li><strong>Booking Number:</strong>BK12354685</li>
										<li><strong>Booking Date</strong>20 May 2020</li>
										<li><strong>Reference ID:</strong>Re4584756</li>
										<li><strong>Check In</strong>22 May 2020</li>
										<li><strong>Check Out</strong>27 May 2020</li>
									</ul>
								</div>
								
								<h4>Member Detail</h4>
								<div class="booking-bio">
									<ul>
										<li><strong>Days:</strong>5 Days</li>
										<li><strong>Adults</strong>4 mem</li>
										<li><strong>Child:</strong>2 mem</li>
										<li><strong>Contact:</strong>91 123 458 4758</li>
									</ul>
								</div>
							</div>							
						</div>
					</div>
				</div>
			</section>
			<!-- =================== Sidebar Search ==================== -->
@stop