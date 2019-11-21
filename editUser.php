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


?>

<style type="text/css"><?php include('includes/common.css'); ?></style>

<div class="container-fluid">
	
        <legend><h2>Edit User Information</h2></legend>	

        
        
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
                                <thead>
                                        <tr>
                                                <th>Employee ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Contact Number</th>
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
                                        
                                        $email = $row['email'];
                                        $contact_num = $row['contact_num'];
                                        ?>
                <div style="overflow-x:auto;">
                        
                        <tbody class="table table-striped">
                                        <tr>
                                                <td><a href="updateInfo.php?IDval=<?php echo $employeeID?>"><?php echo $employeeID;?></td>
                                                <td><?php echo $name;?></a></td>
                                                <td><?php echo $email;?></td>
                                                <td><?php echo $contact_num;?></td>
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