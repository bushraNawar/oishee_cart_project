<?php

// Authorize.Net API configuration  
define('ANET_API_LOGIN_ID', '95mFBfG5E67A');  
define('ANET_TRANSACTION_KEY', '23Kbv5A2n3jDM34V');  
$ANET_ENV = 'SANDBOX'; // or PRODUCTION 

//Include Google Client Library for PHP autoload file
$file_path=realpath(dirname(__FILE__));
         include($file_path.'/../vendor/autoload.php');
// require_once '../vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('1067350315429-t6pvk2hpd76e6ugcut08obavooqpqc6h.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('UrBhQYtZT-vFCZz1HWaS_Ueu');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/oishee_cart_project/login.php');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');

?>