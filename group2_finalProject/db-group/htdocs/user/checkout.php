<?php 
 // This page inserts the orders into the table.
 // This page would come after the billing process.
 // This page assumes that the billing process worked (the money has been taken).

 // Set the page title and include the HTML header:
 $page_title = 'Order Confirmation';
 include ('includes/header.html');

 // Assume that the customer is logged in and that this page has access to the customer's ID:
 $cid = 1; // Temporary.

 
$total =  trim($_GET["total"]);
 
$tax = round($total * 0.14,2); //14% tax rate
 require ('../../mysqli_connect.php'); //Connect to the database.

 // Turn autocommit off:
 mysqli_autocommit($dbc, FALSE);

 // Need the order ID:

      
  $q = "INSERT INTO checkout (cust_id, tax, subtotal) VALUES (?, ?, ?)" or die(mysql_error());
 
$stmt = mysqli_prepare($dbc, $q);
 mysqli_stmt_bind_param($stmt, 'sss', $cid, $tax, $total);
 mysqli_stmt_execute($stmt);

 $oid = mysqli_insert_id($dbc);
  mysqli_stmt_close($stmt);
  
  
 $q = "INSERT INTO checkoutaction(checkout_id, UPC, quantity) VALUES (?, ?, ?)" or die(mysql_error());
 $stmt = mysqli_prepare($dbc, $q);
 mysqli_stmt_bind_param($stmt, 'sss', $oid, $pid, $qty);
 mysqli_stmt_execute($stmt);


 $q = "UPDATE inventory SET quantity=quantity - ? WHERE UPC=? AND store_id=1" or die(mysql_error());
 $stmt = mysqli_prepare($dbc, $q);
 mysqli_stmt_bind_param($stmt, 'ss', $qty, $pid);
 mysqli_stmt_execute($stmt);

 // Check the results...
 
 
 
 // Execute each query; count the total affected:
 $affected = 0;
 foreach ($_SESSION['cart'] as $pid => $item) {
$qty = $item['quantity'];
$price = $item['price'];
mysqli_stmt_execute($stmt);
$affected += mysqli_stmt_affected_rows($stmt);
 }

 // Close this prepared statement:
 mysqli_stmt_close($stmt);
 // Report on the success....
if ($affected == count($_SESSION['cart'])) { // Whohoo!

// Commit the transaction:
 mysqli_commit($dbc);

// Clear the cart:
 unset($_SESSION['cart']);

 // Message to the customer:
 echo '<p>Thank you for your order!</p>';

 // Send emails and do whatever else.

 } else { // Rollback and report the problem.

mysqli_rollback($dbc);

 echo '<p>Your order could not be processed due to a system error.You will be contacted in order to have the problem fixed.
 We apologize for the inconvenience.</p>';
// Send the order information to the administrator.

 }

 
 mysqli_close($dbc);

 include ('includes/footer.html');
 ?>
