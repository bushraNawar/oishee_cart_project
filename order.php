<?php include('header.php');?>
<?php
if (isset($_SESSION['customer_logged_in'])&&$_SESSION['customer_logged_in']===false) {

	header('Location:demo.php');
	exit();
}
?>

<div class="container">

<div class="row">

<h3>Order Page</h3>
	
</div>	
</div>

<?php include('footer.php');?>