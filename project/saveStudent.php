<?php

include 'header.php';



$student_name = mysqli_real_escape_string($link, $_REQUEST['student_name']);
$student_email = mysqli_real_escape_string($link, $_REQUEST['student_email']);
$uni_id = mysqli_real_escape_string($link, $_REQUEST['uni_id']);
 

$sql = "INSERT INTO student (student_name, student_email, uni_id) VALUES ('$student_name', '$student_email', '$uni_id')";


if(mysqli_query($link, $sql )){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 

mysqli_close($link);

?>




<?php include "footer.php" ;?>


