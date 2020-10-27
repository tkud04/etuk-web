<?php
$title = "My Bookings";
$subtitle = "List of bookings made by you";
$noFooter = true;
?>


<?php $__env->startSection('title',$title); ?>


<?php $__env->startSection('content'); ?>
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
												<a href="javascript:window.print()" class="btn btn-theme">Print this invoice</a>
											</div>
										</div>
										
										<div class="row mrg-0">
											<div class="col-md-6">
												<div id="logo"><img src="assets/img/logo.png" class="img-fluid" alt=""></div>
											</div>

											<div class="col-md-6">	
												<p id="invoice-info">
													<strong>Order:</strong> #7075872 <br>
													<strong>Issued:</strong> 17/10/2017 <br>
													Due 7 days from date of issue
												</p>
											</div>
											
										</div>
										
										<div class="row  mrg-0 detail-invoice">
										
											<div class="col-md-12">
												<h2>INVOICE</h2>
											</div>
											
											<div class="col-md-12">
												<div class="row">
												  <div class="col-lg-7 col-md-7 col-sm-7">
												  
													<h4>Supplier: </h4>
													<h6>Glovia Ltd</h6>
													<p>
														info@glovia.com<br>
														
														+91-587-936-5876<br>
														
														780/77 , Lane Here, Chandigarh,
														<br> India
													</p>
													
												  </div>
												  <div class="col-lg-5 col-md-5 col-sm-5">
													<h4>Client Contact :</h4>
													<h6>Saurav Singh</h6>
													<p>
														sauravmail87@gmail.com<br>
														
														+91-587-936-5876<br>
														
														780/77 , Gurudwara Chauk, Allahabad,
														<br> India
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\etuk-web\resources\views/receipt.blade.php ENDPATH**/ ?>