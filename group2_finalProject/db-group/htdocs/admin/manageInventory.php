
<?php 
 require ('../../mysqli_connect.php');
 include $_SERVER['DOCUMENT_ROOT'] . '/db-group/htdocs/includes/header.html';
 include ('includes/header.html');

$bn = "";
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

 $q = "SELECT distinct
    CONCAT(' ', I.brand_id, ' - ', I.description) AS item,
    CONCAT(' ', S.branch_name) AS branch_name, INV.quantity
	
		FROM items AS I, store AS S, inventory as INV
		WHERE S.branch_name = '$bn' AND I.UPC = INV.UPC AND S.store_id = INV.store_id
		ORDER BY I.description";



 // Create the table head:
 echo '<br/><table class="table table-bordered" border="0" width="90%" cellspacing="3" cellpadding="3" align="center">
 <tr>
 <td align="left" width="20%"><b>Store</b></td>
 <td align="left" width="20%"><b>Item</b></td>
 
 <td align="right" width="10%"><b>Quantity</b></td>
  
 </tr>';

 // Display all the products:
 $r = mysqli_query ($dbc, $q);
 while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)) {

 // Display each record:
 echo "\t<tr>
 <td align=\"left\">{$row['branch_name']}</td>
 <td align=\"left\">{$row['item']}</td>
 <td align=\"right\">{$row['quantity']}</td>

 </tr>\n";

 } // End of while loop.

 echo '</table>';


 ?>

 
<form enctype="multipart/form-data" action="manageInventory.php" method="POST">

 <p><b>Store:</b>
 <select name="store"><option>Select One</option>
 <?php // Retrieve all the branches and add to the pull-down menu.
 $q = "SELECT branch_name, CONCAT_WS(' ', branch_name) 
		FROM store ORDER BY branch_name ASC";
 $r = mysqli_query ($dbc, $q);
 if (mysqli_num_rows($r) > 0) {
 while ($row = mysqli_fetch_array ($r, MYSQLI_NUM)) {
 echo "<option value=\"$row[0]\"";
 // Check for stickyness:
 if (isset($_POST['existing']) && ($_POST['existing'] == $row[0]) ) echo ' selected="selected"';
 echo ">$row[1]</option>\n";
 }
 } else {
 echo '<option>Please add a new catagory first.</option>';
 }
// Close the database connection. 
	mysqli_close($dbc); 
 ?>
 </select></p>
 </fieldset>

 <div align="center"><input class="btn btn-primary" type="submit" name="submit" value="Submit" /></div>

 </form>
 
 </body>
 </html>