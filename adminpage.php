<?php require_once('includes/header.php'); 
//Leave Request - include month
//include date picker for employee and admin
//include emp info

$userID = $_SESSION['check'];
$username = $_SESSION['username'];
$first_name = $_SESSION['firstname'];
$last_name = $_SESSION['lastname'];
$department = $_SESSION['department'];

$START = date('Y-m-01')."<br>";
$END = date('Y-m-t',strtotime('this month'))."<br>";


if ($_SESSION['department']!='Admin'){
    header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index2.php");
} 
    
include('includes/navbar.php');
include('includes/adminsidebar.php'); 

?>



<LEGEND><h2>Admin Homepage</h2></LEGEND>


<style type="text/css"><?php include('includes/common.css'); ?></style>


<div class="container-fluid">
    
    <form action="viewPendingRequest.php" method="post" target="my_iframe1">
        <font size="5"><b>Schedule:</b></font>
        <input type="month" name='dateSearch1' value="<?php echo date('Y-m');?>" ">
        <input type="submit" class="btn btn-def" name='searchDate1' value="Search" />
    </form>
    <iframe width=800px height=450px src=<?php echo "viewPendingRequest.php"?> frameborder="yes" scrolling="yes" name="my_iframe1" id="my_iframe1"></iframe>


    <form action="adminDisplaySchedule.php" method="post" target="my_iframe2">
        <font size="5"><b>Schedule:</b></font>
        <input type="month" name='dateSearch2' value="<?php echo date('Y-m');?>" ">
        <input type="submit" class="btn btn-def" name='searchDate2' value="Search" />
    </form>
    <iframe width=1200px height=350px src=<?php echo "adminDisplaySchedule.php"?> frameborder="yes" scrolling="yes" name="my_iframe2" id="my_iframe2"></iframe>


























































































<!-- 


<div class="container">
        <div class="row">
            <div class="Absolute-Center is-Responsive">
                <div class="col-sm-12 col-md-10 col-md-offset-0">
                    <h3> Schedule as of <?php echo date('F Y')?> </h3>




<?php     
    

    
    // SELECT * FROM lddap WHERE lddap_no LIKE '%2017-06%';
    // $viewSchedule = mysqli_query($conn,"SELECT user.employee_ID, user.first_name, user.last_name, user.department, schedule.sched_Date, shift.shift  FROM schedule JOIN shift ON schedule.shift_ID = shift.shift_ID JOIN user ON schedule.user_ID = user.user_ID WHERE schedule.sched_Date  BETWEEN '$START' AND '$END' ORDER BY  schedule.sched_Date");
    // $resultNo2 = mysqli_num_rows($viewSchedule);

    // if($resultNo2 > 0){       
    //     ?>

                         <!-- <table class="table table-hover table-striped table-condensed table-bordered" >
                             <thead>
                                 <tr>
                                     <th>Employee ID</th>
                                     <th>Name</th>
                                     <th>Department</th>                                                
                                     <th>Schedule Date</th>
                                     <th>Shift</th>
                                 </tr>
                        
                             </thead>   -->
         <?php

    //     while($row = mysqli_fetch_assoc($viewSchedule)){

    //         $printID = $row['employee_ID'];
    //         $printName = $row['first_name'] . " ". $row['last_name'];
    //         $printDepartment = $row['department']."<br>";
    //         $printDate = $row['sched_Date']."<br>";
    //         $printShift = $row['shift']."<br>";

            ?>
<!--             <div style="overflow-x:auto;">
                                    <tbody class="table table-striped">
                                
                                        <tr>
                                            <td>
 -->                                                <?php //echo $printID;?>
                                            <!-- </td>

                                            <td> -->
                                                <?php //echo $printName;?>
                                            <!-- </td>
                                            
                                            <td> -->
                                                <?php //echo $printDepartment;?>
                                            <!-- </td>

                                            <td> -->
                                                <?php //echo $printDate;?>
                                            <!-- </td>

                                            <td> -->
                                                <?php //echo $printShift;?>
                                    <!--         </td>
                                        </tr>
                                    </tbody> -->

            <?php 
            
    //     }
    // }
    // else {
    //     echo "<h4>There are no schedule assigned for the month of ".date('F Y')." yet.</h4>";
    // }


 ?><!-- </table> -->



<?php include('includes/footer.php'); ?>