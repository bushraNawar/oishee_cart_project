		<?php include('header.php');?>

		<?php
		if (!isset($_SESSION['customer_logged_in'])) {

			header('Location:demo.php');
			exit();
			
		}
		?>
		<!-- <?php
		if (isset($_GET['payNow'])&&$_GET['payNow']==='pay') {
			
			$user_id=$_SESSION['customer_id'];
			$insert_order_result=$cart->insertOrder($user_id);
			// as data is ordered now cart item need to be deleted 
			$delete_cart=$cart->deleteCustomerCart();
			header('Location:success.php');
			exit();

		}
		?> -->

		<div class="container">

		<div class="row">

		<h3>Order Details</h3>
			
		</div>	
		<div class="row">
			<!-- part from profile -->
			<?php
		if (!isset($_SESSION['customer_logged_in'])) {

			header('Location:demo.php');
			exit();
			
		}
		?>

		<div class="container">

		<div class="row">
		<?php
		$user_id=$_SESSION['customer_id'];
		$get_customer_info=$customer->getCustomerInfo($user_id);
		if ($get_customer_info) {

			while ($result=$get_customer_info->fetch_assoc()) {?>

		<table class="table table-striped">
		    <thead>
		    	<tr>
		    	 <td colspan="3"><h3><strong>Your Profile</strong></h3></td> 
		    	</tr>
		      <tr>

		        <th>First Name</th>
		        <th>Last Name</th>
		        <th>Email</th>
		        <th>Contact Number</th>
		        <th>Address</th>
		        
		      </tr>
		    </thead>
		    <tbody>
		      <tr>

		        <td><?=$result['first_name']?></td>
		        <td><?=$result['last_name']?></td>
		        <td><?=$result['email']?></td>
		        <td><?=$result['contact_number']?></td>
		        <td><?=$result['address']?></td>
		      </tr>
		      <tr>
		      	<td><a href="edit_profile.php?userId=<?=$result['user_id']?>" class="btn btn-primary">Update Profile</a></td>
		      </tr>
		      
		    </tbody>
		    <?php		
			}
		}

		?>	

		  </table>	
			
		</div>
		</div>
		</div>
		<div class="row">
			<!-- from cart -->

		<?php 
					// updating cart quantity
					if (isset($_POST['update_cart'])) {
						$cart_id                   =$_POST['cart_id'];
						$quantity                  =$_POST['quantity'];
						$update_cart_quatity_result=$cart->updateCartQuantity($quantity,$cart_id);
						if ($quantity<=0) {
							// when quantity is 0 or neg number delete item from carts
							$delete_product_from_cart_result=$cart->delproductFromCart($cart_id);
						}
					}

					?>
					<?php
					// Deleting from cart
						if (isset($_GET['delProduct'])) {
						$cart_id=$_GET['delProduct'];
							$cart_id=preg_replace('/[^-a-z-A-Z0-9]/', '', $cart_id);
							$delete_product_from_cart_result=$cart->delproductFromCart($cart_id);
						} 

					?>
		<div class="container">
		<div class="row">
		<div class="col-md-3">
			<!-- for msg -->
			<?php
		     if (isset($delete_product_from_cart_result)) {

		     	echo $delete_product_from_cart_result;
		     }
			?>
			<?php
		    if (isset($update_cart_quatity_result)) {
		    	echo $update_cart_quatity_result;
		    }
			?>
			
		</div>	
			
		</div>
		<div class="row">
		<table class="table table-hover">
		    <thead>
		  <tr>
		  	<th width="5%">Serial Number</th>
		    <th width="30%">Product Name</th>
			<th width="10%">Image</th>
			<th width="15%">Price</th>
			<th width="15%">Quantity</th>
			<th width="15%">Total Price</th>
			<th width="10%">Action</th>
		      </tr>
		    </thead>
		    <tbody>
		    	<?php $get_cart_product_result=$cart->getCartProduct();
		    	$sum=0;
		                 if ($get_cart_product_result) {
		                 	$i=0;
		                 	
		                     while ($result=$get_cart_product_result->fetch_assoc()) {
		                     	$i++;?>
		                     <tr>
		      	<td><?=$i;?></td>

		        <td><?=$result['product_name'];?></td>
				<td><img src="<?=$result['image'];?>" alt=""/></td>
				<td><?=$result['price'];?></td>
				<td>
					<form action="" method="post" style="width: 0%;
		  margin: 0px ;
		  padding: 0px;
		  border: 1px solid #B0C4DE;
		  background: white;
		  border-radius: 0px">
		                <input style="width: 80px;" type="hidden" name="cart_id" value="<?=$result['cart_id'];?>"/>
						<input style="width: 80px;" type="number" name="quantity" value="<?=$result['quantity'];?>"/>
						<input type="submit" name="update_cart" value="Update" class="btn btn-primary" style="font-size: 10px;" />
					</form>
				</td>
				<td>Tk. <?php
		        $total=$result['price']*$result['quantity'];
		        echo $total;
				?></td>
				<td><a onclick="return confirm('You are about to delete this from cart,are you sure?')" href="?delProduct=<?=$result['cart_id'];?>">X</a></td>
		      </tr>
		      
		    </tbody>
		    <?php $sum=$sum+$total;?>
		      <?php    }
		                 
		                 }
		                 else{
		      	header('Location:index.php');
		      }
		    	 ?>

		  </table>
			<table style="float:right;text-align:left;" width="40%">
									<tr>
										<th>Sub Total : </th>
										<td><?=$sum;?></td>
									</tr>
									<tr>
										<th>VAT : </th>
										<td>10%</td>
									</tr>
									<tr>
										<th>Grand Total :</th>
										<?php 
											 $vat   = 0.1*$sum;
			                                 $grand_total=$sum+$vat;
			                                   $_SESSION['grandTotal']=$grand_total;  
										?>
										<td><?=$grand_total;?> </td>
									</tr>
									
										   </table>
				<div class="container">
				<div class="row">
				<div class="col-md-6">
				 <form action="make_payment.php" method="POST">
	            
	            <div class="form-group">
	                <label>CARD NUMBER</label>
	                <input type="text" name="card_number" placeholder="1234 1234 1234 1234" autocomplete="off" required="">
	            </div>
	            <div class="row">
	                <div class="left">
	                    <div class="form-group">
	                        <label>EXPIRY DATE</label>
	                        <div class="col-1">
	                            <input type="text" name="card_exp_month" placeholder="MM" required="">
	                        </div>
	                        <div class="col-2">
	                            <input type="text" name="card_exp_year" placeholder="YYYY" required="">
	                        </div>
	                    </div>
	                </div>
	                <div class="right">
	                    <div class="form-group">
	                        <label>CVC CODE</label>
	                        <input type="text" name="card_cvc" placeholder="CVC" autocomplete="off" required="">
	                    </div>
	                </div>
	            </div>
	            <button type="submit" class="btn btn-success" name="payNow">Submit Payment</button>
	        </form>
	    </div>
	</div>   
	</div>    
	    
	</div>   
	    
	</div>


		<!-- <div class="row">
			
			<a href="?payNow=pay" class="btn btn-danger">Pay Now</a>

		</div>
		</div> -->

		<?php include('footer.php');?>