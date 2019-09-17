<!DOCTYPE html>
 <html>
 <head>
 <meta http-equiv="content-type"
content="text/html; charset=utf-8" />
 <title>Request</title>
 </head>
 <body>
 <?php 
 require ('../../mysqli_connect.php');
 if(isset($_GET["UPC"]) && !empty(trim($_GET["UPC"]))){

        // Get URL parameter
		$UPC =  trim($_GET["UPC"]);   
		}	
		
		if(isset($_GET["store"]) && !empty(trim($_GET["store"]))){

        // Get URL parameter
		$store_id =  trim($_GET["store"]);   
		}

 if ($_SERVER['REQUEST_METHOD'] == 'POST')
{ // Handle the form.

 // Validate the incoming data...
 $errors = array( );

 

 
 // Check for a qty:
 if (!empty($_POST['quantity'])) {
 $qty = trim($_POST['quantity']);
} else {
 $errors[ ] = 'Please enter the qty';
 } 

 

 
 if (empty($errors)) { // If everything's OK.

		
		

	 $q = 'INSERT INTO restock (quantity, UPC, store_id)
			VALUES (?, ?, ?)';
			 $stmt = mysqli_prepare($dbc, $q);
			 mysqli_stmt_bind_param($stmt, 'sss', $qty, $UPC, $store_id);
			 mysqli_stmt_execute($stmt);

 // Check the results...
	if (mysqli_stmt_affected_rows($stmt) == 1) {

		 // Print a message:
		 echo '<p>The quantity has been requested.</p>';


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
 <h1>Request Restock</h1>
<form enctype="multipart/form-data" action="reorderRequest.php?UPC=<?php echo $UPC ?>&store=<?php echo $store_id ?>" method="post">

 <input type="hidden" name="MAX_FILE_SIZE" value="524288" />

 <fieldset>

 <p><b>Quantity to add:</b> <input type="text" name="quantity" size="30" maxlength="60" value="<?php if (isset($_POST['quantity'])) echo htmlspecialchars($_POST['quantity']); ?>"/></p>
 

 </select></p>

 </fieldset>

 <div align="center"><input class="btn btn-primary" type="submit" name="submit" value="Submit" /> <a class="btn btn-secondary" href="reorder.php">back</a></div>

 </form>
 <?php
 echo "Store ID - $store_id<br />\n";
 echo "UPC - $UPC<br />\n";
 
 ?>
 </body>
 </html>