	<?php include('header.php'); ?>

	<?php
	if (isset($_SESSION['customer_logged_in'])&&$_SESSION['customer_logged_in']===true) {

		header('Location:order.php');
		exit();
	}
	?>

   <?php
    if(isset($_POST['login'])){
    	$email                  =$_POST['email'];
        $password               =$_POST['password'];
		$login_customer_result  = $customer->loginCustomer($email,$password);}
		
    ?>
    <div class="container">
    <div class="row">
    <div class="col-md-12">
    <?php if (isset($_GET['needToResubmit'])&&$_GET['needToResubmit']=="yes") {
    	?>
    	<p class="error">The reset password request expired .You are trying with an old request sent to you earlier.</p>
    <?php }
    ?>	
   <?php if (isset($_GET['newpwd'])&&$_GET['newpwd']=="passwordUpdated") {
    	?>
    	<p class="success">Password updated.</p>
    <?php }
    ?>	
  
    <?php
    if (isset($login_customer_result)) {
    	echo $login_customer_result;
    }
    ?>	
    </div>	
    	
    </div>	
    	
    </div>
    
    <div class="container">
    <div class="row">
	<div class="col-md-6">
	        	<h3>Existing Customers</h3>
	        	<p>Sign in with the form below.</p>
	        	<form action="" method="post" id="member">
	                	<input name="email" type="email"  placeholder="Email">
	                    <input name="password" type="password" placeholder="Password" >
	                    <div class="buttons"><div><button class="grey" name="login">Sign In</button></div></div>
	                     <p class="note"><a href="forget_password_request.php">Forgot password?</a></p>
	                    </div>

	                 </form>
	                 
	                    
	                    <!--send data for validation  -->
	                    <?php
	                    if(isset($_POST['register'])){
							$register_customer_result= $customer->registerCustomer($_POST);}
							
	                    ?>

	    	<div class="col-md-6">
	    		<!--msg  -->
		    		<?php
		    		if (isset($register_customer_result)) {
		    			echo $register_customer_result;
		    		}
		    		?>
	    		<h3>Register New Account</h3>
	    		<form action="" method="post">
			   			 <table>
			   				<tbody>
							<tr>
							<td>
								<div>
								
	                           <input type="text" name="first_name" placeholder="First Name(required)">
								</div>

								<div>
								
	                           <input type="text" name="last_name" placeholder="Last Name(required)">
								</div>
								<div>
								
	                           <input type="email" name="email" placeholder="Email(required)">
								</div>
								<div>
								
	                           <input type="password" name="password" placeholder="Password(required)">
								</div>
								<div>
								
	                           <input type="password" name="confirm_password" placeholder="Confirm Password(required)">
								</div>

								<div>
								
	                           <input type="text" name="contact_number" placeholder="Contact Number">
								</div>
								
								<div>
								
	                           <input type="text" name="address" placeholder="Address(required)">
								</div>

								
			           
			    	</td>
			    </tr> 
			    </tbody></table> 
			   <div class="search"><div><button class="grey" name="register">Create Account</button></div></div>
			    <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
			    <div class="clear"></div>
			    </form>
	    	</div>
	    	</div>
	    </div>