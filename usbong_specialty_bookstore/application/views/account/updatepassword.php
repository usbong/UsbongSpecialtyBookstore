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
			<div class="col-sm-9 nopadding nomargin">	
			<div class="Customer-information">
				<div class="Customer-information-text-in-checkout"><b>Update Password</b></div>
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
						<form method="post" action="<?php echo site_url('account/savepassword')?>">
								<?php 
								//Current Password--------------------------------------------------					
								//Error Message
/*								if (strpos($validation_errors, "The Confirm New Password field does not match the New Password field.") !== false) {
									echo '<div class="Update-error">The Confirm New Password field does not match the New Password field.</div>';
								}		
								*/					
								
								if (isset($is_update_password_successful)) {
									echo '<div class="Update-success">Update Successful.</div>';									
								}
								
								if (isset($data['password_is_incorrect'])) {
									echo '<div class="Update-error">The Current Password field is incorrect.</div>';
								}
								echo '<div class="Checkout-div">';
								if (isset($data['currentPasswordParam'])) {
									echo '<input type="password" class="Update-input" placeholder="" name="currentPasswordParam" value="'.$data['currentPasswordParam'].'" required>';
								}
								else { //default
									echo '<input type="password" class="Update-input" placeholder="" name="currentPasswordParam" required>';
								}
								echo '<span class="floating-label">Current Password</span>';
								echo '</div>';
								//-----------------------------------------------------------
								
								//New Password--------------------------------------------------
								echo '<div class="Checkout-div">';					
								if (isset($data['newPasswordParam'])) {
									echo '<input type="password" class="Update-input" placeholder="" name="newPasswordParam" value="'.$data['newPasswordParam'].'" required>';
								}
								else { //default
									echo '<input type="password" class="Update-input" placeholder="" name="newPasswordParam" required>';
								}
								echo '<span class="floating-label">New Password</span>';
								echo '</div>';
								//-----------------------------------------------------------
								
								//Confirm New Password--------------------------------------------------
								//Error Message
								if (strpos($validation_errors, "The Confirm New Password field does not match the New Password field.") !== false) {
									echo '<div class="Update-error">The Confirm New Password field does not match the New Password field.</div>';
								}							
								echo '<div class="Checkout-div">';					
								if (isset($data['confirmNewPasswordParam'])) {
									echo '<input type="password" class="Update-input" placeholder="" name="confirmNewPasswordParam" value="'.$data['confirmNewPasswordParam'].'" required>';
								}
								else { //default
									echo '<input type="password" class="Update-input" placeholder="" name="confirmNewPasswordParam" required>';
								}
								echo '<span class="floating-label">Confirm New Password</span>';
								echo '</div>';
								//-----------------------------------------------------------

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