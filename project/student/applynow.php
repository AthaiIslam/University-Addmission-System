<?php 

session_start();
 

if(isset($_GET["id"]));
  $uni_id = $_GET["id"];
 
if(!isset($_SESSION["user_type"]) || $_SESSION["user_type"] !== 'ST'){
    header("location: login.php");
    exit;
}


$std_id = $_SESSION["id"];
include 'st_header.php';


?>


<div class="container">
    
    <div class="row">

<!-- header -->

<div class="col-md-2"></div>

<div class="col-md-8">


    <form action="save_student.php" method="post">
    
  <div class="form-group">

    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="student_address" placeholder="Student Address" required="required" >
   
  </div>

      <div class="form-group">
  
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="hsc_grade" placeholder="HSC GPA ( 4, 4.5 , 5)" required="required" >
   
  </div>
<!-- form row 2 end -->

  <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="degree" id="inlineRadio1" value="Undergraduate" required="required" >
  <label class="form-check-label" for="inlineRadio1">Undergraduate</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="degree" id="inlineRadio2" value="Graduate">
  <label class="form-check-label" for="inlineRadio2">Graduate</label>
</div>





<!-- department -->

 <?php

 // Attempt select query execution
$sqld = "SELECT * FROM department  ORDER BY department_name ASC" ;

if($resultd = mysqli_query($link, $sqld)){
    if(mysqli_num_rows($resultd) > 0){

?>

  <div class="form-group">

    <select class="form-control" name="department_name"  id="exampleFormControlSelect1" required="required" >

<option> Select Department </option>

               <?php
              while($row = mysqli_fetch_array($resultd)){

          ?>

<!-- <p> <?php echo $row['uni_id'] ;?> || <?php echo $row['uni_name'] ;?> </p> -->
  <option value="<?php echo $row['department_name'] ;?>"> <?php echo $row['department_name'] ;?> </option>

<?php }
  ?>

        </select>
      </div>


<!-- department  -->


     <div class="form-group">
    <label for="exampleFormControlSelect1">Select HSC Group</label>
    <select class="form-control" id="exampleFormControlSelect1" name="hsc_group">
      <option>Select HSC Group</option>
      <option value="Arts" >Arts</option>
      <option value="Commerce">Commerce</option>
      <option value="Science">Science</option>
     
    </select>
  </div>


<input type="hidden" value="<?php echo $uni_id;?>" name="uni_id">
<input type="hidden" value="Graduate" name="student_type">
<input type="hidden" value="5" name="rate">

    <input type="submit" value="Submit">
</form>

      
     
     </div>
</div>

</div>
<?php
        mysqli_free_result($resultd);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sqld. " . mysqli_error($link);
}

// select department

    mysqli_close($link);
    ?>  
</body>
</html>