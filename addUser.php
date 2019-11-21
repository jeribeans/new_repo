<?php require_once('includes/header.php'); 

// $userID = $_SESSION['check'];
// $firstname = $_SESSION['firstname'];
// $lastname = $_SESSION['lastname'];
$date = date("Y:m:d");
$time = date("H:i:s");
$status = "Logged in";

?>


<LEGEND><h2>Add New Employee</h2></LEGEND>

<?php 
 if ($_SESSION['department']!='Admin') 
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
?>
<style type="text/css"><?php include('includes/common.css'); ?></style>
<?php include('includes/navbar.php'); ?>
<?php include('includes/adminsidebar.php'); ?>

<div class="container-fluid">

	       
       <div class="container-fluid">
        
        <h3>Employee Information:</h3>     
 
<?php 
    if (isset($_POST['submit'])){

      

      $fname = mysqli_real_escape_string($conn, $_POST['firstname']);
      $mname = mysqli_real_escape_string($conn, $_POST['middlename']);
      $lname = mysqli_real_escape_string($conn, $_POST['lastname']);
      $contact = mysqli_real_escape_string($conn, $_POST['contactNumber']);
      $email = mysqli_real_escape_string($conn, $_POST['emailAddress']);
      $id = mysqli_real_escape_string($conn, $_POST['IDnumber']);
      $password = mysqli_real_escape_string($conn, $_POST['password1']);
      $confirm = mysqli_real_escape_string($conn, $_POST['password2']);
      $dept = mysqli_real_escape_string($conn, $_POST['department']);

      if ($dept == "Administrator"){
            $department = "Admin";
          }elseif ($dept == "Network Operations Center"){
            $department = "NOC";
          }elseif ($dept == "Field Support"){
            $department = "FS";
          }else{
            $department = "CS";
          }


      if($password != $confirm){
        ?> <script> alert ("Password does not match. Please enter password again.")</script><?php
      } 
      else{
        
        $password = md5($password);
        
        $sql = "INSERT INTO user (employee_id, password, first_name, middle_name, last_name, email, contact_num, department) VALUES('$id', '$password','$fname', '$mname', '$lname', '$email', '$contact', '$department')";
        
        $query = mysqli_query($conn,$sql);

        ?> <script> alert ("User Successfuly Added!")</script><?php
        
      }



     

    }
?>



<div class="container">
  <div class="row">
    <div class="Absolute-Center is-Responsive">
      <div id="logo-container"></div>
      <div class="col-sm-12 col-md-10 col-md-offset-1">

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="addUserForm" method="post">

          <label for="sel1">Employee Name:</label>
          <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input class="form-control" type="text" name='firstname' placeholder="First Name" required="true">          
          </div>

          <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input class="form-control" type="text" name='middlename' placeholder="Middle Initial" required="true">          
          </div>

          <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input class="form-control" type="text" name='lastname' placeholder="last Name" required="true">          
          </div>

          <label for="sel1">Contact Information:</label>
          <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
            <input class="form-control" type="text" name='contactNumber' placeholder="Contact number" required="true">          
          </div>

          <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
            <input class="form-control" type="text" name='emailAddress' placeholder="Email Address" required="true">          
          </div>



          <label for="sel1">Employee ID Number:</label>
          <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input class="form-control" type="text" name='IDnumber' placeholder="ID Number" required="true">          
          </div>

          <label for="sel1">Temporary Password:</label>
          <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input class="form-control" type="password" name='password1' placeholder="Password" required="true">          
          </div>

          <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input class="form-control" type="password" name='password2' placeholder="Re-enter Password" required="true">          
          </div>

          <div class="form-group">
                <label for="sel1">Department:</label>
                <select class="form-control" name="department" required="true">
                     <option value="" disabled selected>Select Department</option>
                    <option>Administrator</option>
                    <option>Network Operations Center</option>
                    <option>Field Support</option>
                    <option>Customer Support</option>
                  </select>
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