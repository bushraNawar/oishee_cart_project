  <!DOCTYPE html>
  <html>
  <head>
  	<title>Create Password</title>
  	
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  	<link rel="stylesheet" type="text/css" href="assets/css/custom_style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  	
  </head>
  <body>

     <form action="includes/reset_password.inc.php" method="post">
      <div class="container">
      	

          
  	   <div class="row">
              <div class="col-md-6">

  	          <div class="login-header">
                     <h1>Create New Password</h1>

  	            </div>	
  		
                 
  		
  	         </div>	
  		
  	    </div>      
  	    <!-- error block -->

                          <?php
                          if (isset($_GET['pwd'])){
                          
                             
                             if ($_GET['pwd']==='emptyPwd'){?>

                                <div class="row">

                  
                                 <div class="col-md-6 error" >
                    
                                   <p>Enter both fields to change password.</p>
                     

                        
                                      </div> 
                              
                                      </div>
                            

                           <?php  }}?>
                           <br>
                           <?php
                          if (isset($_GET['pwd'])){
                          
                             
                             if ($_GET['pwd']==='mismatchedPwd'){?>

                                <div class="row">

                  
                                 <div class="col-md-6 error" >
                    
                                   <p>Mismatched passwords.</p>
                     

                        
                                      </div> 
                              
                                      </div>
                            

                           <?php  }}?>
                           <br>
                           
  	                         <?php
                    $selector=$_GET['selector'];
                    $validator=$_GET['validator'];
                     if(empty($selector)||empty($validator)){?>
  	            
  	            <!-- error block -->
  	                 <div class="row">

                  
                     <div class="col-md-6 error" >
                    
                     	<p>Invalid request try starting the process again.</p>
                     

                      	
                   </div>	
                   	         	
  	            </div>

                 <?php
                  header('Location:../login.php?noValidator=yes');
                  } 
                  else{
                    if(ctype_xdigit($selector)!==false && ctype_xdigit($validator)!==false){
                  ?>
                  
                       
                       

               <div class="row">

                  
                     <div class="col-md-6">
                    
                     		
                     
                     	  <div class="form-group" style="">
                     
                            <label for="password">Password</label>
                             <input type="password" name="password" class="form-control"> 
                     	
                       
                  	
                           </div>

                      	<div class="form-group">     
                       <input type="hidden" name="selector" value="<?php echo $selector; ?>">
                      </div>
                    <div class="form-group">
                    <input type="hidden" name="validator" value="<?php echo $validator; ?>">
                    </div>
                   </div>	
                   
                   	         	
  	            </div>
  	                <div class="row">
  	                	<div class="col-md-6">

  	                		<label for="confirm_password">Confirm Password</label>
                             <input type="password" name="confirm_password" class="form-control"> 
  	                	</div>
  	                	
  	                </div>
  	                <div class="row">
  	               	  <div class="col-md-6 button-area-login">
                           <button class="btn btn-default"  name="change_password">Change Password</button>    
  	               	  	 
  	               	     </div>

  	            	
  	                 </div>

                     
                   <?php }}
                 ?>
  	             
  	             

      </div>
       </form>
  </body>
  </html>