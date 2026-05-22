<?php
session_start();
if(isset($_SESSION['email'])){
include('../includes/connection.php');
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
    <div class="row justify-content-left">
        <div class="col-md-6">

            <!-- Heading -->
            <h5 class="mb-3 fw-bold" style="margin-left:15px;">Create a New Task</h5>

            <!-- Form -->
            <form action="" method="post">
                <!-- Select Employee -->
                <div class="mb-3" style="margin-left:15px;">
                    <label class="form-label">Select Employee</label>
                    <select class="form-select" name="id" required>
                        <option>Choose Employee</option>
                        <?php
                        include('../includes/connection.php');
                        $query = "select uid, name from users";
                        $query_run = mysqli_query($connection, $query);
                        if(mysqli_num_rows($query_run)){
                            while($row = mysqli_fetch_assoc($query_run)){
                                ?>
                                <option value="<?php echo $row['uid']; ?>"
                                ><?php echo $row['name']; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>

                <!-- Description -->
                <div class="mb-3" style="margin-left:15px;">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Enter task description" required></textarea>
                </div>

                <!-- Start Date -->
                <div class="mb-3" style="margin-left:15px;">
                    <label class="form-label">Start Date</label>
                    <input type="date" name="start_date" class="form-control" required>
                </div>

                <!-- End Date -->
                <div class="mb-3" style="margin-left:15px;">
                    <label class="form-label">End Date</label>
                    <input type="date" name="end_date" class="form-control" required>
                </div>

                <!-- Button -->
                <div class="d-grid" style="margin-left:15px;">
                    <button type="submit" name="create_task" style="width:100px;" class="btn btn-primary">Create</button>
                </div>
            </form>

        </div>
    </div>
</div>

</body>
</html>
<?php
} 
else{
  header('Location:admin_login.php');
}
