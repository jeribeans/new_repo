<?php include('includes/header.php'); ?>
<?php 
if ($_SESSION['dept_check']!="emp"){
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index2.php");
 }

$dept_check = $_SESSION["dept_check"];
$check = $_SESSION['check'];
$username = $_SESSION['username'];
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
$department = $_SESSION['department'];


$START = date('Y-m-01');
$END = date('Y-m-t',strtotime('this month'))."<br>";

?>



<?php     


if(isset($_POST['searchDate4'])){
    

    $START1 = $_POST['dateSearch4']."-01";
    $END1 = date('Y-m-t',strtotime($START1));

    ?>
    <h3>Swap Request Status:(<?php echo date('F Y', strtotime($END1));?>):</h3>     
    <?php
    $getEmployeeRequest = mysqli_query($conn, "SELECT requested_sched_ID, sched_Date, shift, swap_request_ID, status FROM swaprequest JOIN schedule ON schedule.schedule_ID = swaprequest.requester_sched_ID JOIN shift ON shift.shift_ID = schedule.shift_ID JOIN user ON  user.user_ID = schedule.user_ID WHERE user.user_ID = '$check' AND date_requested BETWEEN '$START1' AND '$END1'");


    $resultNo = mysqli_num_rows($getEmployeeRequest);
        
    if (!$resultNo){
        echo ' <h4>There are no requests at the moment. </h4>';
    } 
    else{
    
        ?>
        <table class="table table-hover table-striped table-condensed table-bordered" >
            <thead>
            <tr>
                    <th>Swap with </th>
                    <th>Original Schedule</th>
                    <th>Original Shift</th>
                    <th>Requested Schedule</th>
                    <th>Requested Shift</th>
                    <th>Status</th> 
            </tr>
            </thead>

            <?php
                if($resultNo > 0){                                
                    while($row = mysqli_fetch_assoc($getEmployeeRequest)){
                        $ID = $row['requested_sched_ID'];
                        $original_schedule = $row['sched_Date'];
                        $original_shift = $row['shift'];


                        $getUser = mysqli_query($conn, "SELECT first_name, last_name, sched_Date, shift FROM schedule JOIN user on user.user_ID = schedule.user_ID JOIN shift on shift.shift_ID = schedule.shift_ID WHERE schedule_ID = '$ID'");
                        $row2 = mysqli_fetch_assoc($getUser);
                    
                        $employeeID = $row['swap_request_ID'];
                        $name = $row2['first_name']." ".$row2['last_name'];
                        $requested_schedule = $row2['sched_Date'];
                        $requested_shift = $row2['shift'];
                        
                        ?>
                        <div style="overflow-x:auto;">
                        <tbody class="table table-striped">
                            <tr>
                                <td><?php echo $name;?></td>
                                <td><?php echo date("M d, Y - l", strtotime($original_schedule));?></td>
                                <td><?php echo $original_shift;?></td>
                                <td><?php echo date("M d, Y - l", strtotime($requested_schedule));?></td>
                                <td><?php echo $requested_shift;?></td>
                                <?php 

                                if($row['status'] == "PENDING"){
                                    echo "<td bgcolor='#ffa500'><b>".$row['status']."</b></td>";    
                                }elseif($row['status'] == "APPROVED"){
                                    echo "<td bgcolor='#00FF00'><b>".$row['status']."</b></td>";    
                                }else{
                                    echo "<td bgcolor='#FF0000'><b>".$row['status']."</b></td>";    
                                }
                                
                                ?>
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
    <h3>Swap Request Status:(<?php echo date('F Y');?>):</h3>     
     
    <?php
    $getEmployeeRequest = mysqli_query($conn, "SELECT requested_sched_ID, sched_Date, shift, swap_request_ID, status FROM swaprequest JOIN schedule ON schedule.schedule_ID = swaprequest.requester_sched_ID JOIN shift ON shift.shift_ID = schedule.shift_ID JOIN user ON  user.user_ID = schedule.user_ID WHERE user.user_ID = '$check'");


    $resultNo = mysqli_num_rows($getEmployeeRequest);
        
    if (!$resultNo){
        echo ' <h4>There are no requests at the moment. </h4>';
    } 
    else{
    
        ?>
        <table class="table table-hover table-striped table-condensed table-bordered" >
            <thead>
            <tr>
                    <th>Swap with </th>
                    <th>Original Schedule</th>
                    <th>Original Shift</th>
                    <th>Requested Schedule</th>
                    <th>Requested Shift</th>
                    <th>Status</th> 
            </tr>
            </thead>

            <?php
                if($resultNo > 0){                                
                    while($row = mysqli_fetch_assoc($getEmployeeRequest)){
                        $ID = $row['requested_sched_ID'];
                        $original_schedule = $row['sched_Date'];
                        $original_shift = $row['shift'];


                        $getUser = mysqli_query($conn, "SELECT first_name, last_name, sched_Date, shift FROM schedule JOIN user on user.user_ID = schedule.user_ID JOIN shift on shift.shift_ID = schedule.shift_ID WHERE schedule_ID = '$ID'");
                        $row2 = mysqli_fetch_assoc($getUser);
                    
                        $employeeID = $row['swap_request_ID'];
                        $name = $row2['first_name']." ".$row2['last_name'];
                        $requested_schedule = $row2['sched_Date'];
                        $requested_shift = $row2['shift'];
                        
                        ?>
                        <div style="overflow-x:auto;">
                        <tbody class="table table-striped">
                            <tr>
                                <td><?php echo $name;?></td>
                                <td><?php echo date("M d, Y - l", strtotime($original_schedule));?></td>
                                <td><?php echo $original_shift;?></td>
                                <td><?php echo date("M d, Y - l", strtotime($requested_schedule));?></td>
                                <td><?php echo $requested_shift;?></td>
                                <?php 

                                if($row['status'] == "PENDING"){
                                    echo "<td bgcolor='#ffa500'><b>".$row['status']."</b></td>";    
                                }elseif($row['status'] == "APPROVED"){
                                    echo "<td bgcolor='#00FF00'><b>".$row['status']."</b></td>";    
                                }else{
                                    echo "<td bgcolor='#FF0000'><b>".$row['status']."</b></td>";    
                                }
                                
                                ?>
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

    