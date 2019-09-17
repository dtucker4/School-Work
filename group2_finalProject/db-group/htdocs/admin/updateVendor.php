<!DOCTYPE html>
 <html>
 <head>
 <meta http-equiv="content-type"
content="text/html; charset=utf-8" />
 <title>Update Record</title>
 </head>
 <body>
<?php 

$brand_name = $vendor = "";
 // Set the page title and include the HTML header:
 $page_title = 'Update Vendor Record';
 //include ('includes/header.html');

 require ('../../mysqli_connect.php');

 if ($_SERVER['REQUEST_METHOD'] == 'POST')
{ // Handle the form.

 // Validate the incoming data...
 $errors = array( );

 
 } // End of SUBMITTED IF.


 // Check for a vendor name:
 if (!empty($_POST['vendor_name'])) {
 $n = trim($_POST['vendor_name']);
} else {
 $errors[ ] = 'Please enter the vendor name';
 } 

     if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){

        // Get URL parameter
        $id =  trim($_GET["id"]);    
        // Prepare a select statement
        $sql = "SELECT * FROM vendor WHERE vendor_id = ?";
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
                    $vendor_name = $row["vendor_name"];              
                } else{

                    // URL doesn't contain valid id. 
                     $errors[ ] = 'URL doesnt contain valid id';
                }
			}
		}
	 }

	 
	 if (empty($errors)) { 
	$catagory_name = $n;
	
	$q = "UPDATE vendor SET vendor_name=? WHERE vendor_id=?";           
 


	 $stmt = mysqli_prepare($dbc, $q);
	 mysqli_stmt_bind_param($stmt, 'ss', $n, $id);
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
                            <label>Vendor Name</label>
                            <input type="text" name="vendor_name" class="form-control" value="<?php echo $vendor_name; ?>">
                        </div>
				
                        <input type="hidden" name="catagory_id" value="<?php echo $catagory_id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="viewVendors.php" class="btn btn-default">Back</a>

                    </form>

                </div>
      

        </div>

    </div>
 </body>
 </html>