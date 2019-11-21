<?php require_once('includes/header.php'); 
include('includes/navbar.php');
include('includes/sidebar.php');


if ($_SESSION['department']!='NOC'){
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
}
        

$userID = $_SESSION['check'];
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
$date = $_SESSION['date'];
$status = "Logged in";


$sql = "INSERT INTO timeCheck (login, status, user_ID) VALUES('$date','$status', '$userID')";
$query = mysqli_query($conn,$sql);

$sql2 = "SELECT * FROM timeCheck WHERE login = '$date' AND status = '$status'";
$query2 = mysqli_query($conn,$sql2);

$row = mysqli_fetch_array($query2,MYSQLI_ASSOC);

$_SESSION['checkID'] = $row['check_ID'];
$_SESSION['login_time'] = $row['login'];
$_SESSION['status'] = $row['status'];
$_SESSION['userID'] = $row['user_ID'];
?>

<style type="text/css"><?php include('includes/common.css'); ?></style>

<div class="container-fluid">
	
        <legend>View Attendance</legend>	
	
        <h4>Name: </h4><?php echo $firstname . " "; echo $lastname; ?>
                <?php // echo $checkID;
                // echo $login;
                // echo $status;
                // echo $userID; ?>
        <h4> Log in time: </h4> <?php echo $date;?>

        
        <?php
        $getEmployee = mysqli_query($conn, "SELECT *	FROM user");
        $getTime = mysqli_query($conn, "SELECT * FROM timeCheck");
                        
        $resultNo = mysqli_num_rows($getEmployee);
        
        if (!$resultNo){
                echo 'Sorry, no resutls were found';
        } else{
                ?>
                        
                        <table class="table table-hover table-condensed" >
                                <thead>
                                        <tr>
                                                <th>Name</th>
                                                <th>Department</th>
                                                <th>Employee ID</th>
                                        </tr>
                                </thead>
                                
                        
                        <?php
                        
                        
                        if($resultNo > 0){
                                
                                while($row = mysqli_fetch_assoc($getEmployee)){
                                        $row2 = mysqli_fetch_assoc($getTime);
                                        
                                        $name = $row['first_name'];
                                        $contactperson = $row['supplier_contactperson'];
                                        $contactnumber = $row['supplier_contactNum'];
                                        if ($row['supplier_id'] == $row2['ingredient_supplier_id']){
                                                $id = $row2['ingredient_id'];
                                                if ($id == $row3['ingredient_id']){
                                                        $supply = $row3['ingredient_name'];
                                                }
                                        }
                                        ?>
                <div style="overflow-x:auto;">
                        
                        <tbody>
                                        <tr>
                                                <td><?php echo $name;?></td>
                                                <td><?php echo $contactperson;?></td>
                                                <td><?php echo $contactnumber;?></td>
                                                <td><a href="supplierdisplay.php?name=<?php echo $supply?>"><?php echo $supply;?></a></td>
                                        </tr>

                        
                <?php 
                                        }
                                }
                        }
                
                ?>
                        </tbody>
                </table>	


</div>
<?php include('includes/footer.php'); ?>