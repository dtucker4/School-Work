<!DOCTYPE html>
 <html>
 <head>
 <meta http-equiv="content-type"
content="text/html; charset=utf-8" />
 <title>Add new Catagory</title>
 </head>
 <body>
 <?php 
 require ('../../mysqli_connect.php');

 if ($_SERVER['REQUEST_METHOD'] == 'POST')
{ // Handle the form.

 // Validate the incoming data...
 $errors = array( );

 
  // Check for a catagory:
 if (!empty($_POST['catagory'])) {
 $catagory = trim($_POST['catagory']);
} else {
 $errors[ ] = 'Please enter the catagory name';
 }
 

 if (empty($errors)) { // If everything's OK.
 // Add the catagory to the database:
 $q = 'INSERT INTO catagory (catagory_name)
VALUES (?)';
 $stmt = mysqli_prepare($dbc, $q);
 mysqli_stmt_bind_param($stmt, 's', $catagory);
 mysqli_stmt_execute($stmt);

 // Check the results...
 if (mysqli_stmt_affected_rows($stmt) == 1) {

 // Print a message:
 echo '<p>The catagory has been added.</p>';


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
<form enctype="multipart/form-data" action="addCatagory.php" method="post">

 <input type="hidden" name="MAX_FILE_SIZE" value="524288" />

 <fieldset><legend>Fill out the form to add a vendor:</legend>

 <p><b>catagory Name:</b> <input type="text" name="catagory" size="30" maxlength="60" value="<?php if (isset($_POST['catagory'])) echo htmlspecialchars($_POST['catagory']); ?>"/></p>
 

 </fieldset>

 <div align="center"><input type="submit" name="submit" value="Submit" /> <a href="#">back</a></div>

 </form>

 </body>
 </html>