<?php

/* database connection information */
$server = "localhost"; 
$user = "root"; 
$password = "";
$database = "12";

/* create a new mysqli object */
$db = new mysqli($server, $user, $password, $database);

/* check if connection was successful */
if ($db->connect_errno) {
    die("Error: Connection failed. Please try again later.");
}

?>
