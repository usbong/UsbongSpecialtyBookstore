<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
	<div class="login-and-create">
		<div class="register-text-in-create"><b>Create New Account</b></div>
		<div class="login-text-in-create"><a href = "<?php echo site_url('account/login/')?>"><b>Sign In</b></a></div>
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
			<form method="post" action="<?php echo site_url('b/literature_and_fiction')?>">
				<?php 
					//First Name--------------------------------------------------
					if (isset($data['firstNameParam'])) {
						echo '<input type="text" class="Register-input" placeholder="First Name" name="firstNameParam" value="'.$data['firstNameParam'].'" required>';
					}
					else { //default
						echo '<input type="text" class="Register-input" placeholder="First Name" name="firstNameParam" required>';
					}
					//-----------------------------------------------------------

					//Last Name--------------------------------------------------
					if (isset($data['lastNameParam'])) {
						echo '<input type="text" class="Register-input" placeholder="Last Name" name="lastNameParam" value="'.$data['lastNameParam'].'" required>';
					}
					else { //default
						echo '<input type="text" class="Register-input" placeholder="Last Name" name="lastNameParam" required>';
					}
					//-----------------------------------------------------------

					
					//Error Message
					if (strpos($validation_errors, "The Email Address field must contain a valid email address.") !== false) {
						echo '<div class="Register-error">Email Address is not a valid email.</div>';					
					}					
					
					//Email Address--------------------------------------------------					
					if (isset($data['emailAddressParam'])) {
						echo '<input type="text" class="Register-input" placeholder="Email Address" name="emailAddressParam" value="'.$data['emailAddressParam'].'" required>';
					}
					else { //default
						echo '<input type="text" class="Register-input" placeholder="Email Address" name="emailAddressParam" required>';
					}
					//-----------------------------------------------------------
					
					//Error Message					
					if (strpos($validation_errors, "The Confirm Email Address field does not match the Email Address field.") !== false) {
						echo '<div class="Register-error">Confirm Email does not match Email Address.</div>';
					}				
					
					//Confirm Email Address--------------------------------------------------
					if (isset($data['confirmEmailAddressParam'])) {
						echo '<input type="text" class="Register-input" placeholder="Confirm Email Address" name="confirmEmailAddressParam" value="'.$data['confirmEmailAddressParam'].'" required>';
					}
					else { //default
						echo '<input type="text" class="Register-input" placeholder="Confirm Email Address" name="confirmEmailAddressParam" required>';
					}

					//Password--------------------------------------------------					
					if (isset($data['passwordParam'])) {
						echo '<input type="password" class="Register-input" placeholder="Password" name="passwordParam" value="'.$data['passwordParam'].'" required>';
					}
					else { //default
						echo '<input type="password" class="Register-input" placeholder="Password" name="passwordParam" required>';
					}
					//-----------------------------------------------------------
					
					//Error Message
					if (strpos($validation_errors, "The Password Confirmation field does not match the Password field.") !== false) {
						echo '<div class="Register-error">Confirm Password does not match Password.</div>';
					}
					
					//Confirm Email Address--------------------------------------------------
					if (isset($data['confirmPasswordParam'])) {
						echo '<input type="password" class="Register-input" placeholder="Confirm Password" name="confirmPasswordParam" value="'.$data['confirmPasswordParam'].'" required>';
					}
					else { //default
						echo '<input type="password" class="Register-input" placeholder="Confirm Password" name="confirmPasswordParam" required>';
					}				
					
					//reset the session values to null
					$this->session->set_flashdata('errors', null);
					$this->session->set_flashdata('data', null); //added by Mike, 20170619
				?>
				<button type="submit" class="Button-login">
<!-- <img src="<?php echo base_url('assets/images/cart_icon.png'); ?>">	
 -->					
 				Register
				</button>
			</form>
		</div>		
	</div>
</body>
</html>
