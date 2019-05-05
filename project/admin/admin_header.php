 <?php 




 require_once "../config.php" ;


?>


<!DOCTYPE html>
<html>
<head>


	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $site_name;?></title>
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
  <a class="navbar-brand" href="login.php"><?php echo $site_name;?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
  
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">University</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="add_university.php">Add New university</a>
      <a class="dropdown-item" href="showUniList.php">Show University List</a>
     
    </div>
  </li>

    <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Student</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="AdminAddStudent.php">Add New Student</a>
      <a class="dropdown-item" href="Student_list.php">Student List</a>
      
    </div>
  </li>

     <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Department</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="AddDepartment.php">Add New Department</a>
      <a class="dropdown-item" href="departmentList.php">Department List</a>
      
    </div>
  </li>


  <li class="nav-item">
    <a class="nav-link" href=" ../logout.php">Logout</a>
  </li>


  
</ul>
  </div>
</nav>

