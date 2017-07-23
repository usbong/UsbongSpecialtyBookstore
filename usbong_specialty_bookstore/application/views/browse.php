<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
	<h2 class="header">Search</h2>
	<br>
	<?php 
		$resultCount = count($result);
		if ($resultCount==0) {
			echo '<div class="Search-noResult">';
			echo 'Your search <b>- '.$param.' -</b> did not match any of our products.';
			echo '<br><br>Suggesion:';
			echo '<br>&#x25CF; Make sure that all words are spelled correctly.';				
			echo '</div>';
		}
		else {
			if ($resultCount==1) {
				echo '<div class="Search-result"><b>'.count($result).'</b> result found.</div>';
			}
			else {
				echo '<div class="Search-result"><b>'.count($result).'</b> results found.</div>';			
			}
	?>
		<div class="container">
			<?php
				$colCounter = 0;
				$itemCounter = 0;
				
				foreach ($result as $value) {
/*					
					$reformattedProductName = str_replace(':','',str_replace('\'','',$value['name'])); //remove ":" and "'"
					$URLFriendlyReformattedProductName = str_replace(',','',str_replace(' ','-',$reformattedProductName)); //replace " " and "-"
					$URLFriendlyReformattedProductAuthor = str_replace(',','',str_replace(' ','-',$value['author'])); //replace " " and "-"
*/
					$reformattedProductName = str_replace(':','',str_replace('\'','',$value['name'])); //remove ":" and "'"
					$URLFriendlyReformattedProductName = str_replace("(","",
														str_replace(")","",
															str_replace("&","and",
															str_replace(',','',
																str_replace(' ','-',
																	$reformattedProductName))))); //replace "&", " ", and "-"
					$URLFriendlyReformattedProductAuthor = str_replace("(","",
														str_replace(")","",
															str_replace("&","and",
																str_replace(',','',
																str_replace(' ','-',
																	$value['author']))))); //replace "&", " ", and "-"
					
					$productType="books"; //default
					switch($value['product_type_id']) {
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
							$productType="toy_and_collectibles";
							break;
					}
				?>
					<div class="row">
						<div class="col-sm-3">	
							<img class="Product-image" src="<?php echo base_url('assets/images/'.$productType.'/'.$reformattedProductName.'.jpg');?>">				
						</div>
						<div class="col-sm-5">	
							<div class="row Product-name">							
								<?php
									echo '<a class="Product-item" href="'.site_url('w/'.$URLFriendlyReformattedProductName.'-'.$URLFriendlyReformattedProductAuthor.'/'.$value['product_id']).'">';
									echo $value['name'];
									echo '</a>';
								?>
							</div>
							<div class="row Product-author">
								<b>
								<?php
									echo $value['author'];
								?>
								</b>
							</div>				
							<div class="row">	
								<div class="Product-overview-header"><b>Product Overview</b><br></div>
								<div class="Product-overview-content">
								<?php	
									if (!empty($result->product_overview)) {
										echo $value['product_overview'];
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
								if (trim($value['price'])=='') {
									echo 'out of stock';						
								}
								else {
									echo '&#x20B1;'.$value['price'].' [Free Delivery]';
								}
								?>
								</b>					
							</div>					
							<div class="row Product-quantity">
								<label class="Quantity-label">Quantity:</label>
								<input type="tel" id="quantityId<?php echo $itemCounter.'~'.$resultCount;?>" class="Quantity-textbox no-spin" 
										name="quantityParam<?php echo $itemCounter;?>"
										value="1" min="1" max="99" onKeyUp="" onKeyPress="if(this.value.length==2) {return false;} if(parseInt(this.value)<1) {this.value='1'; return false;}" required>					    
								
								<input type="hidden" id="productId<?php echo $itemCounter?>" value="<?php echo $value['product_id'];?>">
								<input type="hidden" id="productName<?php echo $itemCounter?>" value="<?php echo $value['name'];?>">
								<input type="hidden" id="productImage<?php echo $itemCounter?>" value="<?php echo base_url('assets/images/'.$productType.'/'.$reformattedProductName.'.jpg');?>">
							
							</div>
							<div class="row Product-purchase-button">
								<?php 
//										$quantity = 1;
										//TODO: fix quantity and price
											
// 										echo '<input type="hidden" id="product_idParam" value="'.$value['product_id'].'" required>';
										echo '<input type="hidden" id="customer_idParam" value="'.$this->session->userdata('customer_id').'" required>';										
		// 								echo '<input type="hidden" id="quantityParam" value="'.$quantity.'" required>';
										echo '<input type="hidden" id="priceParam" value="'.$value['price'].'" required>';							
								?>				
								<button id="addToCartId<?php echo $itemCounter.'~'.$resultCount;?>" onclick="myPopupFunctionInSearchPage(this.id)" class="Button-purchase">ADD TO CART</button>
								<div id="myPopup" class="popup-content">
									<div class="row">
										<div class="col-sm-4">									
											<img class="Popup-product-image" id="productImageId" src="">				
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
//												echo '<b>'.$value['name'].'</b>!'
											echo '<b><span id="productNameId"></span></b>!'
											
											?>
											<br><b>Order Total: </b>
											<label class="Popup-product-price">&#x20B1;<?php echo $value['price'];?></label>
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
					<hr class="horizontal-line">
				<?php 
					$itemCounter++;
				  }
				?>					
			</div>		
		<?php 
		}		
		?>
</body>
</html>