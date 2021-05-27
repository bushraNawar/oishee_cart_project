
  <?php

  /**
   * This class is for category
   */

  class Category 
  {
     public $db;

  	 function __construct()
  	 {
      include('../config/db.inc.php');
      $this->db=$db;
     
  	 }
      public function addCategory($category_name)
       {
        
         $category_name=mysqli_real_escape_string($this->db,$category_name);
         if (empty($category_name)) {
          $msg="<span class='error'>Category name can't be left empty</span>";
          return $msg;
         } else{
          $query="INSERT INTO category (category_name) 
    			  VALUES('$category_name')";
    			  
    		 $category_insert = mysqli_query($this->db, $query);	
      		 if($category_insert){
      		 	return $msg="<span class='success'> Category added successfully. </span>";
      		 }  else{
      		 	return $msg="<span class='error'> Category not added. </span>";
      		 }

         }
         

       }
         public function showCategory()
        {
            
            $query = "SELECT * FROM category ORDER BY category_id DESC";
            $result = mysqli_query($this->db, $query);
            if (mysqli_num_rows($result) > 0){ 
              return $result;
            }
            else
            {
              return false;
            }
        }

        public function showCategoryById($category_id)

        {
         

          $query = "SELECT * FROM category where category_id ='$category_id'";
            $result = mysqli_query($this->db, $query);
            if (mysqli_num_rows($result) > 0){ 
              return $result;
            }
            else
            {
              return false;
            }

        }
        public function editCategory($category_name,$category_id)
        {

         $category_name=mysqli_real_escape_string($this->db,$category_name);
         if (empty($category_name)) {
          $msg="<span class='error'>Category name can't be left empty</span>";
          return $msg;
         } else{
            $query="UPDATE  category
            SET category_name= '$category_name' 
            WHERE category_id='$category_id'";
              
           $category_edit= mysqli_query($this->db, $query); 
               if($category_edit){

                return $msg="<span class='success'> Category edited successfully. </span>";

               }  else{
                return $msg="<span class='error'> Category not edited. </span>";
               }
             }
            }
        public function deleteCategory($category_id)
        {
            

          $query="DELETE FROM category WHERE category_id='$category_id'";
          $category_delete=mysqli_query($this->db,$query);
              if($category_delete){

              return $msg="<span class='success'> Category deleted successfully. </span>";

             }  else{
              return $msg="<span class='error'> Category not deleted. </span>";
             }
           }
        

  }