 
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
if(isset($_POST['searchDate2'])){
    $START1 = $_POST['dateSearch2']."-01";
    $END1 = date('Y-m-t',strtotime($START1));
?>
    
<div class="container">
        <div class="row">
            <div class="Absolute-Center is-Responsive">
                <div class="col-sm-12 col-md-10 col-md-offset-0">
                    <h3> Schedule as of <?php echo date('F Y', strtotime($START1))?> </h3>


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
                                        
                                        <tr>
                                            <td><b>Shift</b></td>
                                            <?php
                                                $viewDates =  mysqli_query($conn, "SELECT sched_Date from schedule JOIN shift ON schedule.shift_ID = shift.shift_ID JOIN user ON schedule.user_ID = user.user_ID WHERE schedule.shift_ID = '1' AND (schedule.sched_Date BETWEEN '$START1' AND '$END1')  ORDER BY schedule.sched_Date");
                                                
                                            
                                                while($row = mysqli_fetch_assoc($viewDates)){
                                                    echo "<td><b>".date('M d - D', strtotime($row['sched_Date']))."</b></td>";
                                                }
                                           ?>
                                        </tr>

                                        <tr>
                                            <td>Morning</td>
                                            <?php
                                                $viewMorning =  mysqli_query($conn, "SELECT first_name, last_name from schedule JOIN shift ON schedule.shift_ID = shift.shift_ID JOIN user ON schedule.user_ID = user.user_ID WHERE schedule.shift_ID = '1' AND (schedule.sched_Date BETWEEN '$START1' AND '$END1')  ORDER BY schedule.sched_Date");
                                                
                                            
                                                while($row = mysqli_fetch_assoc($viewMorning)){
                                                    ?><td><a href="swapSchedule.php?IDval=1"target='top'> </a></td>"<?php
                                                }
                                           ?>
                                        </tr>
                                        <tr>
                                            <td>Mid-Day</td>
                                            <?php
                                                $viewMid =  mysqli_query($conn, "SELECT first_name, last_name from schedule JOIN shift ON schedule.shift_ID = shift.shift_ID JOIN user ON schedule.user_ID = user.user_ID WHERE schedule.shift_ID = '2' AND (schedule.sched_Date BETWEEN '$START1' AND '$END1')  ORDER BY schedule.sched_Date");
                                                while($row = mysqli_fetch_assoc($viewMid)){
                                                    echo "<td><a>".$row['first_name']." ".$row['last_name']."</a></td>";
                                                }   
                                           ?>
                                        </tr>
                                        <tr>
                                            <td>GY</td>
                                            <?php
                                                $viewGY =  mysqli_query($conn, "SELECT first_name, last_name from schedule JOIN shift ON schedule.shift_ID = shift.shift_ID JOIN user ON schedule.user_ID = user.user_ID WHERE schedule.shift_ID = '3' AND (schedule.sched_Date BETWEEN '$START1' AND '$END1')  ORDER BY schedule.sched_Date");
                                                
                                                while($row = mysqli_fetch_assoc($viewGY)){
                                                    echo "<td><a>".$row['first_name']." ".$row['last_name']."</a></td>";
                                                }
                                           ?>
                                        </tr>
                        
                             </thead>  

<?php
    
} else{
   ?>
    
<div class="container">
        <div class="row">
            <div class="Absolute-Center is-Responsive">
                <div class="col-sm-12 col-md-10 col-md-offset-0">
                    <h3> Schedule as of <?php echo date('F Y')?> </h3>


     <table class="table table-hover table-striped table-condensed table-bordered" >
                             <thead>
                                 <tr>
                                 <!--    <th>Shift</th> -->
                                    <?php 
                                    $START01 = date('Y-m-01');
                                    $END01 = date('t',strtotime($START01));
                                    // for ($i = 1; $i <= $END01; $i++){
                                    //     echo "<th>". $dates[] = date('M') . " " . str_pad($i, 2, '0', STR_PAD_LEFT). " ";"</th>";
                                    // }
                                    ?>
                                     <!-- <th>Employee ID</th>
                                     <th>Name</th>
                                     <th>Department</th>                                                
                                     <th>Schedule Date</th>
                                     <th>Shift</th> -->
                                 </tr>

                                 <div style="overflow-x:auto;">
                                    <tbody class="table table-striped">
                                        
                                        <tr>
                                            <td><b>Shift</b></td>
                                            <?php
                                                $viewDates =  mysqli_query($conn, "SELECT sched_Date from schedule JOIN shift ON schedule.shift_ID = shift.shift_ID JOIN user ON schedule.user_ID = user.user_ID WHERE schedule.shift_ID = '1' AND (schedule.sched_Date BETWEEN '$START' AND '$END')  ORDER BY schedule.sched_Date");
                                                
                                            
                                                while($row = mysqli_fetch_assoc($viewDates)){
                                                    echo "<td><b>".date('M d - D', strtotime($row['sched_Date']))."</b></td>";
                                                }
                                           ?>
                                        </tr>

                                        <tr>
                                            <td>Morning</td>
                                            <?php
                                                $viewMorning =  mysqli_query($conn, "SELECT first_name, last_name, schedule_ID from schedule JOIN shift ON schedule.shift_ID = shift.shift_ID JOIN user ON schedule.user_ID = user.user_ID WHERE schedule.shift_ID = '1' AND (schedule.sched_Date BETWEEN '$START' AND '$END')  ORDER BY schedule.sched_Date");
                                                
                                            
                                                while($row = mysqli_fetch_assoc($viewMorning)){
                                                    
                                                    ?> 
                                                    
                                                    <td><a href="swapSchedule.php?IDval=<?php echo $row['schedule_ID']?>" target="top"><?php echo $row['first_name']." ".$row['last_name']?> </td>

                                                    <?php
                                                }
                                           ?>
                                        </tr>
                                        <tr>
                                            <td>Mid-Day</td>
                                            <?php
                                                $viewMid =  mysqli_query($conn, "SELECT first_name, last_name, schedule_ID from schedule JOIN shift ON schedule.shift_ID = shift.shift_ID JOIN user ON schedule.user_ID = user.user_ID WHERE schedule.shift_ID = '2' AND (schedule.sched_Date BETWEEN '$START' AND '$END')  ORDER BY schedule.sched_Date");
                                                while($row = mysqli_fetch_assoc($viewMid)){
                                                    ?> 
                                                    
                                                    <td><a href="swapSchedule.php?IDval=<?php echo $row['schedule_ID']?>" target="top"><?php echo $row['first_name']." ".$row['last_name']?> </td>

                                                    <?php
                                                
                                                }   
                                           ?>
                                        </tr>
                                        <tr>
                                            <td>GY</td>
                                            <?php
                                                $viewGY =  mysqli_query($conn, "SELECT first_name, last_name, schedule_ID from schedule JOIN shift ON schedule.shift_ID = shift.shift_ID JOIN user ON schedule.user_ID = user.user_ID WHERE schedule.shift_ID = '3' AND (schedule.sched_Date BETWEEN '$START' AND '$END')  ORDER BY schedule.sched_Date");
                                                
                                                while($row = mysqli_fetch_assoc($viewGY)){
                                                ?> 
                                                    
                                                    <td><a href="swapSchedule.php?IDval=<?php echo $row['schedule_ID']?>" target="top"><?php echo $row['first_name']." ".$row['last_name']?> </td>

                                                    <?php
                                                }
                                           ?>
                                        </tr>
                        
                             </thead>  

            <?php 
    
?> </table>

</div>

<?php
}
?>
<!-- 
<FORM>
<INPUT TYPE="button" class="btn btn-def" onClick="window.print()" value="Print">
</FORM>
     -->

