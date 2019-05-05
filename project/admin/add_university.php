<?php
session_start();
 

if(!isset($_SESSION["user_type"]) || $_SESSION["user_type"] !== 'AD'){
    header("location: login.php");
    exit;
}



  include 'admin_header.php';
 

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
 

    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{

        $sql = "SELECT uni_id FROM university WHERE username = ?";
        
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
  

         $sql = "INSERT INTO university (username, password, uni_name, uni_address, uni_phone, user_type)
    VALUES (?,?,'".$_POST["uni_name"]."','".$_POST["uni_address"]."','".$_POST["uni_phone"]."','".$_POST["user_type"]."')";

         
        if($stmt = mysqli_prepare($link, $sql)){
 
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
 
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); //password hash
            
            if(mysqli_stmt_execute($stmt)){
 
                header("location: showUniList.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
 
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
       mysqli_close($link);
 
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
             
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" placeholder="Username" required="required">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    


<!-- form row 1 start -->

<div class="form-row">
    <div class="col">
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                

              
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>" placeholder="Password">
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

    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="uni_name" placeholder="University Name" required="required">
   
  </div>

<!-- form row 2 start -->

<div class="form-row">
    <div class="col">

  <div class="form-group">

    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="uni_address" placeholder="University Address" required="required">
  </div>

</div>
<div class="col">

  <div class="form-group">
  
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="uni_phone" placeholder="University Phone" required="required">
   
  </div>

</div>
</div>

<!-- form row 2 end -->

<input type="hidden" name="user_type" class="btn btn-primary" value="UV">

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            
        </form>
        </div>
    </div>
</div> 
  
    </body>
</html>
