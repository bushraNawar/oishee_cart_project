<?php include('header.php');?>
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
<h3>Profile</h3>

</div>

<?php include('footer.php');?>