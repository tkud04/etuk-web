<?php
$title = "My Apartments";
$subtitle = "Manage everything about your apartments here";
?>


<?php $__env->startSection('title',$title); ?>

<?php $__env->startSection('top-header'); ?>
<?php echo $__env->make('top-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('banner-2',['title' => $title,'subtitle' => $subtitle], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<!-- ============================ Dashboard Start ================================== -->
			<section class="gray">
				<div class="container-fluid">
					<div class="row">
						
						<?php echo $__env->make('host-dashboard-sidebar',['user' => $user], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						
						<div class="col-lg-9 col-md-8 col-sm-12">
							<div class="dashboard-wrapers">
							
								<div class="dashboard-gravity-list mt-0">
									<h4>Saved Listings</h4>
									<ul>

										<li>
											<div class="list-box-listing">
												<div class="list-box-listing-img"><a href="#"><img src="assets/img/destination/des-2.jpg" alt=""></a></div>
												<div class="list-box-listing-content">
													<div class="inner">
														<h3><a href="#">Castle Palace</a></h3>
														<span>964 Seek Velly, Canada</span>
														<div class="star-rating">
															<div class="rating-counter">(10 reviews)</div>
														<span class="ti-star"></span><span class="ti-star"></span><span class="ti-star"></span><span class="ti-star"></span><span class="ti-star empty"></span></div>
													</div>
												</div>
											</div>
											<div class="buttons-to-right">
												<a href="#" class="button gray"><i class="ti-pencil"></i> Edit</a>
												<a href="#" class="button gray"><i class="ti-trash"></i> Delete</a>
											</div>
										</li>
										
										<li>
											<div class="list-box-listing">
												<div class="list-box-listing-img"><a href="#"><img src="assets/img/destination/des-4.jpg" alt=""></a></div>
												<div class="list-box-listing-content">
													<div class="inner">
														<h3><a href="#">Tom's Beauty Spa</a></h3>
														<span>964 Rim Street, New York</span>
														<div class="star-rating">
															<div class="rating-counter">(07 reviews)</div>
														<span class="ti-star"></span><span class="ti-star"></span><span class="ti-star"></span><span class="ti-star"></span><span class="ti-star empty"></span></div>
													</div>
												</div>
											</div>
											<div class="buttons-to-right">
												<a href="#" class="button gray"><i class="ti-pencil"></i> Edit</a>
												<a href="#" class="button gray"><i class="ti-trash"></i> Delete</a>
											</div>
										</li>
										
										<li>
											<div class="list-box-listing">
												<div class="list-box-listing-img"><a href="#"><img src="assets/img/destination/des-5.jpg" alt=""></a></div>
												<div class="list-box-listing-content">
													<div class="inner">
														<h3><a href="#">Sweet Restaurants</a></h3>
														<span>Seek Velly, New York</span>
														<div class="star-rating">
															<div class="rating-counter">(12 reviews)</div>
														<span class="ti-star"></span><span class="ti-star"></span><span class="ti-star"></span><span class="ti-star"></span><span class="ti-star empty"></span></div>
													</div>
												</div>
											</div>
											<div class="buttons-to-right">
												<a href="#" class="button gray"><i class="ti-pencil"></i> Edit</a>
												<a href="#" class="button gray"><i class="ti-trash"></i> Delete</a>
											</div>
										</li>
										
										<li>
											<div class="list-box-listing">
												<div class="list-box-listing-img"><a href="#"><img src="assets/img/destination/des-8.jpg" alt=""></a></div>
												<div class="list-box-listing-content">
													<div class="inner">
														<h3><a href="#">Veero Weddings & Events</a></h3>
														<span>507 School Street, Austria</span>
														<div class="star-rating">
															<div class="rating-counter">(14 reviews)</div>
														<span class="ti-star"></span><span class="ti-star"></span><span class="ti-star"></span><span class="ti-star"></span><span class="ti-star empty"></span></div>
													</div>
												</div>
											</div>
											<div class="buttons-to-right">
												<a href="#" class="button gray"><i class="ti-pencil"></i> Edit</a>
												<a href="#" class="button gray"><i class="ti-trash"></i> Delete</a>
											</div>
										</li>
										
										<li>
											<div class="list-box-listing">
												<div class="list-box-listing-img"><a href="#"><img src="assets/img/destination/des-8.jpg" alt=""></a></div>
												<div class="list-box-listing-content">
													<div class="inner">
														<h3><a href="#">Hilly Salon</a></h3>
														<span>702 Beez Market, London</span>
														<div class="star-rating">
															<div class="rating-counter">(17 reviews)</div>
														<span class="ti-star"></span><span class="ti-star"></span><span class="ti-star"></span><span class="ti-star"></span><span class="ti-star empty"></span></div>
													</div>
												</div>
											</div>
											<div class="buttons-to-right">
												<a href="#" class="button gray"><i class="ti-pencil"></i> Edit</a>
												<a href="#" class="button gray"><i class="ti-trash"></i> Delete</a>
											</div>
										</li>
										
										<li>
											<div class="list-box-listing">
												<div class="list-box-listing-img"><a href="#"><img src="assets/img/destination/des-3.jpg" alt=""></a></div>
												<div class="list-box-listing-content">
													<div class="inner">
														<h3><a href="#">Dan's Wedding Events</a></h3>
														<span>102 Shic School, Canada</span>
														<div class="star-rating">
															<div class="rating-counter">(12 reviews)</div>
														<span class="ti-star"></span><span class="ti-star"></span><span class="ti-star"></span><span class="ti-star"></span><span class="ti-star empty"></span></div>
													</div>
												</div>
											</div>
											<div class="buttons-to-right">
												<a href="#" class="button gray"><i class="ti-pencil"></i> Edit</a>
												<a href="#" class="button gray"><i class="ti-trash"></i> Delete</a>
											</div>
										</li>


									</ul>
								</div>
								
							</div>
						</div>
						
					</div>
				</div>
			</section>
			<!-- ============================ Dashboard End ================================== -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\etuk-web\resources\views/my-apartments.blade.php ENDPATH**/ ?>