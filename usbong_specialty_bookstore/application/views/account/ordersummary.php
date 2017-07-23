<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
	<h2 class="header">Order Summary</h2>
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
				<?php 
					if (count($order_summary)==0) {
						echo '<div class="Order-Summary-noResult">';
						echo 'You have not made any orders yet.';
						echo '</div>';
					}
					else {
				?>
					<div class="row">
						<div class="col-sm-2 Order-summary">		
						</div>
						<div class="col-sm-10 Order-summary">		
							<h3>Orders</h3>
							<div>
								<div class="row">
									<div class="col-sm-2 Order-summary">		
										<b>Date</b>
									</div>
									<div class="col-sm-2 Order-summary">		
										<b>Order #</b>
									</div>
									<div class="col-sm-2 Order-summary">		
										<b># of Items</b>
									</div>
									<div class="col-sm-2 Order-summary">		
										<b>Status</b>
									</div>
									<div class="col-sm-2 Order-summary">		
										<b>Price</b>
									</div>
								</div>
								<?php 
									$counter=0;
									foreach ($order_summary as $value) {
										echo '<div class="row">';
											if ($counter!=0) {
												echo '<div class="col-sm-2 Order-summary-alternate">';
												echo date_format(date_create($value['added_datetime_stamp']),'m/d/Y');
												echo '</div>';
												
												echo '<div class="col-sm-2 Order-summary-alternate">';
			//									echo strtotime($value['added_datetime_stamp']);
												$date = new DateTime($value['added_datetime_stamp'], new DateTimeZone("Asia/Hong_Kong"));
												$timestamp = $date->format('U');
//												echo $timestamp;
												echo '<a class="Order-details-order-number-link" href="'.site_url('account/orderdetails/'.$timestamp).'">'.$timestamp.'</a>';
												echo '</div>';
												
												echo '<div class="col-sm-2 Order-summary-alternate">';
												echo $value['quantity'];
												echo '</div>';
												
												echo '<div class="col-sm-2 Order-summary-alternate">';
												echo "Accepted";
												echo '</div>';
												
												echo '<div class="col-sm-2 Order-summary-alternate offset-col-sm-2">';
												echo '&#x20B1;'.$value['order_total_price'];
												echo '</div>';
												
											}
											else {
												echo '<div class="col-sm-2 Order-summary">';
												echo date_format(date_create($value['added_datetime_stamp']),'m/d/Y');
												echo '</div>';
												
												echo '<div class="col-sm-2 Order-summary">';
			//									echo strtotime($value['added_datetime_stamp']);
												$date = new DateTime($value['added_datetime_stamp'], new DateTimeZone("Asia/Hong_Kong"));
												$timestamp = $date->format('U');
//												echo $timestamp;
												echo '<a class="Order-details-order-number-link" href="'.site_url('account/orderdetails/'.$timestamp).'">'.$timestamp.'</a>';											
												echo '</div>';
												
												echo '<div class="col-sm-2 Order-summary">';
												echo $value['quantity'];
												echo '</div>';
												
												echo '<div class="col-sm-2 Order-summary">';
												echo "Accepted";
												echo '</div>';
												
												echo '<div class="col-sm-2 Order-summary">';
												echo '&#x20B1;'.$value['order_total_price'];
												echo '</div>';									
											}
											
											$counter=($counter+1)%2;
											
										echo '</div>';		
									}
								?>					
							</div>
						</div>
					</div>
				<?php		
					}
				?>		
			</div>
		</div>
	</div>
	<br>
</body>
</html>