
<?php include('includes/header.php'); ?>
<?php 
 if ($_SESSION['dept_check']!="emp"){
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index2.php");
 }


$dept_check = $_SESSION["dept_check"];
$check = $_SESSION['check'];
$username = $_SESSION['username'];
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
$department = $_SESSION['department'];


$START = date('Y-m-01')."<br>";
$END = date('Y-m-t',strtotime('this month'))."<br>";

?>
<style type="text/css"><?php include('includes/common.css'); ?></style>
<?php 
include('includes/navbar.php');
include('includes/sidebar.php');
?>


<div class="container-fluid">
	<LEGEND><h2>Employee Homepage</h2></LEGEND>
             
    
    <form action="schedule.php" method="post" target="my_iframe1">
        <font size="5"><b>Schedule:</b></font>
        <input type="month" name='dateSearch1' value="<?php echo date('Y-m');?>" ">
        <input type="submit" class="btn btn-def" name='searchDate1' value="Search" />
    </form>
    <iframe width=800px height=450px src=<?php echo "schedule.php"?> frameborder="yes" scrolling="yes" name="my_iframe1" id="my_iframe1"></iframe>
                    
                    
    <form action="attendance.php" method="post" target="my_iframe2">
        <font size="5"><b>Attendance:</b></font>
        <input type="month" name='dateSearch2' value="<?php echo date('Y-m');?>" ">
        <input type="submit" class="btn btn-def" name='searchDate2' value="Search" />
    </form>
    <iframe width=800px height=450px src=<?php echo "attendance.php"?> frameborder="yes" scrolling="yes" name="my_iframe2" id="my_iframe2"></iframe>



    <form action="viewEmpRequest.php" method="post" target="my_iframe3">
        <font size="5"><b>Request:</b></font>
        <input type="month" name='dateSearch3' value="<?php echo date('Y-m');?>" ">
        <input type="submit" class="btn btn-def" name='searchDate3' value="Search" />
    </form>
    <iframe width=800px height=450px src=<?php echo "viewEmpRequest.php"?> frameborder="yes" scrolling="yes" name="my_iframe3" id="my_iframe3"></iframe>

    





<?php include('includes/footer.php'); ?>