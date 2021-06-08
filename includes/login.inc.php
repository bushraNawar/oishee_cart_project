  <?php
           session_start();
            $email="";
            $password="";
            $errors=array();
            include('../config/db.inc.php');

                 if (isset($_POST['admin_login'])){
            
            $email = mysqli_real_escape_string($db, $_POST['email']);
            $password=mysqli_real_escape_string($db,$_POST['password']);
             if(empty($email)&&empty($password)){

              header("Location:../admin/login.php?error=emptyBoth");
              exit();
            }
            if(empty($email)){

              header("Location:../admin/login.php?error=emptyEmail");
              exit();
            }
            if(empty($password)){

              header("Location:../admin/login.php?error=emptyPwd");
              exit();
            }
         if(!empty($email)&&!empty($password)){

           $password=md5($password);
           $query = "SELECT * FROM admin WHERE admin_email='$email' AND admin_password='$password'";
           $results = mysqli_query($db, $query);

           if (mysqli_num_rows($results) === 1 ){

                $_SESSION['msg']="You are successfully logged in";
                $retrieveInfo= mysqli_fetch_assoc($results);
                $_SESSION['userId']= $retrieveInfo['admin_id'];
                $_SESSION['userEmail']=$email;
                $_SESSION['role']="admin";
                header("Location:../admin/index.php");
                exit();

           }
           else{
            header("Location:../admin/login.php?error=invalidCrd");
            exit();
           }

         
             }

       }

       else if (isset($_POST['login'])){
            $email = mysqli_real_escape_string($db, $_POST['email']);
            $password=mysqli_real_escape_string($db,$_POST['password']);
             if(empty($email)&&empty($password)){

              header("Location:../login.php?error=emptyBoth");

              exit();
            }
            if(empty($email)){

            	header("Location:../login.php?error=emptyEmail");
              exit();
            }
            if(empty($password)){


            	header("Location:../login.php?error=emptyPassword");

            	
              exit();
            }
         if(!empty($email)&&!empty($password)){
         	 $password=md5($password);
         	 $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
           $results = mysqli_query($db, $query);

           if (mysqli_num_rows($results) === 1 ){

                $_SESSION['msg']="You are successfully logged in";
                $retrieveInfo= mysqli_fetch_assoc($results);
                $_SESSION['userId']= $retrieveInfo['user_id'];
                $_SESSION['userEmail']=$email;
                header("Location:../index.php");


           }
           else{

           	header("Location:../login.php?error=invalidCredential");
            exit();
           }

           

           	
           }

          

             }

       

       else
       {

       	 header("Location:../login.php");

       	//header("Location:../index.php");

        exit();
       }