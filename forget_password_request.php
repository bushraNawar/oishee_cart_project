<?php include('header.php'); ?>
<?php if (isset($_POST['forget_password'])) {
	   $email                   = $_POST['email'];
       $forget_password_result=$customer->passwordResetRequest($email);
       
       print_r($forget_password_result);
	
}

?>

<div class="container" >
<div  class="row">
<div class="col-md-12">
<!-- msg -->
	<? if (isset($forget_password_result)) {
		echo $forget_password_result;
	}
	?>	
</div>	

	
</div>		
	
</div>

<form action=""method="post">
<div class="container">

<div class="row">
<div class="col-md-6">
<h3>Forgot password</h3>
</div>	
</div>	


<div class="row">
<div class="col-md-6">
<input type="email" name="email"placeholder="Enter Email">
</div>
</div>
<div class="row">
<div class="col-md-6">
<p></p>
<button class="btn btn-primary" type="submit" name="forget_password">Send Email</button>	
	
</div>
</div>
	
	
</div>
	
	

	
</form>	
	
</div>	






<?php include('footer.php'); ?>