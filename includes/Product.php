  <?php
  /**
   * 
   */
  class Product 
  {
  	public $db;
  	function __construct()

  	 {
         include('../config/db.inc.php');
         $this->db=$db;
     
  	 }
      public function addProduct($data,$file)
      
      {
       $product_name=mysqli_real_escape_string($this->db,$data['product_name']);
       $category_id=mysqli_real_escape_string($this->db,$data['category_id']);
       $description=mysqli_real_escape_string($this->db,$data['description']);
       $price=mysqli_real_escape_string($this->db,$data['price']);
      $permited  = array('jpg', 'jpeg', 'png');
      $file_name = $file['image']['name'];
      $file_size = $file['image']['size'];
      $file_temp = $file['image']['tmp_name'];
      $div = explode('.', $file_name);
      $file_ext = strtolower(end($div));
      $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
      $image = "../assets/images/".$unique_image;
      if (empty($product_name)||empty($category_id)||empty($description)||empty($price)) {

      	  return $msg= "<span class='error'>Fields cannot be left empty.Please enter every field.</span>";
      }else{
        if (empty($file_name)) {
         return $msg= "<span class='error'>Please Select Image.</span>";
        }elseif ($file_size >1048567) {
        return $msg= "<span class='error'>Image Size should be less then 1MB!
         </span>";
        } elseif (in_array($file_ext, $permited) === false) {
         return $msg= "<span class='error'>You can upload only files with extention:"
         .implode(', ', $permited)."</span>";
        } else{
          move_uploaded_file($file_temp, $image);
          $query = "INSERT INTO product(product_name,category_id,description,price,image) 
          VALUES('$product_name','$category_id','$description','$price','$image')";
         $product_insert = mysqli_query($this->db, $query);	
         
          if ($product_insert) {
          return $msg= "<span class='success'>Product Added Successfully.</span>";
          }else {
           return $msg="<span class='error'>Product Not Inserted.</span>";
          }
               
    	}
  }
  }
   public function showProduct()
        {
            
            $query = "SELECT product.*,category.category_name
                      FROM product
                      INNER JOIN category
                      ON product.category_id=category.category_id
                       ORDER BY product.product_id DESC";
            $result = mysqli_query($this->db, $query);
            if (mysqli_num_rows($result) > 0){ 
              return $result;
            }
            else
            {
              return false;
            }
        }


        
         public function showProductById($product_id)

        {
         

          $query = "SELECT * FROM product where product_id ='$product_id'";
            $result = mysqli_query($this->db, $query);
            if (mysqli_num_rows($result) > 0){ 
              return $result;
            }
            else
            {
              return false;
            }

        }
      public function editProduct($data,$file,$product_id)

    {
       $product_name=mysqli_real_escape_string($this->db,$data['product_name']);
       $category_id=mysqli_real_escape_string($this->db,$data['category_id']);
       $description=mysqli_real_escape_string($this->db,$data['description']);
       $price=mysqli_real_escape_string($this->db,$data['price']);
      $permited  = array('jpg', 'jpeg', 'png');
      $file_name = $file['image']['name'];
      $file_size = $file['image']['size'];
      $file_temp = $file['image']['tmp_name'];
      $div = explode('.', $file_name);
      $file_ext = strtolower(end($div));
      $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
      $image = "../assets/images/".$unique_image;
      if (empty($product_name)||empty($category_id)||empty($description)||empty($price)) {

      	  return $msg= "<span class='error'>Fields cannot be left empty.Please enter every field.</span>";
      }else{
        //has got file and wants to edit other entity!	
          if (!empty($file_name)) {
          if ($file_size >1048567) {
            return $msg= "<span class='error'>Image Size should be less then 1MB!
         </span>";
         } elseif (in_array($file_ext, $permited) === false) {
         return $msg= "<span class='error'>You can upload only files with extention:"
         .implode(', ', $permited)."</span>";
         } else{
            move_uploaded_file($file_temp, $image);
            
            $query= "UPDATE product
                     SET product_name='$product_name',
                         category_id='$category_id',
                         description='$description',
                         price='$price',
                         image='$image'
                         WHERE product_id='$product_id'";
           $product_update= mysqli_query($this->db, $query);	
           
            if ($product_update) {
            return $msg= "<span class='success'>Product Edited Successfully.</span>";
            }else {
             return $msg="<span class='error'>Product Not Edited with file.</span>";
            }
               
    	}
        }
        else{// got no file but wants to edit other fields.
          
          
                  $query= "UPDATE product
                   SET product_name='$product_name',
                       category_id='$category_id',
                       description='$description',
                       price='$price'
                   WHERE product_id='$product_id'";

       $product_update = mysqli_query($this->db, $query);	
       
        if ($product_update) {
        return $msg= "<span class='success'>Product Edited Successfully.</span>";
        }else {
         return $msg="<span class='error'>Product Not Edited without file.</span>";
        }
        }

  }
  }

   public function deleteProduct($product_id)
   {
     // for deleting file from directory
    $image_query="SELECT * FROM product WHERE product_id='$product_id'";
    $bring_image=mysqli_query($this->db,$image_query);
    if ($bring_image) {
    	while ($obtained_image=$bring_image->fetch_assoc()) {
    		$image_link=$obtained_image['image'];
    		
    		unlink($image_link);
    	}
    }

   $query="DELETE FROM product WHERE product_id='$product_id'";
          $product_delete=mysqli_query($this->db,$query);
          if($product_delete){

          return $msg="<span class='success'> Product deleted successfully. </span>";

         }  else{
          return $msg="<span class='error'> Product not deleted. </span>";
       }
  }
}