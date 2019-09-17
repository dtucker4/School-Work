 <?php 
 include $_SERVER['DOCUMENT_ROOT'] . '/db-group/htdocs/includes/header.html';
 require ('../../mysqli_connect.php');
 if(isset($_GET["UPC"]) && !empty(trim($_GET["UPC"]))){
	      // Get URL parameter
		$UPC =  trim($_GET["UPC"]);   
		}	
		
		if(isset($_GET["store"]) && !empty(trim($_GET["store"]))){

			// Get URL parameter
			$store_id =  trim($_GET["store"]);   
		}
			if(isset($_GET["qty"]) && !empty(trim($_GET["qty"]))){

			// Get URL parameter
			$qty =  trim($_GET["qty"]);   
		}
 
 
 if ($_SERVER['REQUEST_METHOD'] == 'POST')
{ // Handle the form.
 // Validate the incoming data...
 $errors = array( );
		
 
 
 
 if (empty($errors)) { // If everything's OK.
 
 
 $q = "UPDATE restock SET fulfilled = 1 WHERE UPC=? AND store_id=?" or die(mysql_error());
 
$stmt = mysqli_prepare($dbc, $q);
 mysqli_stmt_bind_param($stmt, 'ss', $UPC, $store_id);
 mysqli_stmt_execute($stmt);

 
$q = "UPDATE inventory SET quantity=quantity + ? WHERE UPC=? AND store_id=?" or die(mysql_error());
 $stmt = mysqli_prepare($dbc, $q);
 mysqli_stmt_bind_param($stmt, 'sss', $qty, $UPC, $store_id);
 mysqli_stmt_execute($stmt);
 // Check the results...
 if (mysqli_stmt_affected_rows($stmt) == 1) {
 // Print a message:
 echo '<div class="alert alert-success" role="alert">The quantity has been added.</div>';
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
 <div class="text-center">
 <h1>Fulfill request</h1>
 
 <p>Request from Store: <?php echo $store_id ?> for item UPC: <?php echo $UPC ?> with a quantity of <?php echo $qty ?></p>	
 
<form enctype="multipart/form-data" action="fulfill.php?UPC=<?php echo $UPC ?>&store=<?php echo $store_id ?>&qty=<?php echo $qty ?>" method="post">

 <input type="hidden" name="MAX_FILE_SIZE" value="524288" />
<div align="center"><input class="btn btn-primary" type="submit" name="submit" value="Submit" /> <a class="btn btn-secondary" href="viewRestock.php">back</a></div>

 </form>
 
 </div>
 </body>
</html>