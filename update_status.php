<?php
session_start();
include('includes/connection.php');
if(isset($_SESSION['email'])){
if(isset($_POST['update_status'])){
    $query = "update tasks set status = '$_POST[status]' where tid = $_GET[id]";
    $query_run = mysqli_query($connection, $query);
    if($query_run){
        echo "<script type='text/javascript'>
        alert('Status updated successfully');
        window.location.href = 'user_dashboard.php';
        </script>
        ";
        }
        else{
        echo "<script type='text/javascript'>
        alert('Error...Please try again');
        window.location.href = 'user_dashboard.php';
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

<div class="container mt-5">
    <div class="row justify-content-center" style="margin-top:150px;">
        <div class="col-md-6">

            <!-- Heading -->
            <h5 class="mb-3 fw-bold">Update the Task</h5>
            <?php
            $query = "select * from tasks where tid = $_GET[id]";
            $query_run = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($query_run)){
                ?>

            <!-- Form -->
            <form action="" method="post">
                <div class="mb-3">
                    <input type="hidden" name="id" class="form-control" value="" required>
                </div>   
                <!-- Select Employee -->
                <div class="mb-3">
                    <select class="form-select" name="status">
                        <option>--Select--</option>
                        <option>In-Progress</option>
                        <option>Completed</option>
                    </select>
                </div>

                
                <!-- Button -->
                <div class="d-grid">
                    <button type="submit" name="update_status" style="width:100px;" class="btn btn-primary">Update</button>
                </div>
            </form>
            <?php
            }
            ?>
        </div>
    </div>
</div>

</body>
</html>
<?php
} 
else{
  header('Location:user_login.php');
}