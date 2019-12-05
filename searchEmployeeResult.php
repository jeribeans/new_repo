<?php require_once('includes/header.php'); 

$userID = $_SESSION['check'];
$username = $_SESSION['username'];
$first_name = $_SESSION['firstname'];
$last_name = $_SESSION['lastname'];
$department = $_SESSION['department'];


?>



<?php     


if(isset($_POST['search'])){

$search = $_POST['input'];
$START = $_POST['startDate'];
$END = $_POST['endDate'];


}
else {
    echo "";
}
