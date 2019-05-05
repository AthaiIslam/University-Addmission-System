<?php
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["user_type"]) || $_SESSION["user_type"] !== 'ST'){
    header("location: login.php");
    exit;
}


$std_id = $_SESSION["id"];
  include 'st_header.php';

$sql= "update `student` set `student_address`='".$_POST['student_address']."', `hsc_grade`='".$_POST['hsc_grade']."', `student_type`='".$_POST['student_type']."', `degree`='".$_POST['degree']."', `uni_id`='".$_POST['uni_id']."', `hsc_group`='".$_POST['hsc_group']."', `department_name`='".$_POST['department_name']."'where id=".$_SESSION['id'];	
	



if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>

