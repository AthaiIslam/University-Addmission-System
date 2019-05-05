

<?php 
if(isset($_GET["id"]) && !empty(trim($_GET["id"])))
$uni_id = $_GET['id'];


echo ($uni_id);
include 'header.php';
 require_once "config.php";
   





       $count_rating = "SELECT COUNT(rate) FROM rating WHERE uni_id = $uni_id";




    if($resultrt = mysqli_query($link, $count_rating)){
                        if(mysqli_num_rows($resultrt) > 0){

                            while($row = mysqli_fetch_array($resultrt)){

                                $all_count=  $row['COUNT(rate)'] ;
                            }

                        } else{

                        }

                        }else{
                        echo "ERROR: Could not able to execute $count_rating. " . mysqli_error($link);
                    }


       $sum_rating = "SELECT SUM(rate) FROM rating WHERE uni_id = $uni_id";




    if($resulta = mysqli_query($link, $sum_rating)){
                        if(mysqli_num_rows($resulta) > 0){

                            while($row = mysqli_fetch_array($resulta)){

                                $all_sum=  $row['SUM(rate)']  ;

                                $overall_rat = $all_sum / $all_count ;
                            }

                        } else{

                        }

                        }else{
                        echo "ERROR: Could not able to execute $sum_rating. " . mysqli_error($link);
                    }

$sql = "SELECT * FROM student WHERE uni_id = '$uni_id '";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){

?>

        table header

        <table border="1">
        	<thead>
        		<th> Student Name </th>
        		<th> Student Address </th>
        		
        		
        	</thead>
     

           
      
            <tbody>
            	 <?php
              while($row = mysqli_fetch_array($result)){

        	?>
            	<tr>
				

            		<td> <?php echo $row['student_name'];?> </td>
            		<td> <?php echo $row['student_email'];?> </td>

            	</tr> 
            	  <?php }
            	  ?>
            </tbody>
			   </table>

       
     
   <?php   
        
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 

mysqli_close($link);
?>




	<form action="saveStudentAdmission.php" method="post">
    <p>
        <label for="uniname">Student Name</label>
        <input type="text" name="student_name" id="uniname">
    </p>
    <p>
        <label for="universityaddress">University Address</label>
        <input type="text" name="student_email" id="universityaddress">
    </p>

       <p>
       
        <input type="hidden" name="uni_id" value="<?php echo $uni_id ;?>" id="universityaddress">
    </p>
    
    <input type="submit" value="Submit">
</form>

all some: <?php echo  $all_sum;?>
<br>

 Over all rating : <?php echo $overall_rat;?>

 <br>
 all count: 
 <?php echo $all_count;?>
<!-- footer -->
<?php include "footer.php" ;?>

<!-- footer -->