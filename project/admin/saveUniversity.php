<?php


$link = mysqli_connect("localhost", "thr11_ruser", "3M]^2-vRTgGq", "thr11_rating");
 

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 


$uni_name = mysqli_real_escape_string($link, $_REQUEST['uni_name']);
$uni_address = mysqli_real_escape_string($link, $_REQUEST['uni_address']);
$uni_phone = mysqli_real_escape_string($link, $_REQUEST['uni_phone']);
 
$sql =   "INSERT INTO university (uni_name, uni_address, uni_phone) VALUES ('$uni_name', '$uni_address', '$uni_phone')";
if(mysqli_query($link, $sql)){
      // Redirect to login page
                header("location: showUniList.php");
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

mysqli_close($link);
?>

</body>
</html>
