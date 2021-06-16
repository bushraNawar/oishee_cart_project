<?php include('header.php');?>
<?php
if (!isset($_SESSION['customer_logged_in'])) {

	header('Location:demo.php');
	exit();
	
}
?>
<?php
if (isset($_GET['orderStatus'])&&$_GET['orderStatus']=='order') {
	
	$user_id=$_SESSION['customer_id'];
	$insert_order_result=$cart->insertOrder($user_id);
	// as data is ordered now cart item need to be deleted 
	$delete_cart=$cart->deleteCustomerCart();
	header('Location:success.php');
	exit();

}
?>

<div class="container">

<div class="row">

<h3>Payment Page</h3>
	
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
	<table class="table table-hover">
    <thead>
  <tr>
  	<th width="5%">Serial Number</th>
    <th width="30%">Product Name</th>
	
	<th width="15%">Price</th>
	<th width="15%">Quantity</th>
	<th width="15%">Total Price</th>
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
		
		<td><?=$result['price'];?></td>
		<td><?=$result['quantity'];?></td>
		<td>Tk. <?php
        $total=$result['price']*$result['quantity'];
        echo $total;
		?></td>
		
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
	
</div>
<div class="row">
	
	<a href="?orderStatus=order" class="btn btn-danger">Order</a>

</div>
</div>

<?php include('footer.php');?>