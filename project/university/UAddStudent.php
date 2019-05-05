<?php
session_start();

if(!isset($_SESSION["user_type"]) || $_SESSION["user_type"] !== 'UV'){
    header("location: login.php");
    exit;
}

$uni_id = $_SESSION["uni_id"];

include 'u_header.php';
 
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
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        // $sql = "INSERT INTO student (username, password) VALUES (?, ?)";

         $sql = "INSERT INTO student (username, password, email, student_name, course, department_name, uni_id, student_address, degree, student_contact, hsc_grade, user_type)
    VALUES (?,?,'".$_POST["email"]."','".$_POST["student_name"]."','".$_POST["course"]."','".$_POST["department_name"]."','".$_POST["uni_id"]."','".$_POST["student_address"]."','".$_POST["degree"]."','".$_POST["student_contact"]."' ,'".$_POST["hsc_grade"]."' ,'".$_POST["user_type"]."')";

         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: ShowStdList.php");
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

        <h2>Online Admission</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
             
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" placeholder="Username" required="required" >
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    


<!-- form row 1 start -->

<div class="form-row">
    <div class="col">
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                

              
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>" placeholder="Password" required="required" >
                <span class="help-block"><?php echo $password_err; ?></span>


            </div>
</div>
<div class="col">
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
     
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>" placeholder="Confirm Password" required="required" >
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
</div>
</div>
<!-- form row 1 end -->

  <div class="form-group">

    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="student_name" placeholder="Student Name" required="required" >
   
  </div>

<!-- form row 2 start -->

<div class="form-row">
    <div class="col">

  <div class="form-group">

    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Student Email" required="required" >
  </div>

</div>
<div class="col">

  <div class="form-group">
  
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
  
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="course" placeholder="Type your Course" required="required" >
   
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

    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="student_address" placeholder="Student Address" required="required" >
   
  </div>

      <div class="form-group">
  
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="hsc_grade" placeholder="HSC GPA ( 4, 4.5 , 5)" required="required" >
   
  </div>
<input type="hidden" class="btn btn-primary" name="uni_id" value="<?php echo $uni_id;?>">
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

// select department

        mysqli_free_result($resultd);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sqld. " . mysqli_error($link);
}

// select department
// select university 
        // Free result set


// select university


    mysqli_close($link);
    ?>   
</body>
</html>