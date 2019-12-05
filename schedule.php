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

$year = "2019";
$month = "12";
$START = date('Y-m-01');
$END = date('Y-m-t',strtotime('this month'))."<br>";

?>



<?php     


if(isset($_POST['searchDate1'])){
    $START1 = $_POST['dateSearch1']."-01";
    $END1 = date('Y-m-t',strtotime($START1));

    $viewSchedule = mysqli_query($conn,"SELECT user.employee_ID, user.first_name, user.last_name, user.department, schedule.sched_Date, shift.shift, schedule.created_at FROM schedule JOIN shift ON schedule.shift_ID = shift.shift_ID JOIN user ON schedule.user_ID = user.user_ID WHERE schedule.user_ID = '$check' AND schedule.sched_Date  BETWEEN '$START1' AND '$END1' ORDER BY  schedule.sched_Date");
    $resultNo2 = mysqli_num_rows($viewSchedule);


    if($resultNo2 > 0){             
        ?>
        <h3> Schedule (<?php echo date('F Y', strtotime($START1))?>): </h3>
                        <table class="table table-hover table-striped table-condensed table-bordered" >
                            <thead>
                                <tr>
                                    <th>Schedule Date</th>
                                    <th>Shift</th>
                                    <th>Schedule updated as of:</th>
                                </tr>
                        
                            </thead>  
        <?php
        // $row = mysqli_fetch_assoc($viewSchedule);
        while($row = mysqli_fetch_assoc($viewSchedule)){
            // for ($i =0; $i < $END; $i++){


            $printID = $row['employee_ID'];
            $printName = $row['first_name'] . " ". $row['last_name'];
            $printDepartment = $row['department'];
            $printDate = $row['sched_Date'];
            $printShift = $row['shift'];
            $printCreatedat = $row['created_at'];
            

            ?>
            <div style="overflow-x:auto;">
                                    <tbody class="table table-striped">
                                
                                        <tr>
                                            <td>
                                                <?php echo date("M d, Y - l", strtotime($printDate));?>
                                            </td>

                                            <td>
                                                <?php echo $printShift;?>
                                            </td>

                                            <td>
                                                <?php echo date("M d, Y - H:i:s", strtotime($printCreatedat));?>
                                            </td>

                                        </tr>
                                    </tbody>

            <?php 
        }
    }
    else {
        echo "<h4>There are no schedule assigned for the month of ".date('F Y',strtotime($START1))." yet.</h4>";
    }

?> </table>

</div>

<?php

    
} else{

    $viewSchedule = mysqli_query($conn,"SELECT user.employee_ID, user.first_name, user.last_name, user.department, schedule.sched_Date, shift.shift, schedule.created_at FROM schedule JOIN shift ON schedule.shift_ID = shift.shift_ID JOIN user ON schedule.user_ID = user.user_ID WHERE schedule.user_ID = '$check' AND schedule.sched_Date  BETWEEN '$START' AND '$END' ORDER BY  schedule.sched_Date");
    $resultNo2 = mysqli_num_rows($viewSchedule);

    
    if($resultNo2 > 0){             
        ?>
            <h3> Schedule (<?php echo date('F Y')?>): </h3>
                        <table class="table table-hover table-striped table-condensed table-bordered" >
                            <thead>
                                <tr>
                                    <th>Schedule Date</th>
                                    <th>Shift</th>
                                    <th>Schedule updated as of:</th>
                                </tr>
                        
                            </thead>  
        <?php
        // $row = mysqli_fetch_assoc($viewSchedule);
        while($row = mysqli_fetch_assoc($viewSchedule)){
            // for ($i =0; $i < $END; $i++){


            $printID = $row['employee_ID'];
            $printName = $row['first_name'] . " ". $row['last_name'];
            $printDepartment = $row['department'];
            $printDate = $row['sched_Date'];
            $printShift = $row['shift'];
            $printCreatedat = $row['created_at'];
            

            ?>
            <div style="overflow-x:auto;">
                                    <tbody class="table table-striped">
                                
                                        <tr>
                                            <td>
                                                <?php echo date("M d, Y - l", strtotime($printDate));?>
                                            </td>

                                            <td>
                                                <?php echo $printShift;?>
                                            </td>

                                            <td>
                                                <?php echo date("M d, Y - H:i:s", strtotime($printCreatedat));?>
                                            </td>

                                        </tr>
                                    </tbody>

            <?php 
        }
    }
    else {
        echo "<h4>There are no schedule assigned for the month of ".date('F Y')." yet.</h4>";
    }

?> </table>

</div>
<?php
}

?>


    