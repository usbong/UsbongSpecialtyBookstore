<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
	<h2 class="header">Checkout</h2>
	<br>
	<div>
	<div class="row nopadding">
		<div class="col-sm-3 Checkout-order-list">	
		<div class="Checkout-shopping-cart-text"><b>Shopping Cart</b></div>			
				<?php				
					//added by Mike, 20170626
//					$orderTotal = 0;				
					$colCounter = 0;
					$itemCounter = 0;
//					$totalQuantity = 0;
										
					foreach ($result as $value) {
						$reformattedProductName = str_replace(':','',str_replace('\'','',$value['name'])); //remove ":" and "'"
						$URLFriendlyReformattedProductName = str_replace(',','',str_replace(' ','-',$reformattedProductName)); //replace " " and "-"
						$URLFriendlyReformattedBookAuthor = str_replace(',','',str_replace(' ','-',$value['author'])); //replace " " and "-"
						
						$productType="books"; //default
						switch($value['product_type_id']) {
							case 3: //beverages
								$productType="beverages";
								break;
							case 5: //combos
								$productType="combos";
								break;
							case 6: //comics
								$productType="comics";
								break;
							case 7: //manga
								$productType="manga";
								break;
							case 8: //toys & collectibles
								$productType="toys_and_collectibles";
								break;
						}
					?>
						<div class="row">
							<div class="col-sm-2">	
								<img class="Checkout-product-image" src="<?php echo base_url('assets/images/'.$productType.'/'.$reformattedProductName.'.jpg');?>">				
							</div>
							<div class="col-sm-7">	
								<div class="row Checkout-product-name">							
									<?php
										echo '<a class="Product-item" href="'.site_url('w/'.$URLFriendlyReformattedProductName.'-'.$URLFriendlyReformattedBookAuthor.'/'.$value['product_id']).'">';
										echo $value['name'];
										echo '</a>';
									?>
								</div>
								<div class="row Checkout-product-author">
									<b>
									<?php
										echo $value['author'];
									?>
									</b>
								</div>		
								<div class="row Checkout-product-quantity">
									<label class="Checkout-quantity-label">Quantity: <?php echo $value['quantity'];?></label>
								</div>										
							</div>
							<div class="col-sm-3">								
								<div class="row Checkout-product-subtotal">
									<?php
										if (trim($value['price'])=='') {
											echo '&#x20B1; 0';
										}
										else {
											echo '<label id="subtotalId'.$itemCounter.'">&#x20B1;'.$value['quantity']*$value['price'].'</label>';
										}
/*																																							
										//added by Mike, 20170626
										$orderTotal+=($value['quantity']*$value['price']); //multiply with quantity to get the subtotal
*/										
									?>	
									<br>
									<label class="Cart-product-item-subtotal">(Subtotal)</label>																				
								</div>
							</div>
						</div>
						<hr class="Cart-hr">
					<?php 
//						$totalQuantity+=$value['quantity'];
						$itemCounter++;
					  }
					?>					
					</div>
		<form method="post" action="<?php echo site_url('cart/confirm')?>">
		<div class="col-sm-6 nopadding">			
			<div class="Checkout-customer-information">	
				<div class="Customer-information-text-in-checkout"><b>Customer Information</b></div>
				<?php
					//added by Mike, 20170710
					$totalQuantity = $quantity;
					$orderTotal = $order_total_price;
				
					$validation_errors="";
					if ($this->session->flashdata('errors')) {
						$validation_errors = $this->session->flashdata('errors');
					}	
					
					$data=[];
					if ($this->session->flashdata('data')) {
						$data = $this->session->flashdata('data');
					}
			    ?>
				<div class="fields">
								<?php 
								//Email Address--------------------------------------------------					
								//Error Message
								if (strpos($validation_errors, "The Email Address field must contain a valid email address.") !== false) {
									echo '<div class="Register-error">Email Address is not a valid email.</div>';
								}		
								echo '<div class="Checkout-div">';
								if (isset($data['emailAddressParam'])) {
									echo '<input type="text" class="Checkout-input" placeholder="" name="emailAddressParam" value="'.$data['emailAddressParam'].'" required>';
								}
								else if (isset($customer_information_result->customer_email_address)) {
									echo '<input type="text" class="Checkout-input" placeholder="" name="emailAddressParam" value="'.$customer_information_result->customer_email_address.'" required>';
								}
								else { //default
									echo '<input type="text" class="Checkout-input" placeholder="" name="emailAddressParam" required>';
								}
								echo '<span class="floating-label">Email Address</span>';
								echo '</div>';
								//-----------------------------------------------------------
								
								//First Name--------------------------------------------------
								echo '<div class="Checkout-div">';					
								if (isset($data['firstNameParam'])) {
									echo '<input type="text" class="Checkout-input" placeholder="" name="firstNameParam" value="'.$data['firstNameParam'].'" required>';
								}
								else if (isset($customer_information_result->customer_first_name)) {
									echo '<input type="text" class="Checkout-input" placeholder="" name="firstNameParam" value="'.$customer_information_result->customer_first_name.'" required>';
								}						
								else { //default
									echo '<input type="text" class="Checkout-input" placeholder="" name="firstNameParam" required>';
								}
								echo '<span class="floating-label">First Name</span>';
								echo '</div>';
								//-----------------------------------------------------------
								
								//Last Name--------------------------------------------------
								echo '<div class="Checkout-div">';					
								if (isset($data['lastNameParam'])) {
									echo '<input type="text" class="Checkout-input" placeholder="" name="lastNameParam" value="'.$data['lastNameParam'].'" required>';
								}
								else if (isset($customer_information_result->customer_last_name)) {
									echo '<input type="text" class="Checkout-input" placeholder="" name="lastNameParam" value="'.$customer_information_result->customer_last_name.'" required>';
								}						
								else { //default
									echo '<input type="text" class="Checkout-input" placeholder="" name="lastNameParam" required>';
								}
								echo '<span class="floating-label">Last Name</span>';
								echo '</div>';
								//-----------------------------------------------------------
								
		
								//Contact Number--------------------------------------------------
								echo '<div class="Checkout-div">';						
								//Error Message
								if (strpos($validation_errors, "The Contact Number field must contain only numbers.") !== false) {
									echo '<div class="Register-error">Contact Number must contain only numbers.</div>';
								}
								if (isset($data['contactNumberParam'])) {
									echo '<input type="tel" class="Checkout-input" placeholder="" name="contactNumberParam" value="'.$data['contactNumberParam'].'" required>';
								}
								else if (isset($customer_information_result->customer_contact_number)) {
									echo '<input type="text" class="Checkout-input" placeholder="" name="contactNumberParam" value="'.$customer_information_result->customer_contact_number.'" required>';
								}
								else { //default
									echo '<input type="tel" class="Checkout-input" placeholder="" name="contactNumberParam" required>';
								}
								echo '<span class="floating-label">Contact Number</span>';
								echo '</div>';
								//-----------------------------------------------------------
								
								
								//Shipping Address--------------------------------------------------
								echo '<div class="Checkout-div">';						
								if (isset($data['shippingAddressParam'])) {
									echo '<input type="text" class="Checkout-input" placeholder="" name="shippingAddressParam" value="'.$data['shippingAddressParam'].'" required>';
								}
								else if (isset($customer_information_result->customer_shipping_address)) {
									echo '<input type="text" class="Checkout-input" placeholder="" name="shippingAddressParam" value="'.$customer_information_result->customer_shipping_address.'" required>';
								}
								else { //default
									echo '<input type="text" class="Checkout-input" placeholder="" name="shippingAddressParam" required>';
								}
								echo '<span class="floating-label">Shipping Address</span>';
								echo '</div>';
								//-----------------------------------------------------------
								
								//City--------------------------------------------------
								echo '<div class="Checkout-div">';						
								if (isset($data['cityParam'])) {
									echo '<input type="text" class="Checkout-input" placeholder="" name="cityParam" value="'.$data['cityParam'].'" required>';
								}
								else if (isset($customer_information_result->customer_city)) {
									echo '<input type="text" class="Checkout-input" placeholder="" name="cityParam" value="'.$customer_information_result->customer_city.'" required>';
								}
								else { //default
									echo '<input type="text" class="Checkout-input" placeholder="" name="cityParam" required>';
								}
								echo '<span class="floating-label">City</span>';
								echo '</div>';
								//-----------------------------------------------------------
								
								
								//Country--------------------------------------------------
								echo '<div class="Checkout-div">';
								if (isset($data['countryParam'])) {
									echo '<input type="text" class="Checkout-input" placeholder="" name="countryParam" value="'.$data['countryParam'].'" required>';
								}
								else if (isset($customer_information_result->customer_country)) {
									echo '<input type="text" class="Checkout-input" placeholder="" name="countryParam" value="'.$customer_information_result->customer_country.'" required>';
								}
								else { //default
									echo '<input type="text" class="Checkout-input" placeholder="" name="countryParam" required>';
								}
								echo '<span class="floating-label">Country</span>';
								echo '</div>';
								//-----------------------------------------------------------
		
								//Postal Code--------------------------------------------------
								echo '<div class="Checkout-div">';						
								if (strpos($validation_errors, "The Postal Code field must contain only numbers.") !== false) {
									echo '<div class="Register-error">Postal Code must contain only numbers.</div>';
								}
								//Postal Code--------------------------------------------------
								if (isset($data['postalCodeParam'])) {
									echo '<input type="text" class="Checkout-input" placeholder="" name="postalCodeParam" value="'.$data['postalCodeParam'].'" required>';
								}
								else if (isset($customer_information_result->customer_postal_code)) {
									echo '<input type="text" class="Checkout-input" placeholder="" name="postalCodeParam" value="'.$customer_information_result->customer_postal_code.'" required>';
								}
								else { //default
									echo '<input type="text" class="Checkout-input" placeholder="" name="postalCodeParam" required>';
								}
								echo '<span class="floating-label">Postal Code</span>';
								echo '</div>';
								//-----------------------------------------------------------
								
								echo '<label class="Checkout-input-mode-of-payment">-Mode of Payment-</label>';
								$isBankDepositChecked=true;												
								if (isset($data['modeOfPaymentParam'])) {
									if ($data['modeOfPaymentParam']==0) {
										$isBankDepositChecked=true;
									}
									else {
										$isBankDepositChecked=false;
									}							
								}						
								else if (isset($customer_information_result->mode_of_payment_id)) {
									if ($customer_information_result->mode_of_payment_id==0) {
										$isBankDepositChecked=true;
									}
									else {
										$isBankDepositChecked=false;
									}
								}
		
								if ($isBankDepositChecked==true) {
									echo '<div class="radio Checkout-input-mode-of-payment">';
									echo '<label><input type="radio" name="modeOfPaymentParam" value="0" checked>Bank Deposit</label>';
									echo '</div>';
									echo '<div class="radio Checkout-input-mode-of-payment">';
									echo '<label><input type="radio" name="modeOfPaymentParam" value="1">Paypal</label>';
									echo '</div>';
								}
								else {
									echo '<div class="radio Checkout-input-mode-of-payment">';
									echo '<label><input type="radio" name="modeOfPaymentParam" value="0">Bank Deposit</label>';
									echo '</div>';
									echo '<div class="radio Checkout-input-mode-of-payment">';
									echo '<label><input type="radio" name="modeOfPaymentParam" value="1" checked>Paypal</label>';
									echo '</div>';							
								}
								
								echo '<br>';
								
								//reset the session values to null
								$this->session->set_flashdata('errors', null);
								$this->session->set_flashdata('data', null); //added by Mike, 20170619
							?>
					</div>	
				</div>
			</div>
			<div class="col-sm-3">
				<div class="Cart-order-total">
						<div class="row Cart-order-total-row">
							<div class="col-sm-6">		
								<?php 									
									if ($totalQuantity>1) {	
										echo '<span id="totalQuantityId">'.$totalQuantity.'</span> items';
									}
									else {
										echo '<span id="totalQuantityId">'.$totalQuantity.'</span> item';
									}
								?>		
							</div>
							<div class="col-sm-6 Cart-order-price">		
							    <?php echo '<label>&#x20B1;<span id="orderTotalId1">'.$orderTotal.'</span></label>';?>
							
								<?php //echo '&#x20B1; '.$orderTotal?>		
							</div>								
						</div>
						<div class="row Cart-order-total-row">
							<div class="col-sm-6">		
								Shipping (PH)
							</div>
							<div class="col-sm-6">		
								FREE
							</div>		
						</div>						
						<div class="row Cart-order-total-with-checkout-row">
							<div class="col-sm-6">		
								Order Total
							</div>
							<div class="col-sm-6 Cart-order-price">		
							    <?php echo '<label>&#x20B1;<span id="orderTotalId2">'.$orderTotal.'</span></label>';?>

								<?php //echo '&#x20B1; '.$orderTotal?>		
							</div>								
						</div>
						<br>
						<div class="row Cart-order-total-row">
							<div class="col-sm-12">												
								<button type="submit" class="Button-continue-to-checkout">
			 						CONFIRM
								</button>				
							</div>
						</div>											
					</div>		
			</div>
			</form>			
		</div>
</body>
</html>