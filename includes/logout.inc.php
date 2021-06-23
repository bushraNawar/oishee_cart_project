<?php 
   
    session_start();
    include('../config/config.php');

//Reset OAuth access token
  $google_client->revokeToken();

//Destroy entire session data.
     session_destroy();
     include('Cart.php');
     $cart=new Cart();
    
    if (!isset($_SESSION['customer_logged_in'])) {
      header("Location:../login.php");
  exit();
      }
    if (isset($_SESSION['customer_logged_in'])) {
        
         $delete_cart=$cart->deleteCustomerCart();
        unset($_SESSION['customer_id']);
        unset($_SESSION['customer_email']);
        unset($_SESSION['customer_logged_in']);
         
       
       session_destroy();
   
     header("Location:../index.php");
       
       
        
        
    }
  