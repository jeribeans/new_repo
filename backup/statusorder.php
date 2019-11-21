<?php include('includes/header.php'); ?>
<?php 
 if ($_SESSION['usertype']!=101) 
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
?>
<style type="text/css"><?php include('includes/common.css'); ?></style>
<?php include('includes/navbar.php'); ?>
<?php include('includes/sidebar.php'); ?>






<div class="container-fluid">
	<form class="form-horizontal" id="dischargeform" method="post" action="jo_searchresult.php">
<fieldset>


<legend>Job Order Status Report</legend>


<div class="form-group">
	<input type="submit" name="submit" class="input-md btn btn-success center-block" value="submit" id="Form">
</div>

</div>









</fieldset>
</form>


<?php include('includes/footer.php'); ?>