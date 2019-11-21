<?php require_once('includes/header.php'); 

$userID = $_SESSION['check'];
$date = date("Y:m:d");
$time = date("H:i:s");
$status = "Logged in";

$getID  = $_GET['IDval'];

$sql = "SELECT * FROM user WHERE employee_ID = '$getID'";
$query = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($query,MYSQLI_ASSOC);
    
$name = $row['first_name'];
$middlename = $row['middle_name'];
$last = $row['last_name'];
$email = $row['email'];
$contact = $row['contact_num'];
$employeeID = $row['employee_id'];

?>


<LEGEND><h2>Attendance</h2></LEGEND>

<?php


?>
<?php 
 if ($_SESSION['department']!='Admin') 
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
?>
<style type="text/css"><?php include('includes/common.css'); ?></style>
<?php include('includes/navbar.php'); ?>
<?php include('includes/adminsidebar.php'); ?>

<div class="container-fluid">

	       
       <div class="container-fluid">
        
        <h3>Employee Information:</h3>     
 




<?php include('includes/footer.php'); ?>