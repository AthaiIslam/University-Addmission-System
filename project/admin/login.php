<?php
session_start();
 
if(isset($_SESSION["user_type"]) && $_SESSION["user_type"] === 'AD'){
  header("location: admin_dashboard.php");
  exit;
}
 


require_once "../config.php";

$username = $password = "";
$username_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    if(empty($username_err) && empty($password_err)){
  
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
  
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
  
            $param_username = $username;
            
     
            if(mysqli_stmt_execute($stmt)){
     
                mysqli_stmt_store_result($stmt);
             
                if(mysqli_stmt_num_rows($stmt) == 1){                    
   
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            session_start();

                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["user_type"] = 'AD';                            
                       
                            header("location: admin_dashboard.php");
                        } else{
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{

                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
 
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>


<!DOCTYPE html>
<html>
<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link rel="stylesheet" href="">

<!-- <link rel="stylesheet" href="assets/css/bootstrap.css"> -->

<link rel="stylesheet" href="../assets/css/bootstrap.css">


<script src="../assets/js/all.js"></script>



<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous"> -->



</head>
<body>
    <div class="container">

        <div class="row">
            
       <div class="col-md-2"></div>

        <div class="col-md-8" style="margin-top: 30px;">
        <h2>Admin Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            
        </form>

    </div>
 </div>

    </div>    

<?php
include 'admin_footer.php';

?>