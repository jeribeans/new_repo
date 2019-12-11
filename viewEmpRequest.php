<?php include('includes/header.php'); ?>
<?php 
 if ($_SESSION['dept_check']!="emp"){
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index2.php");
 }


$dept_check = $_SESSION["dept_check"];
$check = $_SESSION['check'];
$username = $_SESSION['username'];
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
$department = $_SESSION['department'];


$START = date('Y-m-01');
$END = date('Y-m-t',strtotime('this month'))."<br>";

?>



<?php     


if(isset($_POST['searchDate3'])){
    

    $START1 = $_POST['dateSearch3']."-01";
    $END1 = date('Y-m-t',strtotime($START1));

    ?>
    <h3>Request Status:(<?php echo date('F Y');?>):</h3>     
     
    <?php
    $getEmployeeRequest = mysqli_query($conn, "SELECT * FROM request WHERE user_ID = '$check' AND request_Date BETWEEN '$START1' AND '$END1'");
    
    $resultNo = mysqli_num_rows($getEmployeeRequest);
        
    if (!$resultNo){
        echo ' <h4>There are no requests at the moment. </h4>';
    } 
    else{
    
        ?>
        <table class="table table-hover table-striped table-condensed table-bordered" >
            <thead>
            <tr>
                    <th>Leave type</th>
                    <th>Leave Date (Start to End)</th>
                    <th>Reason</th>
                    <th>Status</th>
            </tr>
            </thead>

            <?php
                if($resultNo > 0){                                
                    while($row = mysqli_fetch_assoc($getEmployeeRequest)){
                        $ID = $row['user_ID'];
                        $getUser = mysqli_query($conn, "SELECT * FROM user WHERE user_id = '$ID'");
                        $row2 = mysqli_fetch_assoc($getUser);
                    
                        $employeeID = $row['request_ID'];
                        $name = $row2['first_name']." ".$row2['middle_name']." ".$row2['last_name'];
                        $department = $row2['department'];
                        ?>
                        <div style="overflow-x:auto;">
                        <tbody class="table table-striped">
                            <tr>
                                <td><?php echo $row['leave_type'];?></td>
                                <td><?php echo date("M d, Y - l", strtotime($row['start_Date']))." to ".date("M d, Y - l", strtotime($row['end_Date']));?></td>
                                <td><?php echo $row['reason'];?></a></td>
                                <?php 

                                if($row['status'] == "PENDING"){
                                    echo "<td bgcolor='#ffa500'><b>".$row['status']."</b></td>";    
                                }elseif($row['status'] == "APPROVED"){
                                    echo "<td bgcolor='#00FF00'><b>".$row['status']."</b></td>";    
                                }else{
                                    echo "<td bgcolor='#FF0000'><b>".$row['status']."</b></td>";    
                                }
                                
                                ?>
                            </tr>
                            <?php 
                    }
                }
    }
    ?>
                        </tbody>
        </table>        


</div>

<?php  
} 
else{

     ?>
    <h3>Request Status:(<?php echo date('F Y');?>):</h3>     
     
    <?php
    $getEmployeeRequest = mysqli_query($conn, "SELECT * FROM request WHERE user_ID = '$check' AND request_Date BETWEEN '$START' AND '$END'");
    
    $resultNo = mysqli_num_rows($getEmployeeRequest);
        
    if (!$resultNo){
        echo ' <h4>There are no requests at the moment. </h4>';
    } 
    else{
    
        ?>
        <table class="table table-hover table-striped table-condensed table-bordered" >
            <thead>
            <tr>
                    <th>Leave type</th>
                    <th>Leave Date (Start to End)</th>
                    <th>Reason</th>
                    <th>Status</th>
            </tr>
            </thead>

            <?php
                if($resultNo > 0){                                
                    while($row = mysqli_fetch_assoc($getEmployeeRequest)){
                        $ID = $row['user_ID'];
                        $getUser = mysqli_query($conn, "SELECT * FROM user WHERE user_id = '$ID'");
                        $row2 = mysqli_fetch_assoc($getUser);
                    
                        $employeeID = $row['request_ID'];
                        $name = $row2['first_name']." ".$row2['middle_name']." ".$row2['last_name'];
                        $department = $row2['department'];
                        ?>
                        <div style="overflow-x:auto;">
                        <tbody class="table table-striped">
                            <tr>
                                <td><?php echo $row['leave_type'];?></td>
                                <td><?php echo date("M d, Y - l", strtotime($row['start_Date']))." to ".date("M d, Y - l", strtotime($row['end_Date']));?></td>
                                <td><?php echo $row['reason'];?></a></td>
                                <?php 

                                if($row['status'] == "PENDING"){
                                    echo "<td bgcolor='#ffa500'><b>".$row['status']."</b></td>";    
                                }elseif($row['status'] == "APPROVED"){
                                    echo "<td bgcolor='#00FF00'><b>".$row['status']."</b></td>";    
                                }else{
                                    echo "<td bgcolor='#FF0000'><b>".$row['status']."</b></td>";    
                                }
                                
                                ?>
                            </tr>
                            <?php 
                    }
                }
    }
    ?>
                        </tbody>
        </table>        



</div>

<?php

}

?>

    