<?php include ('header.php'); ?>
<?php include('../includes/Category.php'); ?>
<?php include('../includes/Product.php'); ?>
<?php
//add product
$product = new Product();
if(isset($_POST['add_product'])){
$add_product_result= $product->addProduct($_POST,$_FILES);
$result=$add_product_result;

if(isset($result))
{
    header('Location:list_product.php?msg_add_prod='.$result);
     exit();
}

    
}

?>
<div class="container">
 
 <form action="" method="post" enctype="multipart/form-data">
            <table >
               
                <tr>
                    <td>
                        <label>Product Name</label>
                    </td>
                    <td>

                        <input class="form-control" name="product_name" type="text" placeholder="Enter Product Name"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>

                        <select class="form-control"  name="category_id" >
                            <option>Select Category</option>
                            <?php $category= new Category();
                             $get_category= $category->showCategory();
                             if ($get_category) {
                                 foreach ($get_category as $result) {?>

                                     <option value="<?=$result['category_id'];?>"><?= $result['category_name']; ?></option>

                                 <?php  

                                 }
                             }

                             ?> 
                            
                          
                        </select>
                    </td>
                </tr>
                
                
                 <tr>
                    <td ">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="form-control" name="description" ></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="price" placeholder="Enter Price"  />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <input type="file"  name="image" />
                    </td>
                </tr>
                
                

                <tr>
                    
                    <td>
                        <button class="btn btn-primary" name="add_product">Add product</button>
                    </td>
                </tr>
            </table>
            </form>   
    
</div>



<?php include('footer.php'); ?>