<?php require_once('includes/header.php'); 


$dept_check = $_SESSION["dept_check"];
$check = $_SESSION['check'];
$username = $_SESSION['username'];
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
$department = $_SESSION['department'];



 if ($_SESSION['dept_check']!="emp"){
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index2.php");
 }

    
include('includes/navbar.php');
include('includes/sidebar.php');   
$getEmployee = mysqli_query($conn, "SELECT * FROM user");
$getTime = mysqli_query($conn, "SELECT * FROM timeCheck");
$getShift = mysqli_query($conn, "SELECT * FROM shift");
                                
$resultNo = mysqli_num_rows($getEmployee);
//While loop that checks which info is submitted
$itr=0;
while($resultNo > $itr){
    $submit = "submit" . $itr;
    if(isset($_POST[$submit])){
        $edate = "endDate" . $itr;
        $sdate = "startDate" . $itr;
        $shift = "shift" . $itr;
        $name = "name" . $itr;
        $empID = "empID" . $itr;
        $usrID = "usrID" . $itr;
        $dept = "dept" . $itr;
        $edate = $_POST[$edate];
        $sdate = $_POST[$sdate];
        $shift = $_POST[$shift];
        $empID = $_POST[$empID];
        $usrID = $_POST[$usrID];
        $name = $_POST[$name];
        $dept = $_POST[$dept];
        if($shift == "Morning Shift"){
            $shiftID = 1;
        } 
        else if ($shift == "Mid-Day Shift"){
            $shiftID = 2;
        }
        else {
            $shiftID = 3;
        }
        $start_date = $sdate;
        $end_date = $edate;
        $created_at = date("Y:m:d H:i:s");
        if ($edate < $sdate){
            ?> <script> alert ("Incorrect Date Range! Please double check start and end date for schedule.")</script><?php
        }
        else {
            $strtdate = date('F d Y', strtotime($sdate));
            $enddate = date('F d Y', strtotime($edate));
            ?> <script> alert ("New schedule set for <?=$name?>!"+"\n"+"Schedule date from: <?=$strtdate?> to <?=$enddate?>"+"\n"+"Shift: <?=$shift?>")</script><?php
            //Check and loops the number of days (range from start to end date)
            while (strtotime($start_date) <= strtotime($end_date)) {
                //query to check if input schedule date is existing or not
                $getSchedule = mysqli_query($conn, "SELECT * FROM schedule where sched_Date ='$start_date' AND user_ID = '$usrID'");
                $resultNo2 = mysqli_num_rows($getSchedule);
                //inserts schedule date if not existing
                if(!$resultNo2){
                    $sql = "INSERT INTO schedule (sched_date, created_at, user_ID, shift_ID) VALUES('$start_date', '$created_at','$usrID', '$shiftID')";
                    $query = mysqli_query($conn,$sql);
                }
                
                //updates schedule date if existing
                else {
                    $setSchedule = mysqli_query($conn, "UPDATE schedule SET shift_ID = '".$shiftID."', created_at = '".$created_at."' WHERE sched_Date ='$start_date' AND user_ID = '$usrID'");
                }
                //adds 1 day until it reaches end date
                $start_date = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)));    
            }
        }
    }
    $itr++;
}
?>

<style type="text/css"><?php include('includes/common.css'); ?></style>
 
    <h2>Swap Schedule</h2>  

     <?php
        $getID  = $_GET['IDval'];
        $getOGSched = mysqli_query($conn, "SELECT first_name, last_name, schedule_ID, sched_Date, shift, department from schedule JOIN shift ON schedule.shift_ID = shift.shift_ID JOIN user ON schedule.user_ID = user.user_ID WHERE schedule.schedule_ID = '$getID' ");
        
                        
        $resultNo = mysqli_num_rows($getOGSched);
        
        if (!$resultNo){
                echo 'Sorry, no resutls were found';
        } else{
                ?>

        <!-- <div class="container"> -->
                <div class="row">
                        <div class="Absolute-Center is-Responsive">
                                <div class="col-sm-12 col-md-10 col-md-offset-0">
                        <h3> Original Schedule Detail </h3>
                        <table class="table table-hover table-striped table-condensed table-bordered" >
                                <thead>
                                        <tr>
                                                <th>Name</th>
                                                <th>Schedule Date</th>
                                                <th>Shift</th>
                                                <th>Department</th>
                                        </tr>
                                </thead>
                        <?php
                        if($resultNo > 0){
                                
                                while($row = mysqli_fetch_assoc($getOGSched)){
                                    $OGName = $row['first_name']. " ".$row['last_name'];
                                    $test = date('Y-m-d',strtotime($row['sched_Date']));
                                    $OGSched = date('F d, Y - l',strtotime($row['sched_Date']));
                                    $OGShift = $row['shift'];
                                    $OGDept = $row['department'];
                                        ?>
                   <div style="overflow-x:auto;">
                        
                        <tbody class="table table-striped">
                                        <tr>
                                                <td><?php echo $OGName;?></a></td>
                                                <td><?php echo $OGSched;?></td>
                                                <td><?php echo $OGShift;?></td>
                                                <td><?php echo $OGDept;?></td>                                                
                                        </tr>

                <?php 
                                        }
                                }
                        }
                
                ?>
                        </tbody>
                </table>        
                        
                        </div>    
                </div>
        </div>
</div>





<br>
<form action="swapResultRequest.php" method="post" target="my_iframe1">
        <font size="5"><b>Swap Date:</b></font>
        <input type="date" name='dateSearch1' value="<?php echo date('m/d/Y', strtotime($test));?>" ">
        <input type="submit" class="btn btn-def" name='searchDate1' value="Search" />
</form>
    <iframe width=900px height=450px src=<?php echo "swapResultRequest.php"?> frameborder="no" scrolling="yes" name="my_iframe1" id="my_iframe1"></iframe>
 
</div>
<?php include('includes/footer.php'); ?>