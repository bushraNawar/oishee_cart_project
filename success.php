<?php include('header.php');?>
<?php
if (!isset($_SESSION['customer_logged_in'])) {

	header('Location:demo.php');
	exit();
	
}
?>

<div class="container">

<div class="row">

<h3>Sucess pages</h3>
	
</div>	
</div>

<?php include('footer.php');?>