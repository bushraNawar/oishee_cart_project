    <?php include('header.php');?>
    <?php include('../includes/Category.php'); ?>
    <?php include('../includes/Product.php'); ?>
    <div class="container">



     <?php
        if (!isset($_GET['pd_id'])||empty($_GET['pd_id'])) {
        	header("Location:list_product.php?error=noPdId");
        	exit();
        } else{
            $product_id=$_GET['pd_id'];
            $product_id=preg_replace('/[^-a-z-A-Z0-9]/', '', $product_id);
        }?>
        <?php
    //edit product
    $product = new Product();
    if(isset($_POST['edit_product'])){
    $edit_product_result= $product->editProduct($_POST,$_FILES,$product_id);
    $result=$edit_product_result;
    if(isset($result))
    {
        header('Location:list_product.php?msg_edit_prod='.$result);
         exit();
    }

    }

    ?>

    <?php
    $get_product= $product->showProductById($product_id);
    if ($get_product) {

    	while ($value= $get_product->fetch_assoc()) {?>
    	
    		
    	
     <form action="" method="post" enctype="multipart/form-data">
                <table >
                   
                    <tr>
                        <td>
                            <label>Product Name</label>
                        </td>
                        <td>

                            <input class="form-control" name="product_name" type="text" value="<?=$value['product_name'];?>" />
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

                                         <option  

                                         <?php
                                         if ($value['category_id']===$result['category_id']) {?>
                                         	selected="selected"
                                        <?php }
                                         ?>  
                                         value="<?=$result['category_id'];?>"><?= $result['category_name']; ?></option>

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
                            <textarea class="form-control" name="description" >
                            <?=$value['description'];?>	
                            </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Price</label>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="price" value="<?=$value['price'];?>"  />
                        </td>
                    </tr>
                
                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                        	<td><img src="<?= $value['image']; ?>" style="height: 40px; width: 40px;"></td>
                        	<br>
                         <tr> <td><input type="file"  name="image" /></td></tr>
                            
                        </td>
                    </tr>
                  
                    

                    <tr>
                        
                        <td>
                            <button class="btn btn-primary" name="edit_product">Edit product</button>
                        </td>
                    </tr>
                </table>
                </form>  
         <?php
         }
         }

         ?> 
        
    </div>


    <?php include('footer.php');?>
