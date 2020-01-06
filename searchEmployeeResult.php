<?php require_once('includes/header.php'); 

$userID = $_SESSION['check'];
$username = $_SESSION['username'];
$first_name = $_SESSION['firstname'];
$last_name = $_SESSION['lastname'];
$department = $_SESSION['department'];
$dept_check = $_SESSION['department'];
if ($dept_check != "SuperAdmin"){
    $team = $_SESSION['team'];
}
if (!in_array($_SESSION['department'], array('Admin', 'SuperAdmin', 'AdminNOC', 'AdminFS', 'AdminCS'))) {
  header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index2.php");
}

?>



<?php     


if(isset($_POST['search'])){

    $input = $_POST['input'];
    $START = $_POST['startDate'];
    $END = $_POST['endDate'];


    if ($dept_check == "SuperAdmin"){
        $searchEmployee = mysqli_query($conn,"SELECT * FROM user WHERE (employee_ID = '%$input%') OR (concat(first_name,' ',last_name) LIKE '%$input%') OR (email LIKE '%$input%') OR (contact_num = '%$input%')");   
    }
    else {
        $searchEmployee = mysqli_query($conn,"SELECT * FROM user WHERE (department = '$team') AND (employee_ID = '%$input%') OR (concat(first_name,' ',last_name) LIKE '%$input%') OR (email LIKE '%$input%') OR (contact_num = '%$input%')");   
        
    }
    
    $row = mysqli_fetch_array($searchEmployee,MYSQLI_ASSOC);
    $resultNo = mysqli_num_rows($searchEmployee);

    if(!$resultNo){
        echo "<h4>No results found (Kindly check if Employee Information is correct or under your department)</h4>";
    }else{
        echo "<h4>Employee ID no: <b>".$row['employee_id']."</b></h4>";
        echo "<h4>Name: <b>".$row['first_name']." ".$row['last_name']."</b></h4>";
        echo "<h4>Email: <b>".$row['email']."</b></h4>";
        echo "<h4>ContactNumber: <b>".$row['contact_num']."</b></h4>";
        echo "<h4>Department: <b>".$row['department']."</b></h4>";
        $id = $row['user_ID'];
        
        //SELECT * FROM timecheck JOIN schedule ON schedule.user_ID = timecheck.user_ID JOIN shift ON shift.shift_ID = schedule.shift_ID WHERE timecheck.user_ID = '$id' AND timecheck.login_date = schedule.sched_Date AND timecheck.login_date BETWEEN '$START' AND '$END';
        
        $searchAttendance = mysqli_query($conn,"SELECT * FROM timecheck JOIN schedule ON schedule.user_ID = timecheck.user_ID JOIN shift ON shift.shift_ID = schedule.shift_ID WHERE timecheck.user_ID = '$id' AND timecheck.login_date = schedule.sched_Date AND timecheck.login_date BETWEEN '$START' AND '$END'");
        //$row2 = mysqli_fetch_array($searchAttendance,MYSQLI_ASSOC);
        $resultNo2 = mysqli_num_rows($searchAttendance);

       
         if($resultNo2 > 0){             
        ?>
                        <table class="table table-hover table-striped table-condensed table-bordered" >
                            <thead>
                                <tr>
                                    <th>Shift</th>
                                    <th>Schedule</th>
                                    <th>Login Date and Time</th>
                                    <th>Logout Date and Time</th>
                                    <th>Schedule Status</th>
                                </tr>
                        
                            </thead>  
        <?php
        // $row = mysqli_fetch_assoc($viewSchedule);
        while($row2 = mysqli_fetch_assoc($searchAttendance)){
            // for ($i =0; $i < $END; $i++){


            
            
            ?>
            <div style="overflow-x:auto;">
                                    <tbody class="table table-striped">
                                
                                        <tr>
                                            <td>
                                               <?php echo $row2['shift'];?>
                                            </td>

                                             <td>
                                               <?php echo date("M d, Y - l", strtotime($row2['sched_Date']));?>
                                            </td>

                                            <td>
                                               <?php echo date("M d, Y - l", strtotime($row2['login_date']))." -- ".$row2['login_time'];?>
                                            </td>
                                           
                                            <td>
                                                <?php echo date("M d, Y - l", strtotime($row2['logout_date']))." -- ".$row2['logout_time'];?>
                                            </td>

                                            <td>
                                                <select class="form-control" name="department" required="true">
                                                    <option value="" disabled selected><?php echo $row2['sched_status'];?></option>
                                                    <option>Late</option>
                                                    <option>Overtime</option>
                                                    <option>Undertime</option>
                                                </select>
                                                
                                            </td>

                                        </tr>
                                    </tbody>

            <?php 
        }
    }
    

?> </table>

</div>



<?php   

    }


}
else {
    echo "";
}
?>
<FORM>
<INPUT TYPE="button" class="btn btn-def" onClick="window.print()" value="Print">
</FORM>