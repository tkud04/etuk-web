<?php
$title = "My Bookings";
$subtitle = "List of bookings made by you";
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
						
						<?php echo $__env->make('guest-dashboard-sidebar',['user' => $user], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						
						<div class="col-lg-9 col-md-8 col-sm-12">
							<div class="dashboard-wrapers">
							
								<div class="dashboard-gravity-list">

									<h4><?php echo e($title); ?></h4>
									<ul>
                                       <?php
									   if(count($orders) > 0)
									   {
									    foreach($orders as $o)
										{
										  $ref = $o['reference'];
										  $s = ""; $liClass = ""; $ps = "";
										  
										  if($o['status'] == "paid")
										  {
											  $liClass = "approved-booking";
											  $s = "Active";									
										  }
										  else if($o['status'] == "expired")
										  {
											  $liClass = "pending-booking";
											  $s = "Expired";
											  $ps = " pending";
										  }
										  else if($o['status'] == "cancelled")
										  {
											  $liClass = "canceled-booking";
											  $s = "Cancelled";
										  }
										  
										  $items = $o['items'];
										  $ii = $items['data'];
										  
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
											  
									   ?>
										<li class="<?php echo e($liClass); ?>">
											<div class="list-box-listing bookings">
												<div class="list-box-listing-img"><img src="<?php echo e($imgs[0]); ?>" alt="<?php echo e($apartment['name']); ?>"></div>
												<div class="list-box-listing-content">
													<div class="inner">
														<h3><?php echo e($apartment['name']); ?> <span class="booking-status<?php echo e($ps); ?>"><?php echo e($s); ?></span></h3>

														<div class="inner-booking-list">
															<h5>Booking Date:</h5>
															<ul class="booking-list">
																<li class="highlighted"><?php echo e($checkin); ?> - <?php echo e($checkout); ?></li>
															</ul>
														</div>
																	
														<div class="inner-booking-list">
															<h5>Booking Details:</h5>
															<ul class="booking-list">
																<li class="highlighted"><?php echo e($i['guests']); ?> Adults | <?php echo e($i['kids']); ?> Kids</li>
															</ul>
														</div>		
																	
														<div class="inner-booking-list">
															<h5>Price:</h5>
															<ul class="booking-list">
																<li class="highlighted">&#8358;<?php echo e(number_format($amount,2)); ?></li>
															</ul>
														</div>		

														<div class="inner-booking-list">
															<h5>Host:</h5>
															<ul class="booking-list">
																<li><?php echo e($hostName); ?></li>
															</ul>
														</div>

														<a href="#small-dialog" class="rate-review"><i class="ti-email"></i> Send Message</a>

													</div>
												</div>
											</div>
											<div class="buttons-to-right">
												<a href="#" class="button gray reject"><i class="ti-printer"></i> Receipt</a>
												<a href="#" class="button gray approve"><i class="ti-trash"></i> Cancel</a>
											</div>
										</li>
                                        <?php
										  }
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
			<!-- ============================ Dashboard End ================================== -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\etuk-web\resources\views/orders.blade.php ENDPATH**/ ?>