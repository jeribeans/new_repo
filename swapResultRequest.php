<?php
require_once('includes/header.php'); 


$dept_check = $_SESSION["dept_check"];
$check = $_SESSION['check'];
$username = $_SESSION['username'];
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
$department = $_SESSION['department'];



 if ($_SESSION['dept_check']!="emp"){
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index2.php");
 }


$START = date('Y-m-01');
$END = date('Y-m-t',strtotime('this month'));
?>





<?php     
if(isset($_POST['searchDate1'])){
    
    $START1 = $_POST['dateSearch1'];
    $END1 = date('Y-m-t',strtotime($START1));
    ?>
<!--     <style type="text/css"><?php include('includes/common.css'); ?></style>
 
     -->

     <?php
        
        $getOGSched = mysqli_query($conn, "SELECT first_name, last_name, schedule_ID, sched_Date, shift, department from schedule JOIN shift ON schedule.shift_ID = shift.shift_ID JOIN user ON schedule.user_ID = user.user_ID WHERE schedule.sched_Date = '$START1' ORDER BY shift.shift_ID");
        
                        
        $resultNo = mysqli_num_rows($getOGSched);
        
        if (!$resultNo){
                echo 'Sorry, no resutls were found';
        } else{
                ?>

        <!-- <div class="container"> -->
              <!--   <div class="row">
                        <div class="Absolute-Center is-Responsive">
                                <div class="col-sm-12 col-md-10 col-md-offset-0"> -->
                        <table class="table table-hover table-striped table-condensed table-bordered" >
                                <thead>
                                        <tr>
                                                <th>Name</th>
                                                <th>Schedule Date</th>
                                                <th>Shift</th>
                                                <th>Department</th>
                                                <th>Action</th>
                                        </tr>
                                </thead>
                        <?php
                        if($resultNo > 0){
                                
                                while($row = mysqli_fetch_assoc($getOGSched)){
                                    $SwapName = $row['first_name']. " ".$row['last_name'];
                                    $test = date('Y-m-d',strtotime($row['sched_Date']));
                                    $SwapSched = date('M d, Y - l',strtotime($row['sched_Date']));
                                    $SwapShift = $row['shift'];
                                    $SwapDept = $row['department'];
                                        ?>
                   <!-- <div style="overflow-x:auto;"> -->
                        
                        <tbody class="table table-striped">
                                        <tr>
                                             
                                            <form action="swapResultRequest.php" method="post" target="my_iframe1">
                                                <td><input type="text" name='SwapName' value="<?php echo $SwapName;?>" readonly="true"></td>
                                                <td><input type="text" name='SwapDate' value="<?php echo $SwapSched;?>" readonly="true" "></td>
                                                <td><input type="text" name='SwapShift' value="<?php echo $SwapShift;?>" readonly="true" "></td>
                                                <td><input type="text" name='SwapDept' value="<?php echo $SwapDept;?>" readonly="true" "></td>
                                                <td><input type="submit" class="btn btn-def" name='swap' value="Request Swap" /></td>
                                                
                                            </form>
                                            
                                        </tr>
                <?php 
                                        }
                                }
                        }
                } else {
                    echo "<h3>Please Enter Valid Date </h3>";
                }
                ?>
                        </tbody>
                </table>        
                        
            