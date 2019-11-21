<?php include('includes/header.php'); ?>
<?php 
 if ($_SESSION['usertype']!=102) 
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
?>
<style type="text/css"><?php include('includes/common.css'); ?></style>
<?php include('includes/navbar.php'); ?>
<?php include('includes/adminsidebar.php'); ?>

<div class="container-fluid">
	<form class="form" method="post" action="viewsalesresult.php">
<fieldset>


<legend>View Sales</legend>

<div class="well">
<div class="form-group">
	<span class="glyphicon glyphicon-paste"></span><label for="fromdate"> From date:<textarea class="form-control" id="fromdate" placeholder="YYYY-MM-DD" name="fromdate" rows="1" cols="10"></textarea></label><br>
	<span class="glyphicon glyphicon-copy"></span><label for="todate"> To date:<textarea  class="form-control" id="todate" placeholder="YYYY-MM-DD" name="todate" rows="1" cols="10"></textarea></label>

</div>
<div class="form-group">
	<input type="submit" name="submit" class="input-md btn btn-success btn-lg center-block" value="Search" id="Form">
</div>
</div>
</fieldset>
</form>


<?php include('includes/footer.php'); ?>