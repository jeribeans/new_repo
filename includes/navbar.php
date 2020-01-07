<?php 

$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];

?>

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand"><img id="logo" src="resources/img/logo.png" height="40" width="40"></a>
      <p class="navbar-text" style="margin-top:17px;">Access Base Technology & Solutions, Inc.</p>
    </div>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="nav navbar-nav navbar-right">
        <li><p class="navbar-text" style="margin-top:17px;">Welcome, <?php echo $firstname." ".$lastname;?></p></li>
        <li><a href="logout.php">Log out</a></li>
      </ul>
    </div>
  </div>
</nav>
