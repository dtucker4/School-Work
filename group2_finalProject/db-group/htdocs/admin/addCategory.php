<!DOCTYPE html>
 <html>
 <head>
 <meta http-equiv="content-type"
content="text/html; charset=utf-8" />
 <title>Add new category</title>
 </head>
 <body>
 <?php 
 require ('../../mysqli_connect.php');

 if ($_SERVER['REQUEST_METHOD'] == 'POST')
{ // Handle the form.

 // Validate the incoming data...
 $errors = array( );

 
  // Check for a category:
 if (!empty($_POST['category'])) {
 $category = trim($_POST['category']);
} else {
 $errors[ ] = 'Please enter the category name';
 }
 

 if (empty($errors)) { // If everything's OK.
 // Add the category to the database:
 $q = 'INSERT INTO category (category_name)
VALUES (?)';
 $stmt = mysqli_prepare($dbc, $q);
 mysqli_stmt_bind_param($stmt, 's', $category);
 mysqli_stmt_execute($stmt);

 // Check the results...
 if (mysqli_stmt_affected_rows($stmt) == 1) {

 // Print a message:
 echo '<p>The category has been added.</p>';


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
 <h1>Add a Category</h1>
<form enctype="multipart/form-data" action="addCategory.php" method="post">

 <input type="hidden" name="MAX_FILE_SIZE" value="524288" />

 <fieldset><legend>Fill out the form to add a Category:</legend>	

 <p><b>category Name:</b> <input type="text" name="category" size="30" maxlength="60" value="<?php if (isset($_POST['category'])) echo htmlspecialchars($_POST['category']); ?>"/></p>
 

 </fieldset>

 <div align="center"><input type="submit" name="submit" value="Submit" /> <a href="viewCategories.php">back</a></div>

 </form>

 </body>
 </html>