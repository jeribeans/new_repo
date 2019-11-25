<?php require_once('includes/header.php'); 

if ($_SESSION['department']!='NOC'){
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index2.php");
}

$userID = $_SESSION['check'];
$date = date("Y:m:d");
$time = date("H:i:s");
$status = "Logged in";





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
  $sql = "UPDATE request SET status ='approved' WHERE request_ID = '$test' ";
  $query = mysqli_query($conn,$sql);


  header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/adminpage.php");


  }


?>


<style type="text/css"><?php include('includes/common.css'); ?></style>
<?php include('includes/navbar.php'); ?>
<?php include('includes/sidebar.php'); ?>

<div class="container-fluid">

	       
       <div class="container-fluid">
        
        <legend><h3>Request Details:</h3></legend>     
 
<div class="container">
  <div class="row">
    <div class="Absolute-Center is-Responsive">
      <div id="logo-container"></div>
      <div class="col-sm-12 col-md-10 col-md-offset-1">

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="addUserForm" method="post">

          

          <label for="sel1">Employee Name:</label>
          <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input class="form-control" type="text" name='firstname' value="<?php echo $name. " ".$last; ?>" required="true" >          
          </div>

          <label for="sel1">Leave Type:</label>
          <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input class="form-control" type="text" name='firstname' placeholder="Leave Type" required="true" >          
          </div>

          <label for="sel1">Requested Date of Leave:</label>
          
          <div class="form-group input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            <input class="form-control" type="calendar" name='startDate'  required="true" >          
          </div>
          <label for="sel1">End Date:</label>
          
          <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            <input class="form-control" type="calendar" name='endDate'  required="true" >          
          </div>

          <label for="sel1">Reason:</label>
          <div class="form-group input-group">

            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input class="form-control" type="text" name='firstname' placeholder="Type reason" required="true" style="height:200px" hidden="true">
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