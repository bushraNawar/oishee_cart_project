	<?php

	if(isset($_POST['change_password']))
	{
	       //grab data
	       $selector=$_POST['selector'];
	       $validator=$_POST['validator'];
	       $pwd=$_POST['password'];
	       $pwdRepeat=$_POST['confirm_password'];
	      


	if(empty( $pwd)||empty( $pwdRepeat))
	{
		
		header('Location:../create_new_password.php?pwd=emptyPwd&validator='.$validator.'&selector='.$selector);
	     exit();

	}
	else if ($pwd!=$pwdRepeat) {

	        
			header('Location:../create_new_password.php?pwd=mismatchedPwd&validator='.$validator."&selector=".$selector);
			exit();
		}

		$currentDate=date("U");

	 include('../config/db.inc.php');


	$sql = "SELECT * FROM pwdreset WHERE pwdResetSelector='$selector' AND pwdResetExpires>='$currentDate'";
	$result = mysqli_query($db, $sql);




	if(!$row=mysqli_fetch_assoc($result))
		{
			echo("need to re-submit the request");
			header("Location:../demo.php?needToResubmit=yes");
			exit();

				
		}

	else{
	  
	  $tokenBin=hex2bin($validator);
			$tokenCheck=password_verify($tokenBin, $row['pwdResetToken']);


			if ($tokenCheck===false) {
			 header("Location:../forget_password.php?invalidT=yes");
				exit();
			}

			elseif ($tokenCheck===true) {

				$tokenEmail=$row['pwdResetEmail'];

				$sql="SELECT * FROM users WHERE email='$tokenEmail'";
				$result=mysqli_query($db,$sql);


				if(!$row=mysqli_fetch_assoc($result))
		       {
			           header("Location:../forget_password.php?invalidEmail=notFound");

				exit();
		       }

		else{
			
			$newPwdHash=md5($pwd);
			$sql="UPDATE users SET password='$newPwdHash' WHERE email='$tokenEmail'";
	       $result=mysqli_query($db,$sql);





	$sql="DELETE FROM pwdreset WHERE pwdResetEmail='$tokenEmail'";
	$result=mysqli_query($db,$sql);

		
		
		header('Location:../demo.php?newpwd=passwordUpdated');


		
	}




			}

	}


	 }


	else
	{
		header("Location:../index.php");
	}



	      


		





	  


	?>