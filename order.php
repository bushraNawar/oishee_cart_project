<?php include('header.php');?>
<?php
if (!isset($_SESSION['customer_logged_in'])) {

	header('Location:demo.php');
	exit();
	
}
?>

<div class="container">

<div class="row">

<h3>Order Page</h3>
	
</div>
<div class="row">
<table class="table table-hover">
    <thead>
  <tr>
  	<th width="5%">Serial Number</th>
    <th width="30%">Product Name</th>
	<th width="10%">Image</th>
	
	<th width="15%">Quantity</th>
	<th width="15%">Total Price</th>
	<th width="15%">Action</th>
      </tr>
    </thead>
    <tbody>
    	<?php
         $user_id                 =$_SESSION['customer_id']; 
    	 $get_order_product_result=$cart->getOrderProduct( $user_id );
    	$sum=0;
                 if ($get_order_product_result) {
                 	$i=0;
                 	
                     while ($result=$get_order_product_result->fetch_assoc()) {
                     	$i++;?>
                     <tr>
      	<td><?=$i;?></td>

        <td><?=$result['product_name'];?></td>
		<td><img src="<?=$result['image'];?>" alt=""/></td>
		
		<td>
			<?=$result['quantity'];?>
		</td>
		<td>Tk. <?php
        $total=$result['price']*$result['quantity'];
        echo $total;
		?></td>
		<td><a onclick="return confirm('You are about to delete this from cart,are you sure?')" href="">X</a></td>
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
	
</div>	
</div>

<?php include('footer.php');?>