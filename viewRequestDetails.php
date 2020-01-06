<?php require_once('includes/header.php'); 

$userID = $_SESSION['check'];
$department = $_SESSION['department'];
$dept_check = $_SESSION['department'];
if ($dept_check != "SuperAdmin"){
    $team = $_SESSION['team'];
}

$getID  = $_GET['IDval'];
$getRVal = $_GET['RVal'];

$getEmployeeRequest = mysqli_query($conn, "SELECT * FROM request where user_ID = '$getID' AND request_ID = '$getRVal'");
$row2 = mysqli_fetch_array($getEmployeeRequest,MYSQLI_ASSOC);

$employeeRequestID = $row2['user_ID'];
$requestID = $row2['request_ID'];
$reason = $row2['reason'];
$requestDate = $row2['request_Date'];
$leaveType = $row2['leave_type'];
$strtDate = $row2['start_Date'];
$endDate = $row2['end_Date'];



$sql = "SELECT * FROM user WHERE user_ID = '$employeeRequestID'";
$query = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($query,MYSQLI_ASSOC);


$user = $row['user_ID'];    
$name = $row['first_name'];
$middlename = $row['middle_name'];
$last = $row['last_name'];
$email = $row['email'];
$contact = $row['contact_num'];
$employeeID = $row['employee_id'];




if (isset($_POST['approve'])){
  $test = $_POST['requestid'];
  $sql = "UPDATE request SET status ='APPROVED' WHERE request_ID = '$test' ";
  $query = mysqli_query($conn,$sql);


  header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/adminpage.php");


  }

if (isset($_POST['decline'])){
 $test = $_POST['requestid'];
  $sql = "UPDATE request SET status ='DECLINED' WHERE request_ID = '$test' ";
  $query = mysqli_query($conn,$sql);


  header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/adminpage.php");


  }

?>



<?php 
 if (!in_array($_SESSION['department'], array('Admin', 'SuperAdmin', 'AdminNOC', 'AdminFS', 'AdminCS'))) {
  header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index2.php");
}
?>
<style type="text/css"><?php include('includes/common.css'); ?></style>
<?php include('includes/navbar.php'); ?>
<?php include('includes/adminsidebar.php'); ?>

<div class="container-fluid">

	       
       <div class="container-fluid">
        
        <legend><h3>Request Details:</h3></legend>     
 
<div class="container">
  <div class="row">
    <div class="Absolute-Center is-Responsive">
      <div id="logo-container"></div>
      <div class="col-sm-12 col-md-10 col-md-offset-1">

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="addUserForm" method="post">

          <input class="form-control" type="hidden" name='requestid' value="<?=$requestID ?>">

          <label for="sel1">Employee Name:</label>
          <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input class="form-control" type="text" name='firstname' value="<?php echo $name. " ".$last; ?>" required="true" readonly>          
          </div>


          <label for="sel1">Request submitted:</label>
          <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            <input class="form-control" type="calendar" name='contactNumber' value="<?php echo $requestDate; ?>" required="true" readonly>          
          </div>

          <label for="sel1">Leave Type:</label>
          <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input class="form-control" type="text" name='firstname' value="<?php echo $leaveType?>" required="true" readonly>          
          </div>

          <label for="sel1">Requested Date of Leave:</label>
          
          <div class="form-group input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            <input class="form-control" type="calendar" name='contactNumber' value="<?php echo $strtDate; ?>" required="true" readonly>          
          </div>
          <label for="sel1">End Date:</label>
          
          <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            <input class="form-control" type="calendar" name='contactNumber' value="<?php echo $endDate; ?>" required="true" readonly>          
          </div>

          <label for="sel1">Reason:</label>
          <div class="form-group input-group">

            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <textarea name="textarea" style="width:900px;height:150px;" readonly><?php echo $reason ?></textarea>
            <input class="form-control" type="hidden" name='firstname' value="<?php echo $reason ?>" required="true" style="height:200px" hidden="true">
          </div>


          <div class="form-group">
            <input type="submit" name="approve" class="btn btn-def btn-block" value="Approve" />
          </div>

          <div class="form-group">
            <input type="submit" name="decline" class="btn btn-def btn-block" value="Decline" />
          </div>

        </form>
      </div>  
    </div>    
  </div>
</div>

<?php include('includes/footer.php'); ?>