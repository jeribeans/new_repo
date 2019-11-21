<?php 
include('includes/header.php'); ?>
<style>
<?php include('includes/manual.css'); ?>
</style>

<?php 
	if (isset($_POST['submit'])){

	 	$username = mysqli_real_escape_string($conn, $_POST['username']);
	 	$password = mysqli_real_escape_string($conn, $_POST['password']);
	 	$password = md5($password);

	 $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
	 $query = mysqli_query($conn,$sql);
	 $row = mysqli_fetch_array($query,MYSQLI_ASSOC);


		if ($row['usertype'] == '102') {

			$_SESSION['username'] = $username;
			$_SESSION['usertype'] = $row['usertype'];

			header('Location:adminpage.php');
		}
		else if ($row['usertype'] == '101') {

			$_SESSION['username'] = $username;
			$_SESSION['usertype'] = $row['usertype'];

			header('Location:homepage.php');
		}
		else {

			header('Location: index.php');
			$message.='<p>Please try again';
			}
	}
?>

<div class="container">
  <div class="row">
    <div class="Absolute-Center is-Responsive">
      <div id="logo-container"></div>
      <div class="col-sm-12 col-md-10 col-md-offset-1">

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="loginForm" method="post">
          <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input class="form-control" type="text" name='username' placeholder="username" maxlength="30" value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>">          
          </div>
          <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input class="form-control" type="password" name='password' placeholder="password"/>     
          </div>
          <div class="form-group">
            <input type="submit" name="submit" class="btn btn-def btn-block" value="Login" />
          </div>
        </form>

      </div>  
    </div>    
  </div>
</div>

<?php include('includes/footer.php'); ?>


