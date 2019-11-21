<?php 
require_once('includes/header.php'); ?>

<style>
<?php  include('includes/manual.css'); ?>
</style>

<?php 
	if (isset($_POST['login'])){

    $date = date("Y-n-d H:m:s");
    
     
    $username = mysqli_real_escape_string($conn, $_POST['username']);
	 	$password = mysqli_real_escape_string($conn, $_POST['password']);
	 	

	  $sql = "SELECT * FROM user WHERE employee_ID = '$username' AND password = '$password'";
	  $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($query,MYSQLI_ASSOC);
   
  
    $sql2 = "SELECT * FROM timeCheck WHERE status = 'Logged in' AND user_ID = '".$row['user_ID']."'";
    $query2 = mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($query2,MYSQLI_ASSOC);
    $resultNo = mysqli_num_rows($query2);
   
    
    if(!$resultNo){
      
      if ($row['department'] == 'admin') {
        
        $_SESSION['check'] = $row['user_ID'];
			  $_SESSION['username'] = $row['employee_id'];
			  $_SESSION['firstname'] = $row['first_name'];
			  $_SESSION['lastname'] = $row['last_name'];
			  $_SESSION['department'] = $row['department'];
      
        $userID = $_SESSION['check'];
        $firstname = $_SESSION['firstname'];
        $lastname = $_SESSION['lastname'];
        // $date = $_SESSION['date'];
        $status = "Logged in";


        $sql3 = "INSERT INTO timeCheck (login, status, user_ID) VALUES('$date','$status', '$userID')";
        $query3 = mysqli_query($conn,$sql3);
       
      }

    } 
    
    if(!$resultNo){
        if ($row['department'] == 'NOC') {
      
      

          $_SESSION['check'] = $row['user_ID'];
		      $_SESSION['username'] = $row['employee_id'];
			    $_SESSION['firstname'] = $row['first_name'];
			    $_SESSION['lastname'] = $row['last_name'];
			    $_SESSION['department'] = $row['department'];
          

          $userID = $_SESSION['check'];
          $firstname = $_SESSION['firstname'];
          $lastname = $_SESSION['lastname'];
          // $date = $_SESSION['date'];
          $status = "Logged in";


          $sql3 = "INSERT INTO timeCheck (login, status, user_ID) VALUES('$date','$status', '$userID')";
          $query3 = mysqli_query($conn,$sql3);
       
        }
      }
    } 

    if (isset($_POST['logout'])){
     
      $userID = $_SESSION['check'];
      $date = date("Y-n-d H:m:s");

      $username = mysqli_real_escape_string($conn, $_POST['username']);
      $password = mysqli_real_escape_string($conn, $_POST['password']);

      $sql4 = "SELECT * FROM user WHERE employee_ID = '$username' AND password = '$password'";
      $query4 = mysqli_query($conn,$sql4);
    

      $row4 = mysqli_fetch_array($query4,MYSQLI_ASSOC);
    

      $sql5 = "SELECT * FROM timeCheck WHERE status = 'Logged in' AND user_ID = '".$row4['user_ID']."'";
      $query5 = mysqli_query($conn,$sql5);
      $row5 = mysqli_fetch_array($query5,MYSQLI_ASSOC);

      $resultNo2 = mysqli_num_rows($query5);

      if(!$resultNo2){
        echo "You must first Log in to do this action";

      
      } else{
      

        $sql6 = "UPDATE timecheck SET logout ='".$date."', status ='Logged out' WHERE status = 'Logged in' AND user_ID = '".$row5['user_ID']."' ";
        $query6 = mysqli_query($conn,$sql6);

        echo "Log out Successful";

        header("location:index.php");
        session_destroy();
    
        exit();


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
            <input type="submit" name="login" class="btn btn-def btn-block"value="Login" />
          </div>

          <div class="form-group">
              <input type="submit" name="logout" class="btn btn-def btn-block"value="Log out" />
            </div>

        </form>




      </div>  
    </div>    
  </div>
</div>

<?php include('includes/footer.php'); ?>


