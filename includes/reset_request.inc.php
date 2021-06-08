        <?php
            if (isset($_POST['rest_request'])) {
            	
               if(empty($_POST['email'])){
                  	header("Location:../forget_password.php?error=emptyEmail");
           }
                   
           $selector=bin2hex(random_bytes(8));
           $token=random_bytes(32) ;

           $url="localhost/oishee_cart_project/create_new_password.php?selector=".$selector. "&validator=".bin2hex($token);

        $expires=date("U")+1800;


         include('../config/db.inc.php');

        $userEmail=$_POST['email'];
        $sql="DELETE FROM pwdreset WHERE pwdResetEmail='$userEmail'";
        mysqli_query($db,$sql);

              $hashedToken=password_hash($token, PASSWORD_DEFAULT);

              $sql="INSERT INTO pwdreset(pwdResetEmail,pwdResetSelector,pwdResetToken,pwdResetExpires)VALUES('$userEmail','$selector','$hashedToken','$expires')";

        mysqli_query($db,$sql);
        print_r(mysqli_query($db,$sql));
          

        //send the email to 
        $to=$userEmail;
        $subject="Reset password";
        $message='<p> We received a password reset request .The link to reset your password is below.If you did not make this request ignore this </p>';
        $message.='<p>Here is your password reset link: </br>';
        $message.='<a href="'.$url.'">'.$url.'</a></p>';

        require_once( '../lib/PHPMailer/PHPMailerAutoload.php');

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
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
           

        } else {
            echo 'Message has been sent';
             header('Location: ../forget_password.php?reset=success');
             exit();
        }






        }
        else
        {
        	header("Location:../forget_password.php");
        	exit();
        }









            