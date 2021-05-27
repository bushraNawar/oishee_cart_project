<?php 

    session_start();

    if (!isset($_SESSION['userId'])) {
	header("Location:login.php");
      }
    if (isset($_SESSION['userId'])) {
        unset($_SESSION['userId']);
  	    unset($_SESSION['email']);

       session_destroy();

     header("Location:../index.php");
    }
  