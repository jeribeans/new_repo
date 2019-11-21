<?php
session_start();
include 'plugins.php';
/**if (isset($_SESSION['badlogin'])){
if ($_SESSION['badlogin']>=3)
       header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/blocked.php");
}**/
//connect to database
$conn = getConnection();
        
if (isset($_POST['submit'])){

$message=NULL;
//check if username field is empty
 if (empty($_POST['username'])){
  $_SESSION['username']=FALSE;
  $message.='<p>You forgot to enter your username!';
 } else {
  $_SESSION['username']=$_POST['username']; 
 }
//check if password field is empty
 if (empty($_POST['password'])){
  $_SESSION['password']=FALSE;
  $message.='<p>You forgot to enter your password!';
 } else {
  $_SESSION['password']=$_POST['password']; 
 }

$un = $_SESSION['username'];
$pw = $_SESSION['password'];

$query="SELECT usertype 
        FROM users 
        WHERE username='".$_SESSION['username']."'
        AND password=password('".$_SESSION["password"]."')";
echo $query;

$result=mysqli_query($conn, $query);
$row=mysqli_fetch_array($result);

echo var_dump($row);

if ($row['usertype']==101) {
       $_SESSION['usertype']=101;
       header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/customer.php");
}else{
if ($row['usertype']==102)
{      $_SESSION['usertype']=102;
       header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/admin.php");

} else {
 $message.='<p>Please try again';}/*
if (isset($_SESSION['badlogin']))
  $_SESSION['badlogin']++;
else
  $_SESSION['badlogin']=1;
}*/
} 
}/*End of main Submit conditional*/

if (isset($message)){
 echo '<font color="red">'.$message. '</font>';
}

?>
<div class="container">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset><legend>Please login below: </legend>

<p>User Name: <input type="text" name="username" size="20" maxlength="30" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>"/></p>
<p>Password: <input type="password" name="password" size="20" maxlength="20" /></p>
<div align="center"><input type="submit" name="submit" value="Login" /></div>

</form>
</div>