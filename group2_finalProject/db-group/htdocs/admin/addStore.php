<!DOCTYPE html>
 <html>
 <head>
 <meta http-equiv="content-type" content="text/html; charset=utf-8" />
 <title>Add new Store</title>
 </head>
 <body>
 <?php
 // This page allows the administrator to add a Store.

 require ('../../mysqli_connect.php');

 if ($_SERVER['REQUEST_METHOD'] == 'POST')
{ // Handle the form.

	 // Validate the incoming data...
	 $errors = array( );

	 // Check for a Store name:
	 if (!empty($_POST['branch_name'])) {
		$branch_name = trim($_POST['branch_name']);
	 } else {
		$errors[ ] = 'Please enter the branch name';
	 }

	 	 // Check for a address:
	 if (!empty($_POST['address'])) {
		$address = trim($_POST['address']);
	 } else {
		$errors[ ] = 'Please enter the address';
	 }
	 
	 	 // Check for a hours:
	 if (!empty($_POST['hours'])) {
		$hours = trim($_POST['hours']);
	 } else {
		$errors[ ] = 'Please enter the hours';
	 }
	 

	 if (empty($errors)) { // If everything's OK.
			 // Add the Store to the database:
			 $q = 'INSERT INTO store (branch_name, address, hours)
			VALUES (?, ?, ?)';
			 $stmt = mysqli_prepare($dbc, $q);
			 mysqli_stmt_bind_param($stmt, 'sss', $branch_name, $address, $hours);
			 mysqli_stmt_execute($stmt);

			 // Check the results...
			 if (mysqli_stmt_affected_rows($stmt) == 1) {

			 // Print a message:
			 echo '<p>The store has been added.</p>';

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
 // Close the database connection. 
	mysqli_close($dbc); 
 // Display the form...
 ?>
 <h1>Add a Store</h1>
	<form enctype="multipart/form-data" action="addStore.php" method="POST">

	 
	 <fieldset><legend>Fill out the form to add a product to the catalog:</legend>

		 <p><b>Branch Name:</b> <input type="text" name="branch_name" size="30" maxlength="128" value="<?php if (isset($_POST['branch_name'])) echo htmlspecialchars($_POST['branch_name']); ?>"/></p>
		 <p><b>Address:</b> <input type="text" name="address" size="30" maxlength="128" value="<?php if (isset($_POST['address'])) echo htmlspecialchars($_POST['address']); ?>"/></p>
		 <p><b>Hours:</b> <input type="text" name="hours" size="30" maxlength="60" value="<?php if (isset($_POST['hours'])) echo htmlspecialchars($_POST['hours']); ?>"/></p>

	 </fieldset>

	 <div align="center"><input type="submit" name="submit" value="Submit" /> <a href="viewStores.php">back</a></div>

	 </form>

 </body>
 </html>