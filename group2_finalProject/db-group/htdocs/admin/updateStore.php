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
 $page_title = 'Update Record';
 //include ('includes/header.html');

 require ('../../mysqli_connect.php');

 if ($_SERVER['REQUEST_METHOD'] == 'POST')
{ // Handle the form.

 // Validate the incoming data...
 $errors = array( );

 
 } // End of SUBMITTED IF.

	 // Check for a Store name:
	 if (!empty($_POST['branch_name'])) {
		$bn = trim($_POST['branch_name']);
	 } else {
		$errors[ ] = 'Please enter the branch name';
	 }

	 	 // Check for a address:
	 if (!empty($_POST['address'])) {
		$a = trim($_POST['address']);
	 } else {
		$errors[ ] = 'Please enter the address';
	 }
	 
	 	 // Check for a hours:
	 if (!empty($_POST['hours'])) {
		$h = trim($_POST['hours']);
	 } else {
		$errors[ ] = 'Please enter the hours';
	 }
	
     if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){

        // Get URL parameter
        $id_brand =  trim($_GET["id"]);    
        // Prepare a select statement
        $sql = "SELECT * FROM store WHERE store_id = ?";
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
                    $branch_name = $row["branch_name"];
                    $address = $row["address"];
                    $hours = $row["hours"];
                } else{

                    // URL doesn't contain valid id. 
                     $errors[ ] = 'URL doesnt contain valid id';
                }
			}
		}
	 }

	 
	 if (empty($errors)) { 
	$branch_name = $bn;
	$address = $a;
	$hours = $h;

	$q = "UPDATE store SET branch_name=?, address=?, hours=? WHERE store_id=?";           
 


	 $stmt = mysqli_prepare($dbc, $q);
	 mysqli_stmt_bind_param($stmt, 'ssss', $bn, $a, $h, $store_id);
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
                       

                    
		 <p><b>Branch Name:</b> <input type="text" name="branch_name" size="30" maxlength="128" value="<?php echo $branch_name; ?>"/></p>
		 <p><b>Address:</b> <input type="text" name="address" size="30" maxlength="128" value="<?php echo $address; ?>"/></p>
		 <p><b>Hours:</b> <input type="text" name="hours" size="30" maxlength="60" value="<?php echo $hours; ?>"/></p>

                        <input type="hidden" name="store_id" value="<?php echo $store_id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="viewStores.php" class="btn btn-default">Back</a>

                    </form>

                </div>
      

        </div>

    </div>
 </body>
 </html>