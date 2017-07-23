<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>		
	<nav class="navbar navbar-inverse navbar-static-top">
	  <div class="container-fluid">
		<ul class="nav navbar-nav">
		  <li><div class="usbongLogo"><a href = "<?php echo site_url('/')?>"><img src="<?php echo base_url('assets/images/usbongStoreBrandLogo.png'); ?>"></a></div></li>
		  <li><div class="input-group Search-container">
					<form method="get" action="<?php echo site_url('browse/search')?>">
					<?php if ((isset($param)) && ($param!="")) {
						echo '<input type="text" class="Search-input" placeholder="I\'m looking for..." value="'.$param.'" name="param" required>';
					}
					else { //default
						echo '<input type="text" class="Search-input" placeholder="I\'m looking for..." name="param" required>';
					}
					?>
					<div class="input-group-btn">
				      <button class="btn btn-default" type="submit">
				        <i class="glyphicon glyphicon-search"></i>
				      </button>
					</div>
					</form>
			  </div></li>
		</ul>		
		<ul class="nav navbar-nav navbar-right" role="menu">
		  <li>
			<div class="dropdown">
				<?php
						$is_login_successful = false;
			  			if (($this->session->has_userdata('customer_first_name')!==null) &&
			  				(!empty($this->session->userdata('customer_first_name')))) {
							$is_login_successful = true;
						}

			  			if ($is_login_successful) {
				 			echo '<div class="Customer-dropdown">';
			  				echo "<a><b>Hi, ".$this->session->userdata('customer_first_name')."!</b></a>";

								echo '<div class="dropdown">';
								echo '<ul class="dropdown-menu">';			  		
								  	echo '<li><a href = "'.site_url('account/settings/').'">My Account</a></li>';				

								  	if ($this->session->userdata('is_admin')=="1") { //true
								  		echo '<li><a href = "'.site_url('account/ordersummaryadmin/').'">Order Summary (Admin)</a></li>';								  	
								  	}
								  	
								  	echo '<li><a href = "'.site_url('account/ordersummary/').'">Order Summary</a></li>';								  
								  	echo '<li><a href = "'.site_url('account/logout/').'">Log Out</a></li>';
								echo '</ul>';
								echo '</div>';
							echo '</div>';
			  			}
				  		else {
				 			echo '<div class="Customer-dropdown">';
				  			echo '<a href = "'.site_url('account/login/').'">';
				  			echo "<b>Login</b>";
				  			echo '</a>';
				 			echo '</div">';
				  		}
				 ?>
			</div>
		  </li>
		  <li>
			<div class="Cart-container">
				<form method="post" action="<?php 
										//added by Mike, 20170627
										if ($this->session->userdata('customer_id')=="") {
											echo site_url('account/login/');									
										}
										else {
											echo site_url('cart/shoppingcart');								
										}
											?>"				
					>
					<button type="submit" class="Button-cart">
							<input type="hidden" id="totalItemsInCartId" value="<?php echo $totalItemsInCart;?>">

							<label class="Text-cart" id="Text-cartId">
								<?php 
									if ($totalItemsInCart<10) {
										echo $totalItemsInCart;
									}
								?>
							</label>
									
							<label class="Text-cart-2digits" id="Text-cart-2digitsId">
								<?php 
									if (($totalItemsInCart>9) && ($totalItemsInCart<100)) {
										echo $totalItemsInCart;
									}
								?>
							</label>

							<label class="Text-cart-3digits" id="Text-cart-3digitsId">
								<?php 
									if ($totalItemsInCart>99) {
										echo $totalItemsInCart;
									}
								?>
							</label>	
							<?php 
								echo '<img src="'.base_url('assets/images/cart_icon_not_empty.png').'">'
							?>
					</button>
				</form>
			</div>    
		  </li>
		</ul>
		</div>
	</nav>	
	<nav class="navbar navbar-static-top categories-navbar ">
	  <div class="container-fluid">
		<ul class="nav navbar-nav">
		  <li><a href = "<?php echo site_url('b/books/')?>">BOOKS</a></li>
		  <li><a href = "<?php echo site_url('b/textbooks/')?>">TEXTBOOKS</a></li>
		  <li><a href = "<?php echo site_url('b/promos/')?>">PROMOS</a></li>
		  <li><a href = "<?php echo site_url('b/beverages/')?>">BEVERAGES</a></li>
		  <li><a href = "<?php echo site_url('b/comics/')?>">COMICS</a></li>
		  <li><a href = "<?php echo site_url('b/manga/')?>">MANGA</a></li>
		  <li><a href = "<?php echo site_url('b/toys-and-collectibles/')?>">TOYS & COLLECTIBLES</a></li>
		</ul>
	</nav>	
</body>
</html>
