 
<?php include('includes/header.php'); ?>
<?php 

if (!in_array($_SESSION['department'], array('SuperAdmin', 'AdminNOC', 'AdminFS', 'AdminCS'))) {
  header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index2.php");
}
  
$dept_check = $_SESSION["dept_check"];
$check = $_SESSION['check'];
$username = $_SESSION['username'];
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
$department = $_SESSION['department'];
$dept_check = $_SESSION['department'];
if ($dept_check != "SuperAdmin"){
    $team = $_SESSION['team'];
}
$year = "2019";
$month = "12";
$START = date('Y-m-01');
$END = date('Y-m-t',strtotime('this month'))."<br>";
?>



<?php     
if(isset($_POST['searchDate3'])){
    $START1 = $_POST['dateSearch3']."-01";
    $END1 = date('Y-m-t',strtotime($START1));
    $sDept = $_POST['department'];

    if ($sDept == "Network Operations Center"){
        $searchDept = "NOC";
    }elseif ($sDept == "Field Support"){
        $searchDept = "FS";
    }
    else{
        $searchDept = "CS";
    }


?>
    
<div class="container">
        <div class="row">
            <div class="Absolute-Center is-Responsive">
                <div class="col-sm-12 col-md-10 col-md-offset-0">
                    <h3> Schedule as of <?php echo date('F Y', strtotime($START1)). " (" .$sDept. ")"?> </h3>


     <table class="table table-hover table-striped table-condensed table-bordered" >
                             <thead>
                                 <tr>
                                    
                                    <?php 
                                        $START01 = date('Y-m-01');
                                        $END01 = date('t',strtotime($START01));
                                    ?>
                                    
                                 </tr>


                                 <!-- CHECK/UPDATE CODES, CHECK TABLE INSTEAD OF MANUALLY VIEWING SHIFTS (VIEW SHIFT TABLE) -->


                                 <div style="overflow-x:auto;">
                                    <tbody class="table table-striped">
                                        
                                        <?php 

                                        if($dept_check == "SuperAdmin"){?>

                                            <tr>
                                            <td><b>Shift</b></td>
                                            <?php
                                               $viewDates =  mysqli_query($conn, "SELECT sched_Date from schedule JOIN shift ON schedule.shift_ID = shift.shift_ID WHERE (schedule.sched_Date BETWEEN '$START1' AND '$END1') GROUP BY sched_Date");
                                                
                                                while($row = mysqli_fetch_assoc($viewDates)){
                                                    echo "<td><b>".date('M d - D', strtotime($row['sched_Date']))."</b></td>";


                                                }

                                                $viewshift =  mysqli_query($conn, "SELECT shift, shift_ID from shift");
                                                while($shift = mysqli_fetch_assoc($viewshift)){
                                                    echo "<tr><td><b>".$shift['shift']."</b></td>";
                                                    $shiftID = $shift['shift_ID'];
                                                    $viewSched =  mysqli_query($conn, "SELECT first_name, last_name, schedule.department from schedule JOIN shift ON schedule.shift_ID = shift.shift_ID JOIN user ON schedule.user_ID = user.user_ID WHERE schedule.shift_ID = '$shiftID' AND (schedule.sched_Date BETWEEN '$START1' AND '$END1') AND schedule.department = '$searchDept' ORDER BY schedule.sched_Date");

                                                    while($test = mysqli_fetch_assoc($viewSched)){
                                                        echo "<td>".$test['first_name']." ".$test['last_name']."</td>";
                                                    }
                                                }

                                                

                                                echo "</tr>";
                                           ?>
                                        </tr>
                                        

                                        <?php } else {


                                        ?>

                                        <tr>
                                            <td><b>Shift</b></td>
                                            <?php
                                                $viewDates =  mysqli_query($conn, "SELECT sched_Date from schedule JOIN shift ON schedule.shift_ID = shift.shift_ID WHERE (schedule.sched_Date BETWEEN '$START' AND '$END') GROUP BY sched_Date");
                                                
                                                while($row = mysqli_fetch_assoc($viewDates)){
                                                    echo "<td><b>".date('M d - D', strtotime($row['sched_Date']))."</b></td>";


                                                }

                                                $viewshift =  mysqli_query($conn, "SELECT shift, shift_ID from shift");
                                                while($shift = mysqli_fetch_assoc($viewshift)){
                                                    echo "<tr><td><b>".$shift['shift']."</b></td>";
                                                    $shiftID = $shift['shift_ID'];
                                                    $viewSched =  mysqli_query($conn, "SELECT first_name, last_name, schedule.department from schedule JOIN shift ON schedule.shift_ID = shift.shift_ID JOIN user ON schedule.user_ID = user.user_ID WHERE schedule.shift_ID = '$shiftID' AND (schedule.sched_Date BETWEEN '$START' AND '$END') AND schedule.department = '$team'  ORDER BY schedule.sched_Date");

                                                    while($test = mysqli_fetch_assoc($viewSched)){
                                                        echo "<td>".$test['first_name']." ".$test['last_name']."</td>";
                                                    }
                                                }

                                                

                                                echo "</tr>";
                                           ?>
                                        </tr>
                                <?php } ?>
                             </thead>  

<?php
    
} else{
   ?>
    
<div class="container">
        <div class="row">
            <div class="Absolute-Center is-Responsive">
                <div class="col-sm-12 col-md-10 col-md-offset-0">
                    <h3> Please Select Department and Date </h3>


</div>

<?php
}
?>
<!-- 
<FORM>
<INPUT TYPE="button" class="btn btn-def" onClick="window.print()" value="Print">
</FORM>
     -->

