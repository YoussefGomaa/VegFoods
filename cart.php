<?php
require_once "connect.php";
require_once "layout.php";
if(!isset($_SESSION['userID'])){
    header('location:http://localhost/vegefoods/login.php');
}
else{
$userID=$_SESSION['userID'];

if($_GET){
	if($_GET['action']=="removeItem"){
$cartID=$_GET['cartID'];

$deleteQuery="delete from cart where id='$cartID'";
$res=$connect->query($deleteQuery);
	}
	else if($_GET['action']=="confirm"){

		$newInvoice="insert into invoice(userID) values ('$userID')";
		$res=$connect->query($newInvoice);
		$lastInvoice=$connect->insert_id;

		$cartItems="select itemID,price,quantity from cart join items on itemID=items.id where userID='$userID'";

		$cart=$connect->query($cartItems);

		while($row=$cart->fetch_assoc()){
$itemID=$row['itemID'];
$quantity=$row['quantity'];
$price=$row['price'];

			$insertItems="insert into orders(itemID,quantity,invoiceID,price)
			values('$itemID','$quantity','$lastInvoice','$price')";
		$res=$connect->query($insertItems);
		}

		$deleteCart="delete from cart where userID='$userID'";
		$res=$connect->query($deleteCart);

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
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Cart</span></p>
            <h1 class="mb-0 bread">My Cart</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section ftco-cart">
			<div class="container">
				<div class="row">
    			<div class="col-md-12">
    				<div class="cart-list">
	    				<table class="table">
						    <thead class="thead-primary">
						      <tr class="text-center">
						        <th>&nbsp;</th>
						        <th>&nbsp;</th>
						        <th>Product name</th>
						        <th>Price</th>
						        <th>Quantity</th>
						        <th>Total</th>
						      </tr>
						    </thead>
						    <tbody>

							<?php
     $cartItems="select cart.id as cartID,name,price,quantity,imgPath from cart
	  inner join items on itemID=items.id
	  where userID='$userID'";
	 $res=$connect->query($cartItems);
	 while($row=$res->fetch_assoc()){
							?>
						      <tr class="text-center">
						        <td class="product-remove"><a href="cart.php?action=removeItem&cartID=<?php echo $row['cartID']; ?>"><span class="ion-ios-close"></span></a></td>
						        
						        <td class="image-prod"><div class="img" style="background-image:url(images/<?php  echo $row['imgPath']; ?>);"></div></td>
						        
						        <td class="product-name">
						        	<h3><?php  echo $row['name']; ?></h3>
						        	
						        </td>
						        
						        <td class="price">$<?php  echo $row['price']; ?></td>
						        
						        <td class="quantity"><?php  echo $row['quantity']; ?></td>
						        
						        <td class="total">$<?php  echo $row['quantity'] * $row['price']; ?></td>
						      </tr><!-- END TR-->
<?php } ?>
						    </tbody>
						  </table>
					  </div>
    			</div>
    		</div>
    		<div class="row justify-content-end">
    			<?php
$subtotal="select sum(quantity*price) as total from cart
inner join items on itemID=items.id
where userID='$userID'";
$res=$connect->query($subtotal);
$row=$res->fetch_assoc();
				?>
    			<div class="col-lg-4 mt-5 cart-wrap">
    				<div class="cart-total mb-3">
    					<h3>Cart Totals</h3>
    					<p class="d-flex">
    						<span>Subtotal</span>
    						<span>$<?php echo $row['total'];?></span>
    					</p>
    					<p class="d-flex">
    						<span>Delivery</span>
    						<span>$0.00</span>
    					</p>
    					<hr>
    					<p class="d-flex total-price">
    						<span>Total</span>
    						<span>$<?php echo $row['total'];?></span>
    					</p>
    				</div>
    				<p><a href="cart.php?action=confirm" class="btn btn-primary py-3 px-4">Place order</a></p>
    			</div>
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

<?php } ?>