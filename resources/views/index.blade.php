@extends('layout')

@section('title',"Welcome")

@section('content')

@include('banner')

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
						
						<!-- Single Tour Place -->
						<div class="col-lg-4 col-md-6 col-sm-12">
							<div class="tour-simple-wrap">
								<div class="tour-simple-thumb">
									<a href="tour-detail.html"><img src="{{asset('img/des-2.jpg')}}" class="img-fluid img-responsive" alt="" /></a>
								</div>
								<div class="tour-simple-caption">
									<div class="ts-caption-left">
										<h4 class="ts-title"><a href="tour-detail.html">Cologne, Germany</a></h4>
										<span>5 Tour Package</span>
									</div>
									<div class="ts-caption-right">
										<div class="ts-caption-rating">
											<i class="ti-star filled"></i>
											<i class="ti-star filled"></i>
											<i class="ti-star filled"></i>
											<i class="ti-star filled"></i>
											<i class="ti-star"></i>
										</div>
										<h5 class="ts-price">$299.00</h5>
									</div>
								</div>
							</div>
						</div>
						
						<!-- Single Tour Place -->
						<div class="col-lg-4 col-md-6 col-sm-12">
							<div class="tour-simple-wrap">
								<div class="tour-simple-thumb">
									<a href="tour-detail.html"><img src="{{asset('img/des-3.jpg')}}" class="img-fluid img-responsive" alt="" /></a>
								</div>
								<div class="tour-simple-caption">
									<div class="ts-caption-left">
										<h4 class="ts-title"><a href="tour-detail.html">Monte Carlo, Monaco</a></h4>
										<span>7 Tour Package</span>
									</div>
									<div class="ts-caption-right">
										<div class="ts-caption-rating">
											<i class="ti-star filled"></i>
											<i class="ti-star filled"></i>
											<i class="ti-star filled"></i>
											<i class="ti-star filled"></i>
											<i class="ti-star filled"></i>
										</div>
										<h5 class="ts-price">$259.00</h5>
									</div>
								</div>
							</div>
						</div>
						
						<!-- Single Tour Place -->
						<div class="col-lg-4 col-md-6 col-sm-12">
							<div class="tour-simple-wrap">
								<div class="tour-simple-thumb">
									<a href="tour-detail.html"><img src="{{asset('img/des-4.jpg')}}" class="img-fluid img-responsive" alt="" /></a>
								</div>
								<div class="tour-simple-caption">
									<div class="ts-caption-left">
										<h4 class="ts-title"><a href="tour-detail.html">Puebla, Mexico</a></h4>
										<span>7 Tour Package</span>
									</div>
									<div class="ts-caption-right">
										<div class="ts-caption-rating">
											<i class="ti-star filled"></i>
											<i class="ti-star filled"></i>
											<i class="ti-star filled"></i>
											<i class="ti-star filled"></i>
											<i class="ti-star"></i>
										</div>
										<h5 class="ts-price">$350.00</h5>
									</div>
								</div>
							</div>
						</div>
						
						<!-- Single Tour Place -->
						<div class="col-lg-4 col-md-6 col-sm-12">
							<div class="tour-simple-wrap">
								<div class="tour-simple-thumb">
									<a href="tour-detail.html"><img src="{{asset('img/des-5.jpg')}}" class="img-fluid img-responsive" alt="" /></a>
								</div>
								<div class="tour-simple-caption">
									<div class="ts-caption-left">
										<h4 class="ts-title"><a href="tour-detail.html">Florence, Italy</a></h4>
										<span>4 Tour Package</span>
									</div>
									<div class="ts-caption-right">
										<div class="ts-caption-rating">
											<i class="ti-star filled"></i>
											<i class="ti-star filled"></i>
											<i class="ti-star filled"></i>
											<i class="ti-star filled"></i>
											<i class="ti-star"></i>
										</div>
										<h5 class="ts-price">$799.00</h5>
									</div>
								</div>
							</div>
						</div>
						
						<!-- Single Tour Place -->
						<div class="col-lg-4 col-md-6 col-sm-12">
							<div class="tour-simple-wrap">
								<div class="tour-simple-thumb">
									<a href="tour-detail.html"><img src="{{asset('img/des-6.jpg')}}" class="img-fluid img-responsive" alt="" /></a>
								</div>
								<div class="tour-simple-caption">
									<div class="ts-caption-left">
										<h4 class="ts-title"><a href="tour-detail.html">Bergen, Norway</a></h4>
										<span>3 Tour Package</span>
									</div>
									<div class="ts-caption-right">
										<div class="ts-caption-rating">
											<i class="ti-star filled"></i>
											<i class="ti-star filled"></i>
											<i class="ti-star filled"></i>
											<i class="ti-star filled"></i>
											<i class="ti-star"></i>
										</div>
										<h5 class="ts-price">$910.00</h5>
									</div>
								</div>
							</div>
						</div>
						
						<!-- Single Tour Place -->
						<div class="col-lg-4 col-md-6 col-sm-12">
							<div class="tour-simple-wrap">
								<div class="tour-simple-thumb">
									<a href="tour-detail.html"><img src="{{asset('img/des-7.jpg')}}" class="img-fluid img-responsive" alt="" /></a>
								</div>
								<div class="tour-simple-caption">
									<div class="ts-caption-left">
										<h4 class="ts-title"><a href="tour-detail.html">Puerto Vallarta, Mexico</a></h4>
										<span>5 Tour Package</span>
									</div>
									<div class="ts-caption-right">
										<div class="ts-caption-rating">
											<i class="ti-star filled"></i>
											<i class="ti-star filled"></i>
											<i class="ti-star filled"></i>
											<i class="ti-star filled"></i>
											<i class="ti-star"></i>
										</div>
										<h5 class="ts-price">$670.00</h5>
									</div>
								</div>
							</div>
						</div>
						
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
												<img class="cover" src="{{asset('img/cat-1.jpg')}}" alt="room">
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
												<img class="cover" src="{{asset('img/cat-7.jpg')}}" alt="room">
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
												<img class="cover" src="{{asset('img/cat-3.jpg')}}" alt="room">
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
												<img class="cover" src="{{asset('img/cat-4.jpg')}}" alt="room">
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
												<img class="cover" src="{{asset('img/cat-5.jpg')}}" alt="room">
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

      @include('recent-blog')
      @include('newsletter-cta')
			
@stop