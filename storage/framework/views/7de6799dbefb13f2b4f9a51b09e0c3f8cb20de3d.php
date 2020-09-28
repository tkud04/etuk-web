<?php $__env->startSection('title',"Welcome"); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- ================= true Facts start ========================= -->
			<section class="facts">
				<div class="container">
					<div class="row">
						
						<div class="col-lg-4 col-md-4">
							<div class="facts-wrap">
								<div class="facts-icon">
									<i class="theme-cl ti-location-pin"></i>
								</div>
								<div class="facts-detail">
									<h4>1,000+ Local Tours</h4>
									<p>Morbi semper fames lobortis ac hac</p>
								</div>
							</div>
						</div>
						
						<div class="col-lg-4 col-md-4">
							<div class="facts-wrap">
								<div class="facts-icon">
									<i class="theme-cl ti-shine"></i>
								</div>
								<div class="facts-detail">
									<h4>Winter Destinations</h4>
									<p>Morbi semper fames lobortis ac hac</p>
								</div>
							</div>
						</div>
						
						<div class="col-lg-4 col-md-4">
							<div class="facts-wrap">
								<div class="facts-icon">
									<i class="theme-cl ti-face-smile"></i>
								</div>
								<div class="facts-detail">
									<h4>98% Happy Travelers</h4>
									<p>Morbi semper fames lobortis ac hac</p>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</section>
			<!-- ================= End true Facts ========================= -->
			
			
						<!-- ================= Travel start ========================= -->
			<section class="min">
				<div class="container">
				
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="sec-heading center">
								<p>Popular Travel Packages</p>
								<h2>Featured Travel Packages</h2>
							</div>
						</div>
					</div>
					
					<div class="row">
						<?php
						 $popularTravels = [
						   ['img' => asset('img/des-2.jpg'),'href' => "javascript-void(0)", 'tc' => "5",'location' => "Ikeja, Lagos",'stars' => "4", 'amount' => "20000"],
						   ['img' => asset('img/des-3.jpg'),'href' => "javascript-void(0)", 'tc' => "6",'location' => "Ikorodu, Lagos",'stars' => "4", 'amount' => "10000"],
						   ['img' => asset('img/des-4.jpg'),'href' => "javascript-void(0)", 'tc' => "5",'location' => "Victoria Island, Lagos",'stars' => "4", 'amount' => "20000"],
						   ['img' => asset('img/des-5.jpg'),'href' => "javascript-void(0)", 'tc' => "5",'location' => "Bodija, Oyo",'stars' => "4", 'amount' => "7000"],
						   ['img' => asset('img/des-6.jpg'),'href' => "javascript-void(0)", 'tc' => "7",'location' => "Mokola, Ibadan",'stars' => "4", 'amount' => "10000"],
						   ['img' => asset('img/des-7.jpg'),'href' => "javascript-void(0)", 'tc' => "7",'location' => "Yaba, Lagos",'stars' => "4", 'amount' => "10000"],
						 ];
						 
						 foreach($popularTravels as $pt)
						 {
						?>
						<!-- Single Tour Place -->
						<div class="col-lg-4 col-md-6 col-sm-12">
							<div class="tour-simple-wrap">
								<div class="tour-simple-thumb">
									<a href="<?php echo e($pt['href']); ?>"><img src="<?php echo e($pt['img']); ?>" class="img-fluid img-responsive" alt="" /></a>
								</div>
								<div class="tour-simple-caption">
									<div class="ts-caption-left">
										<h4 class="ts-title"><a href="tour-detail.html"><?php echo e($pt['location']); ?></a></h4>
										<span><?php echo e($pt['tc']); ?> persons max.</span>
									</div>
									<div class="ts-caption-right">
										<div class="ts-caption-rating">
											<i class="ti-star filled"></i>
											<i class="ti-star filled"></i>
											<i class="ti-star filled"></i>
											<i class="ti-star filled"></i>
											<i class="ti-star"></i>
										</div>
										<h5 class="ts-price">&#8358;<?php echo e(number_format($pt['amount'],2)); ?></h5>
									</div>
								</div>
							</div>
						</div>
						<?php
						 }
						?>
						
						
					</div>
				
				</div>
			</section>
			<!-- ========================= End Travel Section ============================ -->
			
			
			<!-- ================= Activities start ========================= -->
			<section class="gray">
				<div class="container">
					
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="sec-heading center">
								<p>Top Travel Activities</p>
								<h2>New & featured Travel Activities</h2>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="owl-carousel owl-theme" id="lists-slide">
								
								<div class="single-item">
									<div class="destination-item">
										<span class="discount-off">-35%</span>
										<figure class="destination-list-wrap">
											<a class="destination-listlink" href="search.html">
												<img class="cover" src="<?php echo e(asset('img/cat-1.jpg')); ?>" alt="room">
											</a>
										</figure>
										<div class="destination-listdetails">
											<span class="destination-list-cat theme-bg">Eat & Drinks</span>
											<h4 class="title"><a class="title-ln" href="search.html">Machu Picchu, Peru</a></h4>
											<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
										</div>
									</div>
								</div>
								
								<div class="single-item">
									<div class="destination-item">
										<span class="discount-off">-50%</span>
										<figure class="destination-list-wrap">
											<a class="destination-listlink" href="search.html">
												<img class="cover" src="<?php echo e(asset('img/cat-7.jpg')); ?>" alt="room">
											</a>
										</figure>
										<div class="destination-listdetails">
											<span class="destination-list-cat theme-bg">Adventures</span>
											<h4 class="title"><a class="title-ln" href="search.html">Great Barrier Reef</a></h4>
											<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
										</div>
									</div>
								</div>
								
								<div class="single-item">
									<div class="destination-item">
										<span class="discount-off">-10%</span>
										<figure class="destination-list-wrap">
											<a class="destination-listlink" href="search.html">
												<img class="cover" src="<?php echo e(asset('img/cat-3.jpg')); ?>" alt="room">
											</a>
										</figure>
										<div class="destination-listdetails">
											<span class="destination-list-cat theme-bg">Restaurants</span>
											<h4 class="title"><a class="title-ln" href="search.html">Pyramids of Giza</a></h4>
											<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
										</div>
									</div>
								</div>
								
								<div class="single-item">
									<div class="destination-item">
										<span class="discount-off">-20%</span>
										<figure class="destination-list-wrap">
											<a class="destination-listlink" href="search.html">
												<img class="cover" src="<?php echo e(asset('img/cat-4.jpg')); ?>" alt="room">
											</a>
										</figure>
										<div class="destination-listdetails">
											<span class="destination-list-cat theme-bg">Hotel & Rooms</span>
											<h4 class="title"><a class="title-ln" href="search.html">Heritage of England</a></h4>
											<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
										</div>
									</div>
								</div>
								
								<div class="single-item">
									<div class="destination-item">
										<span class="discount-off">-30%</span>
										<figure class="destination-list-wrap">
											<a class="destination-listlink" href="search.html">
												<img class="cover" src="<?php echo e(asset('img/cat-5.jpg')); ?>" alt="room">
											</a>
										</figure>
										<div class="destination-listdetails">
											<span class="destination-list-cat theme-bg">Hike & Ride</span>
											<h4 class="title"><a class="title-ln" href="search.html">The City of Lights </a></h4>
											<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
										</div>
									</div>
								</div>
							
							</div>
						</div>
					</div>
					
				</div>
			</section>
			<!-- ========================= End Activities Section ============================ -->

      <?php echo $__env->make('recent-blog', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php echo $__env->make('newsletter-cta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\bkupp\lokl\repo\etuk-web\resources\views/index.blade.php ENDPATH**/ ?>