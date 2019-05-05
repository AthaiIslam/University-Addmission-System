<?php 

session_start();
 

if(!isset($_SESSION["user_type"]) || $_SESSION["user_type"] !== 'AD'){
    header("location: login.php");
    exit;
}
include 'admin_header.php';




$sql = "SELECT * FROM university RIGHT JOIN student ON student.uni_id = university.uni_id";



if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){

?>


<div class="container">

    <form method="POST" action="../search/search-by-department.php">
      <input type="text" name="q" placeholder="Search by Department">
      <input type="submit" class="btn btn-primary btn-sm" name="search" value="Search">
    </form>
    <form method="POST" action="../search/search-by-gpa.php">
      <input type="text" name="q" placeholder="Search by HSC GPA">
      <input type="submit" class="btn btn-info btn-sm" name="search" value="Search">
    </form>

    <div class="row">
   

      <div class="col-md-10">

        <h3>Student list</h3>

<table class="table table-bordered">
  <thead>
    <th scope="col">SL No</th>
    <th scope="col">Student Name</th>
    <th scope="col"> University Name</th>
    <th scope="col"> Department</th>
    <th scope="col"> Degree</th>
    <th scope="col"> Course</th>
    <th scope="col"> Email</th>
    <th scope="col"> Contact</th>
    <th scope="col"> HSC GPA</th>

  </thead>

  <tbody>

               <?php
                $count=0;
              while($row = mysqli_fetch_array($result)){
          // echo var_dump($row);
          ?>


    
      <tr>
        <td><?php echo ++$count;?></td>
        <td><?php echo $row['student_name'];?></td>
         <td><?php echo $row['uni_name'];?></td>
        <td><?php echo $row['department_name'];?></td>
        <td><?php echo $row['degree'];?></td>
        <td><?php echo $row['course'];?></td>
         <td><?php echo $row['email'];?></td>
         <td><?php echo $row['student_contact'];?></td>
          <td><?php echo $row['hsc_grade'];?></td>
      </tr>


   <!--  <div class="col-sm-3">

<div class="card border-success mb-3" style="max-width: 18rem;">
  <div class="card-header bg-transparent border-success"><?php echo $row['uni_name'];?></div>
  <div class="card-body text-success" style="min-height: 11rem;">
    <h5 class="card-title">Success card title</h5>
    <p class="card-text"> Located in: <?php echo $row['uni_address'];?>, Contact Number: <?php echo $row['uni_phone'];?> </p>
  </div>
  <div class="card-footer bg-transparent border-success"><h5>Ovarall Rating:  <span class="badge badge-secondary"><?php echo $over_all_rating;?></span></h5> </div>


  <a href="admin_viewuni.php?id=<?php echo $row['uni_id']; ?>" class="btn btn-primary">Det</a>

  <div class="card-footer bg-transparent border-success"><?php  echo '<a class="btn btn-info btn-sm" href="admin_viewuni.php?id='.$row['uni_id'].'">'."<i class='fas fa-eye'> </i> &nbsp; View Details".'</a>';?> | <?php   echo '<a href="enrollstudent.php?id='.$row['uni_id'].'">'."Link".'</a>';?> </div>
</div>
</div> -->

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
