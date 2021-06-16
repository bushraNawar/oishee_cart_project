<?php include('header.php');?>
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
								?>
								<td><?=$grand_total;?> </td>
							</tr>
							
					   </table>
					   <div class="container">
					   	<div class="row">
					   		 <a href="index.php" class="btn btn-primary">Continue Shopping</a>
					   </div>
					   <div class="row">		 
                        <a href="payment.php" class="btn btn-primary">Checkout</a>
					   	</div>
					   	
					   </div>

	            

</div>

<?php include('footer.php');?>