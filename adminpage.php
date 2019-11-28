<?php require_once('includes/header.php'); 

$userID = $_SESSION['check'];
$username = $_SESSION['username'];
$first_name = $_SESSION['firstname'];
$last_name = $_SESSION['lastname'];
$department = $_SESSION['department'];

if ($_SESSION['department']!='Admin'){
    header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
} 
    
include('includes/navbar.php');
include('includes/adminsidebar.php'); 

?>

<meta http-equiv="refresh" content="120" > 

<LEGEND><h2>Admin Homepage</h2></LEGEND>


<style type="text/css"><?php include('includes/common.css'); ?></style>


<div class="container-fluid">
    <div class="container-fluid">
    
    <h3>Pending Request:</h3>     
     
    <?php
    $getEmployeeRequest = mysqli_query($conn, "SELECT *    FROM request where status = 'pending'");
    
    $resultNo = mysqli_num_rows($getEmployeeRequest);
        
    if (!$resultNo){
        echo ' <h4>There are no pending requests at the moment. </h4>';
    } 
    else{
    
        ?>
        <table class="table table-hover table-striped table-condensed table-bordered" >
            <thead>
            <tr>
                    <th>Request Detail</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Leave type</th>
            </tr>
            </thead>

            <?php
                if($resultNo > 0){                                
                    while($row = mysqli_fetch_assoc($getEmployeeRequest)){
                        $ID = $row['user_ID'];
                        $getUser = mysqli_query($conn, "SELECT * FROM user where user_id = '$ID'");
                        $row2 = mysqli_fetch_assoc($getUser);
                    
                        $employeeID = $row['request_ID'];
                        $name = $row2['first_name']." ".$row2['middle_name']." ".$row2['last_name'];
                        $department = $row2['department'];
                        ?>
                        <div style="overflow-x:auto;">
                        <tbody class="table table-striped">
                            <tr>
                                <td><a href="viewRequestDetails.php?IDval=<?php echo $employeeID?>">View Request Detail </td>
                                <td><?php echo $name;?></a></td>
                                <td><?php echo $department;?></td>
                                <td><?php echo $row['leave_type'];?></td>
                            </tr>
                            <?php 
                    }
                }
    }
    ?>
                        </tbody>
        </table>        
</div>



<div class="container-fluid">
    <div class="container-fluid">
    
    <h3>Schedule as of <?php echo $YrMnth = date('F Y')?>:</h3>

    <table class="table table-hover table-striped table-condensed table-bordered" >
            <thead>
            <tr>
                    <th>Request Detail</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Leave type</th>
            </tr>
            </thead>     

<?php     
    

    
    // SELECT * FROM lddap WHERE lddap_no LIKE '%2017-06%';
    $viewSchedule = mysqli_query($conn,"SELECT employee_ID, first_name, last_name, department, sched_Date, shift  FROM schedule JOIN shift ON schedule.shift_ID = shift.shift_ID JOIN user ON schedule.user_ID = user.user_ID");
    $resultNo2 = mysqli_num_rows($viewSchedule);

    if($resultNo > 0){                                
        while($row = mysqli_fetch_assoc($viewSchedule)){
            echo "<tr>";
            echo $row['employee_ID']."<br>";
            echo $row['first_name']."<br>";
            echo $row['last_name']."<br>";
            echo $row['department']."<br>";
            echo $row['sched_Date']."<br>";
            echo $row['shift']."<br>";
            echo "</tr>";
        }
    }


?> </table>
<!--      
    <?php
    $getSchedule = mysqli_query($conn, "SELECT *    FROM request where status = 'pending'");
    
    $resultNo = mysqli_num_rows($getEmployeeRequest);
        
    if (!$resultNo){
        echo ' <h4>There are no pending requests at the moment. </h4>';
    } 
    else{
    
        ?>
        <table class="table table-hover table-striped table-condensed table-bordered" >
            <thead>
            <tr>
                    
                    <th>Name</th>
                    <th>Shift</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                </tr>
            </thead>

            <?php
                if($resultNo > 0){                                
                    while($row = mysqli_fetch_assoc($getEmployeeRequest)){
                        $ID = $row['user_ID'];
                        $getUser = mysqli_query($conn, "SELECT * FROM user where user_id = '$ID'");
                        $row2 = mysqli_fetch_assoc($getUser);
                    
                        $employeeID = $row['request_ID'];
                        $name = $row2['first_name']." ".$row2['middle_name']." ".$row2['last_name'];
                        $department = $row2['department'];
                        ?>
                        <div style="overflow-x:auto;">
                        <tbody class="table table-striped">
                            <tr>
                                <td><a href="viewRequestDetails.php?IDval=<?php echo $employeeID?>">View Request Detail </td>
                                <td><?php echo $name;?></a></td>
                                <td><?php echo $department;?></td>
                                <td><?php echo $row['leave_type'];?></td>
                            </tr>
                            <?php 
                    }
                }
    }
    ?>
                        </tbody>
        </table>        
</div> -->



<?php include('includes/footer.php'); ?>