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
        
        $empName = $row['first_name']." ".$row['last_name'];
        $empDepartment = $row['department'];
        $dtrDatestrt = $START;
        $dtrDateend = $END;
        $id = $row['user_ID'];
        
        //SELECT * FROM timecheck JOIN schedule ON schedule.user_ID = timecheck.user_ID JOIN shift ON shift.shift_ID = schedule.shift_ID WHERE timecheck.user_ID = '$id' AND timecheck.login_date = schedule.sched_Date AND timecheck.login_date BETWEEN '$START' AND '$END';
 
 ?>
      <!--   <table class="table table-hover table-striped table-condensed table-bordered" >
                            <thead>
                                <tr>
                                    <th>Shift</th>
                                    <th>Schedule</th>
                                    <th>Login Date and Time</th>
                                    <th>Logout Date and Time</th>
                                    <th>Schedule Status</th>
                                </tr>
                        
                            </thead>   -->

<?php 
        
        // $searchAttendance = mysqli_query($conn,"SELECT * FROM timecheck JOIN user ON user.user_ID = timecheck.user_ID JOIN schedule ON schedule.schedule_ID = timecheck.user_ID JOIN shift ON shift.shift_ID = schedule.shift_ID WHERE timecheck.user_ID = '$id' AND timecheck.login_date BETWEEN '$START' AND '$END'");
        // $row3 = mysqli_fetch_assoc($searchAttendance);

        // echo $row3['first_name']."<br>";


        echo "Name: <b>".$empName."</b><br>";
        echo "Department: <b>".$empDepartment."</b><br>";
        echo "DTR From: <b>".date("F d Y", strtotime($dtrDatestrt))." to ".date("F d Y", strtotime($dtrDateend))."</b>";
        ?>
           <table class="table table-hover table-striped table-condensed table-bordered" >
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Month</th>
                                    <th>Shift Schedule in</th>
                                    <th>Shift Schedule out</th>
                                    <th>Time in</th>
                                    <th>Time out</th>
                                    <th>Overtime</th>
                                    <th>Night Differential</th>
                                    <th>Overtime Night Differential</th>
                                    <th>Rest Day Overtime</th>
                                    <th>Status</th>
                                </tr>
                        
                            </thead>   

        <?php

        

        for ($i =0; $i < date("d", strtotime($END)); $i++){

            $day = $START;
            
            $searchAttendance = mysqli_query($conn,"SELECT * FROM timecheck JOIN user ON user.user_ID = timecheck.user_ID JOIN schedule ON schedule.schedule_ID = timecheck.user_ID JOIN shift ON shift.shift_ID = schedule.shift_ID WHERE timecheck.user_ID = '$id' AND timecheck.login_date BETWEEN '$day' AND '$day'");
            $row3 = mysqli_fetch_assoc($searchAttendance);
            

          

            // echo "<tr>";
            echo "<td>".date("d", strtotime($row3['login_date']))."<td>";
            echo "<td>".date("M", strtotime($row3['login_date']))."<td>";
            echo "<td>".$row3['shift_time_in']."<td>";
            echo "<td>".$row3['login_time']."<td>";
            echo "<td>".$row3['logout_time']."<td>";
            echo "</tr>";

            $START = date ("Y-m-d", strtotime("+1 days", strtotime($START)));
                            

            }



        
        

        // $searchAttendance = mysqli_query($conn,"SELECT * FROM timecheck JOIN schedule ON schedule.user_ID = timecheck.user_ID JOIN shift ON shift.shift_ID = schedule.shift_ID WHERE timecheck.user_ID = '$id' AND timecheck.login_date = schedule.sched_Date AND timecheck.login_date BETWEEN '$START' AND '$END'");

        //$row2 = mysqli_fetch_array($searchAttendance,MYSQLI_ASSOC);
        $resultNo2 = mysqli_num_rows($searchAttendance);

         if($resultNo2 > 0){             
        ?>
                        
        <?php
        // $row = mysqli_fetch_assoc($viewSchedule);
        while($row2 = mysqli_fetch_assoc($searchAttendance)){
            // for ($i =0; $i < $END; $i++){
            
                        
            ?>
            <div style="overflow-x:auto;">
                                    <tbody class="table table-striped">
                                
                                        <tr>
                                            <td>
                                               <?php //echo $row2['shift'];?>
                                            </td>

                                             <td>
                                               <?php //echo date("M d, Y - l", strtotime($row2['sched_Date']));?>
                                            </td>

                                            <td>
                                               <?php //echo date("M d, Y - l", strtotime($row2['login_date']))." -- ".$row2['login_time'];?>
                                            </td>
                                           
                                            <td>
                                                <?php //echo date("M d, Y - l", strtotime($row2['logout_date']))." -- ".$row2['logout_time'];?>
                                            </td>

                                            <!-- <td>
                                                <select class="form-control" name="department" required="true">
                                                    <option value="" disabled selected><?php echo $row2['sched_status'];?></option>
                                                    <option>Late</option>
                                                    <option>Overtime</option>
                                                    <option>Undertime</option>
                                                </select>
                                                
                                            </td> -->

                                        </tr>
                                    </tbody>

            <?php 
        }
    }
    // else{
    //     echo "<h4>No attendance available on specified date.</h4>";

    //     for ($i =0; $i < date("d", strtotime($END)); $i++){

    //         echo $day = "<br>".$START;
    //         $START = date ("Y-m-d", strtotime("+1 days", strtotime($START)));    
                
    //         }


    //}
    

?> </table>

</div>



<?php   

    }


}

?>
<FORM>
<INPUT TYPE="button" class="btn btn-def" onClick="window.print()" value="Print">
</FORM>