<?php require_once('includes/header.php'); 

$userID = $_SESSION['check'];
$department = $_SESSION['department'];
$dept_check = $_SESSION['department'];
if ($dept_check != "SuperAdmin"){
    $team = $_SESSION['team'];
}



if (isset($_POST['approve'])){
  $created_at = date('Y-m-d');
  

    $test = $_POST['requestid'];
    $requester_sched_ID = $_POST['requester_sched_id'];
    $requested_sched_ID = $_POST['requested_sched_id'];
    $requester_user_ID = $_POST['requester_user_id'];
    $requested_user_ID = $_POST['requested_user_id'];


    $sql = "UPDATE swaprequest SET status ='APPROVED', approval_date = '$created_at' WHERE swap_request_ID = '$test' ";
    $query = mysqli_query($conn,$sql);
    
    $updateRequesterSchedule = mysqli_query($conn, "UPDATE schedule SET user_ID = '$requester_user_ID' WHERE schedule_ID = '$requested_sched_ID'"); 
    $updateRequestedSchedule = mysqli_query($conn, "UPDATE schedule SET user_ID = '$requested_user_ID' WHERE schedule_ID = '$requester_sched_ID'");



    header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/adminpage.php");


  }

if (isset($_POST['decline'])){
    $created_at = date('Y-m-d');

    $test = $_POST['requestid'];
    $sql = "UPDATE swaprequest SET status ='DECLINED', approval_date = '$created_at' WHERE swap_request_ID = '$test' ";
    $query = mysqli_query($conn,$sql);


  header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/adminpage.php");


  }

?>



<?php 
 if (!in_array($_SESSION['department'], array('Admin', 'SuperAdmin', 'AdminNOC', 'AdminFS', 'AdminCS'))) {
  header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index2.php");
}
?>
<style type="text/css"><?php include('includes/common.css'); ?></style>
<?php include('includes/navbar.php'); ?>
<?php include('includes/adminsidebar.php'); ?>

<div class="container-fluid">

	       
       <div class="container-fluid">
        
        <legend><h3>Request Details:</h3></legend>     
 

<?php 


$getID  = $_GET['IDval'];


if ($dept_check == "SuperAdmin"){
        $getEmployeeRequest = mysqli_query($conn, "SELECT swaprequest.requester_user_ID, first_name, last_name, requested_sched_ID, requester_sched_ID, sched_Date, shift, swap_request_ID, date_requested, status FROM swaprequest JOIN schedule ON schedule.schedule_ID = swaprequest.requester_sched_ID JOIN shift ON shift.shift_ID = schedule.shift_ID JOIN user ON  user.user_ID = swaprequest.requester_user_ID  WHERE swap_request_ID = '$getID'");        
    }
    else{
        $getEmployeeRequest = mysqli_query($conn, "SELECT swaprequest.requester_user_ID, first_name, last_name, requested_sched_ID, requester_sched_ID, sched_Date, shift, swap_request_ID, date_requested, status FROM swaprequest JOIN schedule ON schedule.schedule_ID = swaprequest.requester_sched_ID JOIN shift ON shift.shift_ID = schedule.shift_ID JOIN user ON  user.user_ID = swaprequest.requester_user_ID WHERE user.department = '$team' AND swap_request_ID = '$getID'");
    }
    
    $resultNo = mysqli_num_rows($getEmployeeRequest);





?>



<table class="table table-hover table-striped table-condensed table-bordered" >
            <thead>
            <tr>
                    <th>Requester </th>
                    <th>Original Schedule</th>
                    <th>Original Shift</th>
                    <th>Swap with </th>
                    <th>Requested Schedule</th>
                    <th>Requested Shift</th>
                    <th>Date Requested</th>
                    <th colspan="2" style="text-align:center";> Action </th>
                    
                    
            </tr>
            </thead>

            <?php
                if($resultNo > 0){                                
                    while($row = mysqli_fetch_assoc($getEmployeeRequest)){
                        $original_schedule = $row['sched_Date'];
                        $original_shift = $row['shift'];
                        $requester_name = $row['first_name']." ".$row['last_name'];
                        $date_requested = $row['date_requested'];


                        $requestID = $row['swap_request_ID'];
                        $requester_sched_ID = $row['requester_sched_ID'];
                        $requested_sched_ID = $row['requested_sched_ID'];
                        $requester_user_ID = $row['requester_user_ID'];
                        

                        $getUser = mysqli_query($conn, "SELECT user.user_ID, first_name, last_name, sched_Date, shift FROM schedule JOIN user on user.user_ID = schedule.user_ID JOIN shift on shift.shift_ID = schedule.shift_ID WHERE schedule_ID = '$requested_sched_ID'");
                        $row2 = mysqli_fetch_assoc($getUser);
                        
                        
                        $requested_name = $row2['first_name']." ".$row2['last_name'];
                        $requested_schedule = $row2['sched_Date'];
                        $requested_shift = $row2['shift'];


                        
                        $requested_user_ID = $row2['user_ID'];


                        ?>
                        <div style="overflow-x:auto;">
                        <tbody class="table table-striped">
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="swaprequestform" method="post">
                            <tr>
                                <td><?php echo $requester_name;?></td>
                                <td><?php echo date("M d, Y - l", strtotime($original_schedule));?></td>
                                <td><?php echo $original_shift;?>
                                <td><?php echo $requested_name;?></td>
                                <td><?php echo date("M d, Y - l", strtotime($requested_schedule));?></td>
                                <td><?php echo $requested_shift;?>
                                <td><?php echo date("M d, Y", strtotime($date_requested));?></td>
                                <input class="form-control" type="hidden" name='requestid' value="<?=$requestID ?>">
                                <input class="form-control" type="hidden" name='requester_sched_id' value="<?=$requester_sched_ID ?>">
                                <input class="form-control" type="hidden" name='requested_sched_id' value="<?=$requested_sched_ID ?>">
                                <input class="form-control" type="hidden" name='requester_user_id' value="<?=$requester_user_ID ?>">
                                <input class="form-control" type="hidden" name='requested_user_id' value="<?=$requested_user_ID ?>">
                                <td> <input type="submit" name="approve" class="btn btn-def btn-block" value="Approve" /> </td>
                                <td> <input type="submit" name="decline" class="btn btn-def btn-block" value="Decline" /> </td>
                            </tr>
                            </form>
                            <?php 
                    }
                }
    
    ?>
                        </tbody>
        </table> 
  </div>
</div>

<br><br>
<form action="adminDisplaySchedule.php" method="post" target="my_iframe2">
        <font size="5"><b>Reference Schedule:</b></font>
        <input type="month" name='dateSearch2' value="<?php echo date('Y-m');?>" ">
        <input type="submit" class="btn btn-def" name='searchDate2' value="Search" />
    </form>
    <iframe width=1200px height=350px src=<?php echo "adminDisplaySchedule.php"?> frameborder="no" scrolling="yes" name="my_iframe2" id="my_iframe2"></iframe>


<?php include('includes/footer.php'); ?>