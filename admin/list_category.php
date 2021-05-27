  <?php include ('header.php');  ?>

  <?php include("../includes/Category.php"); ?>
  <?php
      $category= new Category();
      if (isset($_GET['delCat'])) {

       $category_id=$_GET['delCat'];
        
       $category_id=preg_replace('/[^-a-z-A-Z0-9]/', '', $category_id);
        $delete_category_result=$category->deleteCategory($category_id);

      }
      ?>
  <div class="row">
  <div class="col-md-4">
  <?php

   if(isset($_GET['msg_add_cat'])){

    echo $_GET['msg_add_cat'];

   }
     if(isset($_GET['msg_edit_cat'])){
     echo $_GET['msg_edit_cat'];
     }

  ?>  


  <div class="container">
    <div class="row">
     <div class="col-md-4">
        <?php
        if (isset($delete_category_result)) {
          echo $delete_category_result ;
        }

        ?>
        <?php
         if (isset($_GET['error'])&&$_GET['error']==='noCatId') :?>
          <div  class="error">
            <p>Please try to edit again!</p>
          </div>
         <?php endif;?>
       
     </div> 
      
    </div>
   <table class="table table-hover">
      <thead>
        <tr>
          <th>Serial No</th>
          <th>Category Name</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php $get_category= $category->showCategory();

             if ($get_category) {
              $i=0;
               while ($result=$get_category->fetch_assoc()) {
                    $i++;
                ?>
                 
        <tr>
          <td><?= $i;?></td>
          <td><?= $result['category_name']; ?></td>
          <td><a href="edit_category.php?catId=<?=$result['category_id'];?>" class="btn btn-primary">Edit</a> || <a href="?delCat=<?=$result['category_id'];?>"class="btn btn-danger">Delete</a></td>
        </tr>
        
         <?php }
             }?>
      </tbody>
    </table>	
  	

  </div>



  <?php include ('footer.php');  ?>