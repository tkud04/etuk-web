

$(document).ready(function() {
    "use strict";
	hideInputErrors(["signup","login","forgot-password","reset-password"]);
	hideElem(["#signup-loading","#signup-finish","#login-loading","#login-finish","#fp-loading","#fp-finish","#rp-loading","#rp-finish"]);
	hideElem(["#add-apartment-side-2","#add-apartment-side-3"]);
	
	
	//Init wysiwyg editors
	Simditor.locale = 'en-US';
	let  toolbar = ['title', 'bold', 'italic', 'underline', 'strikethrough', 'fontScale', 'color', '|', 'ol', 'ul', 'blockquote', 'code', 'table', '|', 'link', 'image', 'hr', '|', 'indent', 'outdent', 'alignment'];
	
	let addApartmentDescriptionEditor = new Simditor({
		textarea: $('#add-apartment-description'),
		toolbar: toolbar,
		placeholder: `This is the description`
	});
	
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
      let p = $('#rp-pass').val(), p2 = $('#rp-pass2').val();
		  
		  
	   if(p == "" || p2 == "" || p != p2){
		   if(p == "") showElem('#rp-pass-error');
		   if(p2 == "" || p != p2) showElem('#rp-pass-2-error');
	   }
	   else{
		  hideElem("#rp-submit");
		  showElem("#rp-loading");
		  
		 rp({
			 email: id
		 });   
	   }
    });
	
	$("#add-apartment-side-1-next").click(e => {
       e.preventDefault();
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
	  aptFinalPreview();
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
	   let aptName = $('#add-apartment-name').val(), aptAmount = $('#add-apartment-amount').val(),aptDescription = $('#add-apartment-description').val(),
	       aptCheckin = $('#add-apartment-checkin').val(), aptCheckout = $('#add-apartment-checkout').val(),aptIdRequired = $('#add-apartment-id-required').val(),
	       aptChildren = $('#add-apartment-children').val(), aptIdPets = $('#add-apartment-pets').val();
		  
	  
       let side1_validation = (aptName == "" || aptAmount < 0 || aptDescription == "" || aptCheckin == "none" || aptCheckout == "none" || aptIdRequired == "none" || facilities.length < 1);	  
	   
	   if(side1_validation){
		   Swal.fire({
			 icon: 'error',
             title: "Please fill all the required fields"
           })
	   }
	   
	   //side 2 validation
	   
    });	
});
