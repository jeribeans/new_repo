<?php require_once('includes/header.php'); 
include('includes/navbar.php');
include('includes/adminsidebar.php');


if ($_SESSION['department']!='Admin'){
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
}
        

$userID = $_SESSION['check'];
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
$date = date("H:m:s");
$status = "Logged in";


$sql2 = "SELECT * FROM timeCheck";
$query2 = mysqli_query($conn,$sql2);

$row = mysqli_fetch_array($query2,MYSQLI_ASSOC);

$_SESSION['checkID'] = $row['check_ID'];

$_SESSION['status'] = $row['status'];
$_SESSION['userID'] = $row['user_ID'];
?>

<style type="text/css"><?php include('includes/common.css'); ?></style>

<div class="container-fluid">
	
        <legend><h2>Attendance Summary</h2></legend>	

        
        
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
                                        <h3> Search Date </h3>
                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="loginForm" method="post">
                                                <div class="form-group input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                        <input class="form-control" type="date" name='startDate' placeholder="Start Date">          
                                                </div>
                                                <div class="form-group input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                        <input class="form-control" type="date" name='endDate' placeholder="End Date"/>     
                                                </div>
                                                <div class="form-group">
                                                        <input type="submit" name="search" class="btn btn-def btn-block" value="Search" />
                                                </div>
                                        </form>
                        <br>
                        <h3> All Employees </h3>
                        <table class="table table-hover table-striped table-condensed table-bordered" >
                                <thead>
                                        <tr>
                                                <th>Employee ID</th>
                                                <th>Name</th>
                                                <th>Department</th>
                                                
                                        </tr>
                                </thead>
                        <?php
                        
                        if($resultNo > 0){
                                
                                while($row = mysqli_fetch_assoc($getEmployee)){
                                        $row2 = mysqli_fetch_assoc($getTime);
                                        
                                        $employeeID = $row['employee_id'];
                                        $name = $row['first_name']." ".$row['middle_name']." ".$row['last_name'];
                                        $department = $row['department'];
                                        
                                        ?>
                <div style="overflow-x:auto;">
                        
                        <tbody class="table table-striped">
                                        <tr>
                                                <td><a href="showAttendance.php?IDval=<?php echo $employeeID?>"><?php echo $employeeID;?></td>
                                                <td><?php echo $name;?></a></td>
                                                <td><?php echo $department;?></td>
                                                
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
<?php include('includes/footer.php'); ?>