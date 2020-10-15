<?php
$title = $apartment['name'];
$subtitle = "View this apartment";

$host = $apartment['host'];
$hostName = $host['fname']." ".substr($host['lname'],0,1);
$hostNum = "Send ".$host['fname']." a message to book this apartment.";
$myName = ""; $myEmail = "";

if($user != null)
{
	$myName = $user->fname." ".$user->lname;
	$myEmail = $user->email;
}

$terms = $apartment['terms'];
$adata = $apartment['data'];
$address = $apartment['address'];
$location = $address['city'].", ".$address['state'];
$stars = $apartment['rating'];
$reviews = $apartment['reviews'];
$facilities = $apartment['facilities'];
$cmedia = $apartment['cmedia'];
$media = $apartment['media'];
$rawImgs = $media['images'];
$imgs = $cmedia['images'];
$video = $cmedia['video'];

$as = $apartment['avb'];
$asText = $as == "available" ? "Available for booking" : "Apartment is currently occupied";

?>



<?php $__env->startSection('title',$title); ?>

<?php $__env->startSection('top-header'); ?>
<?php echo $__env->make('top-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<!-- ============================ Hero Banner  Start================================== -->
			<div class="featured-slick">
				<div class="featured-slick-slide">
				<?php
				 foreach($imgs as $img)
				 {
				?>
					<div>
					  <a href="<?php echo e($img); ?>" class="mfp-gallery">
					    <img src="<?php echo e($img); ?>" class="img-fluid mx-auto" alt="" />
					  </a>
					</div>
				<?php
				 }
				?>
				</div>
			</div>
			
			<section class="spd-wrap">
				<div class="container">
					<div class="row">
						
						<div class="col-lg-12 col-md-12">
						
							<div class="slide-property-detail">
								
								<div class="slide-property-first">
									<div class="row">
										<div class="col-lg-8 col-md-8">
											<div class="row">
											
												<!-- Single Items -->
												<div class="col-xs-6 col-lg-4 col-md-6">
													<div class="singles_item">
														<div class="icon">
															<i class="icofont-home"></i>
														</div>
														<div class="info">
															<h4 class="name"><?php echo e(ucwords($as)); ?></h4>
															<p class="value"><?php echo e($asText); ?></p>
														</div>
													</div>
												</div>
												
												<!-- Single Items -->
												<div class="col-xs-6 col-lg-3 col-md-6">
													<div class="singles_item">
														<div class="icon">
															<i class="icofont-credit-card"></i>
														</div>
														<div class="info">
															<h4 class="name">&#8358;<?php echo e(number_format($adata['amount'],2)); ?> </h4>
															<p class="value">per night</p>
														</div>
													</div>
												</div>
												
												<!-- Single Items -->
												<div class="col-xs-6 col-lg-2 col-md-6">
													<div class="singles_item">
														<div class="icon">
															<i class="icofont-travelling"></i>
														</div>
														<div class="info">
															<h4 class="name"><?php echo e($adata['max_adults']); ?></h4>
															<p class="value">Max. adults</p>
														</div>
													</div>
												</div>
												
												<!-- Single Items -->
												<div class="col-xs-6 col-lg-3 col-md-6">
													<div class="singles_item">
														<div class="icon">
															<i class="icofont-island"></i>
														</div>
														<div class="info">
															<h4 class="name"><em>[Address hidden]</em></h4>
															<p class="value"><?php echo e($address['city'].", ".$address['state']); ?></p>
														</div>
													</div>
												</div>
												
											</div>
										</div>
									</div>
								</div>
								
							</div>
							
						</div>
					</div>
				</div>
			</section>
			<!-- ============================ Hero Banner End ================================== -->


            	<!-- ============================ Property Detail Start ================================== -->
			<section class="gray pt-5">
				<div class="container">
					<div class="row">
						
						<!-- property main detail -->
						<div class="col-lg-8 col-md-12 col-sm-12 order-lg-1 order-md-2 order-2">
							
							<!-- Single Block Wrap -->
							<div class="block-wrap">
								
								<div class="block-header">
									<h4 class="block-title">Description</h4>
								</div>
								
								<div class="block-body">
								<?php echo $adata['description']; ?>

								</div>
								
							</div>
							
							<!-- Single Block Wrap -->
							<div class="block-wrap">
								
								<div class="block-header">
									<h4 class="block-title">Facilities</h4>
								</div>
								
								<div class="block-body">
									<ul class="avl-features third">
									<?php
											        foreach($facilities as $f)
													{
														$facility = $f['facility'];
														
														foreach($services as $s)
														{
									                      if($s['tag'] == $facility)
														  {															  
														
					                 ?>
										<li><?php echo e($s['name']); ?></li>
									<?php
														  }
														}
													}
									?>
									</ul>
								</div>
								
							</div>
							
							<!-- Single Block Wrap -->
							<div class="block-wrap">
								
								<div class="block-header">
									<h4 class="block-title">Travel Days</h4>
								</div>
								
								<div class="block-body">
									<ul class="qa-skill-list">
										
										<!-- Single List -->
										<li>
											<div class="qa-skill-box">
												<h4 class="qa-skill-title">Days 01</h4>
												<h5 class="qa-subtitle">Liverpool, London</h5>
												<div class="qa-content">
													<p>Experience with the responsive and adaptive design is strongly preferred. Also, an understanding of the entire web development process, including design, development, and deployment is preferred.</p>
												</div>
											</div>
										</li>
										
										<!-- Single List -->
										<li>
											<div class="qa-skill-box">
												<h4 class="qa-skill-title">Days 02</h4>
												<h5 class="qa-subtitle">Hong, Newyork</h5>
												<div class="qa-content">
													<p>Experience with the responsive and adaptive design is strongly preferred. Also, an understanding of the entire web development process, including design, development, and deployment is preferred.</p>
												</div>
											</div>
										</li>
										
										<!-- Single List -->
										<li>
											<div class="qa-skill-box">
												<h4 class="qa-skill-title">Days 03</h4>
												<h5 class="qa-subtitle">Elip, Paris</h5>
												<div class="qa-content">
													<p>Experience with the responsive and adaptive design is strongly preferred. Also, an understanding of the entire web development process, including design, development, and deployment is preferred.</p>
												</div>
											</div>
										</li>
										
									</ul>

								</div>
								
							</div>
							
							<!-- Review Block Wrap -->
							<div class="rating-overview">
								<div class="rating-overview-box">
									<span class="rating-overview-box-total">4.2</span>
									<span class="rating-overview-box-percent">out of 5.0</span>
									<div class="star-rating" data-rating="5"><i class="ti-star"></i><i class="ti-star"></i><i class="ti-star"></i><i class="ti-star"></i><i class="ti-star"></i>
									</div>
								</div>

								<div class="rating-bars">
										<div class="rating-bars-item">
											<span class="rating-bars-name">Service</span>
											<span class="rating-bars-inner">
												<span class="rating-bars-rating high" data-rating="4.7">
													<span class="rating-bars-rating-inner" style="width: 85%;"></span>
												</span>
												<strong>4.7</strong>
											</span>
										</div>
										<div class="rating-bars-item">
											<span class="rating-bars-name">Value for Money</span>
											<span class="rating-bars-inner">
												<span class="rating-bars-rating good" data-rating="3.9">
													<span class="rating-bars-rating-inner" style="width: 75%;"></span>
												</span>
												<strong>3.9</strong>
											</span>
										</div>
										<div class="rating-bars-item">
											<span class="rating-bars-name">Location</span>
											<span class="rating-bars-inner">
												<span class="rating-bars-rating mid" data-rating="3.2">
													<span class="rating-bars-rating-inner" style="width: 52.2%;"></span>
												</span>
												<strong>3.2</strong>
											</span>
										</div>
										<div class="rating-bars-item">
											<span class="rating-bars-name">Cleanliness</span>
											<span class="rating-bars-inner">
												<span class="rating-bars-rating poor" data-rating="2.0">
													<span class="rating-bars-rating-inner" style="width:20%;"></span>
												</span>
												<strong>2.0</strong>
											</span>
										</div>
								</div>
							</div>
							
							<!-- Reviews Comments -->
							<div class="list-single-main-item fl-wrap">
								<div class="list-single-main-item-title fl-wrap">
									<h3>Item Reviews -  <span> 3 </span></h3>
								</div>
								<div class="reviews-comments-wrap">
									<!-- reviews-comments-item -->  
									<div class="reviews-comments-item">
										<div class="review-comments-avatar">
											<img src="assets/img/user-1.jpg" class="img-fluid" alt=""> 
										</div>
										<div class="reviews-comments-item-text">
											<h4><a href="#">Josaph Manrty</a><span class="reviews-comments-item-date"><i class="ti-calendar theme-cl"></i>27 Oct 2019</span></h4>
											
											<div class="listing-rating high" data-starrating2="5"><i class="ti-star active"></i><i class="ti-star active"></i><i class="ti-star active"></i><i class="ti-star active"></i><i class="ti-star active"></i><span class="review-count">4.9</span> </div>
											<div class="clearfix"></div>
											<p>" Commodo est luctus eget. Proin in nunc laoreet justo volutpat blandit enim. Sem felis, ullamcorper vel aliquam non, varius eget justo. Duis quis nunc tellus sollicitudin mauris. "</p>
											<div class="pull-left reviews-reaction">
												<a href="#" class="comment-like active"><i class="ti-thumb-up"></i> 12</a>
												<a href="#" class="comment-dislike active"><i class="ti-thumb-down"></i> 1</a>
												<a href="#" class="comment-love active"><i class="ti-heart"></i> 07</a>
											</div>
										</div>
									</div>
									<!--reviews-comments-item end-->  
									
									<!-- reviews-comments-item -->  
									<div class="reviews-comments-item">
										<div class="review-comments-avatar">
											<img src="assets/img/user-2.jpg" class="img-fluid" alt=""> 
										</div>
										<div class="reviews-comments-item-text">
											<h4><a href="#">Rita Chawla</a><span class="reviews-comments-item-date"><i class="ti-calendar theme-cl"></i>2 Nov May 2019</span></h4>
											
											<div class="listing-rating mid" data-starrating2="5"><i class="ti-star active"></i><i class="ti-star active"></i><i class="ti-star active"></i><i class="ti-star active"></i><i class="ti-star"></i><span class="review-count">3.7</span> </div>
											<div class="clearfix"></div>
											<p>" Commodo est luctus eget. Proin in nunc laoreet justo volutpat blandit enim. Sem felis, ullamcorper vel aliquam non, varius eget justo. Duis quis nunc tellus sollicitudin mauris. "</p>
											<div class="pull-left reviews-reaction">
												<a href="#" class="comment-like active"><i class="ti-thumb-up"></i> 12</a>
												<a href="#" class="comment-dislike active"><i class="ti-thumb-down"></i> 1</a>
												<a href="#" class="comment-love active"><i class="ti-heart"></i> 07</a>
											</div>
										</div>
									</div>
									<!--reviews-comments-item end-->
									
									<!-- reviews-comments-item -->  
									<div class="reviews-comments-item">
										<div class="review-comments-avatar">
											<img src="assets/img/user-3.jpg" class="img-fluid" alt=""> 
										</div>
										<div class="reviews-comments-item-text">
											<h4><a href="#">Adam Wilsom</a><span class="reviews-comments-item-date"><i class="ti-calendar theme-cl"></i>10 Nov 2019</span></h4>
											
											<div class="listing-rating good" data-starrating2="5"><i class="ti-star active"></i><i class="ti-star active"></i><i class="ti-star active"></i><i class="ti-star active"></i><i class="ti-star"></i> <span class="review-count">4.2</span> </div>
											<div class="clearfix"></div>
											<p>" Commodo est luctus eget. Proin in nunc laoreet justo volutpat blandit enim. Sem felis, ullamcorper vel aliquam non, varius eget justo. Duis quis nunc tellus sollicitudin mauris. "</p>
											<div class="pull-left reviews-reaction">
												<a href="#" class="comment-like active"><i class="ti-thumb-up"></i> 12</a>
												<a href="#" class="comment-dislike active"><i class="ti-thumb-down"></i> 1</a>
												<a href="#" class="comment-love active"><i class="ti-heart"></i> 07</a>
											</div>
										</div>
									</div>
									<!--reviews-comments-item end-->
									
								</div>
							</div>
							
							<!-- Add Review Wrap -->
							<div class="block-wrap">
								
								<div class="block-header">
									<h4 class="block-title">Add Review</h4>
								</div>
								
								<div class="block-body">
								
									<div class="giv-averg-rate">
										<div class="row">
											<div class="col-lg-8 col-md-8 col-sm-12">
												<div class="row">
												
													<div class="col-lg-6 col-md-6 col-sm-12">
														<label>Service?</label>
														<div class="rate-stars">
															<input type="checkbox" id="st1" value="1" />
															<label for="st1"></label>
															<input type="checkbox" id="st2" value="2" />
															<label for="st2"></label>
															<input type="checkbox" id="st3" value="3" />
															<label for="st3"></label>
															<input type="checkbox" id="st4" value="4" />
															<label for="st4"></label>
															<input type="checkbox" id="st5" value="5" />
															<label for="st5"></label>
														</div>
													</div>
													
													<div class="col-lg-6 col-md-6 col-sm-12">
														<label>Value for Money?</label>
														<div class="rate-stars">
															<input type="checkbox" id="vst1" value="1" />
															<label for="vst1"></label>
															<input type="checkbox" id="vst2" value="2" />
															<label for="vst2"></label>
															<input type="checkbox" id="vst3" value="3" />
															<label for="vst3"></label>
															<input type="checkbox" id="vst4" value="4" />
															<label for="vst4"></label>
															<input type="checkbox" id="vst5" value="5" />
															<label for="vst5"></label>
														</div>
													</div>
													
													<div class="col-lg-6 col-md-6 col-sm-12">
														<label>Cleanliness?</label>
														<div class="rate-stars">
															<input type="checkbox" id="cst1" value="1" />
															<label for="cst1"></label>
															<input type="checkbox" id="cst2" value="2" />
															<label for="cst2"></label>
															<input type="checkbox" id="cst3" value="3" />
															<label for="cst3"></label>
															<input type="checkbox" id="cst4" value="4" />
															<label for="cst4"></label>
															<input type="checkbox" id="cst5" value="5" />
															<label for="cst5"></label>
														</div>
													</div>
													
													<div class="col-lg-6 col-md-6 col-sm-12">
														<label>Location?</label>
														<div class="rate-stars">
															<input type="checkbox" id="lst1" value="1" />
															<label for="lst1"></label>
															<input type="checkbox" id="lst2" value="2" />
															<label for="lst2"></label>
															<input type="checkbox" id="lst3" value="3" />
															<label for="lst3"></label>
															<input type="checkbox" id="lst4" value="4" />
															<label for="lst4"></label>
															<input type="checkbox" id="lst5" value="5" />
															<label for="lst5"></label>
														</div>
													</div>
													
												</div>
											</div>
											
											<div class="col-lg-4 col-md-4 col-sm-12">
												<div class="avg-total-pilx">
													<h4 class="high">4.9</h4>
													<span>Average Ratting</span>
												</div>
											</div>
										</div>
									</div>
									
									<div class="review-form-box form-submit">
										<form>
											<div class="row">
												
												<div class="col-lg-6 col-md-6 col-sm-12">
													<div class="form-group">
														<label>Name</label>
														<input class="form-control" type="text" placeholder="Your Name">
													</div>
												</div>
												
												<div class="col-lg-6 col-md-6 col-sm-12">
													<div class="form-group">
														<label>Email</label>
														<input class="form-control" type="email" placeholder="Your Email">
													</div>
												</div>
												
												<div class="col-lg-12 col-md-12 col-sm-12">
													<div class="form-group">
														<label>Review</label>
														<textarea class="form-control ht-140" placeholder="Review"></textarea>
													</div>
												</div>
												
												<div class="col-lg-12 col-md-12 col-sm-12">
													<div class="form-group">
														<button type="submit" class="btn btn-theme">Submit Review</button>
													</div>
												</div>
												
											</div>
										</form>
									</div>
									
								</div>
								
							</div>
							
						</div>
						
						<!-- property Sidebar -->
						<div class="col-lg-4 col-md-12 col-sm-12 order-lg-2 order-md-1 order-1">
							
							<div class="side-booking-wraps ">
								<div class="side-booking-wrap hotel-booking">
						
									<div class="side-booking-header light">
										<div class="author-with-rate">
											<div class="head-author">
												<div class="hau-thumb">
													<img src="<?php echo e($imgs[0]); ?>" alt="" style="width=100px; height: 100px;" />
												</div>
												<h4 class="head-list-titleup"><?php echo e($apartment['name']); ?></h4>
												<span><i class="ti-location-pin"></i><?php echo e($location); ?></span>
											</div>
											<div class="head-ratting">
												<div class="ht-star">
												    <?php for($i = 0; $i < $stars; $i++): ?>
													<i class="fa fa-star filled"></i>
												    <?php endfor; ?>
										            <?php for($i = 0; $i < 5 - $stars; $i++): ?>									
													<i class="fa fa-star"></i>
												    <?php endfor; ?>
													<span><?php echo e(count($reviews)); ?> Reviews</span>
												</div>
												
											</div>
										</div>
									</div>
									
									<div class="side-booking-body">
									<?php
									$checkin = date("m/d/Y");
									?>
										<div class="row mb-4">
											<div class="col-lg-6 col-md-6 col-sm-6">
												<div class="form-group">
													<label>Check In</label>
													<div class="cld-box">
														<i class="ti-calendar"></i>
														<input type="text" name="checkin" id="apartment-checkin" class="form-control" value="<?php echo e($checkin); ?>" />
													</div>
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6">
												<div class="form-group">
													<label>Check Out</label>
													<div class="cld-box">
														<i class="ti-calendar"></i>
														<input type="text" name="checkout" id="apartment-checkout" class="form-control" value="10/24/2020" />
													</div>
												</div>
											</div>
										</div>
									
										<!-- Single Row Booking -->
										<div class="single-row-booking">
											<span class="onsale-section blacks"><span class="onsale">Guests<small></small></span></span>
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 small-spilx">
													<h4 class="booking-title">How many are you?</h4>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6 col-6 small-spilx">
													<div class="form-group">
														<div class="guests">
															<div class="advance-bboking">
															
																<div class="guest-type">
																	<h5>Adults</h5>
																	<span><?php echo e($adata['max_adults']); ?> max.</span>
																</div>
																
																<div class="guests-box">
																	  <button class="counter-btn" type="button" id="cnt-down"><i class="ti-minus"></i></button>
																	  <input type="text" id="guestNo" name="guests" value="2" max="<?php echo e($adata['max_children']); ?>"/>
																	  <button class="counter-btn" type="button" id="cnt-up"><i class="ti-plus"></i></button>
																</div>
																
															</div>
														</div>
													</div>
												</div>

												<div class="col-lg-6 col-md-6 col-sm-6 col-6 small-spilx brl">
													<div class="form-group">
														<div class="guests">
															<div class="advance-bboking">
															
																<div class="guest-type">
																	<h5>Child</h5>
																	<span><?php echo e($adata['max_children']); ?> max.</span>
																</div>
																
																<div class="guests-box">
																	<button class="counter-btn" type="button" id="kcnt-down"><i class="ti-minus"></i></button>
																	<input type="text" id="kidsNo" name="kids" value="0" max="<?php echo e($adata['max_children']); ?>"/>
																	<button class="counter-btn" type="button" id="kcnt-up"><i class="ti-plus"></i></button>
																</div>
																
															</div>
														</div>
													</div>
												</div>
											</div>
											
										</div>
										<!-- Single Row Booking -->
										
										
									</div>
									
									<div class="side-booking-footer light">
										<div class="stbooking-footer-top">
											<div class="stbooking-left">
												<h5 class="st-subtitle">Total:</h5>
												<span>Expected Tax</span>
											</div>
											<h4 class="stbooking-title">&#8358;<?php echo e(number_format($adata['amount'],2)); ?></h4>
										</div>
										<div class="stbooking-footer-bottom">
											<a href="javascript:void(0)" id="apartment-hostchat-btn" class="books-btn btn-theme">Chat with host</a>
											<a href="<?php echo e(url('checkout')); ?>" id="apartment-book-now-btn" class="books-btn black">Checkout</a>
										</div>
									</div>
									
								</div>
							</div>
							
							<div class="page-sidebar" id="apartment-hostchat">
							
								<!-- Agent Detail -->
								<div class="agent-widget">
								   <input type="hidden" id="tk-apt-chat" value="<?php echo e(csrf_token()); ?>"/>
								   <input type="hidden" id="apt-id" value="<?php echo e($apartment['apartment_id']); ?>"/>
									<div class="agent-title">
										<div class="agent-photo"><img src="assets/img/user-3.jpg" alt=""></div>
										<div class="agent-details">
											<h4><a href="javascript:void(0)"><?php echo e($hostName); ?></a></h4>
											<span><i class="ti-mobile"></i><?php echo e($hostNum); ?></span>
										</div>
										<div class="clearfix"></div>
									</div>

									<div class="form-group">
										<label>Full Name</label>
										<input type="text" class="form-control" id="apt-message-name" value="<?php echo e($myName); ?>" placeholder="Your Name">
									</div>
									<div class="form-group">
										<label>Your Email</label>
										<input type="text" class="form-control" id="apt-message-email" value="<?php echo e($myEmail); ?>" placeholder="Your Email">
									</div>
									<div class="form-group">
										<label>Message</label>
										<textarea class="form-control" id="apt-message-msg" placeholder="Send a message to <?php echo e($host['fname']); ?>..."></textarea>
									</div>
									<button class="btn btn-theme full-width" id="apt-chat-btn">Send</button>
									<h4 class="text-primary" id="apt-chat-loading">Sending.. <img alt="Loading.." src="<?php echo e(asset('img/loading.gif')); ?>"></h4>
									<h4 class="text-primary" id="apt-chat-finish"><b>Message sent!</b></h4>
								</div>
								
								<!-- Statics Info -->
								<div class="tr-single-box">
									<div class="tr-single-header">
										<h4><i class="ti-bar-chart"></i> Stats</h4>
									</div>
									
									<div class="tr-single-body">
										<ul class="extra-service half">
											<li>
												<div class="icon-box-icon-block">
													<a href="#">
														<div class="icon-box-round">
															<i class="ti-star"></i>
														</div>
														<div class="icon-box-text">
															4.5 Rating
														</div>
													</a>
												</div>
											</li>
											
											<li>
												<div class="icon-box-icon-block">
													<a href="#">
														<div class="icon-box-round">
															<i class="ti-bookmark"></i>
														</div>
														<div class="icon-box-text">
															20 Bookmarked
														</div>
													</a>
												</div>
											</li>
											
											<li>
												<div class="icon-box-icon-block">
													<a href="#">
														<div class="icon-box-round">
															<i class="ti-eye"></i>
														</div>
														<div class="icon-box-text">
															785 Views
														</div>
													</a>
												</div>
											</li>
											
											<li>
												<div class="icon-box-icon-block">
													<a href="#">
														<div class="icon-box-round">
															<i class="ti-share"></i>
														</div>
														<div class="icon-box-text">
															110 Shared
														</div>
													</a>
												</div>
											</li>
											
											<li>
												<div class="icon-box-icon-block">
													<a href="#">
														<div class="icon-box-round">
															<i class="ti-comment-alt"></i>
														</div>
														<div class="icon-box-text">
															22 comments
														</div>
													</a>
												</div>
											</li>
											
											<li>
												<div class="icon-box-icon-block">
													<a href="#">
														<div class="icon-box-round">
															<i class="ti-heart"></i>
														</div>
														<div class="icon-box-text">
															20 Likes
														</div>
													</a>
												</div>
											</li>
											
										</ul>
									</div>
									
								</div>
								
								<!-- Business Info -->
								<div class="tr-single-box">
									<div class="tr-single-header">
										<h4><i class="ti-direction"></i>Landmarks/Interesting Places</h4>
									</div>
									
									<div class="tr-single-body">
										<ul class="extra-service">
										   <?php
										    for($i = 0; $i < 5; $i++)
											{
										   ?>
											<li>
												<div class="icon-box-icon-block">
													<a href="javascript:void(0)">
														<div class="icon-box-round">
															<i class="lni-map-marker"></i>
														</div>
														<div class="icon-box-text">
															Landmark <?php echo e($i + 1); ?>

														</div>
													</a>
												</div>
											</li>
											<?php
											}
											?>
											
										</ul>
									</div>
									
								</div>
						
								<!-- Tags -->
								<div class="tr-single-box">
									<div class="tr-single-header">
										<h4><i class="lni-tag"></i> Tags</h4>
									</div>
									
									<div class="tr-single-body">
										<ul class="extra-service half">
											<li>
												<div class="icon-box-icon-block">
													<a href="#">
														<div class="icon-box-round">
															<i class="lni-car-alt"></i>
														</div>
														<div class="icon-box-text">
															Car Parking
														</div>
													</a>
												</div>
											</li>
											
											<li>
												<div class="icon-box-icon-block">
													<a href="#">
														<div class="icon-box-round">
															<i class="lni-signal"></i>
														</div>
														<div class="icon-box-text">
															Wifi
														</div>
													</a>
												</div>
											</li>
											
											<li>
												<div class="icon-box-icon-block">
													<a href="#">
														<div class="icon-box-round">
															<i class="lni-emoji-happy"></i>
														</div>
														<div class="icon-box-text">
															Wait Staff
														</div>
													</a>
												</div>
											</li>
											
											<li>
												<div class="icon-box-icon-block">
													<a href="#">
														<div class="icon-box-round">
															<i class="lni-wheelchair"></i>
														</div>
														<div class="icon-box-text">
															Wheelchair
														</div>
													</a>
												</div>
											</li>
											
											<li>
												<div class="icon-box-icon-block">
													<a href="#">
														<div class="icon-box-round">
															<i class="lni-music"></i>
														</div>
														<div class="icon-box-text">
															Music & Bar
														</div>
													</a>
												</div>
											</li>
											
											<li>
												<div class="icon-box-icon-block">
													<a href="#">
														<div class="icon-box-round">
															<i class="ti-widget"></i>
														</div>
														<div class="icon-box-text">
															Swimming
														</div>
													</a>
												</div>
											</li>
											
										</ul>
									</div>
									
								</div>								
							
							</div>
						</div>
						
					</div>
				</div>
			</section>
			<!-- ============================ Property Detail End ================================== -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\etuk-web\resources\views/apartment.blade.php ENDPATH**/ ?>