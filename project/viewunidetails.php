<?php



if(isset($_GET["id"]));
    
    include 'header.php';

  $uni_id = $_GET["id"];  
    
    
   $sql = "SELECT * FROM university WHERE uni_id=$uni_id";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){


         while($row = mysqli_fetch_array($result)){
          $uni_id = $_GET["id"];    
?>


        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>View Details</h1>
                    </div>
                    <div class="form-group">
                        <label>University Name : <b><?php echo $row["uni_name"]; ?></b></label>
                       
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <p class="form-control-static"><?php echo $row["uni_address"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Contact</label>
                        <p class="form-control-static"><?php echo $row["uni_phone"]; ?></p>
                    </div>

                     <a href="applynow.php?id=<?php echo $row['uni_id']; ?>" class="btn btn-success">Apply Now</a>

                 

                    <a href="index.php" class="btn btn-secondary">Back to Dashboard</a>

                </div>
            </div>        
        </div>


<?php
             }
     
        
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 

mysqli_close($link);
?>

    

<!-- footer -->
<?php include "footer.php" ;?>

<!-- footer -->
