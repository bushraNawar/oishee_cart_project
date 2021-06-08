<!DOCTYPE html>
<html>
<head>
	<title>Reset Password</title>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/custom_style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	
</head>
<body>

   <form action="includes/reset_request.inc.php" method="post">
    <div class="container">
    	

        
	   <div class="row">
            <div class="col-md-6">

	          <div class="login-header">
                   <h1>Forget Password</h1>

	            </div>	
		
               
		
	         </div>	
		
	    </div>      
	    <!-- error block -->

                     <div class="row">
                      <div class="col-md-6">
                         <?php if (isset($_GET['invalidEmail'])&&$_GET['invalidEmail']==="notFound") {?>
              <p class="error">This email is not a registered email .Try entering the email you registered with.</p>
            <?php } ?>
            <?php if (isset($_GET['invalidT'])&&$_GET['invalidT']==="yes") {?>
              <p class="error">Please start the process again.Your previous attempt failed.</p>
            <?php } ?>
                        <?php if (isset($_GET['reset'])&&$_GET['reset']==="success") {?>
              <p class="success">Check your mail . An email is sent with instruction how to reset password.</p>
            <?php } ?>
                        
                      </div>
                       
                     </div>
	                 
                      <?php if(isset($_GET['error'])): ?>
	                 <div class="row">

                
                   <div class="col-md-6 error" >
                     <?php if ($_GET['error']==='emptyEmail'):?>
                       <p>Please enter valid email to proceed to reset password process.</p>
                      <?php endif?> 
                   	
                   

                    	
                 </div>	
                 	         	
	            </div>
            <?php endif ?>

              <?php if(isset($_GET['sucess'])): ?>
                   <div class="row">

                
                   <div class="col-md-6 success" >
                     <?php if ($_GET['reset']==='success'):?>
                       <p>Please enter valid email to proceed to reset password process.</p>
                      <?php endif?> 
                    
                   

                      
                 </div> 
                            
              </div>
            <?php endif ?>

             
             <div class="row">

                
                   <div class="col-md-6">
                  
                   		
                   
                   	  <div class="form-group" style="">
                   
                          <label for="email">Email</label>
                           <input type="email" name="email" class="form-control" placeholder="Enter email"> 
                   	
                     
                	
                         </div>

                    	
                 </div>	
                 	         	
	            </div>
	                
	                <div class="row">
	               	  <div class="col-md-6 button-area-login">
                         <button class="btn btn-default"  name="rest_request">Send Email</button>    
	               	  	
                       
	               	     </div>

	            	
	                 </div>
	             
	             

    </div>
     </form>
</body>
</html>