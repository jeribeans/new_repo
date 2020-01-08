<?php

require_once('includes/header.php'); 

if (!in_array($_SESSION['department'], array('Admin', 'SuperAdmin', 'AdminNOC', 'AdminFS', 'AdminCS'))) {
  header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index2.php");
}


$userID = $_SESSION['check'];
$username = $_SESSION['username'];
$first_name = $_SESSION['firstname'];
$last_name = $_SESSION['lastname'];
$department = $_SESSION['department'];
$dept_check = $_SESSION['department'];
if ($dept_check != "SuperAdmin"){
    $team = $_SESSION['team'];
}


$START = date('Y-m-01');
$END = date('Y-m-t',strtotime('this month'));

?>


<meta http-equiv="refresh" content="30" >

<?php     


if(isset($_POST['searchDate3'])){
    

    $START1 = $_POST['dateSearch3']."-01";
    $END1 = date('Y-m-t',strtotime($START1));

    ?>
    <h3>Pending Swap Requests (<?php echo date('F Y', strtotime($START1))?>):</h3>     
     
   

    <?php
    if ($dept_check == "SuperAdmin"){
        $getEmployeeRequest = mysqli_query($conn, "SELECT user.user_ID, first_name, last_name, requested_sched_ID, sched_Date, shift, swap_request_ID, date_requested, status FROM swaprequest JOIN schedule ON schedule.schedule_ID = swaprequest.requester_sched_ID JOIN shift ON shift.shift_ID = schedule.shift_ID JOIN user ON  user.user_ID = schedule.user_ID WHERE date_requested BETWEEN '$START1' AND '$END1' AND status = 'PENDING'");        
    }
    else{
        $getEmployeeRequest = mysqli_query($conn, "SELECT user_ID, first_name, last_name, requested_sched_ID, sched_Date, shift, swap_request_ID, date_requested, status FROM swaprequest JOIN schedule ON schedule.schedule_ID = swaprequest.requester_sched_ID JOIN shift ON shift.shift_ID = schedule.shift_ID JOIN user ON  user.user_ID = schedule.user_ID WHERE user.department = '$team' AND date_requested BETWEEN '$START1' AND '$END1' AND status = 'PENDING'");    
    }
    
    $resultNo = mysqli_num_rows($getEmployeeRequest);
        
    if (!$resultNo){
        echo ' <h4>There are no pending requests at the moment. </h4>';
    } 
    else{
    
        ?>
        <table class="table table-hover table-striped table-condensed table-bordered" >
            <thead>
            <tr>
                    <th>Requester </th>
                    <th>Original Schedule</th>
                    <th>Swap with </th>
                    <th>Requested Schedule</th>
                    <th>Date Requested</th>
                    
                    
            </tr>
            </thead>

            <?php
                if($resultNo > 0){                                
                    while($row = mysqli_fetch_assoc($getEmployeeRequest)){
                        $ID = $row['requested_sched_ID'];
                        $original_schedule = $row['sched_Date'];
                        $original_shift = $row['shift'];
                        $requester_name = $row['first_name']." ".$row['last_name'];
                        $date_requested = $row['date_requested'];

                        $getUser = mysqli_query($conn, "SELECT first_name, last_name, sched_Date, shift FROM schedule JOIN user on user.user_ID = schedule.user_ID JOIN shift on shift.shift_ID = schedule.shift_ID WHERE schedule_ID = '$ID'");
                        $row2 = mysqli_fetch_assoc($getUser);
                        
                        $requestID = $row['swap_request_ID'];
                        $requested_name = $row2['first_name']." ".$row2['last_name'];
                        $requested_schedule = $row2['sched_Date'];
                        $requested_shift = $row2['shift'];

                        ?>
                        <div style="overflow-x:auto;">
                        <tbody class="table table-striped">
                            <tr>
                                <td><a href="viewSwapRequestDetails.php?IDval=<?php echo $requestID?>" target="top"><?php echo $requester_name;?> </td>
                                <td><?php echo date("M d, Y - l", strtotime($original_schedule));?></td>
                                <td><?php echo $requested_name;?></td>
                                <td><?php echo date("M d, Y - l", strtotime($requested_schedule));?></td>
                                <td><?php echo date("M d, Y", strtotime($date_requested));?></td>
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
    <h3>Pending Swap Requests (<?php echo date('F Y');?>):</h3>     
     
   <?php
    if ($dept_check == "SuperAdmin"){
        $getEmployeeRequest = mysqli_query($conn, "SELECT user.user_ID, first_name, last_name, requested_sched_ID, sched_Date, shift, swap_request_ID, date_requested, status FROM swaprequest JOIN schedule ON schedule.schedule_ID = swaprequest.requester_sched_ID JOIN shift ON shift.shift_ID = schedule.shift_ID JOIN user ON  user.user_ID = schedule.user_ID WHERE status ='PENDING'");        
    }
    else{
        $getEmployeeRequest = mysqli_query($conn, "SELECT user_ID, first_name, last_name, requested_sched_ID, sched_Date, shift, swap_request_ID, date_requested, status FROM swaprequest JOIN schedule ON schedule.schedule_ID = swaprequest.requester_sched_ID JOIN shift ON shift.shift_ID = schedule.shift_ID JOIN user ON  user.user_ID = schedule.user_ID WHERE user.department = '$team' AND status = 'PENDING'");    
    }
    
    $resultNo = mysqli_num_rows($getEmployeeRequest);
        
    if (!$resultNo){
        echo ' <h4>There are no pending requests at the moment. </h4>';
    } 
    else{
    
        ?>
        <table class="table table-hover table-striped table-condensed table-bordered" >
            <thead>
            <tr>
                    <th>Requester </th>
                    <th>Original Schedule</th>
                    <th>Swap with </th>
                    <th>Requested Schedule</th>
                    <th>Date Requested</th>
                    
                    
            </tr>
            </thead>

            <?php
                if($resultNo > 0){                                
                    while($row = mysqli_fetch_assoc($getEmployeeRequest)){
                        $ID = $row['requested_sched_ID'];
                        $original_schedule = $row['sched_Date'];
                        $original_shift = $row['shift'];
                        $requester_name = $row['first_name']." ".$row['last_name'];
                        $date_requested = $row['date_requested'];

                        $getUser = mysqli_query($conn, "SELECT first_name, last_name, sched_Date, shift FROM schedule JOIN user on user.user_ID = schedule.user_ID JOIN shift on shift.shift_ID = schedule.shift_ID WHERE schedule_ID = '$ID'");
                        $row2 = mysqli_fetch_assoc($getUser);
                        
                        $requestID = $row['swap_request_ID'];
                        $requested_name = $row2['first_name']." ".$row2['last_name'];
                        $requested_schedule = $row2['sched_Date'];
                        $requested_shift = $row2['shift'];

                        ?>
                        <div style="overflow-x:auto;">
                        <tbody class="table table-striped">
                            <tr>
                                <td><a href="viewSwapRequestDetails.php?IDval=<?php echo $requestID?>" target="top"><?php echo $requester_name;?> </td>
                                <td><?php echo date("M d, Y - l", strtotime($original_schedule));?></td>
                                <td><?php echo $requested_name;?></td>
                                <td><?php echo date("M d, Y - l", strtotime($requested_schedule));?></td>
                                <td><?php echo date("M d, Y", strtotime($date_requested));?></td>
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

    