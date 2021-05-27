  <!DOCTYPE html>
  <html>
  <head>
  	<title></title>
  	
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  	<link rel="stylesheet" type="text/css" href="assets/css/custom_style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  	
  </head>
  <body>

     <form action="includes/login.inc.php" method="post">
      <div class="container">
      	

          
  	   <div class="row">
              <div class="col-md-6">

  	          <div class="login-header">
                     <h1>Login Form</h1>

  	            </div>	
  		
                 
  		
  	         </div>	
  		
  	    </div>      
  	    <!-- error block -->

  	                 <?php if (isset($_GET['error'])): ?>
                       <?php if($_GET['error']=='emptyEmail'){
                       	$error_msg="Enter email to login";

                       }
                       if($_GET['error']=='emptyPwd'){
                       $error_msg="Enter password to login";
                        }
                         if($_GET['error']=='invalidCrd'){
                       $error_msg="Invalid email or password!";
                        }

                       ?>

  	                 <div class="row">

                  
                     <div class="col-md-6 error" >
                    
                     	
                     <p><?= $error_msg; ?></p>
                     
                    
                       
                      	
                   </div>	
                   	         	
  	            </div>
  	        <?php endif ;?>
  	            
  	        
                   <div class="row">

                  <?php if(isset($_GET['sucessfullyRegistered'])&&$_GET['sucessfullyRegistered']==="yes"):?>
                     <div class="col-md-6 success" >
                    
                      
                        <p>Registed Successfully .</p>
                    
                     

                        
                   </div> 
                     <?php endif ?>         
                </div>
               
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
                           <button class="btn btn-default" type="submit" name="login_btn">Login</button>    
  	               	  	 <a href="registration.php" class="btn btn-primary" role="button" name="registration">Register</a>
  	               	     </div>

  	            	
  	                 </div>
  	             
  	             

      </div>
       </form>
  </body>
  </html>