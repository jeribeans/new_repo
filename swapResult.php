<?php
require_once('includes/header.php'); 

if (!in_array($_SESSION['department'], array('SuperAdmin', 'AdminNOC', 'AdminFS', 'AdminCS'))) {
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

$getEmployee = mysqli_query($conn, "SELECT * FROM user");
// $getTime = mysqli_query($conn, "SELECT * FROM timeCheck");
// $getShift = mysqli_query($conn, "SELECT * FROM shift");
                                
$resultNo = mysqli_num_rows($getEmployee);
//While loop that checks which info is submitted


$itr=0;

while($resultNo > $itr){

    $submit = "submit" . $itr;

    if(isset($_POST[$submit])){


        $SwapUserID = "SwapID".$itr;
        $SwapSchedID = "SwapSchedID".$itr;
        $OGSCHEDID = "OGSCHEDID".$itr;
        $OGUSERID = "OGUSERID".$itr;

        $SwapUserID = $_POST[$SwapUserID];
        $SwapSchedID = $_POST[$SwapSchedID];
        $OGSCHEDID = $_POST[$OGSCHEDID];
        $OGUSERID = $_POST[$OGUSERID];

                
        
        
        $created_at = date("Y-m-d");
        

        $updateRequesterSchedule = mysqli_query($conn, "UPDATE schedule SET user_ID = '$OGUSERID' WHERE schedule_ID = '$SwapSchedID'"); 
        $updateRequestedSchedule = mysqli_query($conn, "UPDATE schedule SET user_ID = '$SwapUserID' WHERE schedule_ID = '$OGSCHEDID'");
        echo "<script>window.parent.location.reload();</script>";
        ?> <script> alert ("Swap schedule successful!")</script><?php

        

        
        
        
        
    }
    $itr++;
}





?>





<?php     
if(isset($_POST['searchDate1'])){
    
    $START1 = $_POST['dateSearch1'];
    $END1 = date('Y-m-t',strtotime($START1));
    $OGSchedID = $_POST['originalschedid'];

    ?>
<!--     <style type="text/css"><?php include('includes/common.css'); ?></style>
 
     -->

     <?php
        $getOGSched2 = mysqli_query($conn, "SELECT first_name, last_name, schedule_ID, sched_Date, shift, department, schedule.user_ID, schedule.schedule_ID from schedule JOIN shift ON schedule.shift_ID = shift.shift_ID JOIN user ON schedule.user_ID = user.user_ID WHERE schedule.schedule_ID = '$OGSchedID'");

        $row2 = mysqli_fetch_assoc($getOGSched2);
        $OG_user_ID = $row2['user_ID'];
        


        $getOGSched = mysqli_query($conn, "SELECT first_name, last_name, schedule_ID, sched_Date, shift, department, schedule.user_ID, schedule.schedule_ID from schedule JOIN shift ON schedule.shift_ID = shift.shift_ID JOIN user ON schedule.user_ID = user.user_ID WHERE schedule.sched_Date = '$START1' ORDER BY shift.shift_ID");
        
                        
        $resultNo = mysqli_num_rows($getOGSched);
        
        if (!$resultNo){
                echo 'Sorry, no resutls were found';
        } else{
                ?>

                        <table class="table table-hover table-striped table-condensed table-bordered" >
                                <thead>
                                        <tr>
                                                <th>Name</th>
                                                <th>Schedule Date</th>
                                                <th>Shift</th>
                                                <th>Department</th>
                                                <th>Action</th>
                                        </tr>
                                </thead>
                        <?php
                        if($resultNo > 0){
                                $counter=0;
                                while($row = mysqli_fetch_assoc($getOGSched)){
                                    $SwapName = $row['first_name']. " ".$row['last_name'];
                                    $test = date('Y-m-d',strtotime($row['sched_Date']));
                                    $SwapSched = date('M d, Y - l',strtotime($row['sched_Date']));
                                    $SwapShift = $row['shift'];
                                    $SwapDept = $row['department'];
                                    $SwapUserID = $row['user_ID'];
                                    $SwapSchedID = $row['schedule_ID'];
                                        ?>
                   <!-- <div style="overflow-x:auto;"> -->
                        
                        <tbody class="table table-striped">
                                        <tr>
                                             
                                            <form action="swapResult.php" method="post" target="my_iframe1">
                                                <td><input type="text" name='SwapName<?=$counter?>' value="<?php echo $SwapName;?>" readonly="true"></td>
                                                <td><input type="text" name='SwapDate<?=$counter?>' value="<?php echo $SwapSched;?>" readonly="true" "></td>
                                                <td><input type="text" name='SwapShift<?=$counter?>' value="<?php echo $SwapShift;?>" readonly="true" "></td>
                                                <td><input type="text" name='SwapDept<?=$counter?>' value="<?php echo $SwapDept;?>" readonly="true" "></td>
                                                <input type="hidden" name='SwapID<?=$counter?>' value="<?php echo $SwapUserID;?>" readonly="true" ">
                                                <input type="hidden" name='SwapSchedID<?=$counter?>' value="<?php echo $SwapSchedID;?>" readonly="true" ">
                                                <input type="hidden" name='OGSCHEDID<?=$counter?>' value="<?php echo $OGSchedID;?>" readonly="true" ">
                                                <input type="hidden" name='OGUSERID<?=$counter?>' value="<?php echo $OG_user_ID;?>" readonly="true" ">
                                                <td><input type="submit" class="btn btn-def" name='submit<?=$counter?>' value="Swap" /></td>
                                                
                                            </form>
                                            
                                        </tr>
                <?php 
                                        $counter++;
                                        }
                                }
                        }
                } else {
                    echo "<h3>Please Enter Valid Date </h3>";
                }
                ?>
                        </tbody>
                </table>        
                        
            