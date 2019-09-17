<!DOCTYPE html>
 <html>
 <head>
 <meta http-equiv="content-type"
content="text/html; charset=utf-8" />
 <title>Update Brand Record</title>
 </head>
 <body>
<?php 

$brand_name = $vendor = "";
 // Set the page title and include the HTML header:
 $page_title = 'Update Brand Record';
 //include ('includes/header.html');

 require ('../../mysqli_connect.php');

 if ($_SERVER['REQUEST_METHOD'] == 'POST')
{ // Handle the form.

 // Validate the incoming data...
 $errors = array( );

 
 } // End of SUBMITTED IF.


 // Check for a brand name:
 if (!empty($_POST['brand_name'])) {
 $n = trim($_POST['brand_name']);
} else {
 $errors[ ] = 'Please enter the brand\'s name';
 }
 
  // Check for a vendor:
 if (!empty($_POST['vendor'])) {
 $v = trim($_POST['vendor']);
} else {
 $errors[ ] = 'Please enter the vendor name';
 }
 

     if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){

        // Get URL parameter
        $id_brand =  trim($_GET["id"]);    
        // Prepare a select statement
        $sql = "SELECT * FROM brand WHERE id_brand = ?";
        if($stmt = mysqli_prepare($dbc, $sql)){

            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);         
            // Set parameters
            $param_id = $id_brand;          
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);              
                    // Retrieve individual field value
                    $brand_name = $row["brand_name"];
                    $vendor = $row["vendor"];
                    
                } else{

                    // URL doesn't contain valid id. 
                     $errors[ ] = 'URL doesnt contain valid id';
                }
			}
		}
	 }

	 
	 if (empty($errors)) { 
	$brand_name = $n;
	
	$vendor = $v;

	$q = "UPDATE brand SET brand_name=?, vendor=? WHERE id_brand=?";           
 


	 $stmt = mysqli_prepare($dbc, $q);
	 mysqli_stmt_bind_param($stmt, 'sss', $n, $v, $id_brand);
	if(mysqli_stmt_execute($stmt))
	echo "success!";

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
                       

					   <div class="form-group">
                            <label>Brand Name</label>
                            <input type="text" name="brand_name" class="form-control" value="<?php echo $brand_name; ?>">
                        </div>
						
                      
                        <div class="form-group">
                            <label>vendor</label>
                          <select name="vendor"><option value="0">Select One</option>
							 <?php // Retrieve all the depts and add to the pull-down menu.
							 $q = "SELECT vendor_name, CONCAT_WS(' ', vendor_name) 
								FROM vendor ORDER BY vendor_name ASC";
							 $r = mysqli_query ($dbc, $q);
							 if (mysqli_num_rows($r) > 0) {
								 while ($row = mysqli_fetch_array ($r, MYSQLI_NUM)) {
									echo "<option value=\"$row[0]\"";
									
									if ($vendor == $row['0'])
										echo "selected = 'selected'";
									
									//if (isset($_POST['existing']) && ($_POST['existing'] == $row[0]) ) ';
								 echo ">$row[1]</option>\n";
								 }
							 } else {
							 echo '<option>Please add a new dept first.</option>';
						}
						 ?>
						</select>
                        </div>
                        <input type="hidden" name="id_brand" value="<?php echo $id_brand; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="viewBrands.php" class="btn btn-default">Back</a>

                    </form>

                </div>
      

        </div>

    </div>
 </body>
 </html>