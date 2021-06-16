<?php
/**
 * 
 */
class Customer 
{
	
	public $db;
  	function __construct()

  	 {
          $file_path=realpath(dirname(__FILE__));
         include($file_path.'/../config/db.inc.php');
         $this->db=$db;
     
  	 }
  	 public function registerCustomer($data)
  	 {
  	 	 $first_name        = mysqli_real_escape_string($this->db, $_POST['first_name']);
        $last_name        = mysqli_real_escape_string($this->db, $_POST['last_name']);
        $email            = mysqli_real_escape_string($this->db, $_POST['email']);
        $password         = mysqli_real_escape_string($this->db, $_POST['password']);
        $confirm_password = mysqli_real_escape_string($this->db, $_POST['confirm_password']);
        $contact_number   = mysqli_real_escape_string($this->db, $_POST['contact_number']);
        $address = mysqli_real_escape_string($this->db, $_POST['address']);
          if(empty($first_name)||empty($last_name)||empty($email)||empty($password)||empty($confirm_password))
          {
          	 return $msg="<span class='error'>Fields(First Name, Last Name, Email,Password,Confirm Password )MUST not left empty! </span>";

          }
           if (!preg_match("/^[a-zA-Z-'_]*$/",$first_name)) {
           
            return $msg="<span class='error'>Invalid First Name.First Name can contain alphabets and _ . </span>";
       
          }
           if (!preg_match("/^[a-zA-Z-'_]*$/",$last_name)) {
             
              return $msg="<span class='error'>Invalid Last Name.Last Name can contain alphabets and _ . </span>";
            
          }

          if (!empty($contact_number)&&!preg_match("/^(?:\+?88)?01[13-9]\d{8}$/",$contact_number)) {
            return $msg="<span class='error'>Invalid Contact Number. Please enter a valid contact number. </span>";
          }
          if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
             return $msg="<span class='error'>Invalid email .Please enter valid email.</span>";
             
          }
        if($password!==$confirm_password)
                 {
                 	return $msg="<span class='error'>Password and confirm password doesn't match.</span>";


                 }
        $query = "SELECT * FROM users WHERE  email='$email' LIMIT 1";
        $mail_check = mysqli_query($this->db, $query);
              if (mysqli_num_rows($mail_check) > 0){ 
                return $msg="<span class='error'>Mail already exists. Please try registering with another email.</span>";
              }
              else
              {  
               
                if ($password===$confirm_password) {
                	// password matched with unique email
                	$password_hashed=md5($password);
               	$query = "INSERT INTO users (first_name,last_name, email, password,contact_number,address) 
			        VALUES('$first_name', '$last_name', '$email','$password_hashed', '$contact_number', '$address')";
	                $insert_row=mysqli_query($this->db, $query);
  	                if ($insert_row) {
  	                	return $msg="<span class='success'>Registered sucessfully.</span>";
  	                }else{
  	                	return $msg="<span class='error'>Registerion Failed!</span>";

  	                }



                  }


              }
  	 }


	        public function loginCustomer($email,$password)
	        {

	        	$email   =mysqli_real_escape_string($this->db,$email);
	        	$password=mysqli_real_escape_string($this->db,$password);
		        	if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
	               return $msg="<span class='error'>Invalid email .Please enter valid email.</span>";
	           
	                   }
	                   if (empty($email)||empty($password)) {
	                   	return $msg="<span class='error'>Email and [password field must not be empty!.</span>";
    	                   }
    	         if(!empty($email)&&!empty($password)){
             	 $password=md5($password);
             	 $query   = "SELECT * FROM users WHERE email='$email' AND password='$password'";
                 $results = mysqli_query($this->db, $query);

               if (mysqli_num_rows($results) === 1 ){

               	    $records                       =$results->fetch_assoc();
               	    $_SESSION['role']              ="customer";
               	    $_SESSION['customer_logged_in']=true;
               	    $_SESSION['customer_id']       =$records['user_id'];
               	    $_SESSION['customer_email']    =$records['email'];
               	    header('Location:order.php');


        	        }else{
    	        	return $msg="<span class='error'>Login failed.Wrong cardinals.</span>";
    	        }
    	    }
        	    else
        	        {
        	        	return $msg="<span class='error'>Login failed.Wrong cardinals.</span>";
        	        }
}


  public function passwordResetRequest($email){


            $email = mysqli_real_escape_string($this->db,$email);

              if(empty($email)){

              return $msg="<span class='error'>Email must be entered!</span>";
              }

              if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
              return $msg="<span class='error'>Invalid email .Please enter valid email.</span>";

               }       
                $selector  =bin2hex(random_bytes(8));
                $token     =random_bytes(32) ;

                $url       ="localhost/oishee_cart_project/create_new_password.php?selector=".$selector. "&validator=".bin2hex($token);

                $expires   =date("U")+1800;


      

                  $userEmail  =$email;
                  $sql        ="DELETE FROM pwdreset WHERE pwdResetEmail='$userEmail'";
                  mysqli_query($this->db,$sql);

                  $hashedToken =password_hash($token, PASSWORD_DEFAULT);

                  $sql         ="INSERT INTO pwdreset(pwdResetEmail,pwdResetSelector,pwdResetToken,pwdResetExpires)VALUES('$userEmail','$selector','$hashedToken','$expires')";

                 mysqli_query($this->db,$sql);
                  //print_r(mysqli_query($db,$sql));


                //send the email to 
                $to     =$userEmail;
                $subject="Reset password";
                $message='<p> We received a password reset request .The link to reset your password is below.If you did not make this request ignore this </p>';
                $message.='<p>Here is your password reset link: </br>';
                $message.='<a href="'.$url.'">'.$url.'</a></p>';

                require('lib/PHPMailer/PHPMailerAutoload.php');

                $mail = new PHPMailer();

                //$mail->SMTPDebug = 3;                               // Enable verbose debug output

                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'lolababyshark@gmail.com';                 // SMTP username
                $mail->Password = 'demolola';                           // SMTP password
                $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 465;                                    // TCP port to connect to

                $mail->setFrom('no-reply@demo.com', 'Mailer');

                $mail->addAddress($to);               // Name is optional

                $mail->isHTML(true);                                  // Set email format to HTML

                $mail->Subject = $subject;
                $mail->Body    = $message;
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                //$mail->send();
                if(!$mail->send()) {
                // echo 'Message could not be sent.';
                // echo 'Mailer Error: ' . $mail->ErrorInfo;
                 return $msg="<span class='error'>Message could not be sent.Mailer error:</span>".$mail->ErrorInfo;

                } else {
                // echo 'Message has been sent';
                return $msg="<span class='success'>Please check your mail. An email sent with reset password instruction.</span>";
               
                }


    



  }












}