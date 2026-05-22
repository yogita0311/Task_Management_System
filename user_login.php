<?php
session_start();
include('includes/connection.php');
if(isset($_POST['userLogin'])){
$query = "select name, email, password, uid from users where email = '$_POST[email]' AND password = '$_POST[password]'";
$query_run = mysqli_query($connection, $query);
if(mysqli_num_rows($query_run)){
while($row = mysqli_fetch_assoc($query_run)){
    $_SESSION['email'] = $row['email'];
    $_SESSION['name'] = $row['name'];
    $_SESSION['uid'] = $row['uid'];   
}
echo "<script type='text/javascript'>
window.location.href = 'user_dashboard.php';
</script>
";
}
else{
echo "<script type='text/javascript'>
alert('Please enter correct details.');
window.location.href = 'user_login.php';
</script>
";
}
}
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
</head>
<body>
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-11 col-sm-8 col-md-6 col-lg-4">

            <!-- Login Form -->
            <div class="form-box" id="login">
                <h3 class="text-center mb-3">Login</h3>

                <form action="" method="post">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                    </div>

                    <div class="mb-3 password-box">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="loginPass" required>
                        <i class="fa fa-eye-slash toggle-eye" onclick="togglePassword('loginPass', this)"></i>
                    </div>

                    <button name="userLogin" class="btn btn-success w-100">Login</button>

                    <p class="text-center mt-3">
                        Don't have an account?
                        <a href="register.php">Register now</a>
                    </p>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- JS for eye toggle -->
<script>
function togglePassword(fieldId, icon) {
    const field = document.getElementById(fieldId);
    if (field.type === "password") {
        field.type = "text";
        icon.classList.replace("fa-eye-slash", "fa-eye");
    } else {
        field.type = "password";
        icon.classList.replace("fa-eye", "fa-eye-slash");
    }
}
</script>
</body>
</html>