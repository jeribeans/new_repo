<?php $user = $_SESSION['username']?>

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="homepage.php"><img id="logo" src="resources/img/logo.jpg" height="40" width="40"></a>
      <p class="navbar-text" style="margin-top:17px;">DAILA HERBALS</p>
    </div>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="nav navbar-nav navbar-right">
        <li><p class="navbar-text" style="margin-top:17px;">Welcome, <?php echo $user; ?></p></li>
        <li><a href="logout.php">Log out</a></li>
      </ul>
    </div>
  </div>
</nav>
