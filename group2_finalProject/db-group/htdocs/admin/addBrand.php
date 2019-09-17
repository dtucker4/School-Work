<!DOCTYPE html>
 <html>
 <head>
 <meta http-equiv="content-type"
content="text/html; charset=utf-8" />
 <title>Add new Brand</title>
 </head>
 <body>
 <?php 
 require ('../../mysqli_connect.php');

 if ($_SERVER['REQUEST_METHOD'] == 'POST')
{ // Handle the form.

 // Validate the incoming data...
 $errors = array( );

 
  // Check for a student ID:
 if (!empty($_POST['brand_name'])) {
 $brand_name = trim($_POST['brand_name']);
} else {
 $errors[ ] = 'Please enter the brand name';
 }
 
 // Validate the vendor...
 if ( isset($_POST['vendor']) && filter_var($_POST['vendor'], FILTER_SANITIZE_STRING, array('min_
range' => 1)) ) {
 $vendor = $_POST['vendor'];
 } else { // No dept selected.
 $errors[ ] = 'Please select the brands vendor';
 }
 
 
 if (empty($errors)) { // If everything's OK.
 // Add the brand to the database:


 $q = "INSERT INTO brand(brand_name, vendor)
 VALUES (?, ?)";


 $stmt = mysqli_prepare($dbc, $q);
 mysqli_stmt_bind_param($stmt, 'ss', $brand_name, $vendor);
 mysqli_stmt_execute($stmt);

 // Check the results...
 if (mysqli_stmt_affected_rows($stmt) == 1) {

 // Print a message:
 echo '<p>The brand has been added.</p>';


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
 <h1>Add a Brand</h1>
<form enctype="multipart/form-data" action="addBrand.php" method="post">

 <input type="hidden" name="MAX_FILE_SIZE" value="524288" />

 <fieldset><legend>Fill out the form to add a Brand:</legend>

 <p><b>Brand Name:</b> <input type="text" name="brand_name" size="30" maxlength="60" value="<?php if (isset($_POST['brand_name'])) echo htmlspecialchars($_POST['brand_name']); ?>"/></p>
 
 <p><b>Vendor:</b>
 <select name="vendor"><option>Select One</option>
 <?php // Retrieve all the depts and add to the pull-down menu.
 $q = "SELECT vendor_name, CONCAT_WS(' ', vendor_name) 
		FROM vendor ORDER BY vendor_name ASC";
 $r = mysqli_query ($dbc, $q);
 if (mysqli_num_rows($r) > 0) {
 while ($row = mysqli_fetch_array ($r, MYSQLI_NUM)) {
 echo "<option value=\"$row[0]\"";
 // Check for stickyness:
 if (isset($_POST['existing']) && ($_POST['existing'] == $row[0]) ) echo ' selected="selected"';
 echo ">$row[1]</option>\n";
 }
 } else {
 echo '<option>Please add a new dept first.</option>';
 }

 ?>
 </select></p>
 

 </fieldset>

 <div align="center"><input type="submit" name="submit" value="Submit" /> <a href="viewBrands.php">back</a></div>

 </form>

 </body>
 </html>