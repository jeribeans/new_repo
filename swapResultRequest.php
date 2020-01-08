<?php
require_once('includes/header.php'); 


$dept_check = $_SESSION["dept_check"];
$check = $_SESSION['check'];
$username = $_SESSION['username'];
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
$department = $_SESSION['department'];



 if ($_SESSION['dept_check']!="emp"){
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index2.php");
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

        $requestedID = "requestedID" . $itr;
        $SwapName = "SwapName".$itr;
        
        $requestedID = $_POST[$requestedID];
        $requesterID = $_POST['requesterID'];
        $SwapName = $_POST[$SwapName];
        
        $created_at = date("Y-m-d");
        

        
        $swapRequest = mysqli_query($conn, "INSERT INTO swaprequest (requester_sched_ID, requested_sched_ID, date_requested, status) VALUES('$requesterID', '$requestedID','$created_at', 'PENDING')");
        if (!$swapRequest){
            ?> <script> alert ("Error while submitting swap request, please try again.")</script><?php
        }else{
            ?> <script> alert ("Swap request submitted successfully!")</script><?php
        }        
        
    }
    $itr++;
}


?>


<?php     
if(isset($_POST['searchDate1'])){
    
    $START1 = $_POST['dateSearch1'];
    $END1 = date('Y-m-t',strtotime($START1));
    $requesterID = $_POST['requesterID'];
    ?>

     <?php
        
        $getOGSched = mysqli_query($conn, "SELECT first_name, last_name, schedule_ID, sched_Date, shift, department from schedule JOIN shift ON schedule.shift_ID = shift.shift_ID JOIN user ON schedule.user_ID = user.user_ID WHERE schedule.sched_Date = '$START1' ORDER BY shift.shift_ID");
        
                        
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
                                    $SwapSched = date('M d, Y - l',strtotime($row['sched_Date']));
                                    $SwapShift = $row['shift'];
                                    $SwapDept = $row['department'];
                                    $requestedID = $row['schedule_ID'];
                                    ?>
                                           
                        <tbody class="table table-striped">
                                        <tr>
                                             
                                            <form action="swapResultRequest.php" method="post" >
                                                <td><input type="text" name='SwapName<?=$counter?>' value="<?php echo $SwapName;?>" readonly="true" "></td>
                                                <td><input type="text" name='SwapDate' value="<?php echo $SwapSched;?>" readonly="true" "></td>
                                                <td><input type="text" name='SwapShift' value="<?php echo $SwapShift;?>" readonly="true" "></td>
                                                <td><input type="text" name='SwapDept' value="<?php echo $SwapDept;?>" readonly="true" "></td>
                                                <input class="form-control" type="hidden" name='requestedID<?=$counter?>' value="<?php echo $requestedID; ?>">
                                                <input class="form-control" type="hidden" name='requesterID' value="<?php echo $requesterID; ?>">
                                                <td><input type="submit" class="btn btn-def" name='submit<?=$counter?>' value="Request Swap" /></td>
                                                
                                            </form>
                                            
                                        </tr>
                <?php 
                                        }
                                }
                        }
                } else {
                    echo "<h3>Please Enter Valid Date </h3>";
                }
                ?>
                        </tbody>
                </table>        