<!DOCTYPE html>
<html>
<head>
	<title>Login User</title>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/custom_style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	
</head>
<body>
    <?php 
     session_start();
    if (isset($_SESSION['userId'])) {
      header("Location:index.php");
    } ?>
   <form action="includes/login.inc.php" method="post">
    <div class="container">
    	

        
	   <div class="row">
            <div class="col-md-6">

	          <div class="login-header">
                   <h1>Login Form</h1>

	            </div>	
		
               
		
	         </div>	
		
	    </div>      
	    
             <div class="row">
              <div class="col-md-6">
                <?php if (isset($_GET['error'])&&$_GET['error']==="emptyEmail") {?>
              <p class="error">"Enter email to login".</p>
            <?php } ?> 
              <?php if (isset($_GET['error'])&&$_GET['error']==="emptyBothFields") {?>
              <p class="error">"Enter both fields to login".</p>
            <?php } ?> 
                 <?php if (isset($_GET['error'])&&$_GET['error']==="emptyPassword") {?>
              <p class="error">"Enter password to login".</p>
            <?php } ?>
            <?php if (isset($_GET['error'])&&$_GET['error']==="invalidCredential") {?>
              <p class="error">"Invalid email or password!".</p>
            <?php } ?>
              </div>
               
             </div>
            <!--  error -->
             <div class="row">

                
                   <div class="col-md-6">
                  
                   		
                   
                   	  <div class="form-group" style="">
                   
                          <label for="email">Email</label>
                           <input type="email" name="email" class="form-control"> 
                   	
                     
                	
                         </div>

                    	
                 </div>	
                 	         	
	            </div>
	                <div class="row">
	                	<div class="col-md-6">

	                		<label for="password">Password</label>
                           <input type="password" name="password" class="form-control"> 
	                	</div>
	                	
	                </div>
	                <div class="row">
	               	  <div class="col-md-6 button-area-login">
                         <button class="btn btn-default" type="submit" name="login">Login</button>    
	               	  	 <a href="#" class="btn btn-primary" role="button" name="registration">Register</a>
	               	     </div>

	            	
	                 </div>
	             
	             

    </div>
     </form>
</body>
</html>