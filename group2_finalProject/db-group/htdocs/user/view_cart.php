<?php 
 // Set the page title and include the HTML header:
 $page_title = 'View Your Shopping Cart';
 include $_SERVER['DOCUMENT_ROOT'] . '/db-group/htdocs/includes/header.html';

 // Check if the form has been submitted (to update the cart):
 if ($_SERVER['REQUEST_METHOD'] == 'POST'){

 // Change any quantities:
 foreach ($_POST['qty'] as $k => $v) {

 // Must be integers!
 $pid = (int) $k;
 $qty = (int) $v;

 if ( $qty == 0 ) { // Delete.
 unset ($_SESSION['cart'][$pid]);
 } elseif ( $qty > 0 ) { // Change quantity.
 $_SESSION['cart'][$pid]
['quantity'] = $qty;
}

 } // End of FOREACH.

 } // End of SUBMITTED IF.

 // Display the cart if it's not empty...
 if (!empty($_SESSION['cart'])) {

 // Retrieve all of the information for the products  in the cart:
 require ('../../mysqli_connect.php'); // Connect to the database.
 $q = "SELECT description, brand_id, UPC FROM items WHERE UPC IN (";



 foreach ($_SESSION['cart'] as $pid => $value) {
 $q .= $pid . ',';
 }
 $q = substr($q, 0, -1) . ') ORDER BY description ASC';
 $r = mysqli_query ($dbc, $q);

 // Create a form and a table:
 echo '<form action="view_cart.php" method="post">
 <table class="table table-bordered" border="0" width="90%" cellspacing="3" cellpadding="3" align="center">
 <thead>
 <tr>
 <td align="left" width="30%"><b>Product</b></td>
 <td align="left" width="30%"><b>Brand</b></td>
 <td align="right" width="10%"><b>Price</b></td>
 <td align="center" width="10%"><b>Qty</b></td>
 <td align="right" width="10%"><b>Total Price</b></td>
 </tr>
 </thead>
 <tbody>
 ';

 // Print each item...
 $total = 0; // Total cost of the order.
 while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)) {

 // Calculate the total and sub-totals.
 $subtotal = $_SESSION['cart'][$row['UPC']]['quantity'] * $_SESSION['cart'][$row['UPC']]['price'];
 $total += $subtotal;

 // Print the row:
 echo "\t<tr>
 <td align=\"left\">{$row['description']}</td>
 <td align=\"left\">{$row['brand_id']}</td>
 <td align=\"right\">\${$_SESSION['cart'][$row['UPC']]['price']}</td>
 <td align=\"center\"><input type=\"text\" size=\"3\" name=\"qty[{$row['UPC']}]\"
value=\"{$_SESSION['cart'][$row['UPC']]['quantity']}\" /></td>
 <td align=\"right\">$" . number_format ($subtotal, 2) . "</td>
 </tr>\n";
} // End of the WHILE loop.

	 mysqli_close($dbc); // Close the database connection.

	 // Print the total, close the table, and the form:
	 echo '
	 <tr>
		<td colspan="4" align="right"><b>Total:</b></td>
		<td align="right">$' . number_format ($total, 2) . '</td>
	</tr>
	</tbody>
 </table>
 <div align="center"><input class="btn btn-primary" type="submit" name="submit" value="Update My Cart" /></div>
 </form><p align="center">Enter a quantity of 0 to remove an item.
 <br /><br /><a class="btn btn-primary" href="checkout.php?total=' . $total . '">Checkout</a></p>';

 } else {
 echo '<p>Your cart is currently empty.</p>';
 }

 include $_SERVER['DOCUMENT_ROOT'] . '/db-group/htdocs/includes/footer.html';
 ?>