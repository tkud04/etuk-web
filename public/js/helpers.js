const showElem = (name) => {
	let names = [];
	
	if(Array.isArray(name)){
	  names = name;
	}
	else{
		names.push(name);
	}
	
	for(let i = 0; i < names.length; i++){
		$(names[i]).fadeIn();
	}
}

const hideElem = (name) => {
	let names = [];
	
	if(Array.isArray(name)){
	  names = name;
	}
	else{
		names.push(name);
	}
	
	for(let i = 0; i < names.length; i++){
		$(names[i]).hide();
	}
}

const hideInputErrors = type => {
	let ret = [], types = [];
	
	if(Array.isArray(type)){
	  types = type;
	}
	else{
		types.push(type);
	}
	
	for(let i = 0; i < types.length; i++){
	  switch(types[i]){
		case "signup":
		  $('#signup-finish').html(`<b>Signup successful!</b><p class='text-primary'>Redirecting you to the home page.</p>`);
		  ret = ['#s-fname-error','#s-lname-error','#s-email-error','#s-phone-error','#s-pass-error','#s-pass2-error','#signup-finish'];	 
		break;
		
		case "login":
		  $('#login-finish').html(`<b>Signin successful!</b><p class='text-primary'>Redirecting you to your dashboard.</p>`);
	      ret = ['#l-id-error','#l-pass-error','#login-finish'];	 
		break;
		
		case "forgot-password":
		  $('#fp-finish').html(`<b>Request received!</b><p class='text-primary'>Please check your email for your password reset link.</p>`);
	      ret = ['#fp-id-error','#fp-finish'];	 
		break;
		
		case "reset-password":
		  $('#rp-finish').html(`<b>Password reset!</b><p class='text-primary'>You can now <a href="#" data-toggle="modal" data-target="#login">sign in</a>.</p>`);
	      ret = ['#rp-pass-error','#rp-pass-2-error','#fp-finish'];	 
		break;
	  }
	  hideElem(ret);
	}
}

const selectCheckoutSide = dt => {
	unselectCheckoutSide(dt);
	let iicon = `${dt.type}-active-${dt.side}`;
	$(iicon).addClass("active");
	selectedSide = dt.side;
}

const unselectCheckoutSide = (dt) => {
	let iicon = `${dt.type}-active-${selectedSide}`;
	
	$(iicon).removeClass("active");
}

const selectCheckoutSide2 = dt => {
	let iicon = `${dt.type}-active-${dt.side}`;
	
	$(iicon).html(dt.content);
}

const signup = dt => {

     let fd = new FormData();
		 fd.append("dt",JSON.stringify(dt));
		 fd.append("_token",$('#tk-signup').val());
		 
	//create request
	let url = "signup";
	const req = new Request(url,{method: 'POST', body: fd});
	
	//fetch request
	fetch(req)
	   .then(response => {
		   
		   if(response.status === 200){   
			   return response.json();
		   }
		   else{
			   return {status: "error", message: "Technical error"};
		   }
	   })
	   .catch(error => {
		    alert("Failed to sign you up: " + error);			
			hideElem('#signup-loading');
		     showElem('#signup-submit');
	   })
	   .then(res => {
		   console.log(res);
				 
		   if(res.status == "ok"){
              hideElem(['#signup-loading','#signup-submit']); 
              showElem('#signup-finish');
              window.location = "/"; 			   
		   }
		   else if(res.status == "error"){
		     alert("An unknown error has occured, please try again.");			
			hideElem('#signup-loading');
		     showElem('#signup-submit');					 
		   }
		   		   
		  
	   }).catch(error => {
		    alert("Failed to sign you up: " + error);	
            hideElem('#signup-loading');
		     showElem('#signup-submit');		
	   });
}

const login = dt => {

     let fd = new FormData();
		 fd.append("dt",JSON.stringify(dt));
		 fd.append("_token",$('#tk-login').val());
		 
	//create request
	let url = "hello";
	const req = new Request(url,{method: 'POST', body: fd});
	
	//fetch request
	fetch(req)
	   .then(response => {
		   if(response.status === 200){
			   //console.log(response);
			   
			   return response.json();
		   }
		   else{
			   return {status: "error", message: "Technical error"};
		   }
	   })
	   .catch(error => {
		    alert("Failed to sign you in: " + error);			
			hideElem('#login-loading');
		     showElem('#login-submit');
	   })
	   .then(res => {
		   console.log(res);
			 hideElem(['#login-loading','#login-submit']); 
             	 
		   if(res.status == "ok"){
              showElem('#login-finish');
              window.location = "/"; 			   
		   }
		   else if(res.status == "error"){
			   console.log(res.message);
			 if(res.message == "auth"){
				 $('#login-finish').html("Invalid login details, please try again");
				 showElem('#login-finish');
				  showElem('#login-submit');
			 }
			 else{
			   alert("An unknown error has occured, please try again.");			
			   hideElem('#login-loading');
		       showElem('#login-submit');	 
			 }					 
		   }
		   		   
		  
	   }).catch(error => {
		    alert("Failed to sign you in: " + error);	
            hideElem('#login-loading');
		     showElem('#login-submit');		
	   });
}

const fp = dt => {

     let fd = new FormData();
		 fd.append("dt",JSON.stringify(dt));
		 fd.append("_token",$('#tk-login').val());
		 
	//create request
	let url = "forgot-password";
	const req = new Request(url,{method: 'POST', body: fd});
	
	//fetch request
	fetch(req)
	   .then(response => {
		   if(response.status === 200){
			   return response.json();
		   }
		   else{
			   return {status: "error", message: "Technical error"};
		   }
	   })
	   .catch(error => {
		    alert("Failed to send new password request: " + error);			
			hideElem('#fp-loading');
		     showElem('#fp-submit');
	   })
	   .then(res => {
		   console.log(res);
			 hideElem(['#fp-loading','#fp-submit']); 
             	 
		   if(res.status == "ok"){
               $('#fp-finish').html(`<b>Request received!</b><p class='text-primary'>Please check your email for your password reset link.</p>`);
				 showElem(['#fp-finish','#fp-submit']);			   
		   }
		   else if(res.status == "error"){
			   console.log(res.message);
			 if(res.message == "auth"){
				 $('#fp-finish').html(`<p class='text-primary'>No user exists with that email address.</p>`);
				 showElem(['#fp-finish','#fp-submit']);
			 }
			 else if(res.message == "validation" || res.message == "dt-validation"){
				 $('#fp-finish').html(`<p class='text-primary'>Please enter a valid email address.</p>`);
				 showElem(['#fp-finish','#fp-submit']);
			 }
			 else{
			   alert("An unknown error has occured, please try again.");			
			   hideElem('#fp-loading');
		       showElem('#fp-submit');	 
			 }					 
		   }
		   		   
		  
	   }).catch(error => {
		    alert("Failed to sign you in: " + error);	
            hideElem('#login-loading');
		     showElem('#login-submit');		
	   });
}


const switchMode = dt => {
    let url = `sm?m=${dt.mode}`;
	window.location = url;
}

const toggleFacility = dt => {
	 // console.log(`selecting facility ${dt}`);
	  f = $(`a#apt-service-${dt}`);
	  i = $(`i#apt-service-icon-${dt}`);
	  ft = f.attr('data-check');
	  ret = {id: dt, selected: false};
	  ih = "Check", rc = 'btn-warning', ac = 'btn-primary', iac = "ti-control-stop", idc = "ti-check-box",  dc = "unchecked";
	  
	  if(f){
		  if(ft == "unchecked"){
			ih = "Uncheck", rc = 'btn-primary', ac = 'btn-warning',iac = "ti-check-box", idc = "ti-control-stop", dc = "checked";
	        ret.selected = true;
		  } 
		   let ss = facilities.find(i => i.id == dt);
		  //console.log('us: ',us);
		  if(ss){
			ss.selected = ret.selected;  
		  }
		  else{
			facilities.push(ret);  
		  }
		  
		 // f.html(ih);
		  f.removeClass(rc);
		  f.addClass(ac);
		  i.removeClass(idc);
		  i.addClass(iac);
		  f.attr({'data-check':dc});
	  }
}


const aptAddImage = () => {
	let i = $(`#add-apartment-images`), ctr = $(`#add-apartment-images div.row`).length;
	
	i.append(`
			  <div id="add-apartment-image-div-${ctr}" class="row">
				<div class="col-md-7">
					<input type="file" class="form-control" data-ic="${ctr}" onchange="readURL(this,'${ctr}')" id="add-apartment-image-${ctr}" name="add-apartment-images[]">												    
				</div>
			    <div class="col-md-5">
					<img id="add-apartment-preview-${ctr}" src="#" alt="preview" style="width: 50px; height: 50px;"/>
					<a href="javascript:void(0)" onclick="aptSetCoverImage('${ctr}')" class="btn btn-theme btn-sm">Set as cover image</a>
					<a href="javascript:void(0)" onclick="aptRemoveImage('${ctr}')"class="btn btn-warning btn-sm">Remove</a>
				</div>
			  </div>
	  `);
}

const aptRemoveImage = ctr => {
	let r = $(`#add-apartment-image-div-${ctr}`);
	//console.log(r);
	r.remove();
}

const aptSetCoverImage = ctr => {
	aptCover = ctr;
	//r.remove();
}

const readURL = (input,ctr) => {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
		let pv = input.getAttribute("data-ic");
      $(`#add-apartment-preview-${ctr}`).attr({
	      'src': e.target.result,
	      'width': "50",
	      'height': "50"
	  });
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

const aptFinalPreview = (id) => {
	 //side 1 
	   let aptName = $(`#${id}-name`).val(), aptAmount = $(`#${id}-amount`).val(),aptDescription = $(`#${id}-description`).val(),
	       aptCheckin = $(`#${id}-checkin`).val(), aptCheckout = $(`#${id}-checkout`).val(),aptIdRequired = $(`#${id}-id-required`).val(),
	       aptChildren = $(`#${id}-children`).val(), aptIdPets = $(`#${id}-pets`).val(),
		 
       //side 2
	       aptAddress = $(`#${id}-address`).val(), aptCity = $(`#${id}-city`).val(),aptState = $(`#${id}-state`).val(),
	       aptImages = $(`#${id}-images input[type=file]`);
		   
		   let fff = [];
		   for(let y = 0; y < facilities.length; y++){
			 if(facilities[y].selected) fff.push(facilities[y]);
		   }
		   
		   let ff = `None specified`;
		   if(fff.length > 0){
			   ff = `${fff[0].id}`;
		     for(let y = 1; y < fff.length; y++){
				 let ii = fff[y];
			   if(ii.selected) ff += ` | ${ii.id}`;
		     }
		   }
	let i = `
	     <li>Apartment ID.<span>Will be generated</span></li>
												<li>Friendly name<span>${aptName}</span></li>
												<li>Price per day<span>&#8358;${aptAmount}</span></li>
												<li>Description<span></span></li>
												<li>Check in<span>${aptCheckin}</span></li>
												<li>Check out<span>${aptCheckout}</span></li>
												<li>Payment type<span>Card</span></li>
												<li>ID required on check-in<span>${aptIdRequired}</span></li>
												<li>Children<span>${aptChildren}</span></li>
												<li>Facilities & services<span>${ff}</span></li>
	`;
	
	$(`#${id}-final-preview`).html(i);
}


const addApartment = (dt) => {
	//create request
	const req = new Request("add-apartment",{method: 'POST', body: dt});
	//console.log(req);
	
	
	//fetch request
	fetch(req)
	   .then(response => {
		   if(response.status === 200){
			   //console.log(response);
			   
			   return response.json();
		   }
		   else{
			   return {status: "error", message: "Technical error"};
		   }
	   })
	   .catch(error => {
		    alert("Failed to add apartment: " + error);			
			$('#add-apartment-loading').hide();
		     $('#add-apartment-submit').fadeIn();
	   })
	   .then(res => {
		   console.log(res);
          
		   if(res.status == "ok"){
              Swal.fire({
			     icon: 'success',
                 title: "Apartment added!"
               }).then((result) => {
               if (result.value) {                 
			     window.location = `my-apartments`;
                }
              });
		   }
		   else if(res.status == "error"){
			   let hh = ``;
			   if(res.message == "validation"){
				 hh = `Please fill all required fields and try again.`;  
			   }
			   else if(res.message == "Technical error"){
				 hh = `A technical error has occured, please try again.`;  
			   }
			   Swal.fire({
			     icon: 'error',
                 title: hh
               }).then((result) => {
               if (result.value) {
                  $('#add-apartment-loading').hide();
		          $('#add-apartment-submit').fadeIn();	
                }
              });					 
		   }
		  
		   
		  
	   }).catch(error => {
		     alert("Failed to add apartment: " + error);			
			$('#add-apartment-loading').hide();
		     $('#add-apartment-submit').fadeIn();			
	   });
}


/**********************************************************************************************************************
                                                     OLD METHODS
/**********************************************************************************************************************/

function bomb(dt,url){

	//create request
	const req = new Request(url,{method: 'POST', headers: {'Content-Type': 'application/json'}, body: dt});
	//console.log(req);
	
	
	//fetch request
	fetch(req)
	   .then(response => {
		   if(response.status === 200){
			   //console.log(response);
			   
			   return response.json();
		   }
		   else{
			   return {status: "error:", message: "Network error"};
		   }
	   })
	   .catch(error => {
		    alert("Failed to send message: " + error);			
	   })
	   .then(res => {
		   console.log(res);
		   let ev = true;
			
		   if(res.status == "ok"){
			   if(res.message === "finished"){
			      alert("All messages have been sent. To send more messages you need to delete the old leads and select new ones");
				  ev = false;
				  $("#stop-btn").hide();
		          $("#send-btn").fadeIn();
			    }
				else{
				  let ug = res.ug;
		          let bdg = $('#bdg-' + ug);
			      $('#rmk-' + ug).html("Message Sent!");			  
			      bdg.removeClass(bdg.attr("data-badge"));
			      bdg.addClass("badge-success");
                  bdg.html("sent");				  
				}
		   }
		   else if(res.status == "error"){
			   if(res.message == "Network error"){
				     alert("An unknown network error has occured. Please refresh the app or try again later");
                     ev = false;					 
			   }
			   else{
			   let ug = res.ug;
		       let bdg = $('#bdg-' + ug);
			   $('#rmk-' + ug).html("Failed to send message: " + res.message);
			   bdg.removeClass(bdg.attr("data-badge"));
			   bdg.addClass("badge-danger");
			   bdg.html("failed");
			   }
		   }
		   
		   if(ev === true){
		      setTimeout(function(){
		       bomb(dt,url);
		      },5000);
		    }
		   
	   }).catch(error => {
		    alert("Failed to send message: " + error);			
	   });
}


function printElem(html)
{
    let mywindow = window.open('', 'PRINT');
    let content = `
<html><head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>${document.title}</title>
<!-- Google fonts -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
<!-- Ionicons font -->
<link href="css/ionicons.min.css" rel="stylesheet">
<!-- Bootstrap styles-->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!--custom styles-->
<link href="css/custom.css" rel="stylesheet" />
<link href="css/custom-pink.css" rel="stylesheet"/>
<link href="css/custom-turquoise.css" rel="stylesheet" />
<link href="css/custom-purple.css" rel="stylesheet" />
<link href="css/custom-orange.css" rel="stylesheet" />
<link href="css/custom-blue.css" rel="stylesheet" />
<link href="css/custom-green.css" rel="stylesheet" />
<link href="css/custom-red.css" rel="stylesheet" />
<link href="css/custom-gold.css" rel="stylesheet" id="style">
<!--tooltiop-->
<link href="css/hint.css" rel="stylesheet">
<!-- animation -->
<link href="css/animate.css" rel="stylesheet" />
<!--select-->
<link href="css/bootstrap-select.min.css" rel="stylesheet">
<!--color picker-->
<link href="css/jquery.simplecolorpicker.css" rel="stylesheet">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
<!-- favicon -->

<link rel="icon" type="image/png" href="images/favicon.png" sizes="16x16">

<!--jQuery--> 
<script src="js/jquery.min.js"></script> 
<!--SweetAlert--> 
<script src="lib/sweet-alert/all.js"></script>
</head><body>
${html}
</body></html>
	`;
    
	mywindow.document.write(content);
    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    //mywindow.print();
    //mywindow.close();

    return true;
}

function supportsLocalStorage(){
	try{
	  return 'localStorage' in window && window['localStorage'] !== null;
	}
	catch(e){
		return false;
	}
}

const generateRandomString = (length) => {
	let chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	let ret = '';
	
	for(let i = length; i > 0; --i){
		ret += chars[Math.floor(Math.random() * chars.length)];
	}
	return ret;
}


function addToCart(dt)
{
	if(!dt.fromWishlist) dt.fromWishlist = "no";
    
	if(!dt.qty){
		dt.qty = $('#qty').val();
	}
  let cu = `add-to-cart?sku=${dt.sku}&from_wishlist=${dt.fromWishlist}&qty=${dt.qty}&gid=${gid}`;
  console.log("cu: ",cu);
  
  fbq('track', 'AddToCart', {
	currency: "NGN",
	contents: [{
      id: dt.sku,
      quantity: dt.qty
    }],
    content_type: 'product'
	});
  
  window.location = cu;
}

function updateCart(dt)
{    
  let qty = $(`#qty-${dt.sku}`).val();
  let upu = `update-cart?sku=${dt.sku}&qty=${qty}&gid=${gid}`;
  console.log("upu: ",upu);
  window.location = upu;
}

function removeFromCart(dt)
{
  let ru = `remove-from-cart?sku=${dt.sku}&gid=${gid}`;
  console.log("ru: ",ru);
  window.location = ru;
}

function addToWishlist(dt)
{
  let wu = `add-to-wishlist?sku=${dt.sku}&gid=${gid}`;
  console.log("wu: ",wu);
  window.location = wu;
}

function removeFromWishlist(dt)
{
  let wu = `remove-from-wishlist?sku=${dt.sku}&gid=${gid}`;
  window.location = wu;
}

function addToCompare(dt)
{
  let cu = `add-to-compare?sku=${dt.sku}&gid=${gid}`;
  window.location = cu;
}

function removeFromCompare(dt)
{
  let wu = `remove-from-compare?sku=${dt.sku}&gid=${gid}`;
  window.location = wu;
}

function showCheckout(type){
	switch(type){
		case 'new':
		 $('#checkout-anon').hide();
		 $('#checkout-new').fadeIn();
		break;
		
		case 'anon':
		 $('#checkout-new').hide();
		 $('#checkout-anon').fadeIn();
		break;
	}
}



const getCart = () => {
	let cart = null;
	
    try{
		let c = localStorage.getItem('cart');
		if(c){
			cart = JSON.parse(c);
			console.log("cart: ",cart);
		}
		else{
			cart = [];
		}
	}
	
	catch(err){
		console.log("err in getCart(): ",err);
		cart = [];
	}
	
	return cart;
}

const setCartData = (cart) => {
	document.querySelector('#cart-badge').innerHTML = cart.length;
			let cartMenu = document.querySelector('#cart-menu');
			let htt = cartMenu.innerHTML;
			
			for(let j = 0; j < cart.length; j++){
				let cc = cart[j];
				htt += `
                  <li><div class="lnt-cart-products text-success"><i class="ion-android-checkmark-circle icon"></i> {{$item['sku']}} <b>x{{$qty}}</b><span class="lnt-cart-total">&#8358;{{number_format($itemAmount * $qty, 2)}}</span> </div></li>
				 `; 
				 
			}
			htt += `<li class="lnt-cart-actions text-center"> <a class="btn btn-default btn-lg hvr-underline-from-center-default" href="{{url('cart')}}">View cart</a> <a class="btn btn-primary hvr-underline-from-center-primary" href="{{url('checkout')}}">Checkout</a> </li>`;
			cartMenu.innerHTML = htt;
}

const setCookie = (k,v) => {
	var d = new Date;
            d.setTime(d.getTime() + 24 * 60 * 60 * 60 * 1e3);
            var e = "; expires=" + d.toGMTString();
	 document.cookie = k + "=" + v + e;
}

const getCookie = (a) => {
	for (var b = a + "=", c = document.cookie.split(";"), d = 0; d < c.length; d++) {
            for (var e = c[d]; " " == e.charAt(0); )
                e = e.substring(1, e.length);
            if (0 == e.indexOf(b))
                return e.substring(b.length, e.length)
        }
        return null;
}

const getParameterByName = (name, url) => {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

const syncData = (dt) => {
    let url = "sync-data";
	//create request
	const req = new Request(url,{method: "POST",body: dt});
	console.log("dt: ",dt);
	
	
	//fetch request
	return fetch(req)
	   .then(response => {
		   if(response.status === 200){
			   //console.log(response);
			   
			   return response.json();
		   }
		   else{
			   return {status: "error:", message: "Network error"};
		   }
	   })
	   .catch(error => {
		    alert("Failed to send message: " + error);			
	   })
	   .then(res => {
		   console.log("syncData returned: ",res);
		   
	   }).catch(error => {
		    alert("Failed to call getProducts: " + error);			
	   });
}

const searchToCart = (s) => {
	 let qty = $(`#search-qty-${s}`).val();
	   //console.log("qty: ",qty);
	   addToCart({sku: s,qty: qty});
}

const showPage = (p) => {
	//console.log("arr length: ",productsLength);
	//console.log("show per page: ",perPage);
	$('#pagination-row').hide();
	$('#products').html("");
	let start = 0, end = 0;
	
	if(productsLength < perPage){
		end = productsLength;
	}
	else{
		start = (p * perPage) - perPage;
		end = p * perPage;
	}
	
	//console.log(`start: ${start}, end: ${end}`);
	let hh = "", cids = [];

	for(let i = start; i < end; i++){
		if(i < productsLength)
		{
		let p = products[i];
		//console.log(p);
		cids.push(p.sku);
		let nnn = p.name;
		if(p.name.length > 12){
			nnn = `${p.name.substr(0,12)}..`;
		}
		let nn = p.name == "" ? p.sku : nnn;
		let imggs = JSON.parse(p.imggs);
		let ppd = p.pd.replace(/(?:\r\n|\r|\n)/g, '<br>'), pd = JSON.parse(ppd);
		let description = `${pd.description}`;
 	
		hh = `
				    <!--start of product item container-->
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 product-item-container effect-wrap effect-animate">
                          <div class="product-main">
                            <div class="product-view">
                              <figure class="double-img"><a href="${p.uu}" title="${p.name}"><img class="btm-img" src="${imggs[0]}" width="215" height="240"  alt=""/> <img class="top-img" src="${imggs[1]}" width="215" height="240"  alt=""/></a></figure>
                            </div>
                            <div class="product-btns  effect-content-inner">
                              <p class="effect-icon"> <a href="javascript:void(0)"  onclick="addToCart({sku:'${pd.sku}',qty: 1})" class="hint-top" data-hint="Add To Cart"><span class="cart ion-bag"></span></a></p>
                              <p class="effect-icon"> <a href="javascript:void(0)"  onclick="addToWishlist({sku:'${pd.sku}'})" class="hint-top" data-hint="Wishlist"><span class="fav ion-ios-star"></span></a></p>
                              <p class="effect-icon"> <a href="javascript:void(0)"  onclick="addToCompare({sku:'${pd.sku}'})" class="hint-top" data-hint="Compare"> <span class="compare ion-android-funnel"></span> </a></p>
                               <p class="effect-icon">
		   <a data-toggle="modal" data-target="#quick-view-box" onclick="populateQV({sku:'${p.sku}',name:'${p.name}',description:'${description}',amount:${pd.amount},oldAmount:'${pd.amount + 1000}',inStock:'${pd.in_stock}',imgg:'${imggs[0]}'})" class="hint-top" data-hint="Quick View"><span class="ion-ios-eye view"></span> </a>
		  				  </p>
                            </div>
                          </div>
                          <div class="product-info">
                            <h3 class="product-name"><a href="${p.uu}" title="${p.name}">${nn}</a></h3>
                            <p class="group inner list-group-item-text">${pd.description}</p>
                            <div class="product-price"><span class="real-price text-info"><strong>&#8358;${pd.amount}</strong></span></div>
                            <div class="product-evaluate text-info"> <i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star"></i><i class="ion-android-star-half"></i> </div>
                          </div>
                        </div>
                        <!--end of product item container-->
		`;
		$('#products').append(hh);
		
	  }
	}
	
	//Pagination
	$('ul.cd-pagination').html("");
	let pages = productsLength < perPage ? 1 : Math.ceil(productsLength / perPage);
	$('ul.cd-pagination').append(` <li class="button"><a href="javascript:void(0)" onclick="showPreviousPage();">Prev</a> </li>`);
	for(let x = 0; x < pages; x++){
		$('ul.cd-pagination').append(`<li><a href="javascript:void(0)" onclick="showPage(${x+1});">${x+1}</a> </li>`);
	}
	$('ul.cd-pagination').append(`<li class="button"><a href="javascript:void(0)" onclick="showNextPage();">Next</a></li>`);
	
	page = p;
	$('#pagination-row').fadeIn();
	fbq('track', 'ViewContent', {content_ids: cids, currency: "NGN", content_type: 'product'});
}

const showPreviousPage = () => {
	let sp = productsLength < perPage ? 1 : Math.ceil(productsLength / perPage), pp = page - 1;
	//console.log(`page: ${page},sp: ${sp},pp: ${pp}`);
	
	if(sp > pp && pp > 0){
		showPage(pp);
	}
	
}

const showNextPage = () => {
		let sp = productsLength < perPage ? 1 : Math.ceil(productsLength / perPage), pp = page + 1;
	//console.log(`page: ${page},sp: ${sp},pp: ${pp}`);
	
	if(sp >= pp){
		showPage(pp);
	}
}

const changePerPage = () =>{
	       perPage = $('#per-page').val();
		   if(perPage == "none") perPage = 3;

}

const isMobile = () =>{
	let isMobile = window.matchMedia("only screen and (max-width: 760px)").matches;
	return isMobile;
}