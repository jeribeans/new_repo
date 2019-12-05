
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


$START = date('Y-m-01')."<br>";
$END = date('Y-m-t',strtotime('this month'))."<br>";

?>
<style type="text/css"><?php include('includes/common.css'); ?></style>
<?php 
include('includes/navbar.php');
include('includes/sidebar.php');
?>


<div class="container-fluid">
	<LEGEND><h2>Employee Homepage</h2></LEGEND>
             
    <iframe width=800px height=450px src=<?php echo "schedule.php"?> frameborder="yes" scrolling="yes" name="my_iframe1" id="my_iframe1"></iframe>
    <form action="schedule.php" method="post" target="my_iframe1">
        <b>Search Schedule Date:</b>
        <input type="month" name='dateSearch1' value="<?php echo date('Y-m');?>" ">
        <input type="submit" class="btn btn-def" name='searchDate1' value="Search" />
    </form>

                    
                    
<?php     
    
	//SELECT * FROM schedule WHERE sched_Date BETWEEN "2019-11-01" $START AND "2019-11-30" $END;

	//SELECT *  FROM schedule JOIN shift ON schedule.shift_ID = shift.shift_ID JOIN user ON schedule.user_ID = user.user_ID JOIN timecheck on user.user_ID = timecheck.user_ID 
	//WHERE timecheck.login_date = schedule.sched_Date ORDER BY schedule.sched_Date;


    $viewSchedule = mysqli_query($conn,"SELECT user.employee_ID, user.first_name, user.last_name, user.department, schedule.sched_Date, shift.shift, schedule.created_at FROM schedule JOIN shift ON schedule.shift_ID = shift.shift_ID JOIN user ON schedule.user_ID = user.user_ID WHERE schedule.user_ID = '$check' AND schedule.sched_Date  BETWEEN '$START' AND '$END' ORDER BY  schedule.sched_Date");
    $resultNo2 = mysqli_num_rows($viewSchedule);

    
?>


<!-- <div class="container">
        <div class="row">
            <div class="Absolute-Center is-Responsive">
                <div class="col-sm-12 col-md-10 col-md-offset-0"> -->
                    
                    <iframe width=800px height=450px src=<?php echo "attendance.php"?> frameborder="yes" scrolling="yes" name="my_iframe2" id="my_iframe2"></iframe>
                    <form action="attendance.php" method="post" target="my_iframe2">
                        <b>Search Attendance Date:</b>
                        <input type="month" name='dateSearch2' value="<?php echo date('Y-m');?>" ">
                        <input type="submit" class="btn btn-def" name='searchDate2' value="Search" />
                    </form>


<?php     
    
    //SELECT * FROM schedule WHERE sched_Date BETWEEN "2019-11-01" $START AND "2019-11-30" $END;

    //SELECT *  FROM schedule JOIN shift ON schedule.shift_ID = shift.shift_ID JOIN user ON schedule.user_ID = user.user_ID JOIN timecheck on user.user_ID = timecheck.user_ID 
    //WHERE timecheck.login_date = schedule.sched_Date ORDER BY schedule.sched_Date;


    ?>




<div class="container-fluid">
    
    
    <h3>Pending Request (<?php echo date('F Y');?>):</h3>     
     
    <?php
    $getEmployeeRequest = mysqli_query($conn, "SELECT * FROM request WHERE user_ID = '$check' AND request_Date BETWEEN '$START' AND '$END'");
    
    $resultNo = mysqli_num_rows($getEmployeeRequest);
        
    if (!$resultNo){
        echo ' <h4>There are no pending requests at the moment. </h4>';
    } 
    else{
    
        ?>
        <table class="table table-hover table-striped table-condensed table-bordered" >
            <thead>
            <tr>
                    <th>Leave type</th>
                    <th>Leave Date (Start to End)</th>
                    <th>Reason</th>
                    <th>Status</th>
            </tr>
            </thead>

            <?php
                if($resultNo > 0){                                
                    while($row = mysqli_fetch_assoc($getEmployeeRequest)){
                        $ID = $row['user_ID'];
                        $getUser = mysqli_query($conn, "SELECT * FROM user WHERE user_id = '$ID'");
                        $row2 = mysqli_fetch_assoc($getUser);
                    
                        $employeeID = $row['request_ID'];
                        $name = $row2['first_name']." ".$row2['middle_name']." ".$row2['last_name'];
                        $department = $row2['department'];
                        ?>
                        <div style="overflow-x:auto;">
                        <tbody class="table table-striped">
                            <tr>
                                <td><?php echo $row['leave_type'];?></td>
                                <td><?php echo date("M d, Y - l", strtotime($row['start_Date']))." to ".date("M d, Y - l", strtotime($row['end_Date']));?></td>
                                <td><?php echo $row['reason'];?></a></td>
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






<?php include('includes/footer.php'); ?>