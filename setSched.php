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



$getEmployee = mysqli_query($conn, "SELECT * FROM user");
$getTime = mysqli_query($conn, "SELECT * FROM timeCheck");
                                
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

<div class="container-fluid">
    <legend><h2>Set Employee Shifts</h2></legend>	

    <?php
    
    if (!$resultNo){
        echo 'Sorry, no resutls were found';
    } 
    else{
    ?>

    <div class="container">
        <div class="row">
            <div class="Absolute-Center is-Responsive">
                <div class="col-sm-12 col-md-10 col-md-offset-0">
                    <h3> All Employees </h3>
                        <table class="table table-hover table-striped table-condensed table-bordered" >
                            <thead>
                                <tr>
                                    <th>ID No</th>
                                    <th>Name</th>
                                    <th>Department</th>                                                
                                    <th>Shift</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Schedule</th>
                                </tr>
                        
                            </thead>
                            
                            <?php
                            if($resultNo > 0){
                                $counter=0;
    
                                while($row = mysqli_fetch_assoc($getEmployee)){
                                    ?>  

                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="addUserForm" method="post"><?php
                                    $row2 = mysqli_fetch_assoc($getTime);
                                       
                                    $user = $row['user_ID'];      
                                    $employeeID = $row['employee_id'];
                                    $name = $row['first_name']." ".$row['middle_name']." ".$row['last_name'];
                                    $department = $row['department'];

                                    ?>
                                    
                                    <div style="overflow-x:auto;">
                                    <tbody class="table table-striped">
                                        <tr>
                                            <td>
                                                <?php echo $employeeID;?>
                                                <input class="form-control" type="hidden" name="usrID<?=$counter?>" value="<?=$user ?>">
                                                <input class="form-control" type="hidden" name="empID<?=$counter?>" value="<?=$employeeID ?>">
                                            </td>
                                                
                                            <td>
                                                <?php echo $name;?>
                                                <input class="form-control" type="hidden" name="name<?=$counter?>" value="<?=$name ?>">
                                            </td>
                                                
                                            <td>
                                                <?php echo $department;?>
                                                <input class="form-control" type="hidden" name="dept<?=$counter?>" value="<?=$department ?>">
                                            </td>
                                                
                                            <td>
                                                <select class="form-control" name="shift<?=$counter?>">
                                                    <option value="" disabled selected>Select Shift</option>
                                                    <option>Morning Shift</option>
                                                    <option>Mid-Day Shift</option>
                                                    <option>GY Shift</option>
                                                </select>                                                
                                            </td>

                                            <td> 
                                                        <div class="form-group input-group">
                                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                                <input class="form-control" type="date"  name='startDate<?=$counter?>' placeholder="Start Date">          
                                                        </div>
                                                </td>

                                                <td>
                                                    <div class="form-group input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                        <input class="form-control" type="date"  name="endDate<?=$counter?>" placeholder="End Date"/>
                                                               
                                                    </div>
                                                </td>

                                                <td>
                                                    <input type="submit" name="submit<?=$counter?>" class="btn btn-def btn-block" value="Set" />
                                                </td>
                                        </tr>
                                        <?php 
                                        $counter++;
                                }
                            }
    }
                
                ?>
                                    </tbody>
                        </table>        
                  
                                    </form>
        </div>    
    </div>
</div>


</div>
<?php include('includes/footer.php'); ?>