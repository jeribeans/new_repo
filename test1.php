<?php require_once('includes/header.php'); 
include('includes/navbar.php');
include('includes/adminsidebar.php');


if ($_SESSION['department']!='Admin'){
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
}
        

$userID = $_SESSION['check'];

$date = date("H:m:s");
$status = "Logged in";


$sql = "INSERT INTO timeCheck (login, status, user_ID) VALUES('$date','$status', '$userID')";
$query = mysqli_query($conn,$sql);

$sql2 = "SELECT * FROM timeCheck";
$query2 = mysqli_query($conn,$sql2);

$row = mysqli_fetch_array($query2,MYSQLI_ASSOC);


// if (isset($_POST['submit'])){
//         header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/adminpage.php");
// } 

$getEmployee = mysqli_query($conn, "SELECT * FROM user");
        $getTime = mysqli_query($conn, "SELECT * FROM timeCheck");
        
                        
        $resultNo = mysqli_num_rows($getEmployee);



for ($i = 0; $i < $resultNo ; $i++) {
   


   if(isset($_POST['submit'+ $i])){
    echo $i;
       
    }
}





// if(isset($_POST['submit'])){
//     echo key($_POST['submit'])." submit";
//     ?><br><?php

//     echo $_POST['startDate']." startDate";
//     ?><br><?php

//     $testid = mysqli_real_escape_string($conn, key($_POST['employeeid']));
//     echo $testid." ID";

    
//     ?><br><?php

//     $testname = mysqli_real_escape_string($conn, key($_POST['employeeName']));
//     echo $testname." name";
       
// }

?>

<style type="text/css"><?php include('includes/common.css'); ?></style>

<div class="container-fluid">
	
        <legend><h2>Calendar Test</h2></legend>	

        
      




<?php
$date = date('d M Y');
$m = date('m');
$M = date('F');
$y = date('Y');
$d=cal_days_in_month(CAL_GREGORIAN,$m,$y);
echo "There are $d days in $M $y";
echo "<br>";
        


$cols = $d;
$rows = 3;

for($i = 1; $i <=  date('t'); $i++)
{
   // add the date to the dates array
   echo $dates[] = date('M') . "-" . str_pad($i, 2, '0', STR_PAD_LEFT). " ";
}


$table = "<table class='table table-hover table-striped table-condensed table-bordered'>";
for($i=0;$i<$rows;$i++){
   $table .= "<tr>";
      for($j=0;$j<$cols;$j++)
        $table .= "<td> Insert Names Here</td>";
   $table .= "</tr>";
}
$table .= "</table>";




echo $table;


?>          

</div>
<?php include('includes/footer.php'); ?>