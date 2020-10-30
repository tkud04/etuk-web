@extends('layout')

@section('title',"Welcome")

@section('scripts')
<?php
$def = [
  'avb' => "available",
  'city' => "",
  'state' => "none",
  'amount' => "0",
  'rating' => "4",
  'id_required' => "yes",
  'children' => "none",
  'pets' => "no",
  'max_adults' => "4",
  'max_children' => "0",
  'facilities' => []
];

if(count($apf) > 0) $def = $apf;
?>
<script>
let landingSearchDT = {
				avb: "{{$def['avb']}}",
				city: "{{$def['city']}}",
				state: "{{$def['state']}}",
				max_adults: "{{$def['max_adults']}}",
				max_children: "{{$def['max_children']}}",
				amount: "{{$def['amount']}}",
				id_required: "{{$def['id_required']}}",
				children: "{{$def['children']}}",
				pets: "{{$def['pets']}}",
				facilities: [
				<?php
				  if(count($def['facilities']) > 0)
				  {
					 for($i = 0; $i < count($def['facilities']); $i++)
					 {
						 $f = $def['facilities'][$i];
						 $ss = $i != count($def['facilities']) - 1 ? "," : ""
				?>
				   "{{$f['facility']}}"{{$ss}}
				<?php
					 }
				  }
				?>
				],
				rating: "{{$def['rating']}}"
			};
</script>
@stop

@section('content')

@include('banner',['def' => $def])

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
									<h4>1,000+ Choice Apartments</h4>
									<p>With 5-star hospitality</p>
								</div>
							</div>
						</div>
						
						<div class="col-lg-4 col-md-4">
							<div class="facts-wrap">
								<div class="facts-icon">
									<i class="theme-cl ti-shine"></i>
								</div>
								<div class="facts-detail">
									<h4>Home Away</h4>
									<p>A home away from home</p>
								</div>
							</div>
						</div>
						
						<div class="col-lg-4 col-md-4">
							<div class="facts-wrap">
								<div class="facts-icon">
									<i class="theme-cl ti-face-smile"></i>
								</div>
								<div class="facts-detail">
									<h4>98% Happy Guests</h4>
									<p>We strive to serve you better</p>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</section>
			<!-- ================= End true Facts ========================= -->
			
			
						<!-- ================= Apartments start ========================= -->
			<section class="min">
				<div class="container">
				
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="sec-heading center">
								<h2>Featured</h2>
							</div>
						</div>
					</div>
					
					<div class="row">
						<?php
						 $popularApartmentss = [
						   ['img' => asset('img/des-2.jpg'),'href' => "javascript-void(0)", 'tc' => "5",'location' => "Ikeja, Lagos",'stars' => "5", 'amount' => "20000"],
						   ['img' => asset('img/des-3.jpg'),'href' => "javascript-void(0)", 'tc' => "6",'location' => "Ikorodu, Lagos",'stars' => "3", 'amount' => "10000"],
						   ['img' => asset('img/des-4.jpg'),'href' => "javascript-void(0)", 'tc' => "5",'location' => "Victoria Island, Lagos",'stars' => "5", 'amount' => "20000"],
						   ['img' => asset('img/des-5.jpg'),'href' => "javascript-void(0)", 'tc' => "5",'location' => "Bodija, Oyo",'stars' => "3", 'amount' => "7000"],
						   ['img' => asset('img/des-6.jpg'),'href' => "javascript-void(0)", 'tc' => "7",'location' => "Mokola, Ibadan",'stars' => "4", 'amount' => "10000"],
						   ['img' => asset('img/des-7.jpg'),'href' => "javascript-void(0)", 'tc' => "7",'location' => "Yaba, Lagos",'stars' => "4", 'amount' => "10000"],
						 ];
						 
						 foreach($popularApartments as $pa)
						 {
							 $pt = [];
$adata = $pa['data'];
$address = $pa['address'];
$cmedia = $pa['cmedia'];
$imgs = $cmedia['images'];

$pt['img'] = $imgs[0];
$pt['href'] = url('apartment')."?xf=".$pa['url'];
$pt['tc'] = $adata['max_adults'];
$pt['location'] = $address['city'].", ".$address['state'];
$pt['stars'] = $pa['rating'];
$pt['amount'] = $adata['amount'];
$pt['name'] = $pa['name'];
						?>
						<!-- Single Tour Place -->
						<div class="col-lg-4 col-md-6 col-sm-12">
							<div class="tour-simple-wrap">
								<div class="tour-simple-thumb">
									<a href="{{$pt['href']}}"><img src="{{$pt['img']}}" class="img-fluid img-responsive" alt="{{$pt['name']}}" style="width: 348px; height: 237px;"/></a>
								</div>
								<div class="tour-simple-caption">
									<div class="ts-caption-left">
										<h4 class="ts-title">
										 <a href="{{$pt['href']}}">{{$pt['name']}}</a><br>
										 <a href="javascript:void(0)">{{$pt['location']}}</a>
										</h4>
										<span>{{$pt['tc']}} adults max.</span>
									</div>
									<div class="ts-caption-right">
										<div class="ts-caption-rating">
										   @for($i = 0; $i < $pt['stars']; $i++)
											<i class="ti-star filled"></i>
										   @endfor
										   @for($i = 0; $i < 5 - $pt['stars']; $i++)
											<i class="ti-star"></i>
										   @endfor
										</div>
										<h5 class="ts-price">&#8358;{{number_format($pt['amount'],2)}}</h5>
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
			<!-- ========================= End Apartment Section ============================ -->
			
			
			<!-- ================= Ads start ========================= -->
			<section class="gray">
				<div class="container">
					
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="owl-carousel owl-theme" id="lists-slide">
								
								<div class="single-item">
									<div class="destination-item">
										<span class="discount-off">
										  <i class="ti-thumbs-up"></i>35
										</span>
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
										<span class="discount-off"> <i class="ti-thumbs-up"></i>35</span>
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
			<!-- ========================= End Ads Section ============================ -->
			
			
										<!-- ================= Apartments start ========================= -->
			<section class="min">
				<div class="container">
				
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="sec-heading center">
								<h2>Top Apartments</h2>
							</div>
						</div>
					</div>
					
					<div class="row">
						<?php
						 $popularApartmentss = [
						   ['img' => asset('img/des-2.jpg'),'href' => "javascript-void(0)", 'tc' => "5",'location' => "Ikeja, Lagos",'stars' => "5", 'amount' => "20000"],
						   ['img' => asset('img/des-3.jpg'),'href' => "javascript-void(0)", 'tc' => "6",'location' => "Ikorodu, Lagos",'stars' => "3", 'amount' => "10000"],
						   ['img' => asset('img/des-4.jpg'),'href' => "javascript-void(0)", 'tc' => "5",'location' => "Victoria Island, Lagos",'stars' => "5", 'amount' => "20000"],
						   ['img' => asset('img/des-5.jpg'),'href' => "javascript-void(0)", 'tc' => "5",'location' => "Bodija, Oyo",'stars' => "3", 'amount' => "7000"],
						   ['img' => asset('img/des-6.jpg'),'href' => "javascript-void(0)", 'tc' => "7",'location' => "Mokola, Ibadan",'stars' => "4", 'amount' => "10000"],
						   ['img' => asset('img/des-7.jpg'),'href' => "javascript-void(0)", 'tc' => "7",'location' => "Yaba, Lagos",'stars' => "4", 'amount' => "10000"],
						 ];
						 
						 foreach($popularApartments as $pa)
						 {
							 $pt = [];
$adata = $pa['data'];
$address = $pa['address'];
$cmedia = $pa['cmedia'];
$imgs = $cmedia['images'];

$pt['img'] = $imgs[0];
$pt['href'] = url('apartment')."?xf=".$pa['url'];
$pt['tc'] = $adata['max_adults'];
$pt['location'] = $address['city'].", ".$address['state'];
$pt['stars'] = $pa['rating'];
$pt['amount'] = $adata['amount'];
$pt['name'] = $pa['name'];
						?>
						<!-- Single Tour Place -->
						<div class="col-lg-4 col-md-6 col-sm-12">
							<div class="tour-simple-wrap">
								<div class="tour-simple-thumb">
									<a href="{{$pt['href']}}"><img src="{{$pt['img']}}" class="img-fluid img-responsive" alt="{{$pt['name']}}" style="width: 348px; height: 237px;"/></a>
								</div>
								<div class="tour-simple-caption">
									<div class="ts-caption-left">
										<h4 class="ts-title">
										 <a href="{{$pt['href']}}">{{$pt['name']}}</a><br>
										 <a href="javascript:void(0)">{{$pt['location']}}</a>
										</h4>
										<span>{{$pt['tc']}} adults max.</span>
									</div>
									<div class="ts-caption-right">
										<div class="ts-caption-rating">
										   @for($i = 0; $i < $pt['stars']; $i++)
											<i class="ti-star filled"></i>
										   @endfor
										   @for($i = 0; $i < 5 - $pt['stars']; $i++)
											<i class="ti-star"></i>
										   @endfor
										</div>
										<h5 class="ts-price">&#8358;{{number_format($pt['amount'],2)}}</h5>
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
			<!-- ========================= End Apartment Section ============================ -->

      @include('recent-blog')
      @include('newsletter-cta')
			
@stop