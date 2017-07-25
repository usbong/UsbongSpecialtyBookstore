<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-3">	
				<?php 
				
					$reformattedProductName = str_replace(':','',str_replace('\'','',$result->name)); //remove ":" and "'"				
					
					$productType="books"; //default
					switch($result->product_type_id) {
						case 3: //beverages
							$productType="beverages";
							break;
						case 5: //combos
							$productType="promos";
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
						case 9: //textbooks
							$productType="textbooks";
							break;						
					}
				?>
				<img class="Product-image" src="<?php echo base_url('assets/images/'.$productType.'/'.$reformattedProductName.'.jpg');?>">				
				<?php
					if (($productType=="books") || ($productType=="textbooks")
							|| ($productType=="manga")) {
				?>						
				<div class="row Product-format">
					<?php
						echo 'Format: <b>'.$result->format.'</b>';						
					?>
				</div>					
				<div class="row Product-condition">
					<?php
						echo 'Condition: <b>'.$result->description.'</b>';						
					?>
				</div>
				<?php 	
					}
				?>
			</div>
			<div class="col-sm-5">	
				<div class="row Product-name">
					<?php
						echo $result->name;
					?>
				</div>
				<div class="row Product-author">
					<b>
					<?php
						echo $result->author;
					?>
					</b>
				</div>				
				<div class="row">	
					<div class="Product-overview-header"><b>Product Overview</b><br></div>
					<div class="Product-overview-content">
					<?php	
						if (!empty($result->product_overview)) {							
							echo $result->product_overview;
						}
						else {
							echo '<br><br><i>&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;No synopsis available.</i>';							
						}
					?>
					</div>
				</div>		
			</div>
			<div class="col-sm-3">	
				<div class="row Product-price">
					<b>
					<?php
					if (trim($result->price)=='') {
						echo 'out of stock';						
					}
					else {
						echo '&#x20B1;'.$result->price.' [Free Delivery]';
					}
					?>
					</b>					
				</div>						
				<div class="row Product-quantity">
					<label class="Quantity-label">Quantity:</label>
					<input type="tel" id="quantityParam" class="Quantity-textbox no-spin" 
							value="1" min="1" max="99" onKeyPress="if(this.value.length==2) {return false;} if(parseInt(this.value)<1) { this.value='1'; return false;}" required>					    
				</div>
					<div class="row Product-purchase-button">				
						<?php 
								$quantity = 1;
								//TODO: fix quantity and price
									
								echo '<input type="hidden" id="product_idParam" value="'.$result->product_id.'" required>';
								echo '<input type="hidden" id="customer_idParam" value="'.$this->session->userdata('customer_id').'" required>';										
// 								echo '<input type="hidden" id="quantityParam" value="'.$quantity.'" required>';
								echo '<input type="hidden" id="priceParam" value="'.$result->price.'" required>';							
						?>						
						<button onclick="myPopupFunction()" class="Button-purchase">ADD TO CART</button>				
						<div id="myPopup" class="popup-content">
							<div class="row">
								<div class="col-sm-4">									
									<img class="Popup-product-image" src="<?php echo base_url('assets/images/'.$productType.'/'.$reformattedProductName.'.jpg');?>">				
								</div>
								<div class="col-sm-8 Popup-product-details">
									<span id="quantityId"></span>
									<?php 
									
/*									
										$quantity=1;
										if ($quantity>1) {
											echo 'Added<b>'.$quantity.'</b> copies of ';									
										}
										else {
											echo 'Added <b>1</b> copy of ';
										}
*/										
										echo '<b>'.$result->name.'</b>!'
									?>
									<br><b>Order Total: </b>
									<label class="Popup-product-price">&#x20B1;<?php echo $result->price;?></label>
									<label class="Popup-product-free-delivery"><br>[Free Delivery]</label> 												
								<form method="post" action="<?php echo site_url('cart/shoppingcart')?>">
									<button type="submit" class="Button-view-cart">
										View Cart 
									</button>
								</form>						
								</div>
							</div>
						</div>					
					</div>				
			</div>
		</div>	
	</div>		
</body>
</html>
