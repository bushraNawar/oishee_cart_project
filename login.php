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




            <div class="row">
              <div class="col-md-6">
                 <?php if (isset($_GET['noValidator'])&&$_GET['noValidator']==="yes") {?>
              <p class="error">The link is not valid.Try reseting your password again.</p>
            <?php } ?>
                <?php if (isset($_GET['needToResubmit'])&&$_GET['needToResubmit']==="yes") {?>
              <p class="error">The reset password request expired .You are trying with an old request sent to you earlier.</p>
            <?php } ?>

            <?php if (isset($_GET['newpwd'])&&$_GET['newpwd']==="passwordUpdated") {?>
              <p class="success">Password updated successfully!</p>
            <?php } ?>
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
                       <a href="#" class="btn btn-primary" role="button" name="register">Register</a>
                       <a href="forget_password.php" name="forget_password">Forgot password?</a>
                       </div>

                
                   </div>
               
               

    </div>
     </form>
</body>
</html>