<?php

session_start();
 

if(isset($_GET["id"]));
  $uni_id = $_GET["id"];
  include 'header.php';
 

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
 
        $sql = "SELECT id FROM student WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
  
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
   
            $param_username = trim($_POST["username"]);
            
           
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        

         $sql = "INSERT INTO student (username, password, email, student_name, course, department_name, uni_id, student_address, degree, student_contact, hsc_grade, user_type )
    VALUES (?,?,'".$_POST["email"]."','".$_POST["student_name"]."','".$_POST["course"]."','".$_POST["department_name"]."','".$_POST["uni_id"]."','".$_POST["student_address"]."','".$_POST["degree"]."','".$_POST["student_contact"]."' ,'".$_POST["hsc_grade"]."','".$_POST["user_type"]."')";

         
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); //  password hash
            
            
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: student/login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    
}
?>
 


<div class="container">
    <div class="row">

        <div class="col-md-2"></div>

        <div class="col-md-8">

        <h2>Apply Online Admission</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <input type="hidden" value="<?php echo $uni_id;?>" name="uni_id">


            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" required="required" placeholder="username">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    


<!-- form row 1 start -->

<div class="form-row">
    <div class="col">
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                

                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>" required="required" placeholder="Password">
                <span class="help-block"><?php echo $password_err; ?></span>


            </div>
</div>
<div class="col">
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>" placeholder="Confirm Password" required="required" >
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
</div>
</div>
<!-- form row 1 end -->

  <div class="form-group">
    <label for="exampleInputEmail1">Student Name </label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="student_name" placeholder="Student Name" required="required" >
   
  </div>

<!-- form row 2 start -->

<div class="form-row">
    <div class="col">

  <div class="form-group">
    <label for="exampleInputEmail1">Student Email</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Student Email" required="required" >
  </div>

</div>
<div class="col">

  <div class="form-group">
    <label for="exampleInputEmail1">Student Contact</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="student_contact" placeholder="Student Contact" required="required" >
   
  </div>

</div>
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




    <div class="form-group">
    <label for="exampleInputEmail1">Course</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="course" placeholder="Type your Course" required="required" >
   
  </div>
     <div class="form-group">
  
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="hsc_grade" placeholder="HSC GPA (4.5, 4., 5)" required="required" >
   
  </div>
   
<!-- department -->

 <?php

 // Attempt select query execution
$sqld = "SELECT * FROM department  ORDER BY department_name ASC" ;

if($resultd = mysqli_query($link, $sqld)){
    if(mysqli_num_rows($resultd) > 0){

?>

  <div class="form-group">
    <label for="exampleFormControlSelect1">Department</label>
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
    <label for="exampleInputEmail1">Student Address</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="student_address" placeholder="Student Address" required="required" >
   
  </div>

<input type="hidden" class="btn btn-primary" name="user_type" value="ST">

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
     
        </form>
        </div>
    </div>
</div> 


    <?php
include "footer.php" ;
// select department

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