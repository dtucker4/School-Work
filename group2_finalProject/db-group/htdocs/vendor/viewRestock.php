
<?php 
 require ('../../mysqli_connect.php');
 include $_SERVER['DOCUMENT_ROOT'] . '/db-group/htdocs/includes/header.html';
 include ('includes/header.html');

  if ($_SERVER['REQUEST_METHOD'] == 'POST')
{ // Handle the form.
	 // Validate the branch_name...
	 if ( isset($_POST['store']) && filter_var($_POST['store'], FILTER_SANITIZE_STRING, array('min_range' => 1)) ) {
		$bn = $_POST['store'];
	 } else { // No dept selected.
		$errors[ ] = 'Please select the branch_name';
	 }
	 
	 if (empty($errors)) { // If everything's OK.
			 
		
	 } // End of $errors IF.

 } // End of the submission IF.
 
 
 // Default query for this page:
// $q = "SELECT items.description, CONCAT_WS(' ', items.description, items.brand_id) AS item, 
// store.store_id, CONCAT_WS(' ', store_id.branch_name) AS store, quantity
//FROM store, items, inventory 
//ORDER BY store.branch_name";

 // $q = "SELECT distinct
    // CONCAT(' ', I.brand_id, ' - ', I.description) AS item,
    // CONCAT(' ', S.branch_name) AS store, INV.quantity
	
		// FROM items AS I, store AS S, inventory as INV
		// WHERE S.branch_name = '$bn' AND I.UPC = INV.UPC AND S.store_id = INV.store_id
		// ORDER BY I.description";

		$q = "SELECT *, CONCAT(' ', I.brand_id, ' - ', I.description) AS item, CONCAT(' ', S.branch_name) AS store 
		FROM restock as R, store AS S, items as I 
		WHERE S.store_id = R.store_id AND R.UPC = I.UPC AND fulfilled = 0
		ORDER by store"; 


 // Create the table head:
 echo '<br/><table class="table table-bordered" border="0" width="90%" cellspacing="3" cellpadding="3" align="center">
 <tr>
 <td align="left" width="20%"><b>Store</b></td>
 <td align="left" width="20%"><b>Item</b></td>
 
 <td align="right" width="20%"><b>UPC</b></td>
  <td align="right" width="20%"><b>Quantity Requested</b></td>
  
 </tr>';

 // Display all the products:
 $r = mysqli_query ($dbc, $q);
 while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)) {

 // Display each record:
 echo "\t<tr>
 <td align=\"left\">{$row['store']}</td>
  <td align=\"left\">{$row['item']}</td>
 <td align=\"left\">{$row['UPC']}</td>
 <td align=\"right\">{$row['quantity']}</td>
   <td align=\"center\"><a href='fulfill.php?UPC=". $row['UPC'] ."&store=". $row['store_id'] ."&qty=". $row['quantity'] ."' title='Update Record' data-toggle='tooltip'>fulfill</a></td>

 </tr>\n";

 } // End of while loop.

 echo '</table>';


 ?>

 
 </body>
 </html>