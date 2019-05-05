<?php
include 'searchHeader.php';
if(isset($_POST['search'])){
	$q = $_POST['q'];
	
		$sql = "SELECT  r.*, u.*, AVG(rate)FROM rating AS r RIGHT JOIN university AS u ON u.uni_id = r.uni_id WHERE `rate` LIKE '%$q%' GROUP BY u.uni_name ORDER BY u.uni_name DESC" ;


	if($result = mysqli_query($link, $sql)){
    	if(mysqli_num_rows($result) > 0){


?>

<div class="container">
    
    <br>
    <br>
    <h3>Search result by rating</h3>
    <div class="row">


<?php



while($row = mysqli_fetch_array($result)){


$over_all_rating = $row['AVG(rate)'] ;

 ?>



    <div class="col-md-3">

<div class="card border-secondary mb-3" style="max-width: 18rem;">
  <div class="card-header bg-transparent border-success"><?php echo $row['uni_name'];?></div>
  <div class="card-body text-secondary" style="min-height: 11rem;">
    <h5 class="card-title">Success card title</h5>
    <p class="card-text"> Located in: <?php echo $row['uni_address'];?>, Contact Number: <?php echo $row['uni_phone'];?> </p>
  </div>
  <div class="card-footer bg-transparent border-success"><h6>Ovarall Rating: 

 <span class="badge badge-secondary"><?php echo $over_all_rating;?></span>
<!-- <?php
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
?> -->
 </h6> </div>


  

  <div class="card-footer bg-transparent border-success"><?php  echo '<a class="btn btn-info btn-sm" href="viewunidetails.php?id='.$row['uni_id'].'">'."<i class='fas fa-eye'> </i> &nbsp; View".'</a>';?> || <?php  echo '<a class="btn btn-info btn-sm" href="applynow.php?id='.$row['uni_id'].'">'."<i class='fas fa-eye'> </i> &nbsp; Apply Now".'</a>';?> </div>
</div>
</div>

<?php }
                  ?>
     

       
     
   <?php   
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
}

?>


</div>
</div>

</body>
</html>
 <!-- search
	$count = mysqli_num_rows($query);
	if($count == "0"){
		$output = '<h2>No result found!</h2>';
	}else{
		while($row = mysqli_fetch_array($query)){
		$s = $row['uni_name']; // Replace column_to_display with the column you want the results from
				// $output .= '<h2>'.$s.'</h2><br>';
		echo $s;
			}
		}
	}
?> -->