<?php 
 
 // This file contains the database access information.
 // This file also establishes a connection to MySQL
 // and selects the database.

 // Set the database access information as constants:
 DEFINE ('DB_USER', 'user');
 DEFINE ('DB_PASSWORD', 'password');
 DEFINE ('DB_HOST', 'cs3413proj.cowuyyafmbq3.ca-central-1.rds.amazonaws.com');
 DEFINE ('DB_NAME', 'cs3413proj');

 // Make the connection:
 $dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

 // If no connection could be made, trigger an error:
 if (!$dbc) {
 trigger_error ('Could not connect to MySQL: ' . mysqli_connect_error( ) );
 } else { // Otherwise, set the encoding:
 mysqli_set_charset($dbc, 'utf8');
 }