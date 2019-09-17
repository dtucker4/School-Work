<?php 
 // Set the page title and include the HTML header:
 $page_title = 'View Products';
 include $_SERVER['DOCUMENT_ROOT'] . '/db-group/htdocs/includes/header.html';
 include ('includes/header.html');

 // Check if the form has been submitted (to update the cart):
 if ($_SERVER['REQUEST_METHOD'] == 'POST'){


 } // End of SUBMITTED IF.


 // Retrieve all of the information for table:
 require ('../../mysqli_connect.php'); // Connect to the database.
 $q = "SELECT description, brand_id, vendor_cost, price, type, taxable, size, UPC
FROM items ORDER BY brand_id ASC";

 
 $r = mysqli_query ($dbc, $q)
	or die("Error: ".mysqli_error($dbc));
	
 // Create a form and a table:
 echo '<br/>
 <table class="table table-bordered" border="0" width="90%" cellspacing="3" cellpadding="3" align="center">
 <tr>
 <td align="left" width="15%"><b>Product Name</b></td>
 <td align="left" width="15%"><b>Brand</b></td>
 <td align="left" width="10%"><b>Vendor Cost</b></td>
 <td align="left" width="10%"><b>Price</b></td>
  <td align="left" width="15%"><b>category</b></td>
   <td align="left" width="10%"><b>Taxable</b></td>
    <td align="left" width="10%"><b>Size</b></td>
	 <td align="left" width="15%"><b>UPC</b></td>
 </tr>
 ';

 // Print each item...
 while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)) {
 // Print the row:
 echo "\t<tr>
   <td align=\"left\">{$row['description']}</td>
   <td align=\"left\">{$row['brand_id']}</td>
   <td align=\"left\">{$row['vendor_cost']}</td>	
   <td align=\"left\">{$row['price']}</td>
   <td align=\"left\">{$row['type']}</td>
   <td align=\"left\">{$row['taxable']}</td>
   <td align=\"left\">{$row['size']}</td>
   <td align=\"left\">{$row['UPC']}</td>	
   <td align=\"center\"><a href='updateProduct.php?id=". $row['UPC'] ."' title='Update Record' data-toggle='tooltip'>edit</a></td>
        <td align=\"center\"><a href='deleteProduct.php?id=". $row['UPC'] ."' title='Update Record' data-toggle='tooltip'>delete</a></td>
        
 </tr>\n";
} // End of the WHILE loop.

 mysqli_close($dbc); // Close the database connection.

 // Print the total, close the table, and the form:
 echo '</table><div class="text-center"><a class="btn btn-primary" href="addProduct.php">Add New Product</a></div>';


 include ('includes/footer.html');
 ?>