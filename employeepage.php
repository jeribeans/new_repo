
<?php include('includes/header.php'); ?>
<?php 
 if ($_SESSION['dept_check']!="emp") 
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index2.php");
?>
<style type="text/css"><?php include('includes/common.css'); ?></style>
<?php 
include('includes/navbar.php');
include('includes/sidebar.php');
?>


<div class="container-fluid">
	<LEGEND><h2>Employee Homepage</h2></LEGEND>
</div>





<?php include('includes/footer.php'); ?>