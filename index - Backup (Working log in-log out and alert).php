<?php 
require_once('includes/header.php'); ?>



<style>
<?php  include('includes/manual.css'); ?>
</style>

<?php 
	if (isset($_POST['login'])){

    	$username = mysqli_real_escape_string($conn, $_POST['username']);
	 	$password = mysqli_real_escape_string($conn, $_POST['password']);
	 	

	  	$sql = "SELECT * FROM user WHERE employee_ID = '$username' AND password = '$password'";
	  	$query = mysqli_query($conn,$sql);
    	$row = mysqli_fetch_array($query,MYSQLI_ASSOC);
   
  
	    $sql2 = "SELECT * FROM timeCheck WHERE status = 'Logged in' AND user_ID = '".$row['user_ID']."'";
	    $query2 = mysqli_query($conn,$sql2);
    	$row2 = mysqli_fetch_array($query2,MYSQLI_ASSOC);
    	$resultNo = mysqli_num_rows($query2);
   
    	if(!$row){
    			?> <script> alert ("Incorrect Username or Password!")</script><?php
    	}
    	if ($row2){
    		?> <script> alert ("You are already Logged in!")</script><?php
    	}

    	if(!$resultNo){
      
      		if ($row['department'] == 'admin') {
      			$date = date("Y-n-d");
      			$time = date("H:i:s");
        
        		$userID = $row['user_ID'];
			 	$username = $row['employee_id'];
			  	$firstname = $row['first_name'];
			  	$lastname = $row['last_name'];
			  	$department = $row['department'];
      
        		
        		$status = "Logged in";


        		$sql3 = "INSERT INTO timeCheck (login_date, login_time, status, user_ID) VALUES('$date', '$time','$status', '$userID')";
        		$query3 = mysqli_query($conn,$sql3);

        		?> <script> alert ("Welcome, <?=$firstname?> <?=$lastname?>! You have successfully Logged in."+"\n"+"Log in Date: <?=$date?>"+"\n"+"Log in time: <?=$time?>")</script><?php

      		}
    	} 
    
    	if(!$resultNo){
        	if ($row['department'] == 'NOC') {
        		$date = date("Y-n-d");
    			$time = date("H:i:s");

          		$userID = $row['user_ID'];
			 	$username = $row['employee_id'];
			  	$firstname = $row['first_name'];
			  	$lastname = $row['last_name'];
			  	$department = $row['department'];


          		$status = "Logged in";


		        $sql3 = "INSERT INTO timeCheck (login_date, login_time, status, user_ID) VALUES('$date', '$time','$status', '$userID')";
          		$query3 = mysqli_query($conn,$sql3);
          		?> <script> alert ("Welcome, <?=$firstname?> <?=$lastname?>! You have successfully Logged in."+"\n"+"Log in Date: <?=$date?>"+"\n"+"Log in time: <?=$time?>")</script><?php
        	}
      	}
      	
    } 
	

    if (isset($_POST['logout'])){
     
      // $userID = $_SESSION['check'];
      $date = date("Y-n-d");
      $time = date("H:i:s");



      $username = mysqli_real_escape_string($conn, $_POST['username']);
      $password = mysqli_real_escape_string($conn, $_POST['password']);

      $sql4 = "SELECT * FROM user WHERE employee_ID = '$username' AND password = '$password'";
      $query4 = mysqli_query($conn,$sql4);
    	


      $row4 = mysqli_fetch_array($query4,MYSQLI_ASSOC);

      $userID = $row4['user_ID'];
      $username = $row4['employee_id'];
      $firstname = $row4['first_name'];
      $lastname = $row4['last_name'];
      $department = $row4['department'];

      $sql5 = "SELECT * FROM timeCheck WHERE status = 'Logged in' AND user_ID = '".$row4['user_ID']."'";
      $query5 = mysqli_query($conn,$sql5);
      $row5 = mysqli_fetch_array($query5,MYSQLI_ASSOC);
      
      $resultNo2 = mysqli_num_rows($query5);
      
      
      if($resultNo2){

      	if (strtotime($time) <= time()+32400){
      		?> <script> alert ("Are you sure you want to log out? You are below the minimum required time")</script><?php

      	}

      	?> "<script type='text/javascript'>alert("Thank you,<?=$firstname?> <?=$lastname?>! You have successfully Logged out."+"\n"+"Log out Date: <?=$date?>"+"\n"+"Log out time: <?=$time?>");
		window.location='index.php';
		</script>";
		<?php
		$sql6 = "UPDATE timecheck SET logout_date ='".$date."', logout_time ='".$time."', status ='Logged out' WHERE status = 'Logged in' AND user_ID = '".$row5['user_ID']."' ";
        $query6 = mysqli_query($conn,$sql6);
		session_destroy();    
        exit();


      }

      
      if(!$row5){
        ?> <script> alert ("You must be Logged in to do this action!")</script><?php
      } else{
      

        

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
            <input class="form-control" type="text" name='username' placeholder="username" maxlength="30" autocomplete="off" value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>">          
          </div>
          <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input class="form-control" autocomplete="off" type="password" name='password' placeholder="password"/>     
          </div>
          <div class="form-group">
            <input type="submit" name="login" class="btn btn-def btn-block" data-toggle="modal" data-target="#myModal" value="Login" />
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


