<?php
session_start();
if(isset($_SESSION['email'])){
include('includes/connection.php');
if(isset($_POST['create_task'])){
  $query = "insert into tasks values(null, $_POST[id], '$_POST[description]', '$_POST[start_date]', '$_POST[end_date]', 'Pending')";
  $query_run = mysqli_query($connection, $query);
  if($query_run){
    echo "<script type='text/javascript'>
    alert('Task created successfully');
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
    <script src="includes/jquery_latest.js"></script>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<div class="container mt-5">

    <!-- Heading -->
    <h5 class="mb-3 fw-bold" style="margin-left:15px;">My Tasks</h5>

    <!-- Center Table -->
    <div class="table-wrapper">
        <table class="custom-table">
            <thead>
                <tr>
                    <th style="width:40px;">Sr. No.</th>
                    <th style="width:100px;">Task ID</th>
                    <th>Description</th>
                    <th style="width:120px;">Start Date</th>
                    <th style="width:120px;">End Date</th>
                    <th style="width:100px;">Status</th>
                    <th style="width:100px;">Action</th>
                </tr>
            </thead>
            <?php 
            $query = "select * from tasks where uid = $_SESSION[uid]";
            $sno = 1;
            $query_run = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($query_run)){
            ?>   
            <tbody>
                
                <tr>
                    <td><?php echo $sno; ?></td>
                    <td><?php echo $row['tid']; ?></td>
                    <td style="text-align:left;"><?php echo $row['description']; ?></td>
                    <td><?php echo $row['start_date']; ?></td>
                    <td><?php echo $row['end_date']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td class="action-btns">
                        <a href="update_status.php?id=<?php echo $row['tid']; ?>" class="btn btn-sm btn-primary">Update</a>
                    </td>
                </tr>
            </tbody>
            <?php
            $sno = $sno + 1;
            }
            ?>
        </table>
    </div>

</div>

</body>
</html>
<?php
} 
else{
  header('Location:user_login.php');
}

