<?php
/**
 * 	Cart class
 */

class Cart  
{
	public $db;
  	function __construct()

  	 {
          $file_path=realpath(dirname(__FILE__));
         include($file_path.'/../config/db.inc.php');
         $this->db=$db;
     
  	 }
  	 public function addToCart($quantity,$product_id){
     
      $quantity=mysqli_real_escape_string($this->db,$quantity);
      $product_id=mysqli_real_escape_string($this->db,$product_id);
      $session_id=session_id();
       if (!empty($quantity)&&!empty($product_id)&&!empty($session_id)) {
       	$query = "SELECT * FROM product where product_id ='$product_id'";
            $result = mysqli_query($this->db, $query)->fetch_assoc();

		            if ($result){ 
		            $product_name=$result['product_name'];
		            $price       =$result['price'];
		            $image       =$result['image'];
		            // check whether this product previously added to cart or not
		            $check_query= "SELECT * FROM cart where product_id ='$product_id'AND session_id='$session_id'";
		            $get_product_check=mysqli_query($this->db, $check_query);
			             if (mysqli_num_rows($get_product_check) > 0){ 
				             $msg='Product Already added to cart!';
				             return $msg;
				            }
				            else
				            {
				              
				            	
				            $query = "INSERT INTO cart(
				            session_id,product_id,product_name,price,quantity,image) 
		          VALUES('$session_id','$product_id','$product_name','$price','$quantity','$image')";
		         $product_insert = mysqli_query($this->db, $query);	
		         
		          if ($product_insert) {
		          header('Location:cart.php');
		          exit();
		          }else {
		           	 header('Location:404.php');
		           	 exit;
		          }
		      }
		            }
		            else
		            {
		             header('Location:404.php');
		            }
       }
       else{
       	 header('Location:index.php');
		              exit();
       }
       

	}

	public function getCartProduct()
	{
		$session_id=session_id();
		 $query = "SELECT * FROM   cart WHERE session_id='$session_id'";
            $result = mysqli_query($this->db, $query);
            if (mysqli_num_rows($result) > 0){ 
              return $result;
            }
            else
            {
              return false;
            }



	}

	public function updateCartQuantity($quantity,$cart_id){
	      $quantity=mysqli_real_escape_string($this->db,$quantity);
	      $cart_id=mysqli_real_escape_string($this->db,$cart_id);
	      $query="UPDATE  cart
            SET quantity= '$quantity' 
            WHERE cart_id='$cart_id'";
              
           $quantity_update= mysqli_query($this->db, $query); 
               if($quantity_update){

                return $msg="<span class='success'> Quantity updated successfully. </span>";

               }  else{
                return $msg="<span class='error'> Quantity  not updated. </span>";
               }
	}
	public function delproductFromCart($cart_id){

	        $cart_id=mysqli_real_escape_string($this->db,$cart_id);
			$query="DELETE FROM cart WHERE cart_id='$cart_id'";
            $cart_item_delete=mysqli_query($this->db,$query);
              if($cart_item_delete){

             header('Location:cart.php');
             exit();

             }  else{
              return $msg="<span class='error'> Cart item not deleted. </span>";
             }
	}
	public function deleteCustomerCart(){

       $session_id=session_id();
       $query="DELETE  FROM cart WHERE session_id='$session_id'";
       $cart_delete=mysqli_query($this->db,$query);
      
	}
        public function insertOrder($user_id){
		$user_id=mysqli_real_escape_string($this->db,$user_id);
        $session_id=session_id();
		$query     = "SELECT * FROM   cart WHERE session_id='$session_id'";
        $getProduct    = mysqli_query($this->db, $query);
	         if (isset($getProduct)) {

	         	while ($result=$getProduct->fetch_assoc()) {
		         	$product_id   =$result['product_id'];
		         	$product_name =$result['product_name'];
		         	$quantity     =$result['quantity'];
		         	$price        =$result['price'];
		         	$image        =$result['image'];
		         	
                     // insert to customer_order table 
		         	 $query = "INSERT INTO customer_order(
				            user_id,product_id,product_name,quantity,price,image) 
		          VALUES('$user_id','$product_id','$product_name','$quantity','$price','$image')";
		         $order_insert = mysqli_query($this->db, $query);
		         	}
	         }
	}


	public function getOrderProduct( $user_id ){

		$query="SELECT * FROM customer_order WHERE user_id='$user_id' ORDER BY product_id DESC";
       $get_ordered_data=mysqli_query($this->db,$query);
       return $get_ordered_data;
	}
}