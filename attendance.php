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


if(isset($_POST['searchDate2'])){
    

    $START1 = $_POST['dateSearch2']."-01";
    $END1 = date('Y-m-t',strtotime($START1));

    $viewSchedule = mysqli_query($conn,"SELECT user.employee_ID, user.first_name, user.last_name, user.department, schedule.sched_Date, shift.shift, schedule.created_at FROM schedule JOIN shift ON schedule.shift_ID = shift.shift_ID JOIN user ON schedule.user_ID = user.user_ID WHERE schedule.user_ID = '$check' AND schedule.sched_Date  BETWEEN '$START1' AND '$END1' ORDER BY  schedule.sched_Date");
    $resultNo2 = mysqli_num_rows($viewSchedule);

    $viewAttendance = mysqli_query($conn,"SELECT *  FROM timecheck WHERE user_ID = '$check' AND login_date  BETWEEN '$START1' AND '$END1' ORDER BY  login_date");
    $resultNo2 = mysqli_num_rows($viewSchedule);

    
    if($resultNo2 > 0){             
        ?>
            <h3> Attendance Status (<?php echo date('F Y', strtotime($START1))?>) </h3>
                        <table class="table table-hover table-striped table-condensed table-bordered" >
                            <thead>
                                <tr>
                                    <th>Schedule Date</th>
                                    <th>Log in Time:</th>
                                    <th>Log out Time:</th>
                                    <th>Status (tentative)</th>
                                </tr>
                        
                            </thead>  
        <?php
        // $row = mysqli_fetch_assoc($viewSchedule);
        while($getAttendance = mysqli_fetch_assoc($viewAttendance)){
            // for ($i =0; $i < $END; $i++){


            //$printID = $getAttendance['employee_ID'];
            //$printName = $row['first_name'] . " ". $row['last_name'];
            //$printDepartment = $row['department'];
            $printLoginDate = $getAttendance['login_date'];
            $printLoginTime = $getAttendance['login_time'];
            $printLogoutTime = $getAttendance['logout_time'];
            $printSchedStatus = $getAttendance['sched_status'];
            

            ?>
            <div style="overflow-x:auto;">
                                    <tbody class="table table-striped">
                                
                                        <tr>
                                            <td>
                                                <?php echo date("M d, Y - l", strtotime($printLoginDate));?>
                                            </td>

                                            <td>
                                                <?php echo $printLoginTime;?>
                                            </td>

                                            <td>
                                                <?php

                                                if($printLogoutTime == null){
                                                    echo "<b>You are currently Logged in</b>";
                                                }else{
                                                    echo $printLogoutTime;    
                                                }
                                                ?>
                                            </td>

                                             <td>
                                                <?php

                                                if($printSchedStatus == null){
                                                    echo "<b>You are currently Logged in</b>";
                                                }else{
                                                    echo $printSchedStatus;    
                                                }
                                                ?>
                                            </td>

                                        </tr>
                                    </tbody>

            <?php 
        }
    }
    else {
        echo "<h4>There are no attendace for the month of ".date('F Y',strtotime($START1))." yet.</h4>";
    }

?> </table>

</div>

<?php  
} 
else{

    $viewSchedule = mysqli_query($conn,"SELECT user.employee_ID, user.first_name, user.last_name, user.department, schedule.sched_Date, shift.shift, schedule.created_at FROM schedule JOIN shift ON schedule.shift_ID = shift.shift_ID JOIN user ON schedule.user_ID = user.user_ID WHERE schedule.user_ID = '$check' AND schedule.sched_Date  BETWEEN '$START' AND '$END' ORDER BY  schedule.sched_Date");
    $resultNo2 = mysqli_num_rows($viewSchedule);

    $viewAttendance = mysqli_query($conn,"SELECT *  FROM timecheck WHERE user_ID = '$check' AND login_date  BETWEEN '$START' AND '$END' ORDER BY  login_date");
    $resultNo2 = mysqli_num_rows($viewSchedule);

    
    if($resultNo2 > 0){             
        ?>
        <h3> Attendance Status (<?php echo date('F Y')?>) </h3>
                        <table class="table table-hover table-striped table-condensed table-bordered" >
                            <thead>
                                <tr>
                                    <th>Schedule Date</th>
                                    <th>Log in Time:</th>
                                    <th>Log out Time:</th>
                                    <th>Status (tentative)</th>
                                </tr>
                        
                            </thead>  
        <?php
        // $row = mysqli_fetch_assoc($viewSchedule);
        while($getAttendance = mysqli_fetch_assoc($viewAttendance)){
            // for ($i =0; $i < $END; $i++){


            //$printID = $getAttendance['employee_ID'];
            //$printName = $row['first_name'] . " ". $row['last_name'];
            //$printDepartment = $row['department'];
            $printLoginDate = $getAttendance['login_date'];
            $printLoginTime = $getAttendance['login_time'];
            $printLogoutTime = $getAttendance['logout_time'];
            $printSchedStatus = $getAttendance['sched_status'];
            

            ?>
            <div style="overflow-x:auto;">
                                    <tbody class="table table-striped">
                                
                                        <tr>
                                            <td>
                                                <?php echo date("M d, Y - l", strtotime($printLoginDate));?>
                                            </td>

                                            <td>
                                                <?php echo $printLoginTime;?>
                                            </td>

                                            <td>
                                                <?php

                                                if($printLogoutTime == null){
                                                    echo "<b>You are currently Logged in</b>";
                                                }else{
                                                    echo $printLogoutTime;    
                                                }
                                                ?>
                                            </td>

                                             <td>
                                                <?php

                                                if($printSchedStatus == null){
                                                    echo "<b>You are currently Logged in</b>";
                                                }else{
                                                    echo $printSchedStatus;    
                                                }
                                                ?>
                                            </td>

                                        </tr>
                                    </tbody>

            <?php 
        }
    }
    else {
        echo "<h4>There are no attendance for the month of ".date('F Y',strtotime($START1))." yet.</h4>";
    }

?> </table>

</div>

<?php

}

?>
<!-- 
<FORM>
<INPUT TYPE="button" class="btn btn-def" onClick="window.print()" value="Print">
</FORM> -->
    