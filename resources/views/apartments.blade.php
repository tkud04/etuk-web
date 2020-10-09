<?php
$title = "Apartments";
$subtitle = "List of available apartments on ".date("jS F, Y");
?>
@extends('layout')

@section('title',$title)

@section('top-header')
@include('top-header')
@stop

@section('content')
@include('banner-2',['title' => $title,'subtitle' => $subtitle])
<script>
 let page = 1, perPage = 9, apartments = [];
 
  <?php
		   foreach($apartments as $a)
		   {
			   $terms = $a['terms'];
			   $facilities = $a['facilities'];
$adata = $a['data'];
$address = $a['address'];
$cmedia = $a['cmedia'];
$imgs = $cmedia['images'];
$video = $cmedia['video'];

$img = $imgs[0];
$uu = url('apartment')."?xf=".$a['url'];
$lu = url('like')."?xf=".$a['url'];
$bu = url('bookmark')."?xf=".$a['url'];
$tc = $adata['max_adults'];
$location = $address['city'].", ".$address['state'];
$stars = $a['rating'];
$amount = $adata['amount'];
$description = $adata['description'];
			    
	?>
		  
		  temp = {
			   apartment_id: "{{$a['apartment_id']}}",
			   name: "{{$a['name']}}",
			   uu: "{{$uu}}",
			   lu: "{{$lu}}",
			   bu: "{{$bu}}",
			   location: "{{$location}}",
			   description: `{{$description}}`,
			   stars: "{{$stars}}",
			   facilities: "{{json_encode($facilities,JSON_HEX_APOS|JSON_HEX_QUOT) }}".replace(/&quot;/g, '\"'),
			   reviews: "{{count($a['reviews'])}}",
			   amount: "{{number_format($amount,2)}}",
			   img: "{{$img}}",
		   };
		   apartments.push(temp);
	<?php
		   }	
	?>
 
 
  $(document).ready(() => {
	  $('#apartments-loading').hide();
  });
</script>
<!-- =================== Sidebar Search ==================== -->
			<section class="gray">
				<div class="container">
					<div class="row">
						@include('guest-apt-sidebar')
							
						<div class="order-1 content-area col-lg-8 col-md-12 order-md-1 order-lg-2">
							<div class="row">
							
								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="shorting-wrap">
										<h5 class="shorting-title">507 Results</h5>
										<div class="shorting-right">
											<label>Short By:</label>
											<div class="dropdown show">
												<a class="btn btn-filter dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<span class="selection">Most Rated</span>
												</a>
												<div class="drp-select dropdown-menu">
													<a class="dropdown-item" href="javascript:void(0);">Most Rated</a>
													<a class="dropdown-item" href="javascript:void(0);">Most Viewd</a>
													<a class="dropdown-item" href="javascript:void(0);">News Listings</a>
													<a class="dropdown-item" href="javascript:void(0);">High Rated</a>
												</div>
											</div>
										</div>
										<div class="shorting-right" style="margin-left: 20px;">
											<label>View:</label>
											<div class="dropdown show">
												<a class="btn btn-filter dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<span class="selection">Grid</span>
												</a>
												<div class="drp-select dropdown-menu">
													<a class="dropdown-item" href="javascript:void(0);" onclick="aptShowGrid()">Grid</a>
													<a class="dropdown-item" href="javascript:void(0);" onclick="aptShowList()">List</a>
												</div>
											</div>
										</div>
									</div>
								</div>
								
							</div>
							
							<div class="row m-0">
								<!-- Single Place -->
								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="singlePlaceitem">
										<figure class="singlePlacewrap">
											<a class="place-link" href="hotel.html">
												<img class="cover" src="assets/img/hotel/hotel-6.jpg" alt="room">
											</a>
										</figure>
										<div class="placeDetail">
											<span class="onsale-section"><span class="onsale">45% Off</span></span>
											<div class="placeDetail-left">
												<div class="item-rating">
													<i class="fa fa-star filled"></i>
													<i class="fa fa-star filled"></i>
													<i class="fa fa-star filled"></i>
													<i class="fa fa-star filled"></i>
													<i class="fa fa-star"></i>
													<span>(48) Reviews</span>
												</div>
												<h4 class="title"><a href="hotel.html">Atlantis Seaside Hotel</a></h4>
												<span class="placeDetail-detail"><i class="ti-location-pin"></i>London, England</span>
											</div>
											<div class="pricedetail-box">
											<h6 class="price-title-cut">$1199</h6>
											<h4 class="price-title">$799</h4>
											</div>
										</div>
									</div>
								</div>
								
								<!-- Single Place -->
								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="singlePlaceitem">
										<figure class="singlePlacewrap">
											<a class="place-link" href="hotel.html">
												<img class="cover" src="assets/img/hotel/hotel-11.jpg" alt="room">
											</a>
										</figure>
										<div class="placeDetail">
											<span class="onsale-section"><span class="onsale">32% Off</span></span>
											<div class="placeDetail-left">
												<div class="item-rating">
													<i class="fa fa-star filled"></i>
													<i class="fa fa-star filled"></i>
													<i class="fa fa-star filled"></i>
													<i class="fa fa-star filled"></i>
													<i class="fa fa-star"></i>
													<span>(38) Reviews</span>
												</div>
												<h4 class="title"><a href="hotel.html">Fairyland Hotel</a></h4>
												<span class="placeDetail-detail"><i class="ti-location-pin"></i>Florence, Italy</span>
											</div>
											<div class="pricedetail-box">
											<h6 class="price-title-cut">$1299</h6>
											<h4 class="price-title">$870</h4>
											</div>
										</div>
									</div>
								</div>
								
								<!-- Single Place -->
								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="singlePlaceitem">
										<figure class="singlePlacewrap">
											<a class="place-link" href="hotel.html">
												<img class="cover" src="assets/img/hotel/hotel-7.jpg" alt="room">
											</a>
										</figure>
										<div class="placeDetail">
											<span class="onsale-section"><span class="onsale">29% Off</span></span>
											<div class="placeDetail-left">
												<div class="item-rating">
													<i class="fa fa-star filled"></i>
													<i class="fa fa-star filled"></i>
													<i class="fa fa-star filled"></i>
													<i class="fa fa-star filled"></i>
													<i class="fa fa-star"></i>
													<span>(40) Reviews</span>
												</div>
												<h4 class="title"><a href="hotel.html">Fairyland Resort</a></h4>
												<span class="placeDetail-detail"><i class="ti-location-pin"></i>Egypt, USA</span>
											</div>
											<div class="pricedetail-box">
											<h6 class="price-title-cut">$1090</h6>
											<h4 class="price-title">$870</h4>
											</div>
										</div>
									</div>
								</div>
								
								<!-- Single Place -->
								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="singlePlaceitem">
										<figure class="singlePlacewrap">
											<a class="place-link" href="hotel.html">
												<img class="cover" src="assets/img/hotel/hotel-9.jpg" alt="room">
											</a>
										</figure>
										<div class="placeDetail">
											<span class="onsale-section"><span class="onsale">30% Off</span></span>
											<div class="placeDetail-left">
												<div class="item-rating">
													<i class="fa fa-star filled"></i>
													<i class="fa fa-star filled"></i>
													<i class="fa fa-star filled"></i>
													<i class="fa fa-star filled"></i>
													<i class="fa fa-star"></i>
													<span>(48) Reviews</span>
												</div>
												<h4 class="title"><a href="hotel.html">Saffron Tundra Hotel</a></h4>
												<span class="placeDetail-detail"><i class="ti-location-pin"></i>Cologne, Germany</span>
											</div>
											<div class="pricedetail-box">
											<h6 class="price-title-cut">$1099</h6>
											<h4 class="price-title">$899</h4>
											</div>
										</div>
									</div>
								</div>
								
								<!-- Single Place -->
								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="singlePlaceitem">
										<figure class="singlePlacewrap">
											<a class="place-link" href="hotel.html">
												<img class="cover" src="assets/img/hotel/hotel-8.jpg" alt="room">
											</a>
										</figure>
										<div class="placeDetail">
											<span class="onsale-section"><span class="onsale">50% Off</span></span>
											<div class="placeDetail-left">
												<div class="item-rating">
													<i class="fa fa-star filled"></i>
													<i class="fa fa-star filled"></i>
													<i class="fa fa-star filled"></i>
													<i class="fa fa-star filled"></i>
													<i class="fa fa-star"></i>
													<span>(78) Reviews</span>
												</div>
												<h4 class="title"><a href="hotel.html">The Great Barrier Reef</a></h4>
												<span class="placeDetail-detail"><i class="ti-location-pin"></i>Puebla, Mexico</span>
											</div>
											<div class="pricedetail-box">
											<h6 class="price-title-cut">$1199</h6>
											<h4 class="price-title">$599</h4>
											</div>
										</div>
									</div>
								</div>
								
								<!-- Single Place -->
								<div class="col-lg-6 col-md-6 col-sm-12">
									<div class="singlePlaceitem">
										<figure class="singlePlacewrap">
											<a class="place-link" href="hotel.html">
												<img class="cover" src="assets/img/hotel/hotel-1.jpg" alt="room">
											</a>
										</figure>
										<div class="placeDetail">
											<span class="onsale-section"><span class="onsale">40% Off</span></span>
											<div class="placeDetail-left">
												<div class="item-rating">
													<i class="fa fa-star filled"></i>
													<i class="fa fa-star filled"></i>
													<i class="fa fa-star filled"></i>
													<i class="fa fa-star filled"></i>
													<i class="fa fa-star"></i>
													<span>(64) Reviews</span>
												</div>
												<h4 class="title"><a href="hotel.html">Remote Peaks Resort</a></h4>
												<span class="placeDetail-detail"><i class="ti-location-pin"></i>Bergen, Norway</span>
											</div>
											<div class="pricedetail-box">
											<h6 class="price-title-cut">$2000</h6>
											<h4 class="price-title">$1200</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="row m-0">

								<div class="col-md-12 col-sm-12 mt-3" id="apartments-submit">
									<div class="text-center">
									  <a class="btn btn-theme" onclick="showPreviousPage();">Previous</a>
									  <?php
						               $pages = (count($apartments) < 9) ? 1 : ceil(count($apartments) / 9);
					                   for($i = 0; $i < $pages; $i++)
						                {
					                  ?>
									  <a class="btn btn-info" onclick="showNextPage({{$i+1}});">{{$i+1}}</a>
									   <?php
						                }
						               ?>
									  <a class="btn btn-theme" onclick="showNextPage();">Next</a>
									</div>
								</div>	
								<div class="col-md-12 col-sm-12 mt-3" id="apartments-loading">
									<div class="text-center">
										
										<div class="spinner-grow text-danger" role="status">
										  <span class="sr-only">Loading...</span>
										</div>
										<div class="spinner-grow text-warning" role="status">
										  <span class="sr-only">Loading...</span>
										</div>
										<div class="spinner-grow text-success" role="status">
										  <span class="sr-only">Loading...</span>
										</div>
										
									</div>
								</div>
								
							</div>
							
						</div>
					</div>
				</div>
			</section>
			<!-- =================== Sidebar Search ==================== -->

@stop