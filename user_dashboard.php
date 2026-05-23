<?php
session_start();
if(isset($_SESSION['email'])){
include('includes/connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ETMS</title>
    <script src="includes/jquery_latest.js"></script>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script type="text/javascript">
     $(document).ready(function(){
        $("#task_progress").click(function(e){
          e.preventDefault();
          $("#right_sidebar").load("task_progress.php");
        });
      });
    </script>
</head>
<body>
  <input type="checkbox" id="checkbox">
  <header class="header d-flex justify-content-between align-items-center px-3 py-3 text-white">
    <h2 class="u-name m-0">
      Task <b>Pro</b>
      <label for="checkbox" class="ms-2 mb-0">
        <i id="navbtn" class="fa fa-bars"></i>
      </label>
    </h2>
  </header>
  <div class="body d-flex flex-nowrap" id="left_sidebar">
    <nav class="side-bar min-vh-100">
      <div class="user-p text-center pt-3">
        <img src="includes/user.png" class="img-fluid" style="width:110px;" alt="">
        <h6 class="text-light mt-2"><?php echo $_SESSION['email']; ?></h6>
        <h6 class="text-light mt-2"><?php echo $_SESSION['name']; ?></h6>
      </div>
      <ul class="list-unstyled mt-3">
        <li><a href="#" id="task_progress" class="d-flex align-items-center text-decoration-none text-light py-2 px-3"><i class="fa-solid fa-tasks me-2"></i> <span>Task Progress</span></a></li>
        <li><a href="logout.php" class="d-flex align-items-center text-decoration-none text-light py-2 px-3"><i class="fa fa-right-from-bracket me-2"></i> <span>Logout</span></a></li>
      </ul>
    </nav>
    <div id="right_sidebar" class="flex-fill p3">

   </div>
  </div>
</body>
</html>
<?php
} 
else{
  header('Location:user_login.php');
}