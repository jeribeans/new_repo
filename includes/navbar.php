<?php 

$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
// $checkID = $_SESSION['checkID'];
// $login = $_SESSION['login_time'];
// $status = $_SESSION['status'];
// $userID = $_SESSION['userID'];

?>

<nav bg-dark class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand"><img id="logo" src="resources/img/logo.png" height="40" width="40"></a>
      <p class="navbar-text" style="margin-top:17px;">Access Base Technology & Solutions Inc.</p>
    </div>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="nav navbar-nav navbar-right">
        <li><p class="navbar-text" style="margin-top:17px;">Welcome, <?php echo $firstname;?> <?php echo $lastname;?></p></li>
        <li><a href="logout.php">Log out</a></li>
      </ul>
    </div>
  </div>
</nav>
