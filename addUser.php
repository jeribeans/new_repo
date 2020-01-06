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






<?php 
    if($dept_check == "SuperAdmin"){
        echo "<LEGEND><h2>Add New Employees</h2></LEGEND>";
    }
    else{
        echo "<LEGEND><h2>Add New Employees (". $team." Department) </h2></LEGEND>";   
    }


?>
<style type="text/css"><?php include('includes/common.css'); ?></style>


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

      if ($dept == "Super Administrator"){
        $department = "SuperAdmin";
          }
      elseif ($dept == "Administrator NOC"){
        $department = "AdminNOC";
      }
      elseif ($dept == "Administrator CS"){
        $department = "AdminCS";
      }
      elseif ($dept == "Administrator FS"){
        $department = "AdminFS";
      }
      elseif ($dept == "Network Operations Center"){
        $department = "NOC";
      }elseif ($dept == "Field Support"){
        $department = "FS";
      }
      else{
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
                <?php 

                if($dept_check == "SuperAdmin"){
                  ?>
                  <select class="form-control" name="department" required="true">
                    <option value="" disabled selected>Select Department</option>
                    <option>Super Administrator</option>
                    <option>Administrator NOC</option>
                    <option>Administrator CS</option>
                    <option>Administrator FS</option>
                    <option>Network Operations Center</option>
                    <option>Field Support</option>
                    <option>Customer Support</option>
                  </select> 
                  <?php 
                }
                elseif($dept_check == "AdminCS"){
                  ?>
                  <select class="form-control" name="department" required="true">
                    <option value="" disabled selected>Select Department</option>
                    <option>Administrator CS</option>
                    <option>Customer Support</option>
                  </select>
                <?php 
                }
                elseif($dept_check == "AdminFS") {
                ?> 
                <select class="form-control" name="department" required="true">
                    <option value="" disabled selected>Select Department</option>
                    <option>Administrator FS</option>
                    <option>Field Support</option>
                  </select>  
                <?php
                }
                else{
                ?> 
                <select class="form-control" name="department" required="true">
                    <option value="" disabled selected>Select Department</option>
                    <option>Administrator NOC</option>
                    <option>Network Operations Center</option>
                  </select>  
                <?php
                }


                ?>

                <!-- <select class="form-control" name="department" required="true">
                     <option value="" disabled selected>Select Department</option>
                    <option>Administrator</option>
                    <option>Network Operations Center</option>
                    <option>Field Support</option>
                    <option>Customer Support</option>
                  </select> -->
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