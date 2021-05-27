<?php include('header.php');?>

<div class="container">

<?php include("../includes/Category.php"); ?>
<?php
    $category= new Category();
    if(isset($_POST['add_category'])){
      $category_name=$_POST['category_name'];

      $add_category_result= $category->addCategory($category_name);
       $result=$add_category_result;
       
      
          header('Location:list_category.php?msg_add_cat='.$result );
          exit();
    }


?>




<div class="row">
<div class="col-md-4">
<?php

?>	
	
</div>	
	
</div>

<div class="row">
<form action="add_category.php" method="post">
	
<div class="col-md-4">
<label for="category_name">Category Name</label>	
<div class="form-group">
<input type="text" name="category_name" placeholder="Type a name for category" class="form-control">
	
</div>
<button name="add_category" class="btn btn-primary">Add category</button>
	
</div>		
</form>	

	
</div>	



</div>




<?php include('footer.php');?>