<?php
session_start();
 

if(!isset($_SESSION["user_type"]) || $_SESSION["user_type"] !== 'AD'){
    header("location: login.php");
    exit;
}



  include 'admin_header.php';

$department_name = mysqli_real_escape_string($link, $_REQUEST['department_name']);
$description = mysqli_real_escape_string($link, $_REQUEST['description']);

 

$sql = "INSERT INTO department (department_name, description) VALUES ('$department_name', '$description')";
if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
mysqli_close($link);
?>

