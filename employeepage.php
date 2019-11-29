
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

<!-- <div class="container">
        <div class="row">
            <div class="Absolute-Center is-Responsive">
                <div class="col-sm-12 col-md-10 col-md-offset-0"> -->
                    <h3> Schedule as of <?php echo date('F Y')?> </h3>


<?php     
    
	//SELECT * FROM schedule WHERE sched_Date BETWEEN "2019-11-01" $START AND "2019-11-30" $END;

	//SELECT *  FROM schedule JOIN shift ON schedule.shift_ID = shift.shift_ID JOIN user ON schedule.user_ID = user.user_ID JOIN timecheck on user.user_ID = timecheck.user_ID 
	//WHERE timecheck.login_date = schedule.sched_Date ORDER BY schedule.sched_Date;


    $viewSchedule = mysqli_query($conn,"SELECT user.employee_ID, user.first_name, user.last_name, user.department, schedule.sched_Date, shift.shift  FROM schedule JOIN shift ON schedule.shift_ID = shift.shift_ID JOIN user ON schedule.user_ID = user.user_ID WHERE schedule.user_ID = '$check' AND schedule.sched_Date  BETWEEN '$START' AND '$END' ORDER BY  schedule.sched_Date");
    $resultNo2 = mysqli_num_rows($viewSchedule);

    
    if($resultNo2 > 0){             
    	?>
                        <table class="table table-hover table-striped table-condensed table-bordered" >
                            <thead>
                                <tr>
                                    <th>Schedule Date</th>
                                    <th>Shift</th>
                                </tr>
                        
                            </thead>  
        <?php
        // $row = mysqli_fetch_assoc($viewSchedule);
        while($row = mysqli_fetch_assoc($viewSchedule)){
        	// for ($i =0; $i < $END; $i++){


            $printID = $row['employee_ID'];
            $printName = $row['first_name'] . " ". $row['last_name'];
            $printDepartment = $row['department']."<br>";
            $printDate = $row['sched_Date']."<br>";
            $printShift = $row['shift']."<br>";

            ?>
            <div style="overflow-x:auto;">
                                    <tbody class="table table-striped">
                                
                                        <tr>
                                            <td>
                                                <?php echo $printDate;?>
                                            </td>

                                            <td>
                                                <?php echo $printShift;?>
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





<div class="container">
        <div class="row">
            <div class="Absolute-Center is-Responsive">
                <div class="col-sm-12 col-md-10 col-md-offset-0">
                    <h3> Status as of <?php echo date('F Y')?> </h3>




<?php

$viewStatus = mysqli_query($conn,"SELECT *  FROM schedule JOIN shift ON schedule.shift_ID = shift.shift_ID JOIN user ON schedule.user_ID = user.user_ID JOIN timecheck on user.user_ID = timecheck.user_ID WHERE timecheck.login_date = schedule.sched_Date ORDER BY schedule.sched_Date");
    $resultNo3 = mysqli_num_rows($viewStatus);
    // $statusrow = mysqli_fetch_assoc($viewStatus);



if($resultNo3 > 0){             
    	?>
                        <table class="table table-hover table-striped table-condensed table-bordered" >
                            <thead>
                                <tr>
                                    <th>Schedule Date</th>
                                    <th>Shift</th>
                                    <th>Time in</th>
                                    <th>Time out</th>
                                    <th>Status</th>
                                </tr>
                        
                            </thead>  
        <?php
        // $row = mysqli_fetch_assoc($viewSchedule);
        while($statusrow = mysqli_fetch_assoc($viewStatus)){
        	// for ($i =0; $i < $END; $i++){


            // $printID = $row['employee_ID'];
            // $printName = $row['first_name'] . " ". $row['last_name'];
            // $printDepartment = $row['department']."<br>";
            // $printDate = $row['sched_Date']."<br>";
            // $printShift = $row['shift']."<br>";

            ?>
            <div style="overflow-x:auto;">
                                    <tbody class="table table-striped">
                                
                                        <tr>
                                            <td>
                                                <?php echo $printDate;?>
                                            </td>

                                            <td>
                                                <?php echo $printShift;?>
                                            </td>

                                            <td>
                                                <?php echo $statusrow['login_time'];?>
                                            </td>

                                            <td>
                                                <?php echo $statusrow['logout_time'];?>
                                            </td>

                                            <td>
                                            <?php 

                                            if($statusrow['timecheck.login_time'] > $statusrow['shift.login_time']){
	                                        	echo "Late";
                                            } else{
                                            	echo "On-time";
                                            }


                                            



                                            ?>
                                            </td>

                                        </tr>
                                    </tbody>

            <?php 
        }
    }
    else {
        echo "<h4>There are no schedule assigned for the month of ".date('F Y')." yet.</h4>";
    }
?>



<?php include('includes/footer.php'); ?>