<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="icon" type="image/ico" href="<?=base_url()?>/favicon.ico"> 
	
	<script>
		//Reference: https://www.w3schools.com/howto/howto_js_dropdown.asp;
		//last accessed: 20170622
		/* When the user clicks on the button, 
		toggle between hiding and showing the dropdown content */
		function myFunction(id) {
		    document.getElementById("myDropdown"+id).classList.toggle("show");
		}

//		window.onclick = function(event) {
		$(document).click(function(){
// 			$("#dropbtn").hide();
//			if (!event.target.matches('.dropbtn')) {				
//			if (event.target.matches('.window')) {
/*
				if (!event) { 
					var event = window.event; 
				}
*/	
/*
				var S = event.srcElement ? event.srcElement : event.target;
				if(($(S).attr('id')!='myDropDown')||$(S).hasClass('option')==false)
				{ 
					alert("hello");
					$('.dropdown-content').hide();
				}
*/
//				$("div").is(".dropdown-content").hide();
				$(".dropdown-content").hide();
//			}
		});
	</script>
	
	<script>
		//-----------------------------------------------------------
		//PRODUCT ITEM PAGE
		//-----------------------------------------------------------

		//added by Mike, 20170626
		function myPopupFunction() {				
			var product_id = document.getElementById("product_idParam").value;
			var customer_id = document.getElementById("customer_idParam").value;
			var quantity = document.getElementById("quantityParam").value;
			var price = document.getElementById("priceParam").value;
			
			var textCart = document.getElementById("Text-cartId");
			var textCart2Digits = document.getElementById("Text-cart-2digitsId");
			var textCart3Digits = document.getElementById("Text-cart-3digitsId");
	
			var totalItemsInCart = parseInt(document.getElementById("totalItemsInCartId").value);
			//do the following only if quantity is a Number, i.e. not NaN
			if (!isNaN(quantity)) {								
				//added by Mike, 20170701
				var quantityField = document.getElementById("quantityId");
				if (quantity>1) {
					quantityField.innerHTML = "Added <b>" +quantity +"</b> units of ";
				}
				else {
					quantityField.innerHTML = "Added <b>1</b> unit of ";
				}
				//-----------------------------------------------------------
				
				totalItemsInCart+=parseInt(quantity);
				if (totalItemsInCart>99) {
					totalItemsInCart=99;
				}
	
				document.getElementById("totalItemsInCartId").value = totalItemsInCart;
						
				//added by Mike, 20170627
				if (customer_id=="") {
					window.location.href = "<?php echo site_url('account/login/');?>";
				}
				else {				
		//			var base_url = window.location.origin;
					var site_url = "<?php echo site_url('cart/addToCart/');?>";
					var my_url = site_url.concat(product_id,'/',customer_id,'/',quantity,'/',price);
					
					$.ajax({
				        type:"POST",
				        url:my_url,
		
				        success:function() {			        	
				        	if (totalItemsInCart<10) {
					        	textCart.innerHTML=totalItemsInCart;
								textCart2Digits.innerHTML="";
								textCart3Digits.innerHTML="";
				        	}
							else if (totalItemsInCart<100) {
					        	textCart.innerHTML="";
								textCart2Digits.innerHTML=totalItemsInCart;
								textCart3Digits.innerHTML="";
							}
							else {
					        	textCart.innerHTML="";
								textCart2Digits.innerHTML="";
								textCart3Digits.innerHTML=totalItemsInCart;
							}
							
							document.getElementById("myPopup").classList.toggle("show");			        
				        }
		
				    });
				    event.preventDefault();
				}
			}
		}	
/*
		// Close the dropdown menu if the user clicks outside of it
		window.onclick = function(event) {
		  if (!event.target.matches('.Button-purchase')) {
		
		    var dropdowns = document.getElementsByClassName("popup-content");
		    var i;
		    for (i = 0; i < dropdowns.length; i++) {
		      var openDropdown = dropdowns[i];
		      if (openDropdown.classList.contains('show')) {
		        openDropdown.classList.remove('show');
		      }
		    }
		  }
		}		
*/		
	</script>

	<script>
		//-----------------------------------------------------------
		//SEARCH PRODUCT PAGE
		//-----------------------------------------------------------

		//added by Mike, 20170626
		function myPopupFunctionInSearchPage(id) {	
			var trimmedId = id.split("~")[0].substring("addToCartId".length, id.length);
			var totalItemsInCart = id.split("~")[1];	
			
			var product_id = document.getElementById("productId"+trimmedId).value;
			var quantity = document.getElementById("quantityId"+trimmedId+"~"+totalItemsInCart).value;
			
// 			var product_id = document.getElementById("product_idParam").value;
			var customer_id = document.getElementById("customer_idParam").value;
// 			var quantity = document.getElementById("quantityParam").value;
			var price = document.getElementById("priceParam").value;
			
			var textCart = document.getElementById("Text-cartId");
			var textCart2Digits = document.getElementById("Text-cart-2digitsId");
			var textCart3Digits = document.getElementById("Text-cart-3digitsId");
	
			var totalItemsInCart = parseInt(document.getElementById("totalItemsInCartId").value);

			//do the following only if quantity is a Number, i.e. not NaN
			if (!isNaN(quantity)) {								
				//added by Mike, 20170701
				var quantityField = document.getElementById("quantityId");

				if (quantity>1) {
					quantityField.innerHTML = "Added <b>" +quantity +"</b> units of ";
				}
				else {
					quantityField.innerHTML = "Added <b>1</b> unit of ";
				}

				//-----------------------------------------------------------

				var productName = document.getElementById("productName"+trimmedId).value;				
				var productNameField = document.getElementById("productNameId");
				productNameField.innerHTML = productName;

				//-----------------------------------------------------------

				var productImageSrc = document.getElementById("productImage"+trimmedId).value;
				var productImageId = document.getElementById("productImageId");
				productImageId.src = productImageSrc;
								
				//-----------------------------------------------------------
				
				totalItemsInCart+=parseInt(quantity);

				if (totalItemsInCart>99) {
					totalItemsInCart=99;
				}
	
				document.getElementById("totalItemsInCartId").value = totalItemsInCart;
						
				//added by Mike, 20170627
				if (customer_id=="") {
					window.location.href = "<?php echo site_url('account/login/');?>";
				}
				else {				
		//			var base_url = window.location.origin;
					var site_url = "<?php echo site_url('cart/addToCart/');?>";
					var my_url = site_url.concat(product_id,'/',customer_id,'/',quantity,'/',price);
					
					$.ajax({
				        type:"POST",
				        url:my_url,
		
				        success:function() {			        	
				        	if (totalItemsInCart<10) {
					        	textCart.innerHTML=totalItemsInCart;
								textCart2Digits.innerHTML="";
								textCart3Digits.innerHTML="";
				        	}
							else if (totalItemsInCart<100) {
					        	textCart.innerHTML="";
								textCart2Digits.innerHTML=totalItemsInCart;
								textCart3Digits.innerHTML="";
							}
							else {
					        	textCart.innerHTML="";
								textCart2Digits.innerHTML="";
								textCart3Digits.innerHTML=totalItemsInCart;
							}
							
							document.getElementById("myPopup").classList.toggle("show");			        
				        }
		
				    });
				    event.preventDefault();
				}
			}
		}	

		// Close the dropdown menu if the user clicks outside of it
		window.onclick = function(event) {
		  if (!event.target.matches('.Button-purchase')) {
		
		    var dropdowns = document.getElementsByClassName("popup-content");
		    var i;
		    for (i = 0; i < dropdowns.length; i++) {
		      var openDropdown = dropdowns[i];
		      if (openDropdown.classList.contains('show')) {
		        openDropdown.classList.remove('show');
		      }
		    }
		  }
		}		
	</script>
	
	<script>
		//added by Mike, 20170626
		function myQuantityFunction(quantity, id) {			
			var trimmedId = id.split("~")[0].substring("quantityId".length, id.length);
			var totalItemsInCart = id.split("~")[1];	

//			alert("hello"+totalItemsInCart);			
//			alert("hello"+id.substring("quantityParam".length, id.length));
					
			var subTotalField = document.getElementById("subtotalId"+trimmedId);
			var priceField = document.getElementById("priceId"+trimmedId);

			if (Number.isNaN(quantity)) {
				quantity = 0;
			}
			
			var subTotal = quantity * parseInt(priceField.innerHTML);
			subTotalField.innerHTML = "&#x20B1;" + subTotal;

			//-----------------------------------------------------------------------
			//update Order Total
			//-----------------------------------------------------------------------
			var orderTotalField1 = document.getElementById("orderTotalId1");
			var orderTotalField2 = document.getElementById("orderTotalId2");

			var orderTotal=0;
			
			for (i=0; i<totalItemsInCart; i++) {
				var sField = document.getElementById("subtotalId"+i);
				orderTotal += parseInt(sField.innerHTML.substring(1, sField.innerHTML.length));
			}

			orderTotalField1.innerHTML = orderTotal;
			orderTotalField2.innerHTML = orderTotal;	

			//-----------------------------------------------------------------------
			//update Total Quantity		
			//-----------------------------------------------------------------------			
			var totalQuantityField = document.getElementById("totalQuantityId");
			var totalQuantity = 0;
			
			for (i=0; i<totalItemsInCart; i++) {
				var q = document.getElementById("quantityId"+i+"~"+totalItemsInCart);				
				totalQuantity += parseInt(q.value);
			}
			totalQuantityField.innerHTML = totalQuantity;

			//update the DB as well
			var product_id = document.getElementById("productId"+trimmedId).value;
			
			var site_url = "<?php echo site_url('cart/shoppingcart/');?>";
			var my_url = site_url.concat(product_id, "/", quantity);
			
			$.ajax({
		        type:"POST",
		        url:my_url,

		        success:function() {		
					window.location.href = "<?php echo site_url('cart/shoppingcart/');?>";			        	        			        				        
		       	}
		    });
			event.preventDefault();
		}
	</script>

	<script>
		//added by Mike, 20170626
		function removeProductItemFunction(id) {			
//			alert("hello"+id);

			var productId = id;
			var totalItemsInCart = id.split("~")[1];	

//			alert("hello "+productId);						
//			alert("hello"+totalItemsInCart);			
//			alert("hello"+id.substring("quantityParam".length, id.length));

			var site_url = "<?php echo site_url('cart/shoppingcart/');?>";
			var my_url = site_url.concat(productId);

//			alert("hey! "+my_url);
			
			$.ajax({
		        type:"POST",
		        url:my_url,

		        success:function() {		
					window.location.href = "<?php echo site_url('cart/shoppingcart/');?>";			        	        			        				        
		       	}
		    });
			event.preventDefault();

/*					
			var subTotalField = document.getElementById("subtotalId"+trimmedId);
			var priceField = document.getElementById("priceId"+trimmedId);

			if (Number.isNaN(quantity)) {
				quantity = 0;
			}
			
			var subTotal = quantity * parseInt(priceField.innerHTML);
			subTotalField.innerHTML = "&#x20B1;" + subTotal;

			//-----------------------------------------------------------------------
			//update Order Total
			//-----------------------------------------------------------------------
			var orderTotalField1 = document.getElementById("orderTotalId1");
			var orderTotalField2 = document.getElementById("orderTotalId2");

			var orderTotal=0;
			
			for (i=0; i<totalItemsInCart; i++) {
				var sField = document.getElementById("subtotalId"+i);
				orderTotal += parseInt(sField.innerHTML.substring(1, sField.innerHTML.length));
			}

			orderTotalField1.innerHTML = orderTotal;
			orderTotalField2.innerHTML = orderTotal;			
*/			
		}
	</script>
	
	<title>Usbong Store</title>
	<style type="text/css">

	::selection { background-color: #f07746; color: #fff; }
	::-moz-selection { background-color: #f07746; color: #fff; }
	
	body {
		background-color:  #f6f6f6;
		margin: 0px 0px 0px 0px;
		max-width: 100%;
		font: 16px/24px normal "Helvetica Neue",Helvetica,Arial,sans-serif;
		color: #808080;
	}
	
	.navbar {
		background-color: #1a0d00;
		margin: 0;
		z-index: 0;		
	}

	.categories-navbar {	
		background-color: #f6f6f6; <!-- #281e1a -->
		margin-bottom: 20px;
		display:table;
  		margin:0 auto;
  		
	}

	.categories-navbar li a {
		color: #281e1a;
	}


	.categories-navbar li a:hover {
		color: #747372;
	}
	
	a {
		color: #dec32e;
	}

	a:hover {
		color: #dec32e;
	}
	
	a.Footer-list-item {
		color: #fff;
	}
	
	span.Footer-list-header {
		color: #fff;
		font-weight: bold;
		font-size: 20px;
	}

	span.Footer-list-header:hover {
	}
	
	hr {
		margin-right: 142px;
		border: 1px solid #6d8f48;
	}

	hr.Cart-hr {
		border: 1px solid #6d8f48;
		margin: 10px 10px 10px 10px;
	}

	
	p {
		 padding:0;
	}

	p.footer {		
		text-align: right;
		font-size: 12px;
		border-top: 1px solid #d0d0d0;
		line-height: 32px;
		background: #52493f;
		color:#fff;
		margin: 20px 0 0 0; 
		padding: 0 10px 0 10px;
	}

	.Footer-container {		
		font-size: 18px;
		border-top: 1px solid #d0d0d0;
		line-height: 32px;
		background: #52493f;
		color:#fff;
		padding: 42px 20px 42px 120px; 
	}
	
	.Footer-container-list{		
		text-align: left;
		font-size: 14px;
		list-style-type: none;
	}
	
	.Customer-information-ul {
		text-align: left;
		font-size: 16px;
		list-style-type: none;
	}
	
	.Customer-information-li {
		display: inline-block;
	}

	.Contact-information-ul {
		text-align: left;
		font-size: 16px;
		list-style-type: none;

	    columns: 2;
	    -webkit-columns: 2;
	    -moz-columns: 2;
	}

	.Search-container {
		float: left;
		margin-top: 6px;	
		margin-left: 16px;	
	}

	.Search-input {
		float: left;
		font-size: 18px;
		padding: 4px;
		border: #ffffff;		
		border-radius: 3px;
		width: 300px;
	}
	
	.Button-container {
	}
	
	.Button {		
		padding: 5.5px;
		border-top: 1px solid #d0d0d0;
		border-right: 1px solid #d0d0d0;
		border-bottom: 1px solid #d0d0d0;
		border-left: #ffffff;		
		background:#ffffff;
	}

	.Remove-button {
		background-color: Transparent;
	    border: none;
	}
	
	Remove-button-image-text {
		pointer-events: none;
	}

	.Remove-button:hover {
		border: 1px solid #969696;
		border-radius: 4px;	
	}
	
	.Image-item {
	    max-width: 75%;
    	height: auto;
	}
	
	.Product-item {
		border-radius: 4px;	
		color: #222222;
	}

	.Product-item:hover {
		text-decoration: underline;
		color: #222222;
	}

	.Product-item-titleOnly {
		color: #222222;
		font-weight: bold;
	}

	.Product-item-details {
		color: #4b4b4b;	
		font-weight: normal;
	}

	.Product-item-price {
		color: #b88a1b;
	}

			
	.Product-image {
	    max-width: 75%;
    	height: auto;
	}
		
	.Cart-product-image {
	    max-width: 160%;
    	height: auto;
	}

	.Checkout-product-image {
	    max-width: 200%;
    	height: auto;
	}

	.Popup-product-image {
	    max-width: 120%;
    	height: auto;
    	margin-left: 6px;
	}

	.Product-name {
		color: #222222;
		font-size: 30px;
		font-weight: bold;	
	}

	.Cart-product-name {
		color: #222222;
		font-size: 18px;
		font-weight: bold;	
		margin-top: 4px;			
		margin-left: 10px;    			
	}

	.Checkout-product-name {
		color: #222222;
		font-size: 14px;
		font-weight: bold;	
		margin-left: 2px;    			
	}

	.Cart-product-price {
		color: #b88a1b;
		font-size: 20px;
		margin-top: 4px;		
	}

	.Cart-order-price {
		color: #b88a1b;
	}

	.Cart-product-price-each {
		color: #4b4b4b;
		font-size: 20px;
	}

	label.Cart-product-price {
		color: #4b4b4b;
	}

	label.Cart-product-item-subtotal {
		color: #4b4b4b;
	}

	.Cart-product-subtotal {
		color: #b88a1b;
		font-size: 20px;
		margin-top: 4px;		
		margin-right: 30px;
		text-align: right;
	}

	.Checkout-product-subtotal {
		color: #b88a1b;
		font-size: 14px;
		margin-top: 4px;		
		text-align: right;
	}

	.Checkout-order-list {
	}

	.Checkout-shopping-cart-text {
		font-size: 18px;
		margin-bottom: 10px;
		color: #1d1d1d;		
	}

	.Thankyou-text {
		font-size: 18px;
		padding: 20px 100px 20px 100px;
		color: #1d1d1d;
	}

	.Thankyou-order-detail-date-and-number {
		font-size: 16px;
		padding: 20px 20px 5px 20px;
		color: #1d1d1d;
	}

	.Thankyou-order-container {
		padding: 20px 40px 20px 20px;
		border: 1px solid #ab9c7d;		
		border-radius: 4px;
		margin: 20px;
		color: #1d1d1d;
	}

	.Thankyou-order-details {
		font-size: 14px;
		padding-left: 20px;
		padding-right: 20px;
		color: #1d1d1d;
    }

	.Thankyou-order-details-text {
		font-size: 14px;
		text-align: left;
		display:block;
		padding-left: 18px;
    }

	.Cart-order-list {
	}

	.Cart-order-total {
		border: 1px solid;		
		border-radius: 2px;	
		padding: 10px 22px 10px 7px;
		text-align: right;
		color: #77b043;
		font-weight: bold;
	}

	.Cart-order-total-row {
		color: #4b4b4b;
	}

	.Cart-order-total-with-checkout-row {
		border-top: 1px solid;				
		color: #4b4b4b;
		margin-left: 0px;
	}


	.Cart-product-author {
		color: #4b4b4b;
		font-size: 18px;
		margin-left: 6px;
	}

	.Checkout-product-author {
		color: #4b4b4b;
		font-size: 14px;
		margin-left: 6px;
	}

	.Product-author {
		color: #4b4b4b;
		font-size: 18px;
		margin-left: 6px;
	}

	.Cart-product-price {
		color: #b88a1b;
		font-size: 20px;
		margin-top: 4px;		
		margin-left: 6px;
	}

	.Product-price {
		color: #b88a1b;
		font-size: 24px;
		margin-top: 24px;		
		margin-left: 6px;
	}
	
	.Contact {
		width:60%;
		font-size: 18px;
		color: #4b4b4b;
		margin:40px;
		padding:0px;
	}
	
	.Contact-support-email-address {
		color: #77b043;
		font-weight: bold;	
	}
	
	.Order-summary {
		font-size: 18px;
		color: #4b4b4b;
		margin:0px;
		padding:0px;
	}

	.Order-summary-price {
		text-align: left;
    	display: inline-block;
	}

	.Order-summary-alternate {
		font-size: 18px;
		color: #4b4b4b;		
		background-color: #efe6ca;
	}
	
	.Fulfilled-Status-OK {
		background-color: #77b043;
	}

	.Fulfilled-Status-Not-OK {
		background-color: #e04949;
	}

	.Order-details {
		font-size: 18px;
		color: #4b4b4b;
		margin-left: 20px;
	}

	.Order-details-product {
		background-color: #efe6ca;
	}
	
	.Order-details-shipping-address {
		text-align: left;
	}
	
	.Order-details-purchased-datetime-stamp {
		text-align: right;
	}
	
	.Order-details-align-right {
		text-align: right;
	}

	.Order-details-align-right-order-total {
		text-align: right;
		background-color: #efe6ca;
	}
	
	.Order-details-order-number-link {
		font-size: 18px;  
		color: #4b4b4b;
	}

	.Order-details-order-number-link:hover {
		font-size: 18px;  
		color: #4b4b4b;
	}
	
	.Popup-product-details {
		font-size: 15px;
	}

	.Popup-product-currency-symbol {
		color: #b88a1b;
		font-size: 18px;
		margin-left: 6px;
	}

	.Popup-product-price {
		color: #b88a1b;
		font-size: 24px;
		margin-right: 2px;
	}

	.Popup-product-free-delivery {
		color: #b88a1b;
		font-size: 18px;
		margin-top: -30px;
		margin-right: 2px;
	}

	.Product-overview-header {
		color: #8bbf4f;
		margin-top: 12px;
		font-size: 18px;
	}

	.Product-overview-content {
		font-size: 16px;
		color: #5c534b;
	}

	.Cart-product-quantity {
		color: #4b4b4b;
		font-size: 16px;
		margin-top: 4px;
	}

	.Checkout-product-quantity {
		color: #4b4b4b;
		font-size: 14px;
		margin-top: 4px;
	}

	.Product-quantity {
		color: #4b4b4b;
		font-size: 16px;
		margin-top: 24px;
	}

	.Quantity-label {
		padding-right: 8px;
	}

	.Checkout-quantity-label {
		padding-right: 8px;
		color: #463000;
	}

	.Product-format {
		color: #312f2d;
		font-size: 16px;
		margin-top: 6px;
		margin-left: 32px;
		text-align: left;
	}
	
	.Product-condition {
		color: #312f2d;
		font-size: 16px;
		margin-top: 6px;
		margin-left: 32px;
		text-align: left;
	}
	

	.Product-purchase-button {
		color: #4b4b4b;
		font-size: 16px;
		margin-top: 12px;
	}

	.Button-purchase {
		padding: 8px 42px 8px 42px;
		background-color: #ffe400;
		color: #222222;
		font-weight: bold;
		border: 0px solid;		
		border-radius: 4px;
		margin-left: 16px;
	}

	.Button-purchase:hover {
		background-color: #d4be00;
	}

	.Button-continue-to-checkout {
		padding: 8px 24px 8px 24px;
		background-color: #ffe400;
		color: #222222;
		font-weight: bold;
		border: 0px solid;		
		border-radius: 4px;
		margin-left: 16px;
		font-size: 14px;
	}

	.Button-continue-to-checkout:hover {
		background-color: #d4be00;
	}

	.Button-view-cart {
		padding: 8px 42px 8px 42px;
		background-color: #84c44b;
		color: #222222;
		font-weight: bold;
		border: 0px solid;		
		border-radius: 4px;
	}

	.Button-view-cart:hover {
		background-color: #77b043;
	}
		
	.col-sm-3 {
		text-align:center
	}

	.col-sm-2 {
		text-align:center
	}
	
	.container {
		margin-left: 142px;
		margin-bottom: 48px;
	}	
	
	
	.Cart-container {
		margin-right: 24px;
		margin-left: 24px;
		margin-bottom: 12px;
	}	
	
	.Topbar-container {
		width: 100%;
		overflow: hidden;
		float: right;
	}
	
	.Login-container {
		float: left;
		margin-top: 16px;	
		margin-left: 36px;		
	}
	
	.Button-cart {
		background: #0000000;
		border: 0px solid;		
		padding: 0px;
		margin-top: 4px;
		margin-left: 6px;
	}	

	.Text-cart {
		pointer-events: none;
		position: absolute;
		color: white;
		padding-left: 15px;		
	    padding-top: 14px;
		font-size: 14px;
	}	

	.Text-cart-2digits {
		pointer-events: none;
		position: absolute;
		color: white;
		padding-left: 10px;		
	    padding-top: 14px;
		font-size: 14px;
	}	

	.Text-cart-3digits {
		pointer-events: none;
		position: absolute;
		color: white;
		padding-left: 8px;		
	    padding-top: 14px;
		font-size: 14px;
	}	
	
	.Customer-dropdown {
		margin-top: 16px;
	}
	
	.dropdown {
	    position: relative;
    	display: inline-block;
	}
	
	/* Dropdown Content (Hidden by Default) */
	.dropdown-menu {
	    display: none;
	    position: absolute;
	    background-color: #f9f9f9;
	    min-width: 160px;
	    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
	    z-index: 1;
	}
	
	/* Show the dropdown menu on hover */
	.dropdown:hover .dropdown-menu {
	    display: block;
	    margin-right:-80px;
	}
			
	.dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus {
         background-color:#f1f1f1;
         font-weight: bold;
 	}
 	
	.nav {
	}
	
	.header {
		margin: 0px 10px 0px 10px;	
		color: #1d1d1d;
	}

	.Thankyou-header {
		margin: 0px 10px 0px 10px;	
	    color: #77b043
	}
	
	.Search-result {
		margin-left: 100px;
		margin-bottom: 32px;	
		font-size: 18px;
		color: #1a0d00;
	}
	
	.Search-noResult {
		margin-left: 100px;
		margin-bottom: 32px;	
		font-size: 18px;
		color: #1a0d00;
	}

	.Cart-noResult {
		margin-top: 56px;
		margin-left: 560px;
		margin-bottom: 56px;	
		font-size: 18px;
		color: #1a0d00;
	}

	.Order-Summary-noResult {
		margin-top: 56px;
		margin-left: 300px;
		margin-bottom: 56px;	
		font-size: 18px;
		color: #1a0d00;
	}

	.Order-Details-noResult {
		margin-top: 50px;
		margin-left: 200px;
		font-size: 18px;
		color: #1a0d00;
	}
	
	.Order-Details-admin-fulfilled {
		text-align: right;
	}

	.usbongLogo {
		margin-top: 3px;
	}

	.Checkout-customer-information {
		max-width: 80%;		
		float: none;
    	display: block;
    	margin: 0 auto;
    	margin-bottom: 20px;
    	font-size: 24px;    	
    	padding: 16px;
    	border: 1px solid #4b3b2c;
    	border-radius: 4px;
    	color: #1d1d1d;    	
	}

	.Customer-information {
		max-width: 50%;		
		float: none;
    	display: block;
    	margin: 0 auto;
    	margin-bottom: 20px;
    	font-size: 24px;    	
    	padding: 16px;
    	border: 1px solid #4b3b2c;
    	border-radius: 4px;
	}

	.Customer-information-text-in-checkout {
		display: inline-block; 
		padding-right: 12px;	

	}
	
	.Account-settings {	
	}
	
	.Account-settings-subject-header {
		text-align: left;
		margin-left: 40px;
    	font-size: 18px;
    	color: #1a0d00;    	
    	border: .2px solid #4b3b2c;    	
    	background-color: #efe6ca;  
    	padding: 5px;  	    	
    	font-weight: bold;
	}

	.Account-settings-subject-content {
		text-align: left;
		margin-left: 40px;
		font-size: 18px;  
		color: #1a0d00;		  			
    	padding: 5px;  	    	
    	border: .2px dotted #4b3b2c;    	
	}
		
	.Account-settings-subject-content-link {
		text-align: left;
		margin-left: 40px;
		font-size: 18px;  
		color: #1a0d00;		  			
    	padding: 5px;  	    	
	}

	.Account-settings-subject-content-link:hover {
		color: #1a0d00;		  			
	}
		
	.login-and-create {
		max-width: 30%;		
		float: none;
    	display: block;
    	margin: 0 auto;
    	margin-bottom: 20px;
    	font-size: 24px;    	
    	padding: 16px;
    	border: 1px solid #4b3b2c;
    	border-radius: 4px;
	}
	
	.login-text {
		border-right: 1px solid;	
		display: inline-block; 
		padding-right: 12px;	
		color: #1d1d1d;		
	}
	
	.register-text {
    	font-size: 16px;    		
		display: inline-block; 
		padding-left: 12px;		
		padding-bottom: 12px;	
	}

	.login-text-in-create {
    	font-size: 16px;    		
		display: inline-block; 
		padding-left: 12px;		
		padding-bottom: 12px;	
	}
	
	.register-text-in-create {
		border-right: 1px solid;	
		display: inline-block; 
		padding-right: 12px;	
		color: #1d1d1d;		
	}

	.Login-input {
	    font-size: 16px;    			
	    padding: 6px;
	    width: 100%;
	    margin-bottom: 12px;		    
	}

	.Customer-information-text-in-checkout {
		display: inline-block; 
		padding-right: 12px;	
		margin-bottom: 16px;		
	}
	
	.Button-login {
	    font-size: 20px;    			
	    display: inline-block; 	    
		background-color: #ffe400;
		padding: 8px 30px 8px 30px;
		background-color: #ffe400;
		color: #222222;
		border: 0px solid;		
		border-radius: 4px;
	}
	
	.Button-login:hover {
		background-color: #d4be00;
	}

	.forgotPassword-div {
	    font-size: 14px;    			
	    padding: 10px;		
	    display: inline-block; 	    
	}	

	.forgotPassword-text {
	    font-size: 14px;    			
	    display: inline-block; 	    
	    color: #6b6b6b;
	}	

	.forgotPassword-text:hover {
	    font-size: 14px;    			
	    display: inline-block; 	    
	    color: #6b6b6b;
	}	
	
	.Register-input {
	    font-size: 16px;    			
	    padding: 6px;
	    width: 100%;
	    margin-bottom: 12px;		    
	}
	
	.Register-error {		
		font-size: 16px;
		color: #c14646;		
		background-color: #f6aaaa;
		border-top: 1px solid #c98989;	
		border-right: 1px solid #c98989;	
		border-left: 1px solid #c98989;		

		border-bottom: 1px solid #f6aaaa;					
		margin-bottom: -1px;
	}		

	.Update-error {		
		font-size: 16px;
		color: #c14646;		
		background-color: #f6aaaa;
		border-top: 1px solid #c98989;	
		border-right: 1px solid #c98989;	
		border-left: 1px solid #c98989;		

		border-bottom: 1px solid #f6aaaa;					
		margin-bottom: -1px;
	}		

	.Update-success {		
		font-size: 16px;
		color: #496d28;		
		background-color: #77b043;
		border-top: 1px solid #90d94f;	
		border-right: 1px solid #90d94f;	
		border-left: 1px solid #90d94f;		

		border-bottom: 1px solid #f6aaaa;					
		margin-bottom: -1px;
	}		

	.Checkout-div {
		margin: 0px;
		padding: 0px;
		position: relative;
	}

	.Checkout-input {
	    font-size: 16px;    			
	    padding: 16px 6px 6px 8px;
		margin-bottom: 12px;
	    resize: none;
		width: 100%;
		height: 50px;
		color: #3a3a3a;
	}

	.Checkout-input-mode-of-payment {
	    font-size: 16px;    			
	    padding: 6px;
	    width: 100%;
	    margin: 0;		    
	}
	
	.Checkout-input:focus ~ .floating-label,
	.Checkout-input:not(:focus):valid ~ .floating-label{
	  bottom: 50px;
	  font-size: 12px;
	  opacity: 1;
	}	

	.Update-input {
	    font-size: 16px;    			
	    padding: 16px 6px 6px 8px;
		margin-bottom: 12px;
	    resize: none;
		width: 100%;
		height: 50px;
		color: #3a3a3a;
	}

	.Update-input:focus ~ .floating-label,
	.Update-input:not(:focus):valid ~ .floating-label{
	  bottom: 50px;
	  font-size: 12px;
	  opacity: 1;
	}	
	
	.floating-label {
	  bottom: 40px;
	  position: absolute;
	  pointer-events: none;
	  font-size: 20px;
	  left: 10px;
	  transition: 0.2s ease all;
	  height: 10px;
	}

	.nopadding {
	   padding: 0 !important;
	   margin: 0 !important;
	}

	.Quantity-textbox { 
		background-color: #fCfCfC;
	    color: #68502b;
	    padding: 12px;
	    font-size: 16px;
	    border: 1px solid #68502b;
	    width: 20%;
	    border-radius: 3px;	    	    
	}
	
	.no-spin::-webkit-inner-spin-button, .no-spin::-webkit-outer-spin-button {
	    -webkit-appearance: none !important;
	    margin: 0px !important;
	    -moz-appearance:textfield !important;
	}
	
	/* 
	 * ------------------------------------------------------------------
	 * DROPDOWN
	 * Reference: https://www.w3schools.com/howto/howto_js_dropdown.asp;
	 * last accessed: 20170622	 
	 * ------------------------------------------------------------------
	 */

	/* Dropdown Button */
	.dropbtn {
	    background-color: #68502b;
	    color: white;
	    padding: 16px;
	    font-size: 16px;
	    border: none;
	    cursor: pointer;
	}
	
	/* Dropdown button on hover & focus */
	.dropbtn:hover, .dropbtn:focus {
	    background-color: #9f7b42;
	}
	
	/* The container <div> - needed to position the dropdown content */
	.dropdown {
	    position: relative;
	    display: inline-block;
	}
	
	/* Dropdown Content (Hidden by Default) */
	.dropdown-content {
	    display: none;
	    position: absolute;
	    background-color: #f9f9f9;
	    min-width: 40px;
	    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
	    z-index: 1;
	}
	
	/* Links inside the dropdown */
	.dropdown-content a {
	    color: black;
	    padding: 12px 16px;
	    text-decoration: none;
	    display: block;
	}
	
	/* Change color of dropdown links on hover */
	.dropdown-content a:hover {background-color: #f1f1f1}
	
	/* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
	.show {display:block;}
	
	/* added by Mike, 20170626 */		
	/* Popup container */
	.popup {
	    position: relative;
	    display: inline-block;
	}
	
	/* The actual popup (appears on top) */
	.popup-content {
	    display: none;
    	position: fixed;
    	top: 50px;
    	right: 10px;	    
    	width: 300px;
    	background-color: #f9f9f9;
	    padding: 16px;
	    min-width: 40px;
	    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
	    z-index: 1;
	    border-radius: 3px;	    
	}

</style>
</head>
<body>
</body>
</html>
