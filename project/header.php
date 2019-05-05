 <?php 



require_once "config.php";

  // $site_name = "Rate Your University";
?>

 <!DOCTYPE html>
<html>
<head>


	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $site_name;?></title>
	<link rel="stylesheet" href="">

<!-- <link rel="stylesheet" href="assets/css/bootstrap.css"> -->

<link rel="stylesheet" href="<?php  $site_url;?>assets/css/bootstrap.css">

<script src="assets/js/all.js"></script>

<script src="assets/js/jquery.js" ></script>
<script src="assets/js/popper.min.js" ></script>

<script src="assets/js/bootstrap.js"></script>

</head>
<body>
	
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php"><?php echo $site_name;?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <!-- <li class="nav-item active">
        <a class="nav-link" href="index.php">University List <span class="sr-only">(current)</span></a>
      </li> -->
      <!-- <li class="nav-item">
        <a class="nav-link" href="Admission.php">Admission</a>
      </li>
  -->
   
    </ul>
    <ul class="navbar-nav my-2 my-lg-0">
          <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Login
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="student/login.php">Student Login</a>
          <a class="dropdown-item" href="admin/login.php">Admin Login</a>
      <!--     <a class="dropdown-item" href="university/login.php">University Login</a> -->
         
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>
  </div>
</nav>