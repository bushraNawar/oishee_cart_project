    <?php include('header.php'); ?>

   

      <!--Slider        Ends  -->
    <!--Featured product -->
    <div class="container">
    <div class="container">
  <div class="row">
    <h3>Featured products</h3>
    
  </div>
<div class="row">
   <?php
    $get_featured_product=$product->getProduct();
    if ($get_featured_product) {

    while ( $result=$get_featured_product->fetch_assoc()) {?>
<div class="col-md-3">
<div class="card bg-default" style="width:400px">
  <a href="details.php?productId=<?=$result['product_id']?>"><img src="<?=$result['image']?>" alt="Card image"></a>
  <div class="card-body ">
    <h4 class="card-title"><?=$result['product_name']?></h4>
    <p class="card-text">
      <?php 

    $text=$result['description']. " ";
    $text=substr($text, 0,35);
    $text=substr($text,0, strpos($text, ' '));
    $text=$text. "...";
    echo $text;
    ?>
      
    </p>
    <p>৳<?=$result['price']?></p>
    <a href="details.php?productId=<?=$result['product_id']?>" class="btn btn-primary">Details</a>
  </div>
</div>
</div>
 <?php  }
    }
    ?>
<!-- end your iteration here -->
</div>
</div>
  
<!-- New Product -->
<div class="container">
  <div class="row">
    <h3>New products</h3>
    
  </div>
<div class="row">
   <?php
    $get_featured_product=$product->getProduct();
    if ($get_featured_product) {

    while ( $result=$get_featured_product->fetch_assoc()) {
       if ($result['product_id']%2==0) {
         # code...
       
      ?>

<div class="col-md-3">
<div class="card bg-default" style="width:400px">
  <a href="details.php?productId=<?=$result['product_id']?>"><img src="<?=$result['image']?>" alt="Card image"></a>
  <div class="card-body ">
    <h4 class="card-title"><?=$result['product_name']?></h4>
    <p class="card-text">
      <?php 

    $text=$result['description']. " ";
    $text=substr($text, 0,35);
    $text=substr($text,0, strpos($text, ' '));
    $text=$text. "...";
    echo $text;
    ?>
      
    </p>
    <p>৳<?=$result['price']?></p>
    <a href="details.php?productId=<?=$result['product_id']?>" class="btn btn-primary">Details</a>
  </div>
</div>
</div>
 <?php  }
    }}
    ?>
<!-- end your iteration here -->
</div>
</div>
   
    </div>                     


    <?php include('footer.php');?>


