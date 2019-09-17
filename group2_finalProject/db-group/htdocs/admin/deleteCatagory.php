<!DOCTYPE html>
 <html>
 <head>
 <meta http-equiv="content-type"
content="text/html; charset=utf-8" />
 <title>Delete record</title>
 </head>
 <body>
<?php
 // Set the page title and include the HTML header:
 $page_title = 'Delete Record';
 //include ('includes/header.html');

 
 if(isset($_POST["id"]) && !empty($_POST["id"])){
	 
 require ('../../../mysqli_connect.php');

 
 $id = trim($_POST["id"]);



$q = "DELETE FROM vendor WHERE vendor_id = ?";           
 


 if($stmt = mysqli_prepare($dbc, $q)){
	  mysqli_stmt_bind_param($stmt, 's', $id);
	 $param_id = trim($_POST["id"]);
 }

        if(mysqli_stmt_execute($stmt)){
            // Records deleted successfully. Redirect to landing page
            header("location: viewVendors.php");
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
 mysqli_close($dbc);
 }
 
 
 //include ('includes/footer.html');
 ?>
 
 <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Delete Record</h1>
                    </div>	
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  method="post">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Are you sure you want to delete this record?</p><br>
                            <p>
                                <input type="submit" value="Yes">
                                <a href="viewVendors.php">No</a>

                            </p>

                       

                    </form>

                </div>

            </div>        

        </div>

    </div>
 



 </body>
 </html>