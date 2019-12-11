<?php

require_once('includes/header.php'); 


if ($_SESSION['department']!='Admin'){
    header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index2.php");
} 


$userID = $_SESSION['check'];
$username = $_SESSION['username'];
$first_name = $_SESSION['firstname'];
$last_name = $_SESSION['lastname'];
$department = $_SESSION['department'];



$START = date('Y-m-01');
$END = date('Y-m-t',strtotime('this month'));

?>


<meta http-equiv="refresh" content="30" >

<?php     


if(isset($_POST['searchDate1'])){
    

    $START1 = $_POST['dateSearch1']."-01";
    $END1 = date('Y-m-t',strtotime($START1));

    ?>
    <h3>Pending Requests (<?php echo date('F Y', strtotime($START1))?>):</h3>     
     
   <?php
    $getEmployeeRequest = mysqli_query($conn, "SELECT * FROM request WHERE status = 'PENDING' AND request_Date BETWEEN '$START1' AND '$END1'");
    
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
                        $getUser = mysqli_query($conn, "SELECT * FROM user WHERE user_id = '$ID'");
                        $row2 = mysqli_fetch_assoc($getUser);
                    
                        $employeeID = $row['user_ID'];
                        $name = $row2['first_name']." ".$row2['middle_name']." ".$row2['last_name'];
                        $department = $row2['department'];
                        ?>
                        <div style="overflow-x:auto;">
                        <tbody class="table table-striped">
                            <tr>
                                <td><a href="viewRequestDetails.php?IDval=<?php echo $employeeID?>" target="top">View Request Detail </td>
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

<?php  
} 
else{

    ?>
    <h3>Pending Requests (<?php echo date('F Y');?>):</h3>     
     
   <?php
    $getEmployeeRequest = mysqli_query($conn, "SELECT * FROM request WHERE status = 'PENDING' AND request_Date BETWEEN '$START' AND '$END'");
    
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
                        $getUser = mysqli_query($conn, "SELECT * FROM user WHERE user_id = '$ID'");
                        $row2 = mysqli_fetch_assoc($getUser);
                    
                        $employeeID = $row['user_ID'];
                        $name = $row2['first_name']." ".$row2['middle_name']." ".$row2['last_name'];
                        $department = $row2['department'];
                        ?>
                        <div style="overflow-x:auto;">
                        <tbody class="table table-striped">
                            <tr>
                                <td><a href="viewRequestDetails.php?IDval=<?php echo $employeeID?>" target="top">View Request Detail </td>
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

<?php

}

?>

    