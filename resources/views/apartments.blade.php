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
 let page = 0, perPage = 8, apartments = [], viewType = "grid", apartmentsLength = 0;
 
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
$location = ucwords($address['city'].", ".$address['state']);
$stars = $a['rating'];
$amount = $adata['amount'];
$description = $adata['description'];
$rr = count($apartments) == 1 ? "Result" : "Results";
	?>
		  
		  temp = {
			   apartment_id: "{{$a['apartment_id']}}",
			   name: "{{$a['name']}}",
			   uu: "{{$uu}}",
			   lu: "{{$lu}}",
			   bu: "{{$bu}}",
			   location: "{{$location}}",
			   description: `{!! $description !!}`,
			   stars: "{{$stars}}",
			   facilities: "{{json_encode($facilities,JSON_HEX_APOS|JSON_HEX_QUOT) }}".replace(/&quot;/g, '\"'),
			   reviews: "{{count($a['reviews'])}}",
			   amount: "{{number_format($amount,2)}}",
			   img: "{{$img}}",
			   status: "{{$a['status']}}",
		   };
		   apartments.push(temp);
	<?php
		   }	
	?>
 
 
  $(document).ready(() => {
	  $('#apartments-loading').hide();
	  //console.log("apartments: ",apartments);
      apartmentsLength = apartments.length;
      showPage(1);
  });
</script>
<!-- =================== Sidebar Search ==================== -->
			<section class="gray">
				<div class="container">
					<div class="row">
						@include('guest-apt-sidebar',['apf' => $apf])
							
						<div class="order-1 content-area col-lg-8 col-md-12 order-md-1 order-lg-2">
							<div class="row">
							
								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="shorting-wrap">
										<h5 class="shorting-title">{{count($apartments)}} {{$rr}}</h5>
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
							
							<div class="row m-0" id="apartments">
								
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
									  <a class="btn btn-info" onclick="showPage({{$i+1}});">{{$i+1}}</a>
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
