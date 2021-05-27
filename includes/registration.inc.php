<?php 

     include('../config/db.inc.php');
     $first_name="";
     $last_name="";
     $email="";
     $password="";
     $confirm_password="";
     $contact_number="";
     $address="";
    
        function email_exists($db,$email) {
        $flag="true";
        $query = "SELECT * FROM users WHERE  email='$email' LIMIT 1";
        $result = mysqli_query($db, $query);
        $user = mysqli_fetch_assoc($result);
      
              if ($user) { // if user exists
               

                    if ($user['email'] === $email) {
                    	    $flag="false";
                        	header("Location:../registration.php?error=emailExists");
                    }
                    if ($user['email'] !== $email) {
                    	    $flag="true";
                    }
                
                
              }
             return$flag;
             }
    
    if (isset($_POST['registration'])) {

        $first_name = mysqli_real_escape_string($db, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($db, $_POST['last_name']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        $confirm_password = mysqli_real_escape_string($db, $_POST['confirm_password']);
        $contact_number = mysqli_real_escape_string($db, $_POST['contact_number']);
        $address = mysqli_real_escape_string($db, $_POST['address']);

        
        if(empty($first_name)||empty($last_name)||empty($email)||empty($password)||empty($confirm_password))
        {
        	header("Location:../registration.php?error=emptyField");
            exit();

        }	
       
        if (!preg_match("/^[a-zA-Z-'_]*$/",$first_name)) {
           header("Location:../registration.php?error=invalidFname");
            exit();
     
        }
         if (!preg_match("/^[a-zA-Z-'_]*$/",$last_name)) {
           header("Location:../registration.php?error=invalidLname");
            exit();
        }

        if (!empty($contact_number)&&!preg_match("/^(?:\+?88)?01[13-9]\d{8}$/",$contact_number)) {
           header("Location:../registration.php?error=invalidContactNumber");
            exit();
        }
        if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            header("Location:../registration.php?error=invalidEmail");
            exit();
        }
        

    	if (!empty($first_name)&&!empty($last_name)&&!empty($email)&&!empty($password)&&!empty($confirm_password)) { 
    		     $emailIsUnique= email_exists($db,$email);
                  
                 if($password!==$confirm_password)
                 {
                 	header("Location:../registration.php?error=dismatchedPassword");
                     exit();


                 }


                

                 if($emailIsUnique==="true"&&$password===$confirm_password){

                    $password_hashed=md5($password);
                 	$query = "INSERT INTO users (first_name,last_name, email, password,contact_number,address) 
  			        VALUES('$first_name', '$last_name', '$email','$password_hashed', '$contact_number', '$address')";
  	                $insert=mysqli_query($db, $query);
  	                if($insert===true){
                 	header("Location:../login.php?sucessfullyRegistered=yes");
                    exit();

  	                }
                 }
               

       	    }
    }