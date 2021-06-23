<?php session_start();

//include('config/db.inc.php');
include('config/db.inc.php');
spl_autoload_register(function($class){
  include_once "includes/".$class.".php";
});
 $product= new Product();
 $cart= new Cart();
 $customer= new Customer();
?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
  

  <!-- prev -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="assets/css/custom_style.css">
  <link rel="stylesheet" type="text/css" href="assets/css/light_box.css">
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Cart Project</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">Home</a></li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Product
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">1.1</a></li>
          <li><a href="#">1.2</a></li>
         
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">7
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">2.1</a></li>
          <li><a href="#">2.2</a></li>
         
        </ul>
      </li>
       <li><a href="cart.php">Cart</a></li>
      <li><a href="#">Contact</a></li>

        <?php if (isset($_SESSION['customer_id'])||isset($_SESSION['google_user_email_address'])) {?>
           <li><a href="profile.php">Profile</a></li>
            <li><a href="payment.php">Payment</a></li>
            <li><a href="order.php">Order Details</a></li>
           <li><a href="includes/logout.inc.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
   <?php } else { ?>
     <li><a href="login.php">Login</a></li>
      
<?php } ?>
     

  </div>
</nav>