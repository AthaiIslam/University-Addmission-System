<?php

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
         
        
        mysqli_stmt_close($stmt);
    }
    
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
       

         $sql = "INSERT INTO student (username, password, email, student_name, student_type, user_type, uni_id)
    VALUES (?,?,'".$_POST["email"]."','".$_POST["student_name"]."','".$_POST["student_type"]."','".$_POST["user_type"]."','".$_POST["uni_id"]."')";

         
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); 
            
            
            if(mysqli_stmt_execute($stmt)){
                
                header("location: student/login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        
        mysqli_stmt_close($stmt);
    }
    
    
    
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
                

              
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>" placeholder="Password" required="required">
                <span class="help-block"><?php echo $password_err; ?></span>


            </div>
</div>
<div class="col">
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
     
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>" placeholder="Confirm Password" required="required">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
</div>
</div>
<!-- form row 1 end -->

  <div class="form-group">

    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="student_name" placeholder="Student Name" required="required">
   
  </div>

  <div class="form-group">

    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Student Email" required="required">
   
  </div>





 <div class="form-group">
     <label for="exampleFormControlSelect1">Student Type</label>
      <input name="student_type" type="radio" data-toggle="collapse" value="Admission Seeker" /> Admission Seeker
      <input name="student_type" type="radio" data-toggle="collapse" data-target="#collapseOne" value="Graduate"/> Graduate
      <div class="panel-group" id="accordion">
        <div class="panel panel-default">
          <div class="panel-heading">
         
          </div>
          <div id="collapseOne" class="panel-collapse collapse">
            <div class="panel-body">



           <?php

 // Attempt select query execution
$sqlu = "SELECT * FROM university  ORDER BY uni_name ASC" ;

if($result = mysqli_query($link, $sqlu)){
    if(mysqli_num_rows($result) > 0){

?>

  <div class="form-group">
  
    <select class="form-control" name="uni_id"  id="exampleFormControlSelect1" required="required">

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



            </div>
          </div>
        </div>
      </div>

 </div>
<!-- select university -->




<!-- select university end -->

            <div class="form-group">
                <input type="hidden" class="btn btn-primary" name="user_type" value="ST">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-warning" value="Reset">
            </div>
         
        </form>
        <hr>

        <p>
          Already registered? <a href="student/login.php" class="btn btn-success btn-sm"> Login</a>
        </p>
        </div>
    </div>
</div> 


    <?php

   mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sqlu. " . mysqli_error($link);
}

// select university


    mysqli_close($link);
    ?>      
</body>
</html>