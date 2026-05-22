<?php
session_start();
if(isset($_SESSION['email'])){
include('../includes/connection.php');
if(isset($_POST['edit_task'])){
    $query = "update tasks set uid = $_POST[id], description = '$_POST[description]', start_date = '$_POST[start_date]', end_date = '$_POST[end_date]'
    where tid = $_GET[id]";
    $query_run = mysqli_query($connection, $query);
    if($query_run){
        echo "<script type='text/javascript'>
        alert('Task updated successfully');
        window.location.href = 'admin_dashboard.php';
        </script>
        ";
        }
        else{
        echo "<script type='text/javascript'>
        alert('Error...Please try again');
        window.location.href = 'admin_dashboard.php';
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
    <script src="../includes/jquery_latest.js"></script>
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" type="text/css" href="../css/style.css">

</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <!-- Heading -->
            <h5 class="mb-3 fw-bold">Edit the Task</h5>
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
                    <label class="form-label">Select Employee</label>
                    <select class="form-select" name="id" required>
                        <option>Choose Employee</option>
                        <?php
                        $query1 = "select uid, name from users";
                        $query_run1 = mysqli_query($connection,$query1);
                        if(mysqli_num_rows($query_run1)){
                            while($row1 = mysqli_fetch_assoc($query_run1)){
                                ?>
                                <option value="<?php echo $row1['uid']; ?>"
                                ><?php echo $row1['name']; ?></option>
                                <?php
                            }
                        }
                        ?>
        
                    </select>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3" required><?php echo $row['description']; ?></textarea>
                </div>

                <!-- Start Date -->
                <div class="mb-3">
                    <label class="form-label">Start Date</label>
                    <input type="date" name="start_date" class="form-control" value="<?php echo $row['start_date']; ?>" required>
                </div>

                <!-- End Date -->
                <div class="mb-3">
                    <label class="form-label">End Date</label>
                    <input type="date" name="end_date" class="form-control" value="<?php echo $row['end_date']; ?>"  required>
                </div>

                <!-- Button -->
                <div class="d-grid">
                    <button type="submit" name="edit_task" style="width:100px;" class="btn btn-primary">Update</button>
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