<?php require_once('includes/header.php'); 


$dept_check = $_SESSION["dept_check"];
$check = $_SESSION['check'];
$username = $_SESSION['username'];
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
$department = $_SESSION['department'];



 if ($_SESSION['dept_check']!="emp"){
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index2.php");
 }

    
include('includes/navbar.php');
include('includes/sidebar.php');   

?>

<style type="text/css"><?php include('includes/common.css'); ?></style>
 
    <h2>Swap Schedule</h2>  

     <?php
        $getID  = $_GET['IDval'];
        $getOGSched = mysqli_query($conn, "SELECT first_name, last_name, schedule_ID, sched_Date, shift, user.department from schedule JOIN shift ON schedule.shift_ID = shift.shift_ID JOIN user ON schedule.user_ID = user.user_ID WHERE schedule.schedule_ID = '$getID'");
        
                        
        $resultNo = mysqli_num_rows($getOGSched);
        
        if (!$resultNo){
                echo 'Sorry, no resutls were found';
        } else{
                ?>

        <!-- <div class="container"> -->
                <div class="row">
                        <div class="Absolute-Center is-Responsive">
                                <div class="col-sm-12 col-md-10 col-md-offset-0">
                        <h3> Original Schedule Detail </h3>
                        <table class="table table-hover table-striped table-condensed table-bordered" >
                                <thead>
                                        <tr>
                                                <th>Name</th>
                                                <th>Schedule Date</th>
                                                <th>Shift</th>
                                                <th>Department</th>
                                        </tr>
                                </thead>
                        <?php
                        if($resultNo > 0){
                                
                                while($row = mysqli_fetch_assoc($getOGSched)){
                                    $OGName = $row['first_name']. " ".$row['last_name'];
                                    $test = date('Y-m-d',strtotime($row['sched_Date']));
                                    $OGSched = date('F d, Y - l',strtotime($row['sched_Date']));
                                    $OGShift = $row['shift'];
                                    $OGDept = $row['department'];
                                        ?>
                   <div style="overflow-x:auto;">
                        
                        <tbody class="table table-striped">
                                        <tr>
                                                <td><?php echo $OGName;?></a></td>
                                                <td><?php echo $OGSched;?></td>
                                                <td><?php echo $OGShift;?></td>
                                                <td><?php echo $OGDept;?></td>                                                
                                        </tr>

                <?php 
                                        }
                                }
                        }
                
                ?>
                        </tbody>
                </table>        
                        
                        </div>    
                </div>
        </div>
</div>





<br>
<form action="swapResultRequest.php" method="post" target="my_iframe1">
        <font size="5"><b>Swap Date:</b></font>
        <input type="date" name='dateSearch1' value="<?php echo date('m/d/Y', strtotime($test));?>" ">
        <input class="form-control" type="hidden" name='requesterID' value="<?php echo $getID; ?>">
        <input type="submit" class="btn btn-def" name='searchDate1' value="Search" />
</form>
    <iframe width=900px height=450px src=<?php echo "swapResultRequest.php"?> frameborder="no" scrolling="yes" name="my_iframe1" id="my_iframe1"></iframe>
 
</div>
<?php include('includes/footer.php'); ?>