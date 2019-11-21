<?php include('includes/header.php'); ?>
<?php 
 if ($_SESSION['usertype']!=102) 
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
?>
<style type="text/css"><?php include('includes/common.css'); ?></style>
<?php include('includes/navbar.php'); ?>
<?php include('includes/adminsidebar.php'); ?>


<?php if(isset($_POST['submit'])){


		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		$password = md5($password);
		$usertype = mysqli_real_escape_string($conn, $_POST['usertype']);


		$query = "INSERT INTO users(usertype, username, password) VALUES('$usertype','$username','$password')";

		mysqli_query($conn, $query);
	}
?>

<div class="container-fluid">
	<form class="form-horizontal" id="dischargeform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<fieldset>


<legend>Add users</legend>


<div class="form-group">
  <label class="col-md-4 control-label" for="username">User Name</label>  
	  <div class="col-md-4">
	  	<input id="username" name="username" type="text" placeholder="Username" class="form-control input-md" required="">  
	  </div>
</div>




<div class="form-group">
  <label class="col-md-4 control-label" for="location">Password</label>  
	  <div class="col-md-4">
	  	<input id="password" name="password" type="password" placeholder="Password" class="form-control input-md" required="">
	  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="usertype">usertype</label>
  <div class="col-md-4">
    <select id="usertype" name="usertype" class="form-control">
      <option value="101">Employee</option>
      <option value="102">Admin</option>
    </select>
  </div>
</div>




<div class="form-group">
	<input type="submit" name="submit" class="input-md btn btn-success center-block" value="submit">
</div>
</fieldset>
</form>

<?php include('includes/footer.php'); ?>