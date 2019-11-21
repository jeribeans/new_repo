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


$sql = "INSERT INTO timeCheck (login, status, user_ID) VALUES('$date','$status', '$userID')";
$query = mysqli_query($conn,$sql);

$sql2 = "SELECT * FROM timeCheck";
$query2 = mysqli_query($conn,$sql2);

$row = mysqli_fetch_array($query2,MYSQLI_ASSOC);

$_SESSION['checkID'] = $row['check_ID'];

$_SESSION['status'] = $row['status'];
$_SESSION['userID'] = $row['user_ID'];
?>

<style type="text/css"><?php include('includes/common.css'); ?></style>

<div class="container-fluid">
        
        <legend><h2>Attendance Report</h2></legend>     

        
        
        <?php
        $getEmployee = mysqli_query($conn, "SELECT *    FROM user");
        $getTime = mysqli_query($conn, "SELECT * FROM timeCheck");
                        
        $resultNo = mysqli_num_rows($getEmployee);
        
        if (!$resultNo){
                echo 'Sorry, no resutls were found';
        } else{
                ?>



        <div class="container">
                <div class="row">
                        <div class="Absolute-Center is-Responsive">
                                <div id="logo-container"></div>
                                <div class="col-sm-12 col-md-10 col-md-offset-1">

                                        <h4> Please select start date and end date for report generation </h4>
                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="loginForm" method="post">

                                                 <label for="sel1">Start Date:</label>
                                                <div class="form-group input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                        <input class="form-control" type="date" size="10" name='startDate' placeholder="Start Date">          
                                                </div>


                                                 <label for="sel1">End Date:</label>
                                                <div class="form-group input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                                        <input class="form-control" type="date" name='endDate' placeholder="End Date"/>     
                                                </div>
                                                <div class="form-group">
                                                        <input type="submit" name="searh" class="btn btn-def btn-block" value="Search" />
                                                </div>
                                        </form>


                     

                <?php 
                                        }
                                
                                
                ?>
                             



                                </div>  
                        </div>    
                </div>
        </div>


                
                        


</div>
<?php include('includes/footer.php'); ?>