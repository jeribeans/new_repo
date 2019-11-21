<?php require_once('includes/header.php'); 

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
?>


<h3 class="jumbotron">NOC Homepage</h3>

<?php
echo $_SESSION['checkID'] = $row['check_ID'];
echo $_SESSION['login_time'] = $row['login'];
echo $_SESSION['status'] = $row['status'];
echo $_SESSION['userID'] = $row['user_ID'];





?>
<?php 
 if ($_SESSION['department']!='NOC') 
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
?>
<style type="text/css"><?php include('includes/common.css'); ?></style>
<?php include('includes/navbar.php'); ?>
<?php include('includes/sidebar.php'); ?>

<div class="container-fluid">

	
		
        
        <h4>Name: </h4><?php echo $firstname . " "; echo $lastname; ?>
                <?php // echo $checkID;
                // echo $login;
                // echo $status;
                // echo $userID; ?>
        <h4> Log in time: </h4> <?php echo $date;?>




<?php include('includes/footer.php'); ?>