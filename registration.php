<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/custom_style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	
</head>
<body>
   
    <?php
    session_start();
    if (isset($_SESSION['userId'])) {

      //already logged in doesn't get access to registration
      header("Location:index.php");

    }
    ?>
   <form action="includes/registration.inc.php" method="post">
    <div class="container">
    	

        
	   <div class="row">
            <div class="col-md-6">

	          <div class="login-header">
                   <h1>Registration Form</h1>

	            </div>	
		
               
		
	         </div>	
		
	    </div>

            
                   <?php if(isset($_GET['error'])) :?>
                    
                     
             <!-- error block -->
	                 <div class="row">

                          
                   <div class="col-md-6 error" >

                    <?php if(isset($_GET['error'])&&$_GET['error']==="emptyField"):?>
                    <p>First name <br>Last Name<br>Email<br>Password<br>Confirm Password</p>
                    <p>Field(s) cannot be left empty!</p>
                    <?php endif ?>
                  <?php if(isset($_GET['error'])&&$_GET['error']==="dismatchedPassword"):?>
                      <p>Password and confirm password did not match.</p>
                  <?php endif ?>
                   <?php if(isset($_GET['error'])&&$_GET['error']==="emailExists"):?>
                      <p>Email already exists. Enter another email.</p>
                  <?php endif ?>
                  <?php if(isset($_GET['error'])&&$_GET['error']==="invalidEmail"):?>
                      <p>Email is invalid. Enter valid email.</p>
                  <?php endif ?>
                  <?php if(isset($_GET['error'])&&$_GET['error']==="invalidFname"):?>
                      <p>First name is invalid. First Name may countain alphabets and _.</p>
                  <?php endif ?>
                  <?php if(isset($_GET['error'])&&$_GET['error']==="invalidLname"):?>
                      <p>Last name is invalid. First Name may countain alphabets and _.</p>
                  <?php endif ?>
                  <?php if(isset($_GET['error'])&&$_GET['error']==="invalidContactNumber"):?>
                      <p>Invalid contact number.</p>
                  <?php endif ?>
                 </div>	
                 	         	
	            </div>
                 
              <?php endif ?>
	             <!-- success block -->

	                 
             <div class="row">

                
                   <div class="col-md-6">
                  
                   		
                   
                   	  <div class="form-group" style="">
                   
                          <label for="fname">First Name<small>(required)</small></label>
                           <input type="text" name="first_name" class="form-control"> 
                   	
                     
                	
                         </div>

                    	
                 </div>	
                 	         	
	            </div>
	                <div class="row">
	                	<div class="col-md-6">

	                		<label for="lname">Last Name<small>(required)</small></label>
                           <input type="text" name="last_name" class="form-control"> 
	                	</div>
	                	
	                </div>
	                <div class="row">

                
                   <div class="col-md-6">
                  
                   		
                   
                   	  <div class="form-group" style="">
                   
                          <label for="email">Email<small>(required)</small></label>
                           <input type="email" name="email" class="form-control"> 
                   	
                     
                	
                         </div>

                    	
                 </div>	
                 	         	
	            </div>
	                <div class="row">
	                	<div class="col-md-6">

	                		<label for="pwd">Password<small>(required)</small></label>
                           <input type="password" name="password" class="form-control"> 
	                	</div>
	                	
	                </div>
	                <div class="row">

                
                   <div class="col-md-6">
                  
                   		
                   
                   	  <div class="form-group" style="">
                   
                          <label for="cpwd">Confirm Password<small>(required)</small></label>
                           <input type="password" name="confirm_password" class="form-control"> 
                   	
                     
                	
                         </div>

                    	
                 </div>	
                 	         	
	            </div>
	                <div class="row">
	                	<div class="col-md-6">

	                		<label for="contact_number">Contact Number</label>
                           <input type="text" name="contact_number" class="form-control"> 
	                	</div>
	                	
	                </div>
	                <div class="row">

                
                   <div class="col-md-6">
                  
                   		
                   
                   	  <div class="form-group" style="">
                   
                          <label for="address">Address</label>
                           <input type="text" name="address" class="form-control"> 
                   	
                     
                	
                         </div>

                    	
                 </div>	
                 	         	
	            </div>
	               
	                <div class="row">
	               	  <div class="col-md-6 button-area-login">
                         <button class="btn btn-primary"  name="registration">Register</button>    
	               	  	 
	               	     </div>

	            	
	                 </div>
	             
	             

    </div>
     </form>
</body>
</html>