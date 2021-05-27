<?php include('header.php');?>

<div class="container">

<?php include("../includes/Category.php"); ?>
<?php
      if (!isset($_GET['catId'])||empty($_GET['catId'])) {
      	header("Location:list_category.php?error=noCatId");
      	exit();
      } else{
      	$category_id=$_GET['catId'];
         $category_id=preg_replace('/[^-a-z-A-Z0-9]/', '', $category_id);
      }


    $category= new Category();
      if(isset($_POST['edit_category'])){
         $category_name=$_POST['category_name'];
         $edit_category_result= $category->editCategory($category_name,$category_id);
         $result=$edit_category_result;
        
          header('Location:list_category.php?msg_edit_cat='.$result );
             exit();
      
      }


?>


<?php
  $get_category=$category->showCategoryById($category_id);
  if (isset($get_category)) {
  	while ($result=$get_category->fetch_assoc()) {?>
<div class="row">
<form action="" method="post">
	
<div class="col-md-4">
<label for="category_name">Category Name</label>	
<div class="form-group">
<input type="text" name="category_name" value="<?= $result['category_name']; ?>" class="form-control">
	
</div>
<button name="edit_category" class="btn btn-primary">Edit category</button>
	
</div>		
</form>	
<?php	}
  }
 ?>	
	
</div>	



</div>




<?php include('footer.php');?>