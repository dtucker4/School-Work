<?php 

 // Set the page title and include the HTML header:
 $page_title = 'Add to Cart';
 include $_SERVER['DOCUMENT_ROOT'] . '/db-group/htdocs/includes/header.html';

 if (isset ($_GET['pid']) && filter_var($_GET['pid'], FILTER_VALIDATE_INT, 
 array('min_range' => 1)) ) { // Check for a product ID.
 $pid = $_GET['pid'];

 // Check if the cart already contains one of these prints;
 // If so, increment the quantity:
 if (isset($_SESSION['cart'][$pid])) {

$_SESSION['cart'][$pid]['quantity']++; // Add another.

 // Display a message:
 echo '<div class="alert alert-success" role="alert">
 <strong>Success!</strong> Another copy of the print
 has been added to your shoppingcart.
</div>';

 } else { // New product to the cart.

 // Get the print's price from the database:
 require ('../../mysqli_connect.php');
// Connect to the database.
 $q = "SELECT price FROM items WHERE UPC=$pid";
 $r = mysqli_query ($dbc, $q);
if (mysqli_num_rows($r) == 1) { //Valid item UPC.

 // Fetch the information.
 list($price) = mysqli_fetch_array ($r, MYSQLI_NUM);

 // Add to the cart:
 $_SESSION['cart'][$pid] = array
('quantity' => 1, 'price' =>$price);

 // Display a message:
 echo '
 <div class="alert alert-success" role="alert">
 <strong>Success!</strong> The print has been
 added to your shopping cart.
</div>';

 } else { // Not a valid print ID.
 echo '<div class="alert alert-danger" role="alert">
 <strong>Error!</strong> This
 page has been accessed in
 error!
</div>';
 }
 mysqli_close($dbc);

 } // End of isset($_SESSION['cart'] [$pid] conditional.

 } else { // No print ID.
 echo '<div class="alert alert-danger" role="alert">
 <strong>Error!</strong> This
 page has been accessed in
 error!
</div>';
 }

 
echo '<div class="row text-center">
<div class="col">
    <a href="/db-group/htdocs/user/browse.php">
        <img height="250" width="250" src="https://www.shareicon.net/download/2015/09/16/102291_view_512x512.png"/>
        <h1>Browse items</h1>
    </a>
</div>
<div class="col">
    <a href="/db-group/htdocs/user/view_cart.php">
        <img height="250" width="250" src="https://d30y9cdsu7xlg0.cloudfront.net/png/2370-200.png"/>
        <h1>Shopping Cart</h1>
    </a>
</div>
</div>';

 include $_SERVER['DOCUMENT_ROOT'] . '/db-group/htdocs/includes/footer.html';
?>