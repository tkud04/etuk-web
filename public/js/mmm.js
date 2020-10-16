
	let  toolbar = ['title', 'bold', 'italic', 'underline', 'strikethrough', 'fontScale', 'color', '|', 'ol', 'ul', 'blockquote', 'code', 'table', '|', 'link', 'image', 'hr', '|', 'indent', 'outdent', 'alignment'];
	

$(document).ready(function() {
    "use strict";
	hideInputErrors(["signup","login","forgot-password","reset-password","oauth-sp"]);
	hideElem(["#signup-loading","#signup-finish",
	          "#login-loading","#login-finish",
			  "#fp-loading","#fp-finish",
			  "#rp-loading","#rp-finish",
			  "#apt-chat-loading","#apt-chat-finish",
			  ]);
	hideElem(["#add-apartment-side-2","#add-apartment-side-3"]);
	hideElem(["#my-apartment-side-2","#my-apartment-side-3"]);
	
	
	//Init wysiwyg editors
	Simditor.locale = 'en-US';
	let aptDescriptionTextArea = $('#add-apartment-description');
	//console.log('area: ',aptDescriptionTextArea);
	
	
	
    $("a.lno-cart").on("click", function(e) {
    	if(isMobile()){
    	  window.location = "cart";
       }
    })
    
	$("#ca-state").on("change", function(e) {
       // e.preventDefault();
      let s = $('#ca-state').val();
	   if(s == "none"){}
	   else{
		 getDeliveryFee(s);   
	   }
    });
	
	$("#s-form").submit(e => {
       e.preventDefault();
	  
       hideInputErrors("signup");	  
      let fname = $('#s-fname').val(),lname = $('#s-lname').val(),em = $('#s-email').val(),
	      phone = $('#s-phone').val(),p = $('#s-pass').val(),p2 = $('#s-pass2').val();
		  
		  
	   if(fname == "" || lname == "" || em == "" || phone == "" || p == "" || p2 == "" || p != p2){
		   if(fname == "") showElem('#s-fname-error');
		   if(lname == "") showElem('#s-lname-error');
		   if(em == "") showElem('#s-em-error');
		   if(phone == "") showElem('#s-phone-error');
		   if(p == "") showElem('#s-pass-error');
		   if(p2 == "") showElem('#s-pass2-error');
		   if(p != p2) showElem('#s-pass2-error');
	   }
	   else{
		  hideElem("#signup-submit");
		  showElem("#signup-loading");
		  
		 signup({
			 fname: fname,
			 lname: lname,
			 email: em,
			 phone: phone,
			 pass: p,
			 pass_confirmation: p2
		 });   
	   }
    });
	
	$("#l-form").submit(e => {
       e.preventDefault();
	  
       hideInputErrors("login");	  
      let id = $('#l-id').val(),p = $('#l-pass').val();
		  
		  
	   if(id == "" || p == ""){
		   if(id == "") showElem('#l-id-error');
		   if(p == "") showElem('#l-pass-error');
	   }
	   else{
		  hideElem("#login-submit");
		  showElem("#login-loading");
		  
		 login({
			 id: id,
			 pass: p
		 });   
	   }
    });
	
	$("#fp-submit").click(e => {
       e.preventDefault();
	  
       hideInputErrors("forgot-password");	  
      let id = $('#fp-email').val();
		  
		  
	   if(id == ""){
		   if(id == "") showElem('#fp-id-error');
	   }
	   else{
		  hideElem("#fp-submit");
		  showElem("#fp-loading");
		  
		 fp({
			 email: id
		 });   
	   }
    });
	
	$("#rp-submit").click(e => {
       e.preventDefault();
	  
       hideInputErrors("reset-password");	  
      let id = $('#acsrf').val(), p = $('#rp-pass').val(), p2 = $('#rp-pass2').val();
		  
		  
	   if(p == "" || p2 == "" || p != p2){
		   if(p == "") showElem('#rp-pass-error');
		   if(p2 == "" || p != p2) showElem('#rp-pass2-error');
	   }
	   else{
		  hideElem("#rp-submit");
		  showElem("#rp-loading");
		  
		 rp({
			 id: id,
			 pass: p
		 });   
	   }
    });
	
	$("#osp-submit").click(e => {
       e.preventDefault();
	  
       hideInputErrors("oauth-sp");	  
      let p = $('#osp-pass').val(), p2 = $('#osp-pass2').val();
		  
		  
	   if(p == "" || p2 == "" || p != p2){
		   if(p == "") showElem('#osp-pass-error');
		   if(p2 == "" || p != p2) showElem('#osp-pass2-error');
	   }
	   else{
		 $('#osp-form').submit();   
	   }
    });
	
	
	//ADD APARTMENT
	$("#add-apartment-side-1-next").click(e => {
       e.preventDefault();
	   
	   if(facilities.length > 0){
		   let aptSidebarFacilitiesHTML = ``;
		   for(let adf = 0; adf < facilities.length; adf++){
			   aptSidebarFacilitiesHTML += `<li>${facilities[adf].id}</li>`;
		   }
		   $('#apt-sidebar-facilities').html(aptSidebarFacilitiesHTML);
	   }
	   
	  hideElem(['#add-apartment-side-1','#add-apartment-side-3']);
	  selectCheckoutSide({side: 2,type: ".add-apartment",content: "ti-check"});
	  showElem(['#add-apartment-side-2']);
    });
	$("#add-apartment-side-2-prev").click(e => {
       e.preventDefault();
	  hideElem(['#add-apartment-side-2','#add-apartment-side-3']);
	  selectCheckoutSide({side: 1,type: ".add-apartment",content: "ti-check"});
	  showElem(['#add-apartment-side-1']);
    });	
	$("#add-apartment-side-2-next").click(e => {
       e.preventDefault();
	  hideElem(['#add-apartment-side-1','#add-apartment-side-2']);
	  selectCheckoutSide({side: 3,type: ".add-apartment",content: "ti-check"});
	  aptFinalPreview("add-apartment"); 
	  
	  let aptImages = $(`#add-apartment-images input[type=file]`);
	  let ac = aptCover == "none" ? 0 : aptCover;
	  //Add the cover image to the apt sidebar
	  if (aptImages[ac].files && aptImages[ac].files[0]) {
        let reader = new FileReader();
    
        reader.onload = function(e) {
		  $(`#apt-sidebar-cover`).attr({
	        'src': e.target.result,
	        'width': "236",
	        'height': "161"
	      });
        }
    
        reader.readAsDataURL(aptImages[ac].files[0]); // convert to base64 string
		
		let ii = aptImages.length == 1 ? "image" : "images";
		$('#apt-sidebar-img-count').html(`${aptImages.length} ${ii}`);
     }
	  
	  
	  showElem(['#add-apartment-side-3']);
    });
	$("#add-apartment-side-3-prev").click(e => {
       e.preventDefault();
	  hideElem(['#add-apartment-side-1','#add-apartment-side-3']);
	  selectCheckoutSide({side: 2,type: ".add-apartment",content: "ti-check"});
	  showElem(['#add-apartment-side-2']);
    });	
	$("#add-apartment-side-3-next").click(e => {
       e.preventDefault();
	   console.log("add apartment submit");
	   
	   //side 1 validation
	   let aptUrl = $('#add-apartment-url').val(), aptName = $('#add-apartment-name').val(), aptAmount = $('#add-apartment-amount').val(),
	   aptMaxAdults = $('#add-apartment-max-adults').val(),aptMaxChildren = $('#add-apartment-max-children').val(),aptDescription = $('#add-apartment-description').val(),
	       aptCheckin = $('#add-apartment-checkin').val(), aptCheckout = $('#add-apartment-checkout').val(),aptIdRequired = $('#add-apartment-id-required').val(),
	       aptChildren = $('#add-apartment-children').val(), aptPets = $('#add-apartment-pets').val(),
		   side1_validation = (aptUrl == "" || aptName == "" || aptMaxAdults == "" || aptMaxChildren == "" || aptAmount < 0 || aptDescription == "" || aptCheckin == "none" || aptCheckout == "none" || aptIdRequired == "none" || facilities.length < 1);	  
	  
       //side 2 validation imgs = $(`${BUUPlist[bc].id}-images-div input[type=file]`);
	   let aptAddress = $('#add-apartment-address').val(), aptCity = $('#add-apartment-city').val(),aptState = $('#add-apartment-state').val(),
	       aptImages = $(`#add-apartment-images input[type=file]`), emptyImage = false,
           side2_validation = (aptAddress == "" || aptCity == "" || aptState == "none");
           
		   for(let i = 0; i < aptImages.length; i++){
			   if(aptImages[i].files.length < 1) emptyImage = true;
		   }
		   
        // console.log("video: ",aptVideo);
         //console.log("images: ",aptImages);
	   
	   if(side1_validation || side2_validation){
		   Swal.fire({
			 icon: 'error',
             title: "Please fill all the required fields"
           })
	   }
	   else if(emptyImage){
		   Swal.fire({
			 icon: 'error',
             title: "You have an empty image field."
           })
	   }
	   else if(aptCover == "none"){
		   Swal.fire({
			 icon: 'error',
             title: "Select a cover image."
           })
	   }
	   /**
	   else if(aptVideo[0].size > 15000000){
		   Swal.fire({
			 icon: 'error',
             title: "Video must not be larger than 10MB"
           })
	   }
	   **/
	   else{
		 //let aptName = $('#add-apartment-name').val(),   
		 console.log("final");
		 
		 let ff = [];
		 for(let y = 0; y < facilities.length; y++){
			 if(facilities[y].selected) ff.push(facilities[y]);
		 }
		 
		 let fd =  new FormData();
		 fd.append("url",aptUrl);
		 fd.append("name",aptName);
		 fd.append("max_adults",aptMaxAdults);
		 fd.append("max_children",aptMaxChildren);
		 fd.append("description",aptDescription);
		 fd.append("checkin",aptCheckin);
		 fd.append("checkout",aptCheckout);
		 fd.append("id_required",aptIdRequired);
		 fd.append("amount",aptAmount);
		 fd.append("children",aptChildren);
		 fd.append("pets",aptPets);
		 fd.append("address",aptAddress);
		 fd.append("city",aptCity);
		 fd.append("state",aptState);
		 fd.append("facilities",JSON.stringify(ff));
		 
		 //fd.append("video",aptVideo[0]);
		 fd.append("cover",aptCover);
		 fd.append("img_count",aptImages.length);
		 
		 for(let r = 0; r < aptImages.length; r++)
		 {
		    let imgg = aptImages[r];
			let imgName = imgg.getAttribute("id");
            //console.log("imgg name: ",imgName);			
            fd.append(imgName,imgg.files[0]);   			   			
		 }
		 
		 /**
		 for(let vv of fd.values()){
			 console.log("vv: ",vv);
		 }
		 **/
		  fd.append("_token",$('#tk-apt').val());
		  
		  $('#add-apartment-submit').hide();
		  $('#add-apartment-loading').fadeIn();
		  addApartment(fd);
	   }
    });
	
	//MY APARTMENT
	$("#my-apartment-side-1-next").click(e => {
       e.preventDefault();
	   
	   if(facilities.length > 0){
		   let aptSidebarFacilitiesHTML = ``;
		   for(let adf = 0; adf < facilities.length; adf++){
			   aptSidebarFacilitiesHTML += `<li>${facilities[adf].id}</li>`;
		   }
		   $('#apt-sidebar-facilities').html(aptSidebarFacilitiesHTML);
	   }
	  hideElem(['#my-apartment-side-1','#my-apartment-side-3']);
	  selectCheckoutSide({side: 2,type: ".my-apartment",content: "ti-check"});
	  showElem(['#my-apartment-side-2']);
    });
	$("#my-apartment-side-2-prev").click(e => {
       e.preventDefault();
	  hideElem(['#my-apartment-side-2','#my-apartment-side-3']);
	  selectCheckoutSide({side: 1,type: ".my-apartment",content: "ti-check"});
	  showElem(['#my-apartment-side-1']);
    });	
	$("#my-apartment-side-2-next").click(e => {
       e.preventDefault();
	  hideElem(['#my-apartment-side-1','#my-apartment-side-2']);
	  selectCheckoutSide({side: 3,type: ".my-apartment",content: "ti-check"});
	  aptFinalPreview("my-apartment");
	  let aptImages = $(`#my-apartment-images input[type=file]`), acc = parseInt(aptCurrentImgCount) + parseInt(aptImages.length);
	  let ii = acc == 1 ? "image" : "images";
		$('#apt-sidebar-img-count').html(`${acc} ${ii}`);
	  showElem(['#my-apartment-side-3']);
    });
	$("#my-apartment-side-3-prev").click(e => {
       e.preventDefault();
	  hideElem(['#my-apartment-side-1','#my-apartment-side-3']);
	  selectCheckoutSide({side: 2,type: ".my-apartment",content: "ti-check"});
	  showElem(['#my-apartment-side-2']);
    });	
	$("#my-apartment-side-3-next").click(e => {
       e.preventDefault();
	   console.log("my apartment submit");
	   
	   //side 1 validation
	   let aptUrl = $('#my-apartment-url').val(), aptName = $('#my-apartment-name').val(), aptAmount = $('#my-apartment-amount').val(), aptAvb = $('#my-apartment-avb').val(),
	   aptMaxAdults = $('#my-apartment-max-adults').val(),aptMaxChildren = $('#my-apartment-max-children').val(),aptDescription = $('#my-apartment-description').val(),
	       aptCheckin = $('#my-apartment-checkin').val(), aptCheckout = $('#my-apartment-checkout').val(),aptIdRequired = $('#my-apartment-id-required').val(),
	       aptPaymentType = $('#my-apartment-payment-type').val(), aptChildren = $('#my-apartment-children').val(), aptPets = $('#my-apartment-pets').val(),
		   side1_validation = (aptUrl == "" || aptName == "" || aptAvb == "none" || aptMaxAdults == "" || aptMaxChildren == "" || aptAmount < 0 || aptDescription == "" || aptPaymentType == "none" || aptCheckin == "none" || aptCheckout == "none" || aptIdRequired == "none" || facilities.length < 1);	  
	  
       //side 2 validation imgs = $(`${BUUPlist[bc].id}-images-div input[type=file]`);
	   let aptAddress = $('#my-apartment-address').val(), aptCity = $('#my-apartment-city').val(),aptState = $('#my-apartment-state').val(),
	       aptImages = $(`#my-apartment-images input[type=file]`), emptyImage = false,
           side2_validation = (aptAddress == "" || aptCity == "" || aptState == "none");
           
		   for(let i = 0; i < aptImages.length; i++){
			   if(aptImages[i].files.length < 1) emptyImage = true;
		   }
		   
        // console.log("video: ",aptVideo);
         //console.log("images: ",aptImages);
	   
	   if(side1_validation || side2_validation){
		   Swal.fire({
			 icon: 'error',
             title: "Please fill all the required fields"
           })
	   }
	   else if(emptyImage){
		   Swal.fire({
			 icon: 'error',
             title: "You have an empty image field."
           })
	   }
	   else if(aptCover == "none"){
		   Swal.fire({
			 icon: 'error',
             title: "Select a cover image."
           })
	   }
	   /**
	   else if(aptVideo[0].size > 15000000){
		   Swal.fire({
			 icon: 'error',
             title: "Video must not be larger than 10MB"
           })
	   }
	   **/
	   else{
		 //let aptName = $('#my-apartment-name').val(),   
		 console.log("final");
		 
		 let ff = [];
		 for(let y = 0; y < facilities.length; y++){
			 if(facilities[y].selected) ff.push(facilities[y]);
		 }
		 
		 let fd =  new FormData();
		 fd.append("url",aptUrl);
		 fd.append("name",aptName);
		 fd.append("max_adults",aptMaxAdults);
		 fd.append("max_children",aptMaxChildren);
		 fd.append("description",aptDescription);
		 fd.append("checkin",aptCheckin);
		 fd.append("checkout",aptCheckout);
		 fd.append("id_required",aptIdRequired);
		 fd.append("payment_type",aptPaymentType);
		 fd.append("amount",aptAmount);
		 fd.append("avb",aptAvb);
		 fd.append("children",aptChildren);
		 fd.append("pets",aptPets);
		 fd.append("address",aptAddress);
		 fd.append("city",aptCity);
		 fd.append("state",aptState);
		 fd.append("facilities",JSON.stringify(ff));
		 
		 //fd.append("video",aptVideo[0]);
		 fd.append("cover",aptCover);
		 fd.append("img_count",aptImages.length);
		 
		 for(let r = 0; r < aptImages.length; r++)
		 {
		    let imgg = aptImages[r];
			let imgName = imgg.getAttribute("id");
            //console.log("imgg name: ",imgName);			
            fd.append(imgName,imgg.files[0]);   			   			
		 }
		 
		 /**
		 for(let vv of fd.values()){
			 console.log("vv: ",vv);
		 }
		 **/
		  fd.append("_token",$('#tk-apt').val());
		  fd.append("apartment_id",$('#tk-xf').val());
		  
		  $('#my-apartment-submit').hide();
		  $('#my-apartment-loading').fadeIn();
		  updateApartment(fd);
	   }
    });	
	
	
	//APARTMENTS
	$('#guest-apt-sidebar-submit').click(e => {
		e.preventDefault();
		let dt = {}, city = $('#guest-apt-sidebar-city').val(), state = $('#guest-apt-sidebar-state').val(),
 		 validation = true,  dates = $('#guest-apt-sidebar-dates').val(),
 		 facilities = $('input.guest-apt-sidebar-facility:checked'),  rating = $('#guest-apt-sidebar-rating').val();
		
		console.log(facilities);
		validation = (facilities.length < 1 || city == "" || state == "" || dates == "" || rating == "");
		if(validation){
			  Swal.fire({
			 icon: 'error',
             title: "Please fill all the required fields"
           })
		}
		else{
			let ff = [];
			for(let i = 0; i < facilities.length; i++){
				let f = facilities[i];
				console.log(f);
				ff.push($(f).attr('data-tag'));
			}
			dt = {
				city: city,
				state: state,
				dates: dates,
				facilities: ff,
				rating: rating
			};
			search(dt);
		}
			
	});
	
	
	//APARTMENT
	$('#apartment-hostchat-btn').click(e => {
		e.preventDefault();
		document.querySelector('#apartment-hostchat').scrollIntoView({
          behavior: 'smooth' 
        });
			
	});
	
	$('#apt-chat-btn').click(e => {
		e.preventDefault();
		let name = $('#apt-message-name').val(), em = $('#apt-message-email').val(),
   		    msg = $('#apt-message-msg').val(), aptID = $('#apt-id').val();
		
		if(name == "" || em == "" || msg == ""){
			Swal.fire({
			 icon: 'error',
             title: "Please fill all the required fields"
           });
		}
		else{
			 $('#apt-chat-btn').hide();
		  $('#apt-chat-loading').fadeIn();
		   let fd =  new FormData();
		   fd.append("_token",$('#tk-apt-chat').val());
		   fd.append("name",name);
		   fd.append("email",em);
		   fd.append("apartment_id",aptID);
		   fd.append("msg",msg);
			sendMessage(fd);
		}
			
	});
	
	
});
