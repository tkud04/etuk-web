
<!DOCTYPE html>
<html lang="zxx">
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		
        <title><?php echo $__env->yieldContent('title'); ?> | Etuk NG - Rentals</title>
		
        <!-- All Plugins Css -->
        <link rel="stylesheet" href="<?php echo e(asset('css/plugins.css')); ?>">
		 
		
        <!-- Custom CSS -->
        <link href="<?php echo e(asset('css/styles.css')); ?>" rel="stylesheet">
		
		<!-- Custom Color Option -->
		<link href="<?php echo e(asset('css/colors.css')); ?>" rel="stylesheet">
		
		<script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
		<script src="<?php echo e(asset('js/popper.min.js')); ?>"></script>
		<script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
		<script src="<?php echo e(asset('js/helpers.js')); ?>"></script>
		<script src="<?php echo e(asset('js/mmm.js')); ?>"></script>
		
    </head>
	
    <body class="orange-skin">
	
		 <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div id="preloader"><div class="preloader"><span></span><span></span></div></div>
		
        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
		
		<div id="main-wrapper">
		 <?php echo $__env->yieldContent('top-header'); ?>
		 
		 <div class="header header-light">
				<div class="container">
					<nav id="navigation" class="navigation navigation-landscape">
						<div class="nav-header">
							<a class="nav-brand" href="<?php echo e(url('/')); ?>">
								<img src="<?php echo e(asset('img/logo.png')); ?>" class="logo" alt="" />
							</a>
							<div class="nav-toggle"></div>
						</div>
						<div class="nav-menus-wrapper" style="transition-property: none;">
							<ul class="nav-menu">
							
								<li class="active"><a href="javascript:void(0);">Home<span class="submenu-indicator"></span></a>
									<ul class="nav-dropdown nav-submenu">
										<li><a href="index.html">Home Style 1</a></li>                                    
										<li><a href="home-2.html">Home Style 2</a></li>                                    
										<li><a href="home-3.html">Home Style 3</a></li> 
										<li><a href="home-4.html">Home Style 4</a></li> 
										<li><a href="home-5.html">Home Style 5</a></li> 
										<li><a href="home-6.html">Home Style 6</a></li> 
										<li><a href="home-7.html">Home Style 7</a></li>
										<li><a href="video.html">Video Home</a></li> 										
									</ul>
								</li>
								
								<li><a href="javascript:void(0);">Browse<span class="submenu-indicator"></span></a>
									<ul class="nav-dropdown nav-submenu">
										<li><a href="#">Tour Listing<span class="submenu-indicator"></span></a>
											<ul class="nav-dropdown nav-submenu">
												<li><a href="tour-list-sidebar.html">List Layout Sidebar</a></li>
												<li><a href="tour-grid-sidebar.html">Grid Layout Sidebar</a></li>										
												<li><a href="tour-detail.html">Tour Detail</a></li> 
											</ul>
										</li>
										<li><a href="javascript:void(0);">Hotel Listing<span class="submenu-indicator"></span></a>
											<ul class="nav-dropdown nav-submenu">
												<li><a href="hotel-list-sidebar.html">List Layout Sidebar</a></li>                                    
												<li><a href="hotel-list-sidebar-2.html.html">List Layout 2 Sidebar</a></li>                                    
												<li><a href="hotel-grid-sidebar.html">Grid Layout Sidebar</a></li> 
												<li><a href="hotel-detail.html">Hotel Detail</a></li> 
											</ul>
										</li>
										<li>
											<a href="map-search.html">Half Map Screen</a>                                 
										</li>
										<li><a href="javascript:void(0);">Dashboard<span class="submenu-indicator"></span></a>
											<ul class="nav-dropdown nav-submenu">
												<li><a href="dashboard.html">Dashboard Home</a></li> 
												<li><a href="my-booking.html">My Booking</a></li>
												<li><a href="my-profile.html">My Profile</a></li>										
												<li><a href="bookmark-list.html">Bookmark List</a></li>                                    
												<li><a href="checkout.html">Checkout Page</a></li>
												<li><a href="dashboard-invoice.html">Dashboard Invoice</a></li>
											</ul>
										</li>
									</ul>
								</li>
								
								<li><a href="javascript:void(0);">Pages<span class="submenu-indicator"></span></a>
									<ul class="nav-dropdown nav-submenu">
										<li><a href="about-us.html">About Us</a></li>                                    
										<li><a href="blog.html">Blog Page</a></li>                                    
										<li><a href="faq.html">FAQ Page</a></li> 
										<li><a href="contact.html">Get in Touch</a></li> 
										<li><a href="404.html">Error Page</a></li> 
										<li><a href="elements.html">Elements</a></li>  
									</ul>
								</li>
								
								<li>
									<a href="contact.html">Contact</a>                                 
								</li>
								
							</ul>
							
							<ul class="nav-menu nav-menu-social align-to-right">
								
								<li class="add-listing theme-bg"><a href="#">Become A Host</a></li>
								
							</ul>
						</div>
					</nav>
				</div>
			</div>
			<!-- End Navigation -->
			<div class="clearfix"></div>
			<!-- ============================================================== -->
			<!-- Top header  -->
			<!-- ============================================================== -->
			
			  <!--------- Session notifications-------------->
        	<?php
               $pop = ""; $val = "";
               
               if(isset($signals))
               {
                  foreach($signals['okays'] as $key => $value)
                  {
                    if(session()->has($key))
                    {
                  	$pop = $key; $val = session()->get($key);
                    }
                 }
              }
              
             ?> 

                 <?php if($pop != "" && $val != ""): ?>
                   <?php echo $__env->make('session-status',['pop' => $pop, 'val' => $val], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                 <?php endif; ?>
        	<!--------- Input errors -------------->
                    <?php if(count($errors) > 0): ?>
                          <?php echo $__env->make('input-errors', ['errors'=>$errors], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                     <?php endif; ?> 
			
			<?php echo $__env->yieldContent('content'); ?>
			
						<!-- ============================ Newsletter Start ================================== -->			
			
			<!-- ============================ Footer Start ================================== -->
			<footer class="dark-footer skin-dark-footer">
				<div>
					<div class="container">
						<div class="row">
							
							<div class="col-lg-3 col-md-3">
								<div class="footer-widget">
									<img src="<?php echo e(asset('img/logo-light.png')); ?>" class="img-footer" alt="" />
									<div class="footer-add">
										<p><strong>Email:</strong></br><a href="#">hello@workstock.com</a></p>
										<p><strong>Call:</strong></br>91 855 742 62548</p>
										<ul class="footer-bottom-social mt-2">
											<li><a href="#"><i class="ti-facebook"></i></a></li>
											<li><a href="#"><i class="ti-twitter"></i></a></li>
											<li><a href="#"><i class="ti-instagram"></i></a></li>
											<li><a href="#"><i class="ti-linkedin"></i></a></li>
										</ul>
									</div>
									
								</div>
							</div>		
							<div class="col-lg-2 col-md-3">
								<div class="footer-widget">
									<h4 class="widget-title">Navigations</h4>
									<ul class="footer-menu">
										<li><a href="video.html">Video Home Page</a></li>
										<li><a href="#">Browse Candidates</a></li>
										<li><a href="#">Browse Employers</a></li>
										<li><a href="#">Advance Search</a></li>
										<li><a href="#">Job With Map</a></li>
									</ul>
								</div>
							</div>
									
							<div class="col-lg-2 col-md-3">
								<div class="footer-widget">
									<h4 class="widget-title">The Highlights</h4>
									<ul class="footer-menu">
										<li><a href="#">Home Page 2</a></li>
										<li><a href="#">Home Page 3</a></li>
										<li><a href="#">Home Page 4</a></li>
										<li><a href="#">Home Page 5</a></li>
										<li><a href="#">LogIn</a></li>
									</ul>
								</div>
							</div>
							
							<div class="col-lg-2 col-md-3">
								<div class="footer-widget">
									<h4 class="widget-title">My Account</h4>
									<ul class="footer-menu">
										<li><a href="#">Dashboard</a></li>
										<li><a href="#">Applications</a></li>
										<li><a href="#">Packages</a></li>
										<li><a href="#">resume.html</a></li>
										<li><a href="#">SignUp Page</a></li>
									</ul>
								</div>
							</div>
							
							<div class="col-lg-3 col-md-12">
								<div class="footer-widget">
									<h4 class="widget-title">Download Apps</h4>
									<a href="#" class="other-store-link">
										<div class="other-store-app">
											<div class="os-app-icon">
												<i class="ti-android theme-cl"></i>
											</div>
											<div class="os-app-caps">
												Google Play
												<span>Get It Now</span>
											</div>
										</div>
									</a>
									<a href="#" class="other-store-link">
										<div class="other-store-app">
											<div class="os-app-icon">
												<i class="ti-apple theme-cl"></i>
											</div>
											<div class="os-app-caps">
												App Store
												<span>Now it Available</span>
											</div>
										</div>
									</a>
								</div>
							</div>
							
						</div>
					</div>
				</div>
				
				<div class="footer-bottom">
					<div class="container">
						<div class="row align-items-center">
							
							<div class="col-lg-6 col-md-6">
								<p class="mb-0">© 2020 Travlio. Designd By Pixel Experts. All Rights Reserved</p>
							</div>
							
							<div class="col-lg-6 col-md-6 text-right">
								<img src="<?php echo e(asset('img/payment.svg')); ?>" class="img-fluid" alt="" />
							</div>
							
						</div>
					</div>
				</div>
			</footer>
			<!-- ============================ Footer End ================================== -->
			
			<!-- Log In Modal -->
			<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="registermodal">
				<div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
					<div class="modal-content" id="registermodal">
						<span class="mod-close" data-dismiss="modal"><i class="ti-close"></i></span>
						<div class="modal-body">
							<h4 class="modal-header-title">Log <span class="theme-cl">In</span></h4>
							<div class="login-form">
								<form>
								
									<div class="form-group">
										<label>User Name</label>
										<div class="input-with-icon">
											<input type="text" class="form-control" placeholder="Username">
											<i class="ti-user"></i>
										</div>
									</div>
									
									<div class="form-group">
										<label>Password</label>
										<div class="input-with-icon">
											<input type="password" class="form-control" placeholder="*******">
											<i class="ti-unlock"></i>
										</div>
									</div>
									
									<div class="form-group">
										<button type="submit" class="btn btn-md full-width pop-login">Login</button>
									</div>
								
								</form>
							</div>
							<div class="modal-divider"><span>Or login via</span></div>
							<div class="social-login mb-3">
								<ul>
									<li><a href="#" class="btn connect-fb"><i class="ti-facebook"></i>Facebook</a></li>
									<li><a href="#" class="btn connect-twitter"><i class="ti-twitter"></i>Twitter</a></li>
								</ul>
							</div>
							<div class="text-center">
								<p class="mt-5"><a href="#" class="link">Forgot password?</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Modal -->
			
			<!-- Sign Up Modal -->
			<div class="modal fade signup" id="signup" tabindex="-1" role="dialog" aria-labelledby="sign-up">
				<div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
					<div class="modal-content" id="sign-up">
						<span class="mod-close" data-dismiss="modal"><i class="ti-close"></i></span>
						<div class="modal-body">
							<h4 class="modal-header-title">Sign <span class="theme-cl">Up</span></h4>
							<div class="login-form">
								<form>
									
									<div class="row">
										
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<div class="input-with-icon">
													<input type="text" class="form-control" placeholder="First name">
													<i class="ti-user"></i>
												</div>
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<div class="input-with-icon">
													<input type="text" class="form-control" placeholder="Last name">
													<i class="ti-user"></i>
												</div>
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<div class="input-with-icon">
													<input type="text" class="form-control" placeholder="Username">
													<i class="ti-user"></i>
												</div>
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<div class="input-with-icon">
													<input type="email" class="form-control" placeholder="Email">
													<i class="ti-email"></i>
												</div>
											</div>
										</div>
	
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<div class="input-with-icon">
													<input type="password" class="form-control" placeholder="Password">
													<i class="ti-unlock"></i>
												</div>
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<div class="input-with-icon">
													<input type="password" class="form-control" placeholder="Confirm Password">
													<i class="ti-unlock"></i>
												</div>
											</div>
										</div>
										
									</div>
									
									<div class="form-group">
										<button type="submit" class="btn btn-md full-width pop-login">Sign Up</button>
									</div>
								
								</form>
							</div>
							<div class="modal-divider"><span>Or login via</span></div>
							<div class="social-login mb-3">
								<ul>
									<li><a href="#" class="btn connect-fb"><i class="ti-facebook"></i>Facebook</a></li>
									<li><a href="#" class="btn connect-twitter"><i class="ti-twitter"></i>Twitter</a></li>
								</ul>
							</div>
							<div class="text-center">
								<p class="mt-5"><i class="ti-user mr-1"></i>Already Have An Account? <a href="#" class="link">Go For LogIn</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Modal -->
			
			<a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>
			
			

		</div>
		<!-- ============================================================== -->
		<!-- End Wrapper -->
		<!-- ============================================================== -->

		<!-- ============================================================== -->
		<!-- All Jquery -->
		<!-- ============================================================== -->

		
		<script src="<?php echo e(asset('js/circleMagic.min.js')); ?>"></script>
		
		<script src="<?php echo e(asset('js/rangeslider.js')); ?>"></script>
		<script src="<?php echo e(asset('js/select2.min.js')); ?>"></script>
		<script src="<?php echo e(asset('js/aos.js')); ?>"></script>
		<script src="<?php echo e(asset('js/owl.carousel.min.js')); ?>"></script>
		<script src="<?php echo e(asset('js/jquery.magnific-popup.min.js')); ?>"></script>
		<script src="<?php echo e(asset('js/slick.js')); ?>"></script>
		<script src="<?php echo e(asset('js/slider-bg.js')); ?>"></script>
		<script src="<?php echo e(asset('js/lightbox.js')); ?>"></script> 
		<script src="<?php echo e(asset('js/imagesloaded.js')); ?>"></script>
		<script src="<?php echo e(asset('js/isotope.min.js')); ?>"></script>
		
		<script src="<?php echo e(asset('js/custom.js')); ?>"></script>
		<!-- ============================================================== -->
		<!-- This page plugins -->
		<!-- ============================================================== -->
		
		<!-- Date Booking Script -->
		<script src="<?php echo e(asset('js/moment.min.js')); ?>"></script>
		<script src="<?php echo e(asset('js/daterangepicker.js')); ?>"></script>


	</body>
</html><?php /**PATH C:\bkupp\lokl\repo\etuk-web\resources\views/layout.blade.php ENDPATH**/ ?>