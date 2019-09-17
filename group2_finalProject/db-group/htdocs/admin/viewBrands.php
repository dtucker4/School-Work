<?php 
 // Set the page title and include the HTML header:
 $page_title = 'View Brands';
 include $_SERVER['DOCUMENT_ROOT'] . '/db-group/htdocs/includes/header.html';
 include ('includes/header.html');

 // Check if the form has been submitted (to update the cart):
 if ($_SERVER['REQUEST_METHOD'] == 'POST'){


 } // End of SUBMITTED IF.


 // Retrieve all of the information for table:
 require ('../../mysqli_connect.php'); // Connect to the database.
 $q = "SELECT id_brand, brand_name, vendor
FROM brand ORDER BY brand_name ASC";

 
 $r = mysqli_query ($dbc, $q)
	or die("Error: ".mysqli_error($dbc));
	
 // Create a form and a table:
 echo '<br>
 <table class="table table-bordered" border="0" width="90%" cellspacing="3" cellpadding="3" align="center">
 <tr>
 <td align="left" width="15%"><b>ID</b></td>
 <td align="left" width="20%"><b>Brand Name</b></td>
 <td align="left" width="15%"><b>Vendor Name</b></td>
 </tr>
 ';

 // Print each item...
 while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)) {
 // Print the row:
 echo "\t<tr>
   <td align=\"left\">{$row['id_brand']}</td>
   <td align=\"left\">{$row['brand_name']}</td>
   <td align=\"left\">{$row['vendor']}</td>
   <td align=\"center\"><a href='updateBrand.php?id=". $row['id_brand'] ."' title='Update Record' data-toggle='tooltip'>edit</a></td>
        <td align=\"center\"><a href='deleteBrand.php?id=". $row['id_brand'] ."' title='Delete Record' data-toggle='tooltip'>delete</a></td>
        
 </tr>\n";
} // End of the WHILE loop.

 mysqli_close($dbc); // Close the database connection.

 // Print the total, close the table, and the form:
 echo '</table><div class="text-center"><a class="btn btn-primary" href="addBrand.php">Add New Brand</a></div>';


 include ('includes/footer.html');
 ?>