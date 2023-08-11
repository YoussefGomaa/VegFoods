<?php
require_once "connect.php";
require_once "layout.php";

if($_GET){

	if($_GET['action']=="filter"){
     
		$catID=$_GET['catID'];


	}
else if(!$_GET['action']=="filterAll"){
	$itemID=$_GET['itemID'];
    $userID=$_SESSION['userID'];
   $selectStmt="select * from cart where userID='$userID' and itemID='$itemID'";

   $res=$connect->query($selectStmt);
if($res->num_rows>0){

	$updateStmt="update cart set quantity=quantity+1 where userID='$userID' and itemID='$itemID'";
	$res=$connect->query($updateStmt);

}
else{
	$inserStmt="insert into cart(userID,itemID,quantity) values ('$userID','$itemID',1)";
	$res=$connect->query($inserStmt);
}
}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Vegefoods</title>
    <meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/ionicons.min.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body class="goto-here">
	

    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Products</span></p>
            <h1 class="mb-0 bread">Products</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row justify-content-center">
    			<div class="col-md-10 mb-5 text-center">
					<?php
					$selectCategories="select * from categories";
					$res=$connect->query($selectCategories);
					?>
    				<ul class="product-category">
    					<li><a href="shop.php?action=filterAll" >All</a></li>
						<?php while($row=$res->fetch_assoc()){  ?>
    					<li><a href="shop.php?action=filter&catID=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></li>
    				<?php } ?>
    				</ul>
    			</div>
    		</div>
    		<div class="row">

			<?php

if(isset($catID)){
$selectFeatured="select * from items where catID='$catID'";
}
else{
	$selectFeatured="select * from items";
}
$res=$connect->query($selectFeatured);

while($row=$res->fetch_assoc()){
?>
    			<div class="col-md-6 col-lg-3">
    				<div class="product">
    					<a href="#" class="img-prod"><img class="img-fluid" src="images/<?php echo $row['imgPath'];  ?>" alt="Colorlib Template">
    				
    						<div class="overlay"></div>
    					</a>
    					<div class="text py-3 pb-4 px-3 text-center">
    						<h3><a href="#"><?php echo $row['name'];  ?></a></h3>
    						<div class="d-flex">
    							<div class="pricing">
		    						<p class="price"><span ><?php echo $row['price'];  ?></span></p>
		    					</div>
	    					</div>
	    					<div class="bottom-area d-flex px-3">

								<div class="m-auto d-flex">

										
								<?php 
if(isset($_SESSION['userID'])){ ?>
    <a href="index.php?itemID=<?php echo $row['id'];  ?>"><i class="ion-ios-cart"></i></a>
<?php }
else{?>	<a href="login.php"><i class="ion-ios-cart"></i></a>
								<?php	}?>
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>
    			<?php } ?>

    		</div>
    	</div>
    </section>
	<footer class="ftco-footer ftco-section">
		<div class="container">
		  <div class="row mb-5">
			<div class="col-md">
			  <div class="ftco-footer-widget mb-4">
				<h2 class="ftco-heading-2">Vegefoods</h2>
				<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
				<ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
				  <li><a href="#"><span class="icon-twitter"></span></a></li>
				  <li><a href="#"><span class="icon-facebook"></span></a></li>
				  <li><a href="#"><span class="icon-instagram"></span></a></li>
				</ul>
			  </div>
			</div>
			<div class="col-md">
			  <div class="ftco-footer-widget mb-4 ml-md-5">
				<h2 class="ftco-heading-2">Menu</h2>
				<ul class="list-unstyled">
				  <li><a href="#" class="py-2 d-block">Shop</a></li>
				  <li><a href="#" class="py-2 d-block">About</a></li>
				  <li><a href="#" class="py-2 d-block">Contact Us</a></li>
				</ul>
			  </div>
			</div>
			<div class="col-md-4">
			   <div class="ftco-footer-widget mb-4">
				<h2 class="ftco-heading-2">Help</h2>
				<div class="d-flex">
					<ul class="list-unstyled mr-l-5 pr-l-3 mr-4">
					  <li><a href="#" class="py-2 d-block">Shipping Information</a></li>
					  <li><a href="#" class="py-2 d-block">Returns &amp; Exchange</a></li>
					  <li><a href="#" class="py-2 d-block">Terms &amp; Conditions</a></li>
					  <li><a href="#" class="py-2 d-block">Privacy Policy</a></li>
					</ul>
				   
				  </div>
			  </div>
			</div>
			<div class="col-md">
			  <div class="ftco-footer-widget mb-4">
				  <h2 class="ftco-heading-2">Have a Questions?</h2>
				  <div class="block-23 mb-3">
					<ul>
					  <li><span class="icon icon-map-marker"></span><span class="text"> Cairo, Egypt</span></li>
					  <li><a href="#"><span class="icon icon-phone"></span><span class="text">01064477689</span></a></li>
					  <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@Vegefoods.com</span></a></li>
					</ul>
				  </div>
			  </div>
			</div>
		  </div>
		</div>
	  </footer>
	  <script src="js/jquery.min.js"></script>
	  <script src="js/popper.min.js"></script>
	  <script src="js/bootstrap.min.js"></script>
    
  </body>
</html>