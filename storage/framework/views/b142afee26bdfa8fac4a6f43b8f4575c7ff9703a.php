<?php
$title = "Profile";
$subtitle = "Edit your account information";
?>


<?php $__env->startSection('title',$title); ?>

<?php $__env->startSection('top-header'); ?>
<?php echo $__env->make('top-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('banner-2',['title' => $title,'subtitle' => $subtitle], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<!-- ============================ Profile Start ================================== -->
			<section class="gray">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12">
							<div class="dashboard-wraper">
							<form method="post" action="<?php echo e(url('profile')); ?>">
								<!-- Basic Information -->
								<div class="form-submit">	
									<h4>Account Information</h4>
									<div class="submit-section">
										<div class="form-row">
										    
											<div class="form-group col-md-6">
											   <div class="row">
											      <div class="form-group col-md-6">
												      <label>First Name</label>
												      <input type="text" name="fname" class="form-control" value="<?php echo e($u['fname']); ?>">
											      </div>
											      <div class="form-group col-md-6">
												      <label>Last Name</label>
												      <input type="text" name="lname" class="form-control" value="<?php echo e($u['lname']); ?>">
											      </div>
											   </div>
											</div>
											
											<div class="form-group col-md-6">
												<label>Email</label>
												<input type="email" class="form-control" value="<?php echo e($u['email']); ?>">
											</div>
											
											<div class="form-group col-md-6">
												<label>Your Title</label>
												<input type="text" class="form-control" value="Web Designer">
											</div>
											
											<div class="form-group col-md-6">
												<label>Phone</label>
												<input type="text" class="form-control" value="123 456 5847">
											</div>
											
											<div class="form-group col-md-6">
												<label>Address</label>
												<input type="text" class="form-control" value="522, Arizona, Canada">
											</div>
											
											<div class="form-group col-md-6">
												<label>City</label>
												<input type="text" class="form-control" value="Montquebe">
											</div>
											
											<div class="form-group col-md-6">
												<label>State</label>
												<input type="text" class="form-control" value="Canada">
											</div>
											
											<div class="form-group col-md-6">
												<label>Zip</label>
												<input type="text" class="form-control" value="160052">
											</div>
											
											<div class="form-group col-md-12">
												<label>About</label>
												<textarea class="form-control">Maecenas quis consequat libero, a feugiat eros. Nunc ut lacinia tortor morbi ultricies laoreet ullamcorper phasellus semper</textarea>
											</div>
											
										</div>
									</div>
								</div>
								
								<div class="form-submit">	
									<h4>Social Accounts</h4>
									<div class="submit-section">
										<div class="form-row">
										
											<div class="form-group col-md-6">
												<label>Facebook</label>
												<input type="text" class="form-control" value="https://facebook.com/">
											</div>
											
											<div class="form-group col-md-6">
												<label>Twitter</label>
												<input type="email" class="form-control" value="https://twitter.com/">
											</div>
											
											<div class="form-group col-md-6">
												<label>Google Plus</label>
												<input type="text" class="form-control" value="https://googleplus.com">
											</div>
											
											<div class="form-group col-md-6">
												<label>LinkedIn</label>
												<input type="text" class="form-control" value="https://linkedin.com/">
											</div>
											
											<div class="form-group col-lg-12 col-md-12">
												<button class="btn btn-theme" type="submit">Save Changes</button>
											</div>
											
										</div>
									</div>
								</div>
							  </form>
							</div>
						</div>
						
					</div>
				</div>
			</section>
			<!-- ============================ Profile End ================================== -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\etuk-web\resources\views/profile.blade.php ENDPATH**/ ?>