<?php require_once('includes/header.php'); 
include('includes/navbar.php');
include('includes/adminsidebar.php');


if ($_SESSION['department']!='Admin'){
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
}
        

$userID = $_SESSION['check'];

$date = date("H:m:s");
$status = "Logged in";


$sql = "INSERT INTO timeCheck (login, status, user_ID) VALUES('$date','$status', '$userID')";
$query = mysqli_query($conn,$sql);

$sql2 = "SELECT * FROM timeCheck";
$query2 = mysqli_query($conn,$sql2);

$row = mysqli_fetch_array($query2,MYSQLI_ASSOC);


// if (isset($_POST['submit'])){
//         header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/adminpage.php");
// } 

$getEmployee = mysqli_query($conn, "SELECT * FROM user");
        $getTime = mysqli_query($conn, "SELECT * FROM timeCheck");
        
                        
        $resultNo = mysqli_num_rows($getEmployee);



for ($i = 0; $i < $resultNo ; $i++) {
   


   if(isset($_POST['submit'+ $i])){
    echo $i;
       
    }
}





// if(isset($_POST['submit'])){
//     echo key($_POST['submit'])." submit";
//     ?><br><?php

//     echo $_POST['startDate']." startDate";
//     ?><br><?php

//     $testid = mysqli_real_escape_string($conn, key($_POST['employeeid']));
//     echo $testid." ID";

    
//     ?><br><?php

//     $testname = mysqli_real_escape_string($conn, key($_POST['employeeName']));
//     echo $testname." name";
       
// }

?>

<style type="text/css"><?php include('includes/common.css'); ?></style>

<div class="container-fluid">
	
        <legend><h2>Set Employee Shifts</h2></legend>	

        
        
        <?php
        $getEmployee = mysqli_query($conn, "SELECT * FROM user");
        $getTime = mysqli_query($conn, "SELECT * FROM timeCheck");
        
                        
        $resultNo = mysqli_num_rows($getEmployee);
        
        if (!$resultNo){
                echo 'Sorry, no resutls were found';
        } else{
                ?>



        <div class="container">
                <div class="row">
                        <div class="Absolute-Center is-Responsive">
                                <div class="col-sm-12 col-md-10 col-md-offset-1">
                        <h3> All Employees </h3>
                        <table class="table table-hover table-striped table-condensed table-bordered" >
                            <col width="70"> 
                                <col width="200"> 
                                    <col width="50">
                                        <col width="100">
                                            <col width="05">
                                                <col width="80"> 
                                <thead>
                                        <tr>
                                                <th>ID No</th>
                                                <th>Name</th>
                                                <th>Department</th>                                                
                                                <th>Shift</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Schedule</th>
                                        </tr>
                                </thead>
                        <?php
                        
                        if($resultNo > 0){
                                
                               
                                $counter=0;
                                $i = 0;

                                while($row = mysqli_fetch_assoc($getEmployee)){
                                    
                                      ?>  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="addUserForm" method="post"><?php
                                        $row2 = mysqli_fetch_assoc($getTime);
                                                                                
                                        $employeeID = $row['employee_id'];
                                        $name = $row['first_name']." ".$row['middle_name']." ".$row['last_name'];
                                        $department = $row['department'];

                                        
                                        
                                        ?>
                        <div style="overflow-x:auto;">
                        <tbody class="table table-striped">
                                        <tr>
                                                <!-- <?php echo $employeeID;?> -->
                                                <td><input class="form-control" type="text" name="employeeid['.$i.']" value="<?php echo $employeeID;?>" readonly></td>
                                                
                                                <td><input class="form-control" type="text" name="employeeName['.$i.']" value="<?php echo $name;?>" readonly></td>
                                                <td><input class="form-control" type="text" name='employeeDepartment['.$i.']' value="<?php echo $department;?>" readonly></td>
                                                <!-- <td><?php echo $name;?></td>    
                                                <td><?php echo $department;?></td> -->
                                                <td>
                                                        <select class="form-control" id="shift">
                                                        <option value="" disabled selected>Select Shift</option>
                                                        <option>Morning Shift</option>
                                                        <option>Mid-Day Shift</option>
                                                        <option>GY Shift</option>
                                                        </select>                                                
                                                </td>

                                                <td> 
                                                        <div class="form-group input-group">
                                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                                <?php echo '<input class="form-control" type="date"  name="startDate" placeholder="End Date"/>';?>
                                                                                      
                                                        </div>
                                                </td>

                                                <td>
                                                        <div class="form-group input-group">
                                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                                <?php echo '<input class="form-control" type="date"  name="endDate" placeholder="End Date"/>';?>
                                                                     
                                                        </div>
                                                </td>

                                                <td>
                                                    <?php echo '<input type="submit" name="submit['.$i.']" class="btn btn-def btn-block" value="Set" />';?>
                                                </td>
                                        </tr>

                <?php 
                                        $counter++;
                                        $i++;
                                        }
                                }
                        }
                
                ?>
                        </tbody>
                </table>        


                  
                </form>
                        </div>    
                </div>
        </div>


                
                        


</div>
<?php include('includes/footer.php'); ?>