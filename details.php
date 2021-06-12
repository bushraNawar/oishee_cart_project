		<?php include('header.php');?>
			<?php
				if (!isset($_GET['productId'])||empty($_GET['productId'])) {
				header("Location:404.php");
				exit();
				} else{
					$product_id=$_GET['productId'];
					$product_id=preg_replace('/[^-a-z-A-Z0-9]/', '', $product_id);
				}

			?>
		<div class="container">
		<div class="row">
    <div class="col-md-3">
    <div class="card bg-default" style="width:400px">

					
	              <?php 
		$get_single_product=$product->getSingleProductById($product_id);
				if($get_single_product)
				{

					while ($result=$get_single_product->fetch_assoc()) {?>
	                      
					<div class="row">
					<img src="<?=$result['image']?>" alt="<?=$result['product_name']?>" id="myImg"style="width:100%;max-width:300px"/>
					</div>
					<!-- The Modal -->
					<div id="myModal" class="modal">

					  <!-- The Close Button -->
					  <span style="font-size: 60px;" class="close">&times;</span>

					  <!-- Modal Content (The Image) -->
					  <img class="modal-content" id="img01">

					  <!-- Modal Caption (Image Text) -->
					  <div id="caption"></div>
					</div>
					  <div class="card-body ">
    <h4 class="card-title"><?=$result['product_name']?></h4>
    <p class="card-text">
     <h5>Description</h5> 
     <?=$result['description']?>
      
    </p>
    <p class="card-text">Category:<?=$result['category_name']?></p>
    <p class="card-text">Price:<big>৳<?=$result['price']?></big></p>
    <a href="#" class="btn btn-primary">Button</a>
  </div> 
		</div>			
					<?php  }}?>
		<!-- end  -->
		</div>
	     </div>
     </div>

	     <script >
		// Get the modal
	var modal = document.getElementById("myModal");

	// Get the image and insert it inside the modal - use its "alt" text as a caption
	var img = document.getElementById("myImg");
	var modalImg = document.getElementById("img01");
	var captionText = document.getElementById("caption");
	img.onclick = function(){
	  modal.style.display = "block";
	  modalImg.src = this.src;
	  captionText.innerHTML = this.alt;
	}

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
	  modal.style.display = "none";
	}
	</script>
		<?php include ('footer.php');?>