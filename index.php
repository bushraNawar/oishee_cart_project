<!DOCTYPE html>
<html>
<head>
	<title>home</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/custom_style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">CartProject</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a>
      <?php
      session_start();
      if (isset($_SESSION['userId'])) :?>

      	 <a class="nav-item nav-link" href="includes/logout.inc.php">Logout<i class="fa fa-user" aria-hidden="true" style="font-size: 20px;"></i>
         </a>
         <p>logged in as <?= $_SESSION['userEmail'];?></p>
         <?php  endif;
           if(!isset($_SESSION['userId'])) {
          ?>


               <a class="nav-item nav-link" href="login.php">Login<i class="fa fa-user" aria-hidden="true" style="font-size: 20px;"></i>   
            <?php  }?>                          
      
    </div>
  </div>
</nav>
</body>
</html>




