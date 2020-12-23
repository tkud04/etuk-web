<?php
$title = "My Reservations";
$subtitle = "List of your apartment reservations";
?>


<?php $__env->startSection('title',$title); ?>

<?php $__env->startSection('top-header'); ?>
<?php echo $__env->make('top-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('banner-2',['title' => $title,'subtitle' => $subtitle], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<!-- ============================ My Reservations Start ================================== -->
			<section class="gray">
				<div class="container-fluid">
					<div class="row">
						<?php
						if($user == null)
						{
							$cx = "col-lg-12 col-md-12 col-sm-12";
						}
						else
						{
						  $cx = "col-lg-9 col-md-8 col-sm-12";
						  $mode = $user->mode;
						  
						  if($mode == "guest") $sb = "guest-dashboard-sidebar"; 
						  else if($mode == "host") $sb = "host-dashboard-sidebar"; 
						?>
						  <?php echo $__env->make($sb,['user' => $user], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						<?php
						}
						?>
						<div class="<?php echo e($cx); ?>">
							<div class="dashboard-wrapers">
							
								<div class="dashboard-gravity-list mt-0">
									<h4>My Reservations</h4>
									<ul>
                                       <?php
									    if(count($reservations) > 0)
										{
										  foreach($reservations as $r)
										   {
											   $a = $r['apartment'];
											   $name = $a['name'];
											   $address = $a['address'];
											   $reviews = $a['reviews'];
											   $uu = url('apartment')."?xf=".$a['url'];
											   $cu = url('cancel-reservation')."?xf=".$r['id']."&axf=".$a['apartment_id']."&gxf=".$r['user_id'];
											   
											   $imgs = $a['cmedia']['images'];
											   
									   ?>
										<li>
											<div class="list-box-listing">
												<div class="list-box-listing-img"><a href="<?php echo e($uu); ?>"><img src="<?php echo e($imgs[0]); ?>" alt="<?php echo e($name); ?>" style="width: 150px; height: 150px;"></a></div>
												<div class="list-box-listing-content">
													<div class="inner">
														<h3><a href="<?php echo e($uu); ?>"><?php echo e($name); ?></a></h3>
														<span><?php echo e($address['address'].", ".$address['city'].", ".$address['state']); ?></span>
														<div class="star-rating">
															<div class="rating-counter">(<?php echo e(count($reviews)); ?> reviews)</div>
															<?php
															$rating = 8; $stars = $rating / 2;
															
															 for($u = 0; $u < $stars; $u++)
															 {
															?>
															   <span class="ti-star"></span>
															<?php
															 }
															?>
															
															<?php
															 for($v = 0; $v < (5 - $stars); $v++)
															 {
															?>
															   <span class="ti-star empty"></span>
															<?php
															 }
															?>
														</div>
														<h4>Booked: <em><?php echo e($r['date']); ?></em></h4>
													</div>
												</div>
											</div>
											<div class="buttons-to-right">
												<a href="<?php echo e($cu); ?>" class="button gray"><i class="ti-trash"></i> Cancel</a>
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
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\etuk-web\resources\views/my-reservations.blade.php ENDPATH**/ ?>