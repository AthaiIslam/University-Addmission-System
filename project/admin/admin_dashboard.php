<?php

session_start();

if(!isset($_SESSION["user_type"]) || $_SESSION["user_type"] !== 'AD'){
    header("location: login.php");
    exit;
}
include 'admin_header.php';

?>



    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    </div>
    <p>
        <a href="admin_resetpassword.php" class="btn btn-warning">Reset Your Password</a>
        <a href="../logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>


</body>
</html>