<?php
include 'st_header.php';



$student_id = mysqli_real_escape_string($link, $_REQUEST['student_id']);
$rate = mysqli_real_escape_string($link, $_REQUEST['rate']);
$uni_id = mysqli_real_escape_string($link, $_REQUEST['uni_id']);

 



$sqlr = "INSERT INTO rating (student_id, rate, uni_id) VALUES ('$student_id', '$rate', '$uni_id')";
if(mysqli_query($link, $sqlr)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sqlr. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>

</body>
</html>