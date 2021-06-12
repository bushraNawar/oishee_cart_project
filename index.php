    <?php include('header.php'); ?>

   <div class="container">
 
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">

      <div class="item active">
       <a href="details.php?productId=3"> <img src="assets/images/demo.jpg" alt="" style="width:100%;"></a>
        <div class="carousel-caption">
          <h3>Product</h3>
        <a href="details.php?productId=3" class="btn btn-danger">BUY NOW</a>
        </div>
      </div>

      <div class="item">
        <a href="details.php?productId=3"> <img src="assets/images/demo.jpg" alt="" style="width:100%;"></a>
        <div class="carousel-caption">
          <h3>Product</h3>
        <a href="details.php?productId=3" class="btn btn-danger">BUY NOW</a>
        </div>
      </div>
    
      <div class="item">
       <a href="details.php?productId=3"> <img src="assets/images/demo.jpg" alt="" style="width:100%;"></a>
        <div class="carousel-caption">
          <h3>Product</h3>
           <a href="details.php?productId=3" class="btn btn-danger">BUY NOW</a>
        </div>
      </div>
  
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

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


