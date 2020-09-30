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

	<!-- ============================ My Apartments Start ================================== -->
			<section class="gray">
				<div class="container-fluid">
					<div class="row">
						
						<?php echo $__env->make('host-dashboard-sidebar',['user' => $user], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						
						<div class="col-lg-9 col-md-8 col-sm-12">
							<div class="dashboard-wrapers">
							
								<div class="dashboard-gravity-list mt-0">
									<h4>My Apartments | <a href="<?php echo e(url('add-apartment')); ?>">Post New Apartment</a></h4>
									<ul>
                                       <?php
									    if(count($apartments) > 0)
										{
										  foreach($apartments as $a)
										   {
									   ?>
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\etuk-web\resources\views/my-apartments.blade.php ENDPATH**/ ?>