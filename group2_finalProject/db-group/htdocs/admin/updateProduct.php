<!DOCTYPE html>
 <html>
 <head>
 <meta http-equiv="content-type"
content="text/html; charset=utf-8" />
 <title>Update Record</title>
 </head>
 <body>
<?php 

 // Set the page title and include the HTML header:
 $page_title = 'Update record';
 //include ('includes/header.html');

 require ('../../mysqli_connect.php');

 if ($_SERVER['REQUEST_METHOD'] == 'POST')
{ // Handle the form.

 // Validate the incoming data...
 $errors = array( );

 
 } // End of SUBMITTED IF.

	 // Check for a product name:
	 if (!empty($_POST['item_name'])) {
		$item_name = trim($_POST['item_name']);
	 } else {
		$errors[ ] = 'Please enter the products name/description';
	 }

	 // Validate the brand...
	 if ( isset($_POST['brand']) && filter_var($_POST['brand'], FILTER_SANITIZE_STRING, array('min_range' => 1)) ) {
		$brand = $_POST['brand'];
	 } else { // No dept selected.
		$errors[ ] = 'Please select the brand';
	 }
	 
	 	 // Check for a vendor_cost:
	 if (!empty($_POST['vendor_cost'])) {
		$vendor_cost= trim($_POST['vendor_cost']);
	 } else {
		$errors[ ] = 'Please enter the the vendor\'s price!';
	 }

	 
	 // Check for a price:
	 if (!empty($_POST['price'])) {
		$price= trim($_POST['price']);
	 } else {
		$errors[ ] = 'Please enter the the vendor\'s price!';
	 }

	 // Check for a product type:
	 if (!empty($_POST['type'])) {
		$type = trim($_POST['type']);
	 } else {
		$errors[ ] = 'Please enter the products type';
	 }
	
	 // Validate taxable...
	 if ( isset($_POST['taxable']) && filter_var($_POST['taxable'], FILTER_VALIDATE_INT, array('taxable' => 1)) ) {
		$taxable = $_POST['taxable'];
	 } else { // nothing selected.
		$errors[ ] = 'Please indicate taxable';
	 }
	 
	 // Check for a size:
	 if (!empty($_POST['size'])) {
		$size = trim($_POST['size']);
	 } else {
		$errors[ ] = 'Please enter the product\'s size';
	 }

	
 
     if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){

        // Get URL parameter
        $id =  trim($_GET["id"]);    
        // Prepare a select statement
        $sql = "SELECT * FROM items WHERE UPC = ?";
        if($stmt = mysqli_prepare($dbc, $sql)){

            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);         
            // Set parameters
            $param_id = $id;          
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);              
                    // Retrieve individual field value
                    
					 $item_name =  $row["description"];
					 $brand =  $row["brand_id"];
					 $vendor_cost =  $row["vendor_cost"];
					 $price =  $row["price"];
					 $type = $row["type"];
					 $taxable =  $row["taxable"];
					 $size = $row["size"];
					 
                } else{

                    // URL doesn't contain valid id. 
                     $errors[ ] = 'URL doesnt contain valid id';
                }
			}
		}
	 }

	 
	 if (empty($errors)) { 
	
	$q = "UPDATE items SET description=?, brand_id=?, vendor_cost=?, price=?, type=?, taxable=?, size=? WHERE UPC=?";           


	 $stmt = mysqli_prepare($dbc, $q);
	  mysqli_stmt_bind_param($stmt, 'ssssssss', $item_name, $brand, $vendor_cost, $price, $type, $taxable, $size, $id);
	if(mysqli_stmt_execute($stmt))
	echo "success!";
 // Clear $_POST:
			 $_POST = array( );
	 }
	 
	  if ( !empty($errors) && is_array($errors) ) {
		 echo '<h1>Error!</h1>
		 <p style="font-weight: bold; color: #C00">The following error(s) occurred:<br />';
		 foreach ($errors as $msg) {
		 echo " - $msg<br />\n";
		}
	}
 ?>
 

 
     <div class="wrapper">
        <div class="container-fluid">
            <div class="row">            
                    <div class="page-header">
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        
						
											
					 <p><b>Product Name:</b> <input type="text" name="item_name" size="30" maxlength="60" value="<?php echo $item_name; ?>"/></p>

					 <p><b>Brand:</b>
					 <select name="brand"><option>Select One</option>
					 <?php // Retrieve all the depts and add to the pull-down menu.
					 $q = "SELECT brand_name, CONCAT_WS(' ', brand_name) 
							FROM brand ORDER BY brand_name ASC";
					$r = mysqli_query ($dbc, $q);
					  if (mysqli_num_rows($r) > 0) {
						while ($row = mysqli_fetch_array ($r, MYSQLI_NUM)) {
							echo "<option value=\"$row[0]\"";					
							if ($brand == $row['0'])
								echo "selected = 'selected'";
														
								//if (isset($_POST['existing']) && ($_POST['existing'] == $row[0]) ) ';
								 echo ">$row[1]</option>\n";
							}
						} else {
					 echo '<option>Please add a new brand first.</option>';
					 }

					 ?>
					 </select></p>
					 
					 
					 <p><b>Vendor cost:</b> <input type="text" name="vendor_cost" value="<?php echo $vendor_cost; ?>"/></p>
					 <p><b>Selling Price:</b> <input type="text" name="price" value="<?php echo $price; ?>"/></p>
					 

					 <p><b>Category:</b>
					 <select name="type"><option>Select One</option>
					 <?php 
					 $q = "SELECT category_name, CONCAT_WS(' ', category_name) 
							FROM category ORDER BY category_name ASC";
					 $r = mysqli_query ($dbc, $q);
					  if (mysqli_num_rows($r) > 0) {
						while ($row = mysqli_fetch_array ($r, MYSQLI_NUM)) {
							echo "<option value=\"$row[0]\"";					
							if ($type == $row['0'])
								echo "selected = 'selected'";
														
								//if (isset($_POST['existing']) && ($_POST['existing'] == $row[0]) ) ';
								 echo ">$row[1]</option>\n";
							}
						} else {
					 echo '<option>Please add a new category first.</option>';
					 }
					// Close the database connection. 
						mysqli_close($dbc); 
					 ?>
					 </select></p>
					 
					<p><b>Taxable?:</b></p>
					 
					  <input type="radio" name="taxable" value="1" checked> yes
					  <input type="radio" name="taxable" value="0"> no<br>
						

					 <p><b>Size:</b> <input type="text" name="size" size="30" maxlength="60" value="<?php echo $size; ?>"/></p>

					 
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="viewProducts.php" class="btn btn-default">Back</a>

                    </form>

                </div>
      

        </div>

    </div>
 </body>
 </html>