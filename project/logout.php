<?php
// Initialize the session
session_start();
 

$_SESSION = array();
 
// End the session.
session_destroy();
 
// Redirect to login page
header("location: index.php");
exit;
?>