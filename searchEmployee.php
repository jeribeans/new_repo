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
if (!in_array($_SESSION['department'], array('SuperAdmin', 'AdminNOC', 'AdminFS', 'AdminCS'))) {
  header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index2.php");
}
    
include('includes/navbar.php');
include('includes/adminsidebar.php'); 

?>

<style type="text/css"><?php include('includes/common.css'); ?></style>

<?php 

// if (isset($_POST['search'])){
//     echo "hello";
// }


?>




<div class="container-fluid">
	
       
<?php 
    if($dept_check == "SuperAdmin"){
        echo "<LEGEND><h2>Search Employee Attendance </h2></LEGEND>";
    }
    else{
        echo "<LEGEND><h2>Search Employee Attendance (". $team." Department) </h2></LEGEND>";   
    }


?>

        <div class="container">
                <div class="row">
                        <div class="Absolute-Center is-Responsive">
                                <div id="logo-container"></div>
                                <div class="col-sm-12 col-md-10 col-md-offset-0">

                                    <form action="searchEmployeeResult.php" method="post" target="searchEmp">
                                       <h4>Search employee:</h4>
                                                <div class="form-group input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                        <input class="form-control" type="text" size="10" required="true" name='input' placeholder="e.g. (Name, Email, Contact Number)">          
                                                </div>


                                                <h4>Date Range:</h4>
                                                 <label for="sel1">Start Date:</label>
                                                <div class="form-group input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                        <input class="form-control" type="date" required="true" name='startDate' placeholder="Start Date">          
                                                </div>


                                                 <label for="sel1">End Date:</label>
                                                <div class="form-group input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                        <input class="form-control" type="date" required="true"  name='endDate' placeholder="End Date"/>     
                                                </div>
                                                <div class="form-group">
                                                        <input type="submit" name="search" class="btn btn-def" value="Search" />
                                                </div>
                                    </form>

                                    <iframe width=1650px height=1650px src="<?php echo "searchEmployeeResult.php"?>" frameborder="yes" scrolling="yes" name="searchEmp" id="searchEmp"></iframe>


                                </div>  
                        </div>    
                </div>
        </div>


                
                        


</div>
<?php include('includes/footer.php'); ?>