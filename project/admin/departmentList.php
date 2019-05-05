<?php 

session_start();
 
if(!isset($_SESSION["user_type"]) || $_SESSION["user_type"] !== 'AD'){
    header("location: login.php");
    exit;
}
include 'admin_header.php';



$sql = "SELECT * FROM department";


if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){

?>


<div class="container">
    
    <div class="row">
   

      <div class="col-md-10">

        <h3>Department  list</h3>

<table class="table table-bordered">
  <thead>
    <th scope="col">SL No</th>
    <th scope="col">Department Name</th>
    <th scope="col"> Department Description</th>


  </thead>

  <tbody>

               <?php
                $count=0;
              while($row = mysqli_fetch_array($result)){
          // echo var_dump($row);
          ?>


    
      <tr>
        <td><?php echo ++$count;?></td>
      
        <td><?php echo $row['department_name'];?></td>
        <td><?php echo $row['description'];?></td>
    
      </tr>



<?php 




}
          

         ?>
     
  </tbody>
</table>

       
     
   <?php   
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>

        </div>
</div>

</div>

</body>
</html>