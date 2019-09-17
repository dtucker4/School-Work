<?php

 // Set the page title and include the HTML header:
 $page_title = 'View Catagories';
 include $_SERVER['DOCUMENT_ROOT'] . '/db-group/htdocs/includes/header.html';
 include ('includes/header.html');


 // Retrieve all of the information for table:
 require ('../../mysqli_connect.php'); // Connect to the database.
 $q = "SELECT * FROM category ORDER BY category_name ASC";

 
 $r = mysqli_query ($dbc, $q)
	or die("Error: ".mysqli_error($dbc));
	
 // Create a form and a table:
 echo '<br>
 <table class="table table-bordered" border="0" width="90%" cellspacing="3" cellpadding="3" align="center">
 <tr>
 <td align="left" width="15%"><b>ID</b></td>
 <td align="left" width="20%"><b>Category Name</b></td>
 </tr>
 ';

 // Print each item...
 while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)) {
 // Print the row:
 echo "\t<tr>
   <td align=\"left\">{$row['category_id']}</td>
   <td align=\"left\">{$row['category_name']}</td>
   <td align=\"center\"><a href='updateCatagory.php?id=". $row['category_id'] ."' title='Update Record' data-toggle='tooltip'>edit</a></td>
        <td align=\"center\"><a href='deleteCatagory.php?id=". $row['category_id'] ."' title='Delete Record' data-toggle='tooltip'>delete</a></td>
        
 </tr>\n";
} // End of the WHILE loop.

 mysqli_close($dbc); // Close the database connection.

 // Print the total, close the table, and the form:
 echo '</table><div class="text-center"><a class="btn btn-primary" href="addCategory.php">Add New Category</a></div>';


 include ('includes/footer.html');
 ?>