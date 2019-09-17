<?php 

 // Set the page title and include the HTML header:
 $page_title = 'View Stores';
 include $_SERVER['DOCUMENT_ROOT'] . '/db-group/htdocs/includes/header.html';
include ('includes/header.html');

 // Check if the form has been submitted (to update the cart):
 if ($_SERVER['REQUEST_METHOD'] == 'POST'){


 } // End of SUBMITTED IF.


 // Retrieve all of the information for table:
 require ('../../mysqli_connect.php'); // Connect to the database.
 $q = "SELECT store_id, branch_name, city, address, hours
FROM store ORDER BY branch_name ASC";

 
 $r = mysqli_query ($dbc, $q)
	or die("Error: ".mysqli_error($dbc));
	
 // Create a form and a table:
 // Create a form and a table:
 echo '
 <table border="0" width="90%" cellspacing="3" cellpadding="3" align="center">
 <tr>
 <td align="left" width="15%"><b>ID</b></td>
 <td align="left" width="20%"><b>Branch Name</b></td>
 
 <td align="left" width="20%"><b>City</b></td>
 <td align="left" width="15%"><b>Address</b></td>
  <td align="left" width="15%"><b>Hours</b></td>
  
 </tr>
 ';

 // Print each item...
 while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)) {
 // Print the row:
 echo "\t<tr>
   <td align=\"left\">{$row['store_id']}</td>
   <td align=\"left\">{$row['branch_name']}</td>
	<td align=\"left\">{$row['city']}</td>
   <td align=\"left\">{$row['address']}</td>
    <td align=\"left\">{$row['hours']}</td>
	<td align=\"center\"><a href='updateStore.php?id=". $row['store_id'] ."' title='Update Record' data-toggle='tooltip'>edit</a></td>
    <td align=\"center\"><a href='deleteStore.php?id=". $row['store_id'] ."' title='Delete Record' data-toggle='tooltip'>delete</a></td>
        
 </tr>\n";
} // End of the WHILE loop.

 mysqli_close($dbc); // Close the database connection.

 // Print the total, close the table, and the form:
 echo '</table><div class="text-center"><a class="btn btn-primary" href="addStore.php">Add New Branch</a></div>';


 include ('includes/footer.html');
 ?>