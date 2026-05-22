<?php
include('includes/connection.php');
$name = "";
$email = "";
$password = "";
$confirm_password = "";
$nameErr = $emailErr = $passwordErr = $confirmpasswordErr = "";
if(isset($_POST['userRegistration'])){
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
if(empty($name)){
$nameErr = "Name is required";
}
if(empty($email)){
$nameErr = "Email is required";
}
elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
$emailErr = "Invalid email format";
}
else{
$checkSql = "select uid from users where email = '$email'";
$result = mysqli_query($connection, $checkSql);
if(mysqli_num_rows($result)>0){
$emailErr = "Email already registered";
}
}
if(empty($password)){
$passwordErr = "Password is required";
}
elseif(!preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $password)){
$passwordErr = "Password at least 8 characters with uppercase, lowercase, digit and special character";
}
if(empty($confirm_password)){
$confirmpasswordErr = "Confirm Password is required";
}
elseif($password!==$confirm_password){
$confirmpasswordErr = "Passwords do not match";
}
if(empty($nameErr) && empty($emailErr) && empty($passwordErr) && empty($confirmpasswordErr)){
$query = "insert into users(name, email, password)values('$name', '$email', '$password')";
$query_run = mysqli_query($connection, $query);
if($query_run){
echo "<script type='text/javascript'>
alert('User registered successfully...');
window.location.href = 'user_login.php';
</script>
";
}
else{
echo "<script type='text/javascript'>
alert('Error... Please try again.');
window.location.href = 'user_dashboard.php';
</script>
";
}
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
<style>
    .form-box .error{
    color: red;
}
</style>

<script>
window.addEventListener("load", function(){
if(performance.navigation.type===1){
document.querySelectorAll("input").forEach(function(input){
if(input.type==="submit")return;
input.value="";
});
document.querySelectorAll(".error").forEach(function(el){
el.innerText="";
});
}
});
</script>

</head>
<body>
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-11 col-sm-8 col-md-6 col-lg-4">

            <!-- Registration Form -->
            <div class="form-box mb-4" id="register">
                <h3 class="text-center mb-3">Registration</h3>

                <form action="" method="post" id="registerForm">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter username" value="<?php if(isset($_POST['name'])) echo htmlspecialchars($_POST['name']); ?>" required>
                        <div class="error"><?php echo $nameErr ??''; ?></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter email" value="<?php if(isset($_POST['email'])) echo htmlspecialchars($_POST['email']); ?>" required>
                        <div class="error"><?php echo $emailErr ??''; ?></div>
                    </div>

                    <div class="mb-3 password-box">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="regPass" value="<?php if(isset($_POST['password'])) echo htmlspecialchars($_POST['password']); ?>" required>
                        <i class="fa fa-eye-slash toggle-eye" onclick="togglePassword('regPass', this)"></i>
                        <div class="error"><?php echo $passwordErr ??''; ?></div>
                    </div>

                    <div class="mb-3 password-box">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" id="regCpass" value="<?php if(isset($_POST['confirm_password'])) echo htmlspecialchars($_POST['confirm_password']); ?>" required>
                        <i class="fa fa-eye-slash toggle-eye" onclick="togglePassword('regCpass', this)"></i>
                        <div class="error"><?php echo $confirmpasswordErr ??''; ?></div>
                    </div>

                    <button name="userRegistration" class="btn btn-success w-100">Register</button>

                    <p class="text-center mt-3">
                        Already have an account?
                        <a href="user_login.php">Login now</a>
                    </p>
                </form>
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
</script>
</body>
</html>