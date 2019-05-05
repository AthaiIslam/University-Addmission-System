<?php
// Initialize the session
session_start();

if(!isset($_SESSION["user_type"]) || $_SESSION["user_type"] !== 'ST'){
    header("location: login.php");
    exit;

         
}

$std_id = $_SESSION["id"];
include 'st_header.php';




$sql = "SELECT  r.*, u.*, AVG(rate) FROM rating AS r RIGHT JOIN university AS u ON u.uni_id = r.uni_id GROUP BY u.uni_name ORDER BY AVG(rate) DESC" ;

if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){

?>


<div class="container">
    
    <div class="row">


                 <?php
              while($row = mysqli_fetch_array($result)){

$unis_id = $row['uni_id'];

$over_all_rating = $row['AVG(rate)'];


            ?>

    <div class="col-sm-3">

<div class="card border-secondary mb-3" style="max-width: 18rem;">
  <div class="card-header bg-transparent border-success"><?php echo $row['uni_name'];?></div>
  <div class="card-body text-secondary" style="min-height: 11rem;">
    <h5 class="card-title">Success card title</h5>
    <p class="card-text"> Located in: <?php echo $row['uni_address'];?>, Contact Number: <?php echo $row['uni_phone'];?> </p>
  </div>
  <div class="card-footer bg-transparent border-success"><h6>Ovarall Rating: 


<style>
  .fa-star , .fa-star-half-alt{
    color: #FFA500;
  }
</style>

   <!-- <span class="badge badge-secondary"><?php echo $over_all_rating;?></span> -->
<?php
   for($i=1;$i<=5;$i++){
  if($over_all_rating>=1)
  {
    echo "<i class='fas fa-star'></i> ";
    $over_all_rating--;
  }else{

        if($over_all_rating>=0.5)
  {
    echo "<i class='fas fa-star-half-alt'></i> ";
    $over_all_rating-=0.5;
      }
      else{
        echo "<i class='far fa-star'></i> ";
      }
  }
}
?>
  </h6> </div>


<!-- call logged in student from session -->


<?php 
$sqlst = "SELECT  * FROM student WHERE id=$std_id" ;

if($resultst = mysqli_query($link, $sqlst)){
    if(mysqli_num_rows($resultst) > 0){

?>


<div class="container">
    
    <div class="row">


                 <?php
              while($row = mysqli_fetch_array($resultst)){



            ?>

<?php $admit = $row['student_type'];?>
<div class="card-footer bg-transparent border-success"><h6>

<?php 
if($admit==="Graduate"){

  ?>
  <a href="#">Graduate</a>


  <?php
}else{
  ?>
    <div class="card-footer bg-transparent border-success"> <?php  echo '<a class="btn btn-info btn-sm" href="applynow.php?id='.$unis_id.'">'."<i class='fas fa-eye'> </i> &nbsp; Apply Now".'</a>';?> </div>
  <?php
}
?>

   </h6> </div>

   </div>  
     
   <?php 
   }  
        // Free result set
        mysqli_free_result($resultst);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 ?>  

<!-- call logged in student from session end-->
</div>
</div>
</div>

<?php }
                  ?>
     

       
     
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

</body>
</html>
