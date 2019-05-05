 <?php 

// Initialize the session


require_once "../config.php";

  // $site_name = "Rate Your University";
?>


<!DOCTYPE html>
<html>
<head>


	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title> <?php echo $site_name;?> </title>
	<link rel="stylesheet" href="">

<!-- <link rel="stylesheet" href="assets/css/bootstrap.css"> -->

<link rel="stylesheet" href="../assets/css/bootstrap.css">


<script src="../assets/js/all.js"></script>
<script src="../assets/js/jquery.js" ></script>
<script src="../assets/js/popper.min.js" ></script>

<script src="../assets/js/bootstrap.js"></script>



<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous"> -->



</head>
<body>
	
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="st_dashboard.php">Student Portal</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">

	<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" href="st_dashboard.php"><?php echo $site_name;?></a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">University</a>
    <div class="dropdown-menu">
 
      <a class="dropdown-item" href="UniversityList.php">Show University List</a>
     
    </div>
  </li>

    <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">My Account</a>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="st_dashboard.php">My Profile</a>

       <a class="dropdown-item" href="st-reset-password.php">Password Reset</a>
 
      <a class="dropdown-item" href="../logout.php">Logout</a>
     
    </div>
  </li>


</ul>

</div>
</nav>