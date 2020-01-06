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


$getID  = $_GET['IDval'];



$sql = "SELECT * FROM user WHERE employee_ID = '$getID'";
$query = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($query,MYSQLI_ASSOC);


$user = $row['user_ID'];    
$name = $row['first_name'];
$middlename = $row['middle_name'];
$last = $row['last_name'];
$email = $row['email'];
$contact = $row['contact_num'];
$employeeID = $row['employee_id'];

if (isset($_POST['submit'])){

  $iduser =mysqli_real_escape_string($conn, $_POST['user']); 
  $fname = mysqli_real_escape_string($conn, $_POST['firstname']);
  $mname = mysqli_real_escape_string($conn, $_POST['middlename']);
  $lname = mysqli_real_escape_string($conn, $_POST['lastname']);
  $contact = mysqli_real_escape_string($conn, $_POST['contactNumber']);
  $email = mysqli_real_escape_string($conn, $_POST['emailAddress']);
  $id = mysqli_real_escape_string($conn, $_POST['IDnumber']);
  $password = mysqli_real_escape_string($conn, $_POST['password1']);
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

  if(empty($password)){

    // $query = mysql_query("UPDATE article set com_count = " . $comments_count . " WHERE article_id = " . $art_id);

 
    $sql = "UPDATE user SET employee_id = '".$id."', first_name ='".$fname."', middle_name ='".$mname."', last_name ='".$lname."', email ='".$email."', contact_num ='".$contact."', department ='".$department."' WHERE user_id = '".$iduser."' ";
    $query = mysqli_query($conn,$sql);
    
    header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/editUser.php");
  }
    else{

      if(!empty($password)){
        $password = md5($password);
        $sql = "UPDATE user SET employee_id = '".$id."', first_name ='".$fname."', middle_name ='".$mname."', last_name ='".$lname."', password ='".$password."', email ='".$email."', contact_num ='".$contact."', department ='".$department."' WHERE user_id = '".$iduser."' ";
        $query = mysqli_query($conn,$sql);
    
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/editUser.php");
      }
    }

  }
 


  

?>


<LEGEND><h2>Update Employee Information</h2></LEGEND>


<style type="text/css"><?php include('includes/common.css'); ?></style>

<div class="container-fluid">

	       
       <div class="container-fluid">
        
        <h3>Employee Information:</h3>     
 
<div class="container">
  <div class="row">
    <div class="Absolute-Center is-Responsive">
      <div id="logo-container"></div>
      <div class="col-sm-12 col-md-10 col-md-offset-1">

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="addUserForm" method="post">

          <label for="sel1">Employee Name:</label>
          <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input class="form-control" type="text" name='firstname' value="<?php echo $name; ?>" required="true">
            <input class="form-control" type="hidden" name='user' value="<?php echo $user; ?>">                    
          </div>

          <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input class="form-control" type="text" name='middlename' value="<?php echo $middlename; ?>" required="true">          
          </div>

          <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input class="form-control" type="text" name='lastname' value="<?php echo $last; ?>" required="true">          
          </div>

          <label for="sel1">Contact Information:</label>
          <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
            <input class="form-control" type="text" name='contactNumber' value="<?php echo $contact; ?>" required="true">          
          </div>

          <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
            <input class="form-control" type="text" name='emailAddress' value="<?php echo $email; ?>" required="true">          
          </div>



          <label for="sel1">Employee ID Number:</label>
          <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input class="form-control" type="text" name='IDnumber' value="<?php echo $employeeID; ?>" required="true">          
          </div>

          <label for="sel1">Temporary Password:</label>
          <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input class="form-control" type="password" name='password1' placeholder="Password">          
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