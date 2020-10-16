
<!DOCTYPE html>
<html lang="zxx">
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		
        <title>@yield('title') | Etuk NG - Rent Apartments For Short Rest Anywhere In Nigeria</title>
		
        <!-- All Plugins Css -->
        <link rel="stylesheet" href="{{asset('css/plugins.css')}}">
		 
		
        <!-- Custom CSS -->
        <link href="{{asset('css/styles.css')}}" rel="stylesheet">
		
		<!-- Custom Color Option -->
		<link href="{{asset('css/colors.css')}}" rel="stylesheet">
		
		@yield('styles')
		
		<link rel="icon" type="image/png" href="{{asset('img/favicon.png')}}" sizes="16x16">
		
		<script src="{{asset('js/jquery.min.js')}}"></script>
		<script src="{{asset('js/popper.min.js')}}"></script>
		<script src="{{asset('js/bootstrap.min.js')}}"></script>
		<script src="{{asset('js/helpers.js').'?ver='.rand(23,999)}}"></script>
		<script src="{{asset('js/mmm.js').'?ver='.rand(23,999)}}"></script>
		
		@yield('scripts')
		 <!--Simeditor--> 
        <link rel="stylesheet" type="text/css" href="{{asset('lib/simeditor/css/simditor.css')}}" />
        <script type="text/javascript" src="{{asset('lib/simeditor/js/module.js')}}"></script>
        <script type="text/javascript" src="{{asset('lib/simeditor/js/hotkeys.js')}}"></script>
        <script type="text/javascript" src="{{asset('lib/simeditor/js/uploader.js')}}"></script>
        <script type="text/javascript" src="{{asset('lib/simeditor/js/simditor.js')}}"></script>		
		
		<!--SweetAlert--> 
    <link href="{{asset('lib/sweet-alert/sweetalert2.css')}}" rel="stylesheet">
    <script src="{{asset('lib/sweet-alert/sweetalert2.js')}}"></script>
		
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
		 @yield('top-header')
		 
		 <div class="header header-light">
				<div class="container">
					<nav id="navigation" class="navigation navigation-landscape">
						<div class="nav-header">
							<a class="nav-brand" href="{{url('/')}}">
								<img src="{{asset('img/etukng.png')}}" class="logo" alt="" />
							</a>
							<div class="nav-toggle"></div>
						</div>
						<div class="nav-menus-wrapper" style="transition-property: none;">
							<ul class="nav-menu">
							
								<li class="active">
								   <a href="{{url('/')}}">Home</a>
								</li>
								
								<li>
								   <a href="{{url('about')}}">About</a>
								</li>	
								
								<li>
								   <a href="{{url('apartments')}}">Apartments</a>
								</li>	
								
								<li>
								   <a href="{{url('faq')}}">FAQ</a>
								</li>									
								
								<li>
									<a href="{{url('contact')}}">Contact</a>                                 
								</li>
								
							</ul>
							<?php
							 $x = 3;
							?>
							<ul class="nav-menu nav-menu-social align-to-right">
							  @if(!isset($user) || $user == null)
								<li><a href="#" data-toggle="modal" data-target="#login"><i class="fas fa-user-circle text-info mr-1"></i>Log In</a></li>
								<li><a href="#" data-toggle="modal" data-target="#signup"><i class="fas fa-arrow-alt-circle-right text-warning mr-1"></i>Sign Up</a></li>
							  @else
								  <li><a href="javascript:void(0);">Hello, <em>{{$user->fname}}</em><span class="submenu-indicator"></span></a>
									<ul class="nav-dropdown nav-submenu">
										<li><a href="{{url('dashboard')}}">Dashboard</a></li>                              
										<li><a href="{{url('messages')}}">Messages</a></li>
										<li><a href="{{url('bye')}}">Sign out</a></li>  
									</ul>
								</li>
                              @endif							  
							
								<li class="login-attri">
									<div class="btn-group account-drop">
										<button type="button" class="btn btn-order-by-filt theme-cl" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="ti-shopping-cart-full"></i>
											<span class="cart-count">{{count($cart)}}</span>
										</button>
										<div class="dropdown-menu p-0 dm-lg pull-right animated flipInX">
											<div class="cart-card">
												<div class="cart-card-header">
													<h4>Your Cart</h4>
												</div>
												
												<div class="cart-card-body">
												
													<!-- Single Cart Wrap -->
													<div class="single-cart-wrap">
														<a href="#" class="cart-close"><i class="ti-close"></i></a>
														<div class="single-cart-thumb">
															<img src="{{asset('img/hotel-1.jpg')}}" alt=""/>
														</div>
														<div class="single-cart-detail">
															<h3 class="sc-title">Goa To Mumbai</h3>
															<span><i class="ti-location-pin mr-1"></i>Canada</span>
															<h4 class="sc-price theme-cl">$120</h4>
														</div>
													</div>
													
													<!-- Single Cart Wrap -->
													<div class="single-cart-wrap">
														<a href="#" class="cart-close"><i class="ti-close"></i></a>
														<div class="single-cart-thumb">
															<img src="{{asset('img/hotel-1.jpg')}}" alt=""/>
														</div>
														<div class="single-cart-detail">
															<h3 class="sc-title">Goa To Mumbai</h3>
															<span><i class="ti-location-pin mr-1"></i>Canada</span>
															<h4 class="sc-price theme-cl">$120</h4>
														</div>
													</div>
													
													<!-- Single Cart Wrap -->
													<div class="single-cart-wrap">
														<a href="#" class="cart-close"><i class="ti-close"></i></a>
														<div class="single-cart-thumb">
															<img src="{{asset('img/hotel-1.jpg')}}" alt=""/>
														</div>
														<div class="single-cart-detail">
															<h3 class="sc-title">Goa To Mumbai</h3>
															<span><i class="ti-location-pin mr-1"></i>Canada</span>
															<h4 class="sc-price theme-cl">$120</h4>
														</div>
													</div>
													
												</div>
												
												<div class="cart-card-footer">
													<a href="#" class="btn btn-theme">Go To Checkout</a>
													<h4 class="totla-prc">$516</h4>
												</div>
												
											</div>
										</div>
									</div>
								</li>
								
								<li class="login-attri">
									<div class="btn-group account-drop">
										<button type="button" class="btn btn-order-by-filt theme-cl" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="ti-email"></i>
											<span class="cart-count">{{count($messages)}}</span>
										</button>
										<div class="dropdown-menu p-0 dm-lg pull-right animated flipInX">
											<div class="cart-card">
												<div class="cart-card-header">
													<h4>Your Messages</h4>
												</div>
												
												<div class="cart-card-body">
												<?php
												$mLength = count($messages) > 4 ? 4 : count($messages);
												for($i = 0; $i < $mLength; $i++)
												{
													$m = $messages[$i];
													$guest = $m['guest'];
													$guestName = $guest['fname']." ".substr($guest['lname'],0,1).".";
													$host = $m['host'];
													$msg = $m['msg'];
													$date = $m['date'];
													$uu = url('message')."?xf=".$m['id'];
													$img = count($guest['avatar']) > 0 ? $guest['avatar'][0] : asset("img/avatar.png");
												?>
													<!-- Single Cart Wrap -->
													<div class="single-cart-wrap">
														<a href="javascript:void(0)" class="cart-close"><i class="icofont-envelope"></i></a>
														<div class="single-cart-thumb">
															<img src="{{$img}}" alt="" style="width: 40px; height: 40px;"/>
														</div>
														<div class="single-cart-detail">
															<h3 class="sc-title">{{$guestName}}</h3>
															<span><i class="ti-time mr-1"></i>{{$date}}</span>
															<h4 class="sc-price theme-cl">{{substr($msg,0,20)}}..</h4>
														</div>
													</div>
												<?php
												}
												?>
													
												</div>
												
												<div class="cart-card-footer">
													<a href="{{url('messages')}}" class="btn btn-theme">Go To Messages</a>
													
												</div>
												
											</div>
										</div>
									</div>
								</li>
								
								<?php
								if(isset($user) && $user != null)
								{
								$mode = $user->mode; $mu = "";
								if($mode == "guest")
								{
									$mu = "Switch to Host";
								}
								elseif($mode == "host")
								{
									$mu = "Switch to Guest";
								}
								?>
							    <li><a href="javascript:void(0)"><i class="fas fa-user mr-1"></i>Mode: <span class="label label-info">{{strtoupper($mode)}}</span></a></li>
								<li class="add-listing theme-bg"><a href="javascript:void(0)" onclick="switchMode({mode:'{{$mode}}'})">{{$mu}}</a></li>
								<?php
								}
								?>
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

                 @if($pop != "" && $val != "")
                   @include('session-status',['pop' => $pop, 'val' => $val])
                 @endif
        	<!--------- Input errors -------------->
                    @if (count($errors) > 0)
                          @include('input-errors', ['errors'=>$errors])
                     @endif 
			
			@yield('content')
			
						<!-- ============================ Newsletter Start ================================== -->			
			
			<!-- ============================ Footer Start ================================== -->
			<footer class="dark-footer skin-dark-footer">
				<div>
					<div class="container">
						<div class="row">
							
							<div class="col-lg-3 col-md-4">
								<div class="footer-widget">
									<img src="{{asset('img/etukng.png')}}" class="img-footer" alt="" />
									<div class="footer-add">
										<p><strong>Email:</strong></br><a href="javascript:void(0)">hello@etuk.ng</a></p>
										<p><strong>Call:</strong></br>(234) 801 234 5678</p>
										<ul class="footer-bottom-social mt-2">
											<li><a href="javascript:void(0)"><i class="ti-facebook"></i></a></li>
											<li><a href="javascript:void(0)"><i class="ti-twitter"></i></a></li>
											<li><a href="javascript:void(0)"><i class="ti-instagram"></i></a></li>
											<li><a href="javascript:void(0)"><i class="ti-linkedin"></i></a></li>
										</ul>
									</div>
									
								</div>
							</div>		
							<div class="col-lg-3 col-md-4">
								<div class="footer-widget">
									<h4 class="widget-title">Navigate</h4>
									<ul class="footer-menu">
										<li><a href="{{url('about')}}">About Us</a></li>
										<li><a href="{{url('terms')}}">Terms & Conditions</a></li>
										<li><a href="{{url('privacy')}}">Privacy Policy</a></li>
									</ul>
								</div>
							</div>
							<div class="col-lg-3 col-md-4">
								<div class="footer-widget">
									<h4 class="widget-title">Learn More</h4>
									<ul class="footer-menu">
										<li><a href="javascript:void(0)">Blog</a></li>
										<li><a href="javascript:void(0)">Knowledge Center</a></li>
										<li><a href="javascript:void(0)">Forums</a></li>
									</ul>
								</div>
							</div>
							
							<div class="col-lg-3 col-md-12">
								<div class="footer-widget">
									<h4 class="widget-title">Download Apps</h4>
									<a href="javascript:void(0)" class="other-store-link">
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
									<a href="javascript:void(0)" class="other-store-link">
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
								<p class="mb-0">&copy; <script>document.write((new Date()).getFullYear())</script> Etuk NG, All Rights Reserved</p>
							</div>
							
							<div class="col-lg-6 col-md-6 text-right">
								<img src="{{asset('img/payment.svg')}}" class="img-fluid" alt="" />
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
								<form id="l-form">
								   <input id="tk-login" type="hidden" value="{{csrf_token()}}">
									<div class="form-group">
										<label>User Name</label>
										<div class="input-with-icon">
											<input type="text" id="l-id" class="form-control" placeholder="Email or phone number">
										</div>
										<span class="text-danger text-bold input-error" id="l-id-error">This field is required</span>
									</div>
									
									<div class="form-group">
										<label>Password</label>
										<div class="input-with-icon">
											<input type="password" id="l-pass" class="form-control" placeholder="*******">
										</div>
										<span class="text-danger text-bold input-error" id="l-pass-error">This field is required</span>
									</div>
									
									<div class="form-group">
										<button type="submit" id="login-submit" class="btn btn-md full-width pop-login">Submit</button>
										<h4 class="text-primary" id="login-loading">Signing you in.. <img alt="Loading.." src="{{asset('img/loading.gif')}}"></h4>
										<h4 class="text-primary" id="login-finish"><b>Signin successful!</b><p class='text-primary'>Redirecting you to your dashboard.</p></h4>
									</div>
								
								</form>
							</div>
							<div class="modal-divider"><span>Or login via</span></div>
							<div class="social-login mb-3">
							<?php
							$fbLogin = url('oauth')."?type=facebook";
							$twLogin = url('oauth')."?type=twitter";
							$gLogin = url('oauth')."?type=google";
							?>
								<ul>
									<li><a href="{{$fbLogin}}" class="btn connect-fb"><i class="ti-facebook"></i>Facebook</a></li>
									<li><a href="{{$twLogin}}" class="btn connect-twitter"><i class="ti-twitter"></i>Twitter</a></li>
									<li><a href="{{$gLogin}}" class="btn connect-google"><i class="ti-google"></i>Google</a></li>
								</ul>
							</div>
							<div class="text-center">
								<p class="mt-5"><a href="{{url('forgot-password')}}" class="link">Forgot password?</a></p>
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
								<form id="s-form">
									<input id="tk-signup" type="hidden" value="{{csrf_token()}}">
									<div class="row">
										
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<div class="input-with-icon">
													<input type="text" id="s-fname" class="form-control" placeholder="First name">												
												</div>
												<span class="text-danger text-bold input-error" id="s-fname-error">This field is required</span>
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<div class="input-with-icon">
													<input type="text" id="s-lname" class="form-control" placeholder="Last name">
													<!--<i class="ti-user"></i>-->
												</div>
												<span class="text-danger text-bold input-error" id="s-lname-error">This field is required</span>
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<div class="input-with-icon">
													<input type="text" id="s-phone" class="form-control" placeholder="Phone number">
													<!--<i class="ti-user"></i>-->
												</div>
												<span class="text-danger text-bold input-error" id="s-phone-error">This field is required</span>
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<div class="input-with-icon">
													<input type="email" id="s-email" class="form-control" placeholder="Email">
													<!--<i class="ti-user"></i>-->
												</div>
												<span class="text-danger text-bold input-error" id="s-email-error">This field is required</span>
											</div>
										</div>
	
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<div class="input-with-icon">
													<input type="password" id="s-pass" class="form-control" placeholder="Password">
													<!--<i class="ti-user"></i>-->
												</div>
												<span class="text-danger text-bold input-error" id="s-pass-error">This field is required</span>
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<div class="input-with-icon">
													<input type="password" id="s-pass2" class="form-control" placeholder="Confirm Password">
													<!--<i class="ti-user"></i>-->
												</div>
												<span class="text-danger text-bold input-error" id="s-pass2-error">This field is required and passwords must match</span>
											</div>
										</div>
										
									</div>
									
									<div class="form-group">
										<button type="submit" id="signup-submit" class="btn btn-md full-width pop-login">Submit</button>
										<h4 class="text-primary" id="signup-loading">Processing your registration: <img alt="Loading.." src="{{asset('img/loading.gif')}}"></h4>
										<h4 class="text-primary" id="signup-finish"><b>Signup successful!</b><p class='text-primary'>Redirecting you to the home page.</p></h4>
									</div>
								
								</form>
							</div>
							<div class="modal-divider"><span>Or login via</span></div>
							<div class="social-login mb-3">
							<?php
							$fbSignup = url('oauth')."?type=facebook";
							$twSignup = url('oauth')."?type=twitter";
							$gSignup = url('oauth')."?type=google";
							?>
								<ul>
									<li><a href="javascript:void(0)" class="btn connect-fb"><i class="ti-facebook"></i>Facebook</a></li>
									<li><a href="{{$twSignup}}" class="btn connect-twitter"><i class="ti-twitter"></i>Twitter</a></li>
									<li><a href="{{$gSignup}}" class="btn connect-google"><i class="ti-google"></i>Google</a></li>
								</ul>
							</div>
							<div class="text-center">
								<p class="mt-5"><i class="ti-user mr-1"></i>Already Have An Account? <a href="javascript:void(0)" class="link" data-toggle="modal" data-target="#login">Log in</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Modal -->
			
			<a id="back2Top" class="top-scroll" title="Back to top" href="javascript:void(0)"><i class="ti-arrow-up"></i></a>
			
			

		</div>
		<!-- ============================================================== -->
		<!-- End Wrapper -->
		<!-- ============================================================== -->

		<!-- ============================================================== -->
		<!-- All Jquery -->
		<!-- ============================================================== -->

		
		<script src="{{asset('js/circleMagic.min.js')}}"></script>
		
		<script src="{{asset('js/rangeslider.js')}}"></script>
		<script src="{{asset('js/select2.min.js')}}"></script>
		<script src="{{asset('js/aos.js')}}"></script>
		<script src="{{asset('js/owl.carousel.min.js')}}"></script>
		<script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
		<script src="{{asset('js/slick.js')}}"></script>
		<script src="{{asset('js/slider-bg.js')}}"></script>
		<script src="{{asset('js/lightbox.js')}}"></script> 
		<script src="{{asset('js/imagesloaded.js')}}"></script>
		<script src="{{asset('js/isotope.min.js')}}"></script>
		
		<script src="{{asset('js/custom.js')}}"></script>
		
		<?php
		 $unreadMessages = 0;
		 
		 foreach($messages as $m)
		 {
			 if($m['status'] == "unread") ++$unreadMessages;
		 }
		 $umt = $unreadMessages == 1 ? "message" : "messages";
		 if($unreadMessages > 0)
			 
		 {
		?>
		<script>
		let interval = 1000 * 25;
		 $(document).ready(() => {
			 Swal.fire({
			 icon: 'info',
             title: "You've got {{$unreadMessages}} unread {{$umt}}!",
			 showCancelButton: true,
             confirmButtonText: 'Go to messages',
           }).then((result) => {
              if (result.value) {
				  window.location = "messages";
	          }
           });
		   
		   	//check for new messages every 1 minute
			setInterval(() => {
			  checkForMessages();
			},interval);
	        
		 });
		</script>
		<?php
		 }
		?>
		<!-- ============================================================== -->
		<!-- This page plugins -->
		<!-- ============================================================== -->
		
		<!-- Date Booking Script -->
		<script src="{{asset('js/moment.min.js')}}"></script>
		<script src="{{asset('js/daterangepicker.js')}}"></script>


	</body>
</html>