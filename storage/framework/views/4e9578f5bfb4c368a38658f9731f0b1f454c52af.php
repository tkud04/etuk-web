<?php
$title = "Host Dashboard";
$subtitle = "Manage your apartments and host account here";
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
							
								<!-- Row -->
								<div class="row">
									<div class="col-lg-4 col-md-4 col-sm-12">
										<div class="dashboard-stat widget-1">
											<div class="dashboard-stat-content"><h4>6</h4> <span>Total Booking</span></div>
											<div class="dashboard-stat-icon"><i class="ti-location-pin"></i></div>
										</div>	
									</div>
									
									<div class="col-lg-4 col-md-4 col-sm-12">
										<div class="dashboard-stat widget-2">
											<div class="dashboard-stat-content"><h4>7201</h4> <span>Upcoming Booking</span></div>
											<div class="dashboard-stat-icon"><i class="ti-pie-chart"></i></div>
										</div>	
									</div>
									
									<div class="col-lg-4 col-md-4 col-sm-12">
										<div class="dashboard-stat widget-4">
											<div class="dashboard-stat-content"><h4>514</h4> <span>Main Balance</span></div>
											<div class="dashboard-stat-icon"><i class="ti-bookmark"></i></div>
										</div>	
									</div>
								</div>
								
								<!-- Row -->
								<div class="row">
									<div class="col-lg-6 col-md-12">
										<div class="dashboard-gravity-list with-icons">
											<h4>Transaction History</h4>
											<?php
											 if(count($orders) > 0)
											 {
											?>
											 <ul>
											<?php
											   foreach($orders as $o)
											   { 
											?>
												<li><i class="dash-icon-box ti-files"></i>
													<strong>Starter Plan</strong>
													<ul>
														<li class="unpaid">Unpaid</li>
														<li>Order: #20551</li>
														<li>Date: 01/08/2019</li>
													</ul>
													<div class="buttons-to-right">
														<a href="dashboard-invoice.html" class="button gray">View Invoice</a>
													</div>
												</li>

											<?php
											 }
                                            ?>											 
											</ul>
											<?php
											 }
											 else
											 {
											?>
											<ul>
											<li>No payment methods added yet. Book an apartment to add one now.</li>
											</ul>
											<?php
											 }
											?>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-12">
										<div class="dashboard-gravity-list with-icons">
											<h4>New messages</h4>
											<?php
											 if(count($messages) > 0)
											 {
											?>
											 <ul>
											<?php
											   foreach($m as $m)
											   { 
											?>
												<li>
													<i class="dash-icon-box ti-layers"></i> Your booking <strong><a href="#">Shimla to Goa</a></strong> has been done!
													<a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
												</li>

											<?php
											 }
                                            ?>											 
											</ul>
											<?php
											 }
											 else
											 {
											?>
											<ul>
											<li>No apartments have been saved yet.</li>
											</ul>
											<?php
											 }
											?>
										</div>
									</div>	
								</div>
								
							</div>
						</div>
						
					</div>
				</div>
			</section>
			<!-- ============================ Dashboard End ================================== -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\etuk-web\resources\views/host-dashboard.blade.php ENDPATH**/ ?>