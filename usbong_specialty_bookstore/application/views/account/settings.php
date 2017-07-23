<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
	<h2 class="header">Account Settings</h2>
	<br>
	<br>
	<div>
		<div class="row">
			<div class="col-sm-3 Account-settings">
					<div class="row Account-settings-subject-header">Orders</div>
					<div class="row Account-settings-subject-content"><a class="Account-settings-subject-content-link" href="<?php echo site_url('account/ordersummary/')?>">Order Summary</a></div>				
					<div class="row Account-settings-subject-header">Settings</div>
					<div class="row Account-settings-subject-content"><a class="Account-settings-subject-content-link" href="<?php echo site_url('account/settings/')?>">Update Information</a></div>
					<div class="row Account-settings-subject-content"><a class="Account-settings-subject-content-link" href="<?php echo site_url('account/updatepassword/')?>">Update Password</a></div>
			</div>
			<div class="col-sm-9">	
			<div class="Customer-information">
				<div class="Customer-information-text-in-checkout"><b>Customer Information</b></div>
				<?php
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
						<form method="post" action="<?php echo site_url('account/save')?>">
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
								else if (isset($result->customer_email_address)) {
									echo '<input type="text" class="Checkout-input" placeholder="" name="emailAddressParam" value="'.$result->customer_email_address.'" required>';
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
								else if (isset($result->customer_first_name)) {
									echo '<input type="text" class="Checkout-input" placeholder="" name="firstNameParam" value="'.$result->customer_first_name.'" required>';
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
									echo '<input type="text" class="Checkout-input" placeholder="Name" name="lastNameParam" value="'.$data['lastNameParam'].'" required>';
								}
								else if (isset($result->customer_last_name)) {
									echo '<input type="text" class="Checkout-input" placeholder="Name" name="lastNameParam" value="'.$result->customer_last_name.'" required>';
								}						
								else { //default
									echo '<input type="text" class="Checkout-input" placeholder="Name" name="lastNameParam" required>';
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
								else if (isset($result->customer_contact_number)) {
									echo '<input type="text" class="Checkout-input" placeholder="" name="contactNumberParam" value="'.$result->customer_contact_number.'" required>';
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
								else if (isset($result->customer_shipping_address)) {
									echo '<input type="text" class="Checkout-input" placeholder="" name="shippingAddressParam" value="'.$result->customer_shipping_address.'" required>';
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
								else if (isset($result->customer_city)) {
									echo '<input type="text" class="Checkout-input" placeholder="" name="cityParam" value="'.$result->customer_city.'" required>';
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
								else if (isset($result->customer_country)) {
									echo '<input type="text" class="Checkout-input" placeholder="" name="countryParam" value="'.$result->customer_country.'" required>';
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
								else if (isset($result->customer_postal_code)) {
									echo '<input type="text" class="Checkout-input" placeholder="" name="postalCodeParam" value="'.$result->customer_postal_code.'" required>';
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
								else if (isset($result->mode_of_payment_id)) {
									if ($result->mode_of_payment_id==0) {
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
							<br>
							<button type="submit" class="Button-login">
			<!-- <img src="<?php echo base_url('assets/images/cart_icon.png'); ?>">	
			 -->					
			 				Save
							</button>
						</form>
					</div>	
				</div>
			</div>
		</div>
	</div>
</body>
</html>