<?php include('includes/header.php'); ?>
<?php 
 if ($_SESSION['usertype']!=102) 
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
?>
<style type="text/css"><?php include('includes/common.css'); ?></style>
<?php include('includes/navbar.php'); ?>
<?php include('includes/adminsidebar.php'); ?>

<div class="container">



<?php include('includes/footer.php'); ?>