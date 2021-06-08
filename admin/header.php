<!DOCTYPE html>
<html>
<head>
	<title></title>
  <link rel="stylesheet" type="text/css" href="../assets/css/custom_style_admin.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
        <a class="dropdown-toggle" data-toggle="dropdown" href="list_category.php">Category
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="add_category.php">Add Category</a></li>
          <li><a href="list_category.php">List Category</a></li>
         
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="list_product.php">Product
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="add_product.php">Add Product</a></li>
          <li><a href="list_product.php">List Product</a></li>
         
        </ul>
      </li>
      
      <li><a href="#">Page 3</a></li>
    </ul>

   <?php
   session_start();
          if (isset($_SESSION['role'])&&$_SESSION['role']==='admin') {

          	
         
   ?>
    <ul class="nav navbar-nav navbar-right">
      
      <li><a href="../includes/logout.inc.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
   <?php }?>
  </div>
</nav>