<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
	<h2 class="header">Shopping Cart</h2>
	<br>
	<?php 
		$resultCount = count($result);
		if ($resultCount==0) {
			echo '<div class="Cart-noResult">';
			echo 'It is currently empty.';
			echo '</div>';
		}
		else {
	?>
		<div class="Cart-container">
			<div class="row">
			<div class="col-sm-9 Cart-order-list">		
				<form method="post" action="<?php echo site_url('cart/checkout')?>">																			
				<?php				
					//added by Mike, 20170626
					$orderTotal = 0;				
					$colCounter = 0;
					$itemCounter = 0;
					$totalQuantity = 0;
					
					if ($result=='') {
						redirect('/account/login', 'refresh');
					}
					
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
							<div class="col-sm-1">	
								<img class="Cart-product-image" src="<?php echo base_url('assets/images/'.$productType.'/'.$reformattedProductName.'.jpg');?>">				
							</div>
							<div class="col-sm-3">	
								<div class="row Cart-product-name">							
									<?php
										echo '<a class="Product-item" href="'.site_url('w/'.$URLFriendlyReformattedProductName.'-'.$URLFriendlyReformattedBookAuthor.'/'.$value['product_id']).'">';
										echo $value['name'];
										echo '</a>';
									?>
								</div>
								<div class="row Cart-product-author">
									<b>
									<?php
										echo $value['author'];
									?>
									</b>
								</div>				
							</div>
							<div class="col-sm-3">	
								<div class="row Cart-product-price">
									<b>
									<?php
									if (trim($value['price'])=='') {
										echo '<input type="hidden" name="priceParam'.$itemCounter.'" value="0">';
										echo 'out of stock';						
									}
									else {										
										echo '<input type="hidden" name="priceParam'.$itemCounter.'" value="'.$value['price'].'">';
										echo '<label>&#x20B1;<span id="priceId'.$itemCounter.'">'.$value['price'].'</span> [Free Delivery]</label>';
									}
									?>
									</b>
									<br>
									<label class="Cart-product-price-each">each</label>					
								</div>					
							</div>
							<div class="col-sm-3">					
								<div class="row Cart-product-quantity">
									<label class="Quantity-label">Quantity:</label>
									<input type="tel" id="quantityId<?php echo $itemCounter.'~'.$resultCount;?>" class="Quantity-textbox no-spin" 
											name="quantityParam<?php echo $itemCounter;?>"
											value="<?php echo $value['quantity']?>" min="1" max="99" onKeyUp="myQuantityFunction(parseInt(this.value), this.id);" onKeyPress="if(this.value.length==2) {return false;} if(parseInt(this.value)<1) {this.value='1'; return false;}" required>					    
								
									<input type="hidden" id="productId<?php echo $itemCounter?>" value="<?php echo $value['product_id'];?>">
								</div>
								<div class="row">
									<br>
									<button type="button" id="<?php echo $value['product_id'];?>" class="Remove-button" onClick="removeProductItemFunction(this.id);">
										<span class="Remove-button-image-text">
											<?php 
												echo '<img src="'.base_url('assets/images/remove_item.png').'">'
											?>
											Remove Item
										</span>
									</button>												
								</div>
							</div>
							<div class="col-sm-2">								
								<div class="row Cart-product-subtotal">
									<?php
										if (trim($value['price'])=='') {
											echo '&#x20B1; 0';
										}
										else {
											echo '<label id="subtotalId'.$itemCounter.'">&#x20B1;'.$value['quantity']*$value['price'].'</label>';
										}
																																							
										//added by Mike, 20170626
										$orderTotal+=($value['quantity']*$value['price']); //multiply with quantity to get the subtotal
										
									?>	
									<br>
									<label class="Cart-product-item-subtotal">(Subtotal)</label>																				
								</div>
							</div>
						</div>
						<hr class="Cart-hr">
					<?php 
						$totalQuantity+=$value['quantity'];
						$itemCounter++;
					  }
					?>					
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
				 						CONTINUE TO CHECKOUT
									</button>				
								</div>
							</div>											
						</div>														
					</div>	
				</div>
			</div>		
			<?php 
			  }
			?>					
			</form>
</body>
</html>