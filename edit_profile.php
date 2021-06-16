<?php include('header.php');?>
<?php
if (!isset($_SESSION['customer_logged_in'])) {

  header('Location:demo.php');
  exit();
  
}
?>
<?php
   

    if(isset($_POST['update'])){
     $user_id=$_SESSION['customer_id'];
       
    $update_customer_info_result  = $customer->editCustomerInfo($_POST,$user_id);}
    
    ?>

<div class="container">

<div class="row">
<?php
$user_id=$_SESSION['customer_id'];
$get_customer_info=$customer->getCustomerInfo($user_id);
if ($get_customer_info) {

  while ($result=$get_customer_info->fetch_assoc()) {?>
<form action="" method="post" style="width: 0%;
  margin: 0px;
  padding: 0px;
  border:0px;
  background: transparent;
  border-radius:0px;">
<table class="table table-striped">
    <thead>
      <?php if (isset($update_customer_info_result)) {?>
      <tr>
        
         
       <td colspan="2"><h3><strong><?=$update_customer_info_result?></strong></h3></td> 
      </tr>

       <?php  } ?>
      <tr>
       <td colspan="3"><h3><strong>Update Profile</strong></h3></td> 
      </tr>
      <tr>

        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Contact Number</th>
        <th>Address</th>
        
      </tr>
    </thead>
    <tbody>
      <tr>
        
        <td><input type="text" name="first_name" value="<?=$result['first_name']?>"></td>
       <td><input type="text" name="last_name" value="<?=$result['last_name']?>"></td>
       <td><input type="text" name="email" value="<?=$result['email']?>"></td>
       <td><input type="text" name="contact_number" value="<?=$result['contact_number']?>"></td>
        <td><input type="text" name="address" value="<?=$result['address']?>"></td>
       
      </tr>
      <tr>
        <td><input type="submit" name="update" class="btn btn-primary"></td>
      </tr>
      
    </tbody>
    <?php   
  }
}

?>  

  </table> 
  </form> 


</div>
</div>
<?php include('footer.php');?>