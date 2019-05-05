<?php 


session_start();

if(!isset($_SESSION["user_type"]) || $_SESSION["user_type"] !== 'AD'){
    header("location: login.php");
    exit;
}
include 'admin_header.php';


?>


<div class="container">
    
    <div class="row">

<!-- header -->




	<form action="SaveDepartment.php" method="post">
    <p>
        <label for="uniname">Department Name:</label>
        <input type="text" name="department_name" id="uniname" required="required">
    </p>
    <p>
        <label for="universityaddress">Department Description</label>
        <input type="text" name="description" id="universityaddress" required="required">
    </p>


    

<!-- <input type="hidden" value="<?php echo $newuni;?>" name="uni_id">
<input type="hidden" value="1" name="student_id">
<input type="hidden" value="5" name="rate"> -->

    <input type="submit" value="Submit">
</form>

      
     
     </div>


</div>

</body>
</html>