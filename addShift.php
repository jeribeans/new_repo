<?php require_once('includes/header.php'); 

$userID = $_SESSION['check'];
$username = $_SESSION['username'];
$first_name = $_SESSION['firstname'];
$last_name = $_SESSION['lastname'];
$department = $_SESSION['department'];
$dept_check = $_SESSION['department'];
if ($dept_check != "SuperAdmin"){
    $team = $_SESSION['team'];
}
if (!in_array($_SESSION['department'], array('Admin', 'SuperAdmin', 'AdminNOC', 'AdminFS', 'AdminCS'))) {
  header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index2.php");
}
    
include('includes/navbar.php');
include('includes/adminsidebar.php'); 

?>



<LEGEND><h2>Add New Shift</h2></LEGEND>


<style type="text/css"><?php include('includes/common.css'); ?></style>


<div class="container-fluid">

	       
       <div class="container-fluid">
        
        <h3>Shift Information:</h3>     
 
<?php 
    if (isset($_POST['submit'])){

      

      $shiftName = mysqli_real_escape_string($conn, $_POST['shift_name']);
      $timeIn = mysqli_real_escape_string($conn, $_POST['time_in']);
      $timeOut = mysqli_real_escape_string($conn, $_POST['time_out']);

     
      $addShift =  mysqli_query($conn, "INSERT INTO shift (shift, shift_time_in, shift_time_out) VALUES('$shiftName', '$timeIn','$timeOut')");
      ?> <script> alert ("<?=$shiftName?> added!"+"\n"+"Time in: <?=$timeIn?>"+"\n"+"Time out: <?=$timeOut?>")</script><?php

      

    }
?>



<div class="container">
  <div class="row">
    <div class="Absolute-Center is-Responsive">
      <div id="logo-container"></div>
      <div class="col-sm-12 col-md-10 col-md-offset-1">

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="addShiftForm" method="post">

          <label for="sel1">Shift Name:</label>
          <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
            <input class="form-control" type="text" name='shift_name' placeholder="Shift Name (e.g. Morning Shift, Mid-Day Shift, GY Shift)" required="true">          
          </div>

          
          <label for="sel1">Time in:</label>
          <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
            <input class="form-control" type="time" name='time_in' required="true">          
          </div>


          <label for="sel1">Time out:</label>
          <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
            <input class="form-control" type="time" name='time_out' required="true">          
          </div>


          <div class="form-group">
            <input type="submit" name="submit" class="btn btn-def btn-block" value="Submit" />
          </div>
        </form>
      </div>  
    </div>    
  </div>
</div>

<?php include('includes/footer.php'); ?>