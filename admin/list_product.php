<?php include ('header.php');  ?>
<?php include('../includes/Product.php'); ?>
<?php
 $product= new Product();
?>
<?php
 if (isset($_GET['delpd'])) {

      $product_id=$_GET['delpd'];
      $product_id=preg_replace('/[^-a-z-A-Z0-9]/', '', $product_id);
      $delete_product_result=$product->deleteProduct($product_id);
      if ($delete_product_result) {
       echo $delete_product_result;}
}
?>
<div class="container">
  <div class="row">
   <div class="col-md-4">
    <?php if (isset($_GET['msg_add_prod'])) {
      echo $_GET['msg_add_prod'];
    }
    if (isset($_GET['msg_edit_prod'])) {
      echo $_GET['msg_edit_prod'];
    }
     
    ?>
    
     
   </div> 
    
  </div>
 <table class="table table-hover">
    <thead>
      <tr>
        <th>Serial No</th>
        <th>Product Name</th>
        <th>Category</th>
        <th>Description</th>
         <th>Price</th>
         <th>Image</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>

      <?php $get_product= $product->showProduct();

           if ($get_product) {
            $i=0;
             while ($result=$get_product->fetch_assoc()) {
                  $i++;
              ?>
               

            

      
      <tr>
           <td><?= $i;?></td>
           <td><?= $result['product_name']; ?></td>
           <td><?= $result['category_name']; ?></td>
           <td>
            <?php 

           $text=$result['description']. " ";
           $text=substr($text, 0,35);
           $text=substr($text,0, strpos($text, ' '));
           $text=$text. "...";
           echo $text;
            ?>
              
            </td>
           <td>৳<?= $result['price']; ?></td>
           <td><img src="../<?= $result['image']; ?>" style="height: 40px; width: 40px;"></td>
        <td><a href="edit_product.php?pd_id=<?=$result['product_id']?>" class="btn btn-primary">Edit</a> || <a href="?delpd=<?=$result['product_id']?>"class="btn btn-danger">Delete</a></td>
      </tr>
      
       <?php }
           }?>
    </tbody>
  </table>	
	

</div>



<?php include ('footer.php');  ?>