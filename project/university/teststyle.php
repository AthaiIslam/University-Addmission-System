<?php
// Include config file

 include 'header.php';
// Define variables and initialize with empty values
$username = $password = $confirm_password =  "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
   
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM student WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
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
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);

    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
$student_name = mysqli_real_escape_string($link, $_REQUEST['student_name']);
$uni_id = mysqli_real_escape_string($link, $_REQUEST['uni_id']);

    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){


      // $name = mysqli_real_escape_string($link, $_REQUEST['student_name']);  
        // Prepare an insert statement
        $sql = "INSERT INTO student (username, password, student_name, uni_id) VALUES (?, ?, $student_name, $uni_id)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    // mysqli_close($link);
}
?>

<div class="container">
  
  <div class="row">
    
    <div class="col-md-2"></div>

  <div class="col-md-8">
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">


            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div> 

<!-- form row 1 start -->

<div class="form-row">
    <div class="col">
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                

                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>


            </div>
</div>
<div class="col">
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
</div>
</div>
<!-- form row 1 end -->

  <div class="form-group">
    <label for="exampleInputEmail1">Student Name </label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="student_name" placeholder="Student Name">
   
  </div>

            

 <?php

 // Attempt select query execution
$sqlu = "SELECT * FROM university  ORDER BY uni_name ASC" ;

if($result = mysqli_query($link, $sqlu)){
    if(mysqli_num_rows($result) > 0){

?>

  <div class="form-group">
    <label for="exampleFormControlSelect1">Example University</label>
    <select class="form-control" name="uni_id"  id="exampleFormControlSelect1">

<option> Select University </option>

               <?php
              while($row = mysqli_fetch_array($result)){

          ?>

<p> <?php echo $row['uni_id'] ;?> || <?php echo $row['uni_name'] ;?> </p>
  <option value="<?php echo $row['uni_id'] ;?>"> <?php echo $row['uni_name'] ;?> </option>

<?php }
  ?>

        </select>
      </div>

<!-- form row 2 start -->

<div class="form-row">
    <div class="col">

  <div class="form-group">
    <label for="exampleInputEmail1">Student Email</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="student_email" placeholder="Student Email">
  </div>

</div>
<div class="col">

  <div class="form-group">
    <label for="exampleInputEmail1">Student Contact</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="student_contact" placeholder="Student Contact">
   
  </div>

</div>
</div>

<!-- form row 2 end -->

  <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="degree" id="inlineRadio1" value="Undergraduate">
  <label class="form-check-label" for="inlineRadio1">Undergraduate</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="degree" id="inlineRadio2" value="Graduate">
  <label class="form-check-label" for="inlineRadio2">Graduate</label>
</div>






  <div class="form-group">
    <label for="exampleInputEmail1">Course</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="course" placeholder="Type your Course">
   
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
    <select class="form-control" name="department_name"  id="exampleFormControlSelect1">

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
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="student_address" placeholder="Student Address">
   
  </div>



            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
  </div>
  </div>
</div>

<!-- footer -->
<?php include "footer.php" ;?>

  <?php   
        // Free result set
        mysqli_free_result($resultd);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sqld. " . mysqli_error($link);
}
?>

<!-- footer -->
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