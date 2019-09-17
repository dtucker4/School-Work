<!DOCTYPE html>
 <html>
 <head>
 <meta http-equiv="content-type" content="text/html; charset=utf-8" />
 <title>Add new product</title>
 </head>
 <body>
 <?php
 // This page allows the administrator to add a product.

 require ('../../mysqli_connect.php');

 if ($_SERVER['REQUEST_METHOD'] == 'POST')
{ // Handle the form.

	 // Validate the incoming data...
	 $errors = array( );

	 // Check for a product name:
	 if (!empty($_POST['item_name'])) {
		$item_name = trim($_POST['item_name']);
	 } else {
		$errors[ ] = 'Please enter the products name/description';
	 }

	 // Validate the brand...
	 if ( isset($_POST['brand']) && filter_var($_POST['brand'], FILTER_SANITIZE_STRING, array('min_range' => 1)) ) {
		$brand = $_POST['brand'];
	 } else { // No dept selected.
		$errors[ ] = 'Please select the brand';
	 }
	 
	  // Check for a price:
	 if (is_numeric($_POST['vendor_cost']) && ($_POST['vendor_cost'] > 0)) {
		$vendor_cost = (float) $_POST['vendor_cost'];
	 } else {
		$errors[ ] = 'Please enter the vendor\'s price!';
	 }
	 
	 // Check for a price:
	 if (is_numeric($_POST['price']) && ($_POST['price'] > 0)) {
		$price = (float) $_POST['price'];
	 } else {
		$errors[ ] = 'Please enter the products\'s price!';
	 }
	 // Check for a product type:
	 if (!empty($_POST['type'])) {
		$type = trim($_POST['type']);
	 } else {
		$errors[ ] = 'Please enter the products type';
	 }
	
	 // Validate taxable...
	 if ( isset($_POST['taxable']) && filter_var($_POST['taxable'], FILTER_VALIDATE_INT, array('taxable' => 1)) ) {
		$taxable = $_POST['taxable'];
	 } else { // nothing selected.
		$errors[ ] = 'Please indicate taxable';
	 }
	 
	 // Check for a size:
	 if (!empty($_POST['size'])) {
		$size = trim($_POST['size']);
	 } else {
		$errors[ ] = 'Please enter the product\'s size';
	 }
	   // Check for a upc:
	 if (is_numeric($_POST['UPC']) && ($_POST['UPC'] > 0)) {
		$UPC = (float) $_POST['UPC'];
	 } else {
		$errors[ ] = 'Please enter the products\'s upc!';
	 }


	 if (empty($errors)) { // If everything's OK.
			 // Add the print to the database:
			 $q = 'INSERT INTO items (description, brand_id, vendor_cost, price, type, taxable, size, UPC)
			VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
			 $stmt = mysqli_prepare($dbc, $q);
			 mysqli_stmt_bind_param($stmt, 'ssssssss', $item_name, $brand, $vendor_cost, $price, $type, $taxable, $size, $UPC);
			 mysqli_stmt_execute($stmt);

			 // Check the results...
			 if (mysqli_stmt_affected_rows($stmt) == 1) {

			 // Print a message:
			 echo '<p>The product has been added.</p>';

			 // Clear $_POST:
			 $_POST = array( );

		 } else { // Error!
			echo '<p style="font-weight: bold; color: #C00">Your submission could not be processed due to a system error.</p>';
		 }

		 mysqli_stmt_close($stmt);

	 } // End of $errors IF.

 } // End of the submission IF.

	// Check for any errors and print them:
	if ( !empty($errors) && is_array($errors) ) {
		 echo '<h1>Error!</h1>
		 <p style="font-weight: bold; color: #C00">The following error(s) occurred:<br />';
		 foreach ($errors as $msg) {
			echo " - $msg<br />\n";
		 }
	}
 
 // Display the form...
 ?>
 <h1>Add a Product</h1>
<form enctype="multipart/form-data" action="addProduct.php" method="POST">

 
 <fieldset><legend>Fill out the form to add a product to the catalog:</legend>

 <p><b>Product Name:</b> <input type="text" name="item_name" size="30" maxlength="60" value="<?php if (isset($_POST['item_name'])) echo htmlspecialchars($_POST['item_name']); ?>"/></p>

 <p><b>Brand:</b>
 <select name="brand"><option>Select One</option>
 <?php // Retrieve all the depts and add to the pull-down menu.
 $q = "SELECT brand_name, CONCAT_WS(' ', brand_name) 
		FROM brand ORDER BY brand_name ASC";
 $r = mysqli_query ($dbc, $q);
 if (mysqli_num_rows($r) > 0) {
 while ($row = mysqli_fetch_array ($r, MYSQLI_NUM)) {
 echo "<option value=\"$row[0]\"";
 // Check for stickyness:
 if (isset($_POST['existing']) && ($_POST['existing'] == $row[0]) ) echo ' selected="selected"';
 echo ">$row[1]</option>\n";
 }
 } else {
 echo '<option>Please add a new brand first.</option>';
 }

 ?>
 </select></p>
 
 
 <p><b>vendor cost:</b> <input type="text" name="vendor_cost" size="30" maxlength="60" value="<?php if (isset($_POST['vendor_cost'])) echo htmlspecialchars($_POST['vendor_cost']); ?>"/></p>
 <p><b>Selling Price:</b> <input type="text" name="price" size="30" maxlength="60" value="<?php if (isset($_POST['price'])) echo htmlspecialchars($_POST['price']); ?>"/></p>
 

 <p><b>category:</b>
 <select name="type"><option>Select One</option>
 <?php // Retrieve all the depts and add to the pull-down menu.
 $q = "SELECT category_name, CONCAT_WS(' ', category_name) 
		FROM category ORDER BY category_name ASC";
 $r = mysqli_query ($dbc, $q);
 if (mysqli_num_rows($r) > 0) {
 while ($row = mysqli_fetch_array ($r, MYSQLI_NUM)) {
 echo "<option value=\"$row[0]\"";
 // Check for stickyness:
 if (isset($_POST['existing']) && ($_POST['existing'] == $row[0]) ) echo ' selected="selected"';
 echo ">$row[1]</option>\n";
 }
 } else {
 echo '<option>Please add a new category first.</option>';
 }
// Close the database connection. 
	mysqli_close($dbc); 
 ?>
 </select></p>
<p><b>Taxable?:</b></p>
 
  <input type="radio" name="taxable" value="1" checked> yes
  <input type="radio" name="taxable" value="0"> no<br>
	

 <p><b>Size:</b> <input type="text" name="size" size="30" maxlength="60" value="<?php if (isset($_POST['size'])) echo htmlspecialchars($_POST['size']); ?>"/></p>

 <p><b>UPC:</b> <input type="text" name="UPC" size="30" maxlength="60" value="<?php if (isset($_POST['UPC'])) echo htmlspecialchars($_POST['UPC']); ?>"/></p>

 </fieldset>

 <div align="center"><input type="submit" name="submit" value="Submit" /><a href="viewProducts.php">back</a></div>

 </form>

 </body>
 </html>