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
	 	$password = md5($password);

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
    			?> <script> alert ("Incorrect Username or Password! Please contact System Administrator")</script><?php
    	}

    	// Check if user is logged in
    	if ($row2){
    		?> <script> alert ("You are already Logged in!")</script><?php
    	}

    	// check returned user information
    	if(!$resultNo){
        
      		if (in_array($row['department'], array('SuperAdmin', 'AdminNOC', 'AdminFS', 'AdminCS', 'NOC', 'FS', 'CS'))) {
      			$date = date("Y-n-d");
            
        
         		$userID = $row['user_ID'];
  	   		 	$username = $row['employee_id'];
			    	$firstname = $row['first_name'];
			     	$lastname = $row['last_name'];
			  	  $department = $row['department'];


        		$status = "Logged in";
            $sched_status = "On-time";

        		
            //get schedule

            $checkSchedule = mysqli_query($conn, "SELECT sched_Date, shift_ID from schedule WHERE (schedule.sched_Date = '$date')  AND  (schedule.user_ID = '$userID')");
            

            if (mysqli_num_rows($checkSchedule) > 0){

              while($row = mysqli_fetch_assoc($checkSchedule)){
                $shiftID = $row['shift_ID'];
                $checkShift = mysqli_query($conn, "SELECT * from shift WHERE shift_ID = '$shiftID'");

                if (mysqli_num_rows($checkShift) > 0){
                  
                  while ($row2 = mysqli_fetch_assoc($checkShift)){
                     $time = date("H:i:s");
                      
                      $check1 = date("H:i", strtotime($time));
                      $check2 = date("H:i", strtotime($row2['shift_time_in']));


                     //On-time time in
                    if ( $check1 == $check2){

                      
                      $sql3 = "INSERT INTO timecheck (login_date, login_time, status, user_ID, sched_status) VALUES('$date', '$time','$status', '$userID', '$sched_status')";
                      $query3 = mysqli_query($conn,$sql3);

                      ?> <script> alert ("Welcome, <?=$firstname?> <?=$lastname?>! You have successfully Logged in."+"\n"+"Log in Date: <?=$date?>"+"\n"+"Log in time: <?=$time?>")</script><?php
                    }

                    //Late time-in
                    elseif($time > $row2['shift_time_in']){
                      $sched_status = "Late";

                     
                      $sql3 = "INSERT INTO timecheck (login_date, login_time, status, user_ID, sched_status) VALUES('$date', '$time','$status', '$userID', '$sched_status')";
                      $query3 = mysqli_query($conn,$sql3);

                      ?> <script> alert ("Welcome, <?=$firstname?> <?=$lastname?>! You have successfully Logged in."+"\n"+"Log in Date: <?=$date?>"+"\n"+"Log in time: <?=$time?>")</script><?php

                    }

                    //Early time-in
                    elseif($time < $row2['shift_time_in']){
                      $sched_status = "Early";

                      //Insert into conditions (if scheduled and if on-time/late)
                      $sql3 = "INSERT INTO timecheck (login_date, login_time, status, user_ID, sched_status) VALUES('$date', '$time','$status', '$userID', '$sched_status')";
                      $query3 = mysqli_query($conn,$sql3);

                      ?> <script> alert ("Welcome, <?=$firstname?> <?=$lastname?>! You have successfully Logged in."+"\n"+"Log in Date: <?=$date?>"+"\n"+"Log in time: <?=$time?>")</script><?php

                    }
                      
                  }

                } 

              }              

            }
            
            else {
            $time = date("H:i:s");
              $sched_status = "Unscheduled Log-in";
              $sql3 = "INSERT INTO timecheck (login_date, login_time, status, user_ID, sched_status) VALUES('$date', '$time','$status', '$userID', '$sched_status')";
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
     	$password = md5($password);

		  // Get user to check if username and password match
    	$sql4 = "SELECT * FROM user WHERE employee_ID = '$username' AND password = '$password'";
      $query4 = mysqli_query($conn,$sql4);
    	


    	$row4 = mysqli_fetch_array($query4,MYSQLI_ASSOC);

      $userID = $row4['user_ID'];
      $username = $row4['employee_id'];
      $firstname = $row4['first_name'];
      $lastname = $row4['last_name'];
      $department = $row4['department'];
      	


      	// Check if user is logged in
      	$sql5 = "SELECT * FROM timeCheck WHERE status = 'Logged in' AND user_ID = '".$row4['user_ID']."'";
      	$query5 = mysqli_query($conn,$sql5);
      	$row5 = mysqli_fetch_array($query5,MYSQLI_ASSOC);

          // Not logged-in
          if(!$row5){
            ?> <script> alert ("You must be Logged in to do this action!")</script><?php
          } 
      
	    $resultNo2 = mysqli_num_rows($query5);

      
      	// checks returned user info
    	if($resultNo2){

    		// Checker if date is 1 day after log-in
    		$checkDate = date('Y-m-d', strtotime($row5['login_date'] . '+1 day'));

    		

    		// On-time log out
      		
      			?> "<script type='text/javascript'>alert("Thank you,<?=$firstname?> <?=$lastname?>! You have successfully Logged out."+"\n"+"Log out Date: <?=$date?>"+"\n"+"Log out time: <?=$time?>");
				window.location='index.php';
				</script>";
				<?php

      			$sql6 = "UPDATE timecheck SET logout_date ='".$date."', logout_time ='".$time."', status ='Logged out' WHERE status = 'Logged in' AND user_ID = '".$row5['user_ID']."' ";
        		$query6 = mysqli_query($conn,$sql6);
		
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


