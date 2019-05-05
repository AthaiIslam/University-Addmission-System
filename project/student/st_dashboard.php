<?php

session_start();

if(!isset($_SESSION["user_type"]) || $_SESSION["user_type"] !== 'ST'){
    header("location: login.php");
    exit;

         
}

$std_id = $_SESSION["id"];
  include 'st_header.php';



$sql = "SELECT * FROM university INNER JOIN student ON student.uni_id = university.uni_id WHERE id=$std_id";

if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){


         while($row = mysqli_fetch_array($result)){


$uni_name = $row['uni_name'];
?>


<div class="container">
  <div class="row">
    
    <div class="col-md-2"></div>

    <div class="col-md-8">

    <div class="page-header">
        <h1>Hi, <b><?php echo $row['student_name']; ?></b>. Welcome to our site.</h1>

        
    </div>


        
 
<div class="list-group">
  <a href="#" class="list-group-item list-group-item-action active">
    Admitted Institute: <?php echo $uni_name; ?>
  </a>
 
  <a href="#" class="list-group-item list-group-item-action"> Email: <?php echo $row['email']; ?></a>
  <a href="#" class="list-group-item list-group-item-action">Degree: <?php echo $row['degree']; ?></a>
    <a href="#" class="list-group-item list-group-item-action"> Course Taken: <?php echo $row['course']; ?></a>
  <a href="#" class="list-group-item list-group-item-action">Contact: <?php echo $row['student_contact']; ?></a>
  <a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true">Department: <?php echo $row['department_name']; ?></a>
</div>


<br>
<br>

<h3> Your university Rating</h3>


<?php
 $sqlr = "SELECT * FROM rating  WHERE student_id=$std_id";
if($resultr = mysqli_query($link, $sqlr)){
    if(mysqli_num_rows($resultr) > 0){


         while($row = mysqli_fetch_array($resultr)){

      ?>    

    
<h6>You already gave <?php echo $uni_name;?> rating  <?php echo $row['rate'];?>, you can't rate more than once.</h6>

<style>
  
  .fa-star , .fa-star-half-alt{
    color: #FFA500;
  }
</style>

<?php
$rate = $row['rate'];

// switch ($rate) {
//     case "2":
//         echo "Your favorite color is red! 2";
//         break;
//     case "4":
//         echo "Your favorite color is blue! 4";
//         break;
//     case "5":
//         echo "Your favorite color is green! 5 <i class='fas fa-star'></i> ";
//         break;
//     default:
//         echo "Your favorite color is neither red, blue, nor green!";
// }


for($i=1;$i<=5;$i++){
  if($rate>=1)
  {
    echo "<i class='fas fa-star'></i>";
    $rate--;
  }else{

        if($rate>=0.5)
  {
    echo "<i class='fas fa-star-half-alt'></i>";
    $rate-=0.5;
      }
      else{
        echo "<i class='far fa-star'></i>";
      }
  }
}

?>


  <?php
             }
     
        // Close result set
        mysqli_free_result($resultr);
    } else{
        
?>

<!-- rate your university -->

<?php $admit = $row['student_type'];?>


<h6> Rate Your University: <?php echo $uni_name;?> </h6>




<?php 
if($admit==="Graduate"){

  ?>
   <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    Button with data-target
  </button>


  <?php
}else{
  ?>
    a
  <?php
}
?>



  <div class="collapse" id="collapseExample">
  <div class="card card-body">
    

    <form action="student_rating.php" method="post">


   <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="rate" id="inlineRadio1" value="1">
  <label class="form-check-label" for="inlineRadio1">1</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="rate" id="inlineRadio2" value="2">
  <label class="form-check-label" for="inlineRadio2">2</label>
</div>


   <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="rate" id="inlineRadio1" value="3">
  <label class="form-check-label" for="inlineRadio1">3</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="rate" id="inlineRadio2" value="4">
  <label class="form-check-label" for="inlineRadio2">4</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="rate" id="inlineRadio2" value="5">
  <label class="form-check-label" for="inlineRadio2">5</label>
</div>



    

<input type="hidden" value="<?php echo $row['uni_id']; ?>" name="uni_id">
<input type="hidden"  name="student_id" value="<?php echo $row['id']; ?>" >
<!-- <input type="hidden" value="0" name="rate"> -->

<br>
<br>

    <input class="btn btn-success" type="submit" value="Submit">
     <input class="btn btn-danger" type="reset" value="Reset">
</form>


  </div>
</div>


<?php

    }
} else{
    echo "ERROR: Could not able to execute $sqlr. " . mysqli_error($link);
}
 

?>


<!-- rate your university  end-->



  <?php
             }
     
        // Close result set
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