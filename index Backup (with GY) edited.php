<?php 
require_once('includes/header.php'); ?>
<style>
<?php  include('includes/manual.css'); ?>
</style>

<?php 


	// User log-in
	if (isset($_POST['login'])){

    $username = mysqli_real_escape_string($conn, $_POST['username']);
	 	$password = mysqli_real_escape_string($conn, $_POST['password']);
	 	

	 	// Get user to check if username and password match

	  	$sql = "SELECT * FROM user WHERE employee_ID = '$username' AND password = '$password'";
	  	$query = mysqli_query($conn,$sql);
    	$row = mysqli_fetch_array($query,MYSQLI_ASSOC);
   

  		// Check if user is logged in
	    $sql2 = "SELECT * FROM timeCheck WHERE status = 'Logged in' AND user_ID = '".$row['user_ID']."'";
	    $query2 = mysqli_query($conn,$sql2);
    	$row2 = mysqli_fetch_array($query2,MYSQLI_ASSOC);
    	$resultNo = mysqli_num_rows($query2);
   

   		// Check if user is existing/correct credetials given
    	if(!$row){
    			?> <script> alert ("Incorrect Username or Password!")</script><?php
    	}

    	// Check if user is logged in
    	if ($row2){
    		?> <script> alert ("You are already Logged in!")</script><?php
    	}

    	// check returned user information
    	if(!$resultNo){
      
      		if ($row['department'] == 'Admin') {
      			$date = date("Y-n-d");
      			$time = date("H:i:s");
        
        		$userID = $row['user_ID'];
			 	$username = $row['employee_id'];
			  	$firstname = $row['first_name'];
			  	$lastname = $row['last_name'];
			  	$department = $row['department'];
      			$shift = $row['shift'];

        		$status = "Logged in";

        		// Morning shift conditions (early & late)
        		if($shift == "Morning" && $time > "06:01:00"){
        			$sql3 = "INSERT INTO timeCheck (login_date, login_time, status, sched_status, user_ID) VALUES('$date', '$time','$status', 'Late' , '$userID')";
        			$query3 = mysqli_query($conn,$sql3);

        			?> <script> alert ("Welcome, <?=$firstname?> <?=$lastname?>! You have successfully Logged in."+"\n"+"Log in Date: <?=$date?>"+"\n"+"Log in time: <?=$time?>")</script><?php
        		}

        		elseif($shift == "Morning" && $time < "05:30:00"){
        			$sql3 = "INSERT INTO timeCheck (login_date, login_time, status, sched_status, user_ID) VALUES('$date', '$time','$status', 'Early' , '$userID')";
        			$query3 = mysqli_query($conn,$sql3);

        			?> <script> alert ("Welcome, <?=$firstname?> <?=$lastname?>! You have successfully Logged in."+"\n"+"Log in Date: <?=$date?>"+"\n"+"Log in time: <?=$time?>")</script><?php
        		}


        		// Mid shift conditions (early & late)
        		elseif($shift == "Mid" && $time > "12:01:00"){
        			$sql3 = "INSERT INTO timeCheck (login_date, login_time, status, sched_status, user_ID) VALUES('$date', '$time','$status', 'Late' , '$userID')";
        			$query3 = mysqli_query($conn,$sql3);

        			?> <script> alert ("Welcome, <?=$firstname?> <?=$lastname?>! You have successfully Logged in."+"\n"+"Log in Date: <?=$date?>"+"\n"+"Log in time: <?=$time?>")</script><?php
        		}

        		elseif($shift == "Mid" && $time < "11:30:00"){
        			$sql3 = "INSERT INTO timeCheck (login_date, login_time, status, sched_status, user_ID) VALUES('$date', '$time','$status', 'Early' , '$userID')";
        			$query3 = mysqli_query($conn,$sql3);

        			?> <script> alert ("Welcome, <?=$firstname?> <?=$lastname?>! You have successfully Logged in."+"\n"+"Log in Date: <?=$date?>"+"\n"+"Log in time: <?=$time?>")</script><?php
        		}


        		// GY shift conditions (early & late)
        		elseif($shift == "GY" && $time > "21:01:00"){
        			$sql3 = "INSERT INTO timeCheck (login_date, login_time, status, sched_status, user_ID) VALUES('$date', '$time','$status', 'Late' , '$userID')";
        			$query3 = mysqli_query($conn,$sql3);

        			?> <script> alert ("Welcome, <?=$firstname?> <?=$lastname?>! You have successfully Logged in."+"\n"+"Log in Date: <?=$date?>"+"\n"+"Log in time: <?=$time?>")</script><?php
        		}

        		elseif($shift == "GY" && $time < "20:30:00"){
        			$sql3 = "INSERT INTO timeCheck (login_date, login_time, status, sched_status, user_ID) VALUES('$date', '$time','$status', 'Early' , '$userID')";
        			$query3 = mysqli_query($conn,$sql3);

        			?> <script> alert ("Welcome, <?=$firstname?> <?=$lastname?>! You have successfully Logged in."+"\n"+"Log in Date: <?=$date?>"+"\n"+"Log in time: <?=$time?>")</script><?php
        		}


        		// On-time condition
        		else{

        			$sql3 = "INSERT INTO timeCheck (login_date, login_time, status, sched_status, user_ID) VALUES('$date', '$time','$status', 'On-time' , '$userID')";
        			$query3 = mysqli_query($conn,$sql3);

        			?> <script> alert ("Welcome, <?=$firstname?> <?=$lastname?>! You have successfully Logged in."+"\n"+"Log in Date: <?=$date?>"+"\n"+"Log in time: <?=$time?>")</script><?php
        		
        		}
        		

      		}
    	} 
		
		// Same description as above (different department)
    	if(!$resultNo){
        	if ($row['department'] == 'NOC') {
        		$date = date("Y-n-d");
    			$time = date("H:i:s");

          		$userID = $row['user_ID'];
			 	$username = $row['employee_id'];
			  	$firstname = $row['first_name'];
			  	$lastname = $row['last_name'];
			  	$department = $row['department'];
			  	$shift = $row['shift'];


          		$status = "Logged in";

          		// Morning
				if($shift == "Morning" && $time > "06:01:00"){
        			$sql3 = "INSERT INTO timeCheck (login_date, login_time, status, sched_status, user_ID) VALUES('$date', '$time','$status', 'Late' , '$userID')";
        			$query3 = mysqli_query($conn,$sql3);

        			?> <script> alert ("Welcome, <?=$firstname?> <?=$lastname?>! You have successfully Logged in."+"\n"+"Log in Date: <?=$date?>"+"\n"+"Log in time: <?=$time?>")</script><?php
        		}

        		elseif($shift == "Morning" && $time < "05:30:00"){
        			$sql3 = "INSERT INTO timeCheck (login_date, login_time, status, sched_status, user_ID) VALUES('$date', '$time','$status', 'Early' , '$userID')";
        			$query3 = mysqli_query($conn,$sql3);

        			?> <script> alert ("Welcome, <?=$firstname?> <?=$lastname?>! You have successfully Logged in."+"\n"+"Log in Date: <?=$date?>"+"\n"+"Log in time: <?=$time?>")</script><?php
        		}


        		// Mid
        		elseif($shift == "Mid" && $time > "12:01:00"){
        			$sql3 = "INSERT INTO timeCheck (login_date, login_time, status, sched_status, user_ID) VALUES('$date', '$time','$status', 'Late' , '$userID')";
        			$query3 = mysqli_query($conn,$sql3);

        			?> <script> alert ("Welcome, <?=$firstname?> <?=$lastname?>! You have successfully Logged in."+"\n"+"Log in Date: <?=$date?>"+"\n"+"Log in time: <?=$time?>")</script><?php
        		}

        		elseif($shift == "Mid" && $time < "11:30:00"){
        			$sql3 = "INSERT INTO timeCheck (login_date, login_time, status, sched_status, user_ID) VALUES('$date', '$time','$status', 'Early' , '$userID')";
        			$query3 = mysqli_query($conn,$sql3);

        			?> <script> alert ("Welcome, <?=$firstname?> <?=$lastname?>! You have successfully Logged in."+"\n"+"Log in Date: <?=$date?>"+"\n"+"Log in time: <?=$time?>")</script><?php
        		}


        		// GY
        		elseif($shift == "GY" && $time > "21:01:00"){
        			$sql3 = "INSERT INTO timeCheck (login_date, login_time, status, sched_status, user_ID) VALUES('$date', '$time','$status', 'Late' , '$userID')";
        			$query3 = mysqli_query($conn,$sql3);

        			?> <script> alert ("Welcome, <?=$firstname?> <?=$lastname?>! You have successfully Logged in."+"\n"+"Log in Date: <?=$date?>"+"\n"+"Log in time: <?=$time?>")</script><?php
        		}

        		elseif($shift == "GY" && $time < "20:30:00"){
        			$sql3 = "INSERT INTO timeCheck (login_date, login_time, status, sched_status, user_ID) VALUES('$date', '$time','$status', 'Early' , '$userID')";
        			$query3 = mysqli_query($conn,$sql3);

        			?> <script> alert ("Welcome, <?=$firstname?> <?=$lastname?>! You have successfully Logged in."+"\n"+"Log in Date: <?=$date?>"+"\n"+"Log in time: <?=$time?>")</script><?php
        		}

        		// On-time
        		else{

        			$sql3 = "INSERT INTO timeCheck (login_date, login_time, status, sched_status, user_ID) VALUES('$date', '$time','$status', 'On-time' , '$userID')";
        			$query3 = mysqli_query($conn,$sql3);

        			?> <script> alert ("Welcome, <?=$firstname?> <?=$lastname?>! You have successfully Logged in."+"\n"+"Log in Date: <?=$date?>"+"\n"+"Log in time: <?=$time?>")</script><?php
        		
        		}
        	}
      	}
      	
    } 
	

    // User log out
    if (isset($_POST['logout'])){
     
      	$date = date("Y-n-d");
      	$time = date("H:i:s");
      

      	$username = mysqli_real_escape_string($conn, $_POST['username']);
     	$password = mysqli_real_escape_string($conn, $_POST['password']);


		// Get user to check if username and password match
    	$sql4 = "SELECT * FROM user WHERE employee_ID = '$username' AND password = '$password'";
      	$query4 = mysqli_query($conn,$sql4);
    	


    	$row4 = mysqli_fetch_array($query4,MYSQLI_ASSOC);

      	$userID = $row4['user_ID'];
      	$username = $row4['employee_id'];
      	$firstname = $row4['first_name'];
      	$lastname = $row4['last_name'];
      	$department = $row4['department'];
      	$shift = $row4['shift'];


      	// Check if user is logged in
      	$sql5 = "SELECT * FROM timeCheck WHERE status = 'Logged in' AND user_ID = '".$row4['user_ID']."'";
      	$query5 = mysqli_query($conn,$sql5);
      	$row5 = mysqli_fetch_array($query5,MYSQLI_ASSOC);
      
	    $resultNo2 = mysqli_num_rows($query5);

      
      	// checks returned user info
    	if($resultNo2){

    		// Checker if date is 1 day after log-in
    		$checkDate = date('Y-m-d', strtotime($row5['login_date'] . '+1 day'));

    		// GY log out condition

    		// On-time log out
      		if($shift == "GY" && $date == $checkDate && $time >= "06:00:00" && $time <= "07:00:00" && $row5['login_time'] >= "20:00:00" && $row5['login_time'] <= "21:00:00"){
      			?> "<script type='text/javascript'>alert("Thank you,<?=$firstname?> <?=$lastname?>! You have successfully Logged out."+"\n"+"Log out Date: <?=$date?>"+"\n"+"Log out time: <?=$time?>");
				window.location='index.php';
				</script>";
				<?php

      			$sql6 = "UPDATE timecheck SET logout_date ='".$date."', logout_time ='".$time."', status ='Logged out' WHERE status = 'Logged in' AND user_ID = '".$row5['user_ID']."' ";
        		$query6 = mysqli_query($conn,$sql6);
				session_destroy();    
        		exit();
      		}

      		// Undertime log out (less than 9 hours)
      		elseif($shift == "GY" && $date == $checkDate && $time < "06:00:00" && $row5['login_time'] <= "21:00:00"){
      			?> <script> alert ("You are below the required time needed.")</script><?php

	    	  		?> "<script type='text/javascript'>alert("Thank you,<?=$firstname?> <?=$lastname?>! You have successfully Logged out."+"\n"+"Log out Date: <?=$date?>"+"\n"+"Log out time: <?=$time?>");
					window.location='index.php';
					</script>";
					<?php

      			$sql6 = "UPDATE timecheck SET logout_date ='".$date."', logout_time ='".$time."', status ='Logged out', sched_status ='Undertime' WHERE status = 'Logged in' AND user_ID = '".$row5['user_ID']."' ";
        		$query6 = mysqli_query($conn,$sql6);
				session_destroy();    
        		exit();
        	}

        	// Undertime log out (less than 9 hours & same log out date as login date)
        	elseif($shift == "GY" && $date == $row5['login_date']){
      			?> <script> alert ("You are below the required time needed.")</script><?php

	    	  		?> "<script type='text/javascript'>alert("Thank you,<?=$firstname?> <?=$lastname?>! You have successfully Logged out."+"\n"+"Log out Date: <?=$date?>"+"\n"+"Log out time: <?=$time?>");
					window.location='index.php';
					</script>";
					<?php

      			$sql6 = "UPDATE timecheck SET logout_date ='".$date."', logout_time ='".$time."', status ='Logged out', sched_status ='Undertime' WHERE status = 'Logged in' AND user_ID = '".$row5['user_ID']."' ";
        		$query6 = mysqli_query($conn,$sql6);
				session_destroy();    
        		exit();
        	}


        	// Overtime logout (more than 9 hours, late log out time)
			elseif($shift == "GY" && $date == $checkDate && $time > "07:00:00"  && $row5['login_time'] >= "20:00:00" && $row5['login_time'] <= "21:00:00"){
      			
	    	  		?> "<script type='text/javascript'>alert("Thank you,<?=$firstname?> <?=$lastname?>! You have successfully Logged out."+"\n"+"Log out Date: <?=$date?>"+"\n"+"Log out time: <?=$time?>");
					window.location='index.php';
					</script>";
					<?php

      			$sql6 = "UPDATE timecheck SET logout_date ='".$date."', logout_time ='".$time."', status ='Logged out', sched_status ='Overtime' WHERE status = 'Logged in' AND user_ID = '".$row5['user_ID']."' ";
        		$query6 = mysqli_query($conn,$sql6);
				session_destroy();    
        		exit();
        	}
        	

        	// Overtime logout (more than 9 hours, early log in time)
			elseif($shift == "GY" && $date == $checkDate && $time >= "06:00:00" && $time <= "07:00:00"  && $row5['login_time'] < "20:00:00"){
      			
	    	  		?> "<script type='text/javascript'>alert("Thank you,<?=$firstname?> <?=$lastname?>! You have successfully Logged out."+"\n"+"Log out Date: <?=$date?>"+"\n"+"Log out time: <?=$time?>");
					window.location='index.php';
					</script>";
					<?php

      			$sql6 = "UPDATE timecheck SET logout_date ='".$date."', logout_time ='".$time."', status ='Logged out', sched_status ='Overtime' WHERE status = 'Logged in' AND user_ID = '".$row5['user_ID']."' ";
        		$query6 = mysqli_query($conn,$sql6);
				session_destroy();    
        		exit();
        	}	
      		

        	// Morning shift conditions

      		// Overtime logout (more than 9 hours, next day log out)
			elseif($shift == "Morning" && $date == $checkDate){
      			?> "<script type='text/javascript'>alert("Thank you,<?=$firstname?> <?=$lastname?>! You have successfully Logged out."+"\n"+"Log out Date: <?=$date?>"+"\n"+"Log out time: <?=$time?>");
				window.location='index.php';
				</script>";
				<?php

      			$sql6 = "UPDATE timecheck SET logout_date ='".$date."', logout_time ='".$time."', status ='Logged out', sched_status ='Overtime' WHERE status = 'Logged in' AND user_ID = '".$row5['user_ID']."' ";
        		$query6 = mysqli_query($conn,$sql6);
				session_destroy();    
        		exit();
        	}

        	// Overtime logout (more than 9 hours)
        	elseif($shift == "Morning" && $time > "16:00:00" && $row5['login_time'] <= "06:00:00" && $row5['login_time'] >= "05:00:00" || $shift == "Morning" && $time >= "15:00:00" && $row5['login_time'] < "05:00:00"){
      			?> "<script type='text/javascript'>alert("Thank you,<?=$firstname?> <?=$lastname?>! You have successfully Logged out."+"\n"+"Log out Date: <?=$date?>"+"\n"+"Log out time: <?=$time?>");
				window.location='index.php';
				</script>";
				<?php

      			$sql6 = "UPDATE timecheck SET logout_date ='".$date."', logout_time ='".$time."', status ='Logged out', sched_status ='Overtime' WHERE status = 'Logged in' AND user_ID = '".$row5['user_ID']."' ";
        		$query6 = mysqli_query($conn,$sql6);
				session_destroy();    
        		exit();
        	}


        	// Undertime logout (less than 9 hours)
			elseif($shift == "Morning"  && $time < "15:00:00" && $row5['login_time'] <= "06:00:00" || $shift == "Morning"  && $time <= "15:00:00" && $row5['login_time'] >= "07:00:00"){
      			?> <script> alert ("You are below the required time needed.")</script><?php

    	  		?> "<script type='text/javascript'>alert("Thank you,<?=$firstname?> <?=$lastname?>! You have successfully Logged out."+"\n"+"Log out Date: <?=$date?>"+"\n"+"Log out time: <?=$time?>");
				window.location='index.php';
				</script>";
				<?php

      			$sql6 = "UPDATE timecheck SET logout_date ='".$date."', logout_time ='".$time."', status ='Logged out', sched_status ='Undertime' WHERE status = 'Logged in' AND user_ID = '".$row5['user_ID']."' ";
        		$query6 = mysqli_query($conn,$sql6);
				session_destroy();    
        		exit();
        	}


        	// Mid shift conditions

      		// Overtime logout (more than 9 hours, next day log out)
			elseif($shift == "Mid" && $date == $checkDate){
      			?> "<script type='text/javascript'>alert("Thank you,<?=$firstname?> <?=$lastname?>! You have successfully Logged out."+"\n"+"Log out Date: <?=$date?>"+"\n"+"Log out time: <?=$time?>");
				window.location='index.php';
				</script>";
				<?php

      			$sql6 = "UPDATE timecheck SET logout_date ='".$date."', logout_time ='".$time."', status ='Logged out', sched_status ='Overtime' WHERE status = 'Logged in' AND user_ID = '".$row5['user_ID']."' ";
        		$query6 = mysqli_query($conn,$sql6);
				session_destroy();    
        		exit();
        	}

        	// Overtime logout (more than 9 hours)
        	elseif($shift == "Mid" && $time > "22:00:00" && $row5['login_time'] <= "12:00:00" && $row5['login_time'] >= "11:00:00" || $shift == "Mid" && $time >= "21:00:00" && $row5['login_time'] < "11:00:00"){
      			?> "<script type='text/javascript'>alert("Thank you,<?=$firstname?> <?=$lastname?>! You have successfully Logged out."+"\n"+"Log out Date: <?=$date?>"+"\n"+"Log out time: <?=$time?>");
				window.location='index.php';
				</script>";
				<?php

      			$sql6 = "UPDATE timecheck SET logout_date ='".$date."', logout_time ='".$time."', status ='Logged out', sched_status ='Overtime' WHERE status = 'Logged in' AND user_ID = '".$row5['user_ID']."' ";
        		$query6 = mysqli_query($conn,$sql6);
				session_destroy();    
        		exit();
        	}


        	// Undertime logout (less than 9 hours)
			elseif($shift == "Mid"  && $time < "21:00:00" && $row5['login_time'] <= "12:00:00" || $shift == "Morning"  && $time <= "21:00:00" && $row5['login_time'] >= "22:00:00"){
      			?> <script> alert ("You are below the required time needed.")</script><?php

    	  		?> "<script type='text/javascript'>alert("Thank you,<?=$firstname?> <?=$lastname?>! You have successfully Logged out."+"\n"+"Log out Date: <?=$date?>"+"\n"+"Log out time: <?=$time?>");
				window.location='index.php';
				</script>";
				<?php

      			$sql6 = "UPDATE timecheck SET logout_date ='".$date."', logout_time ='".$time."', status ='Logged out', sched_status ='Undertime' WHERE status = 'Logged in' AND user_ID = '".$row5['user_ID']."' ";
        		$query6 = mysqli_query($conn,$sql6);
				session_destroy();    
        		exit();
        	}


        	// Not logged-in
        	elseif(!$row5){
      		  ?> <script> alert ("You must be Logged in to do this action!")</script><?php
      		
      		} 

      		// On-time log out
      		else{
    			?> "<script type='text/javascript'>alert("Thank you,<?=$firstname?> <?=$lastname?>! You have successfully Logged out."+"\n"+"Log out Date: <?=$date?>"+"\n"+"Log out time: <?=$time?>");
				window.location='index.php';
				</script>";
				<?php

				$sql6 = "UPDATE timecheck SET logout_date ='".$date."', logout_time ='".$time."', status ='Logged out' WHERE status = 'Logged in' AND user_ID = '".$row5['user_ID']."' ";
        		$query6 = mysqli_query($conn,$sql6);
				session_destroy();    
        		exit();
    		}

      	
      
      
      

        

      }
    }
  


?>

<!-- Log in/Log out Form -->

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


