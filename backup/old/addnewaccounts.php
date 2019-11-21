<?php
session_start();
if ($_SESSION['usertype']!=102) 
       header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");

$flag=0;
if (isset($_POST['submit'])){

$message=NULL;

 if (empty($_POST['username'])){
  $username=FALSE;
  $message.='<p>You forgot to enter the user name!';
 }else
  $username=$_POST['username'];

 if (empty($_POST['fullname'])){
  $fullname=FALSE;
  $message.='<p>You forgot to enter the fullname!';
 }else
  $fullname=$_POST['fullname'];

 if (empty($_POST['address'])){
  $address=FALSE;
  $message.='<p>You forgot to enter the address!';
 }else
  $address=$_POST['address'];

 if (empty($_POST['pw'])){
  $pw=FALSE;
  $message.='<p>You forgot to enter the password!';
 }else
  $pw=$_POST['pw'];

 if (empty($_POST['pw2'])){
  $pw2=FALSE;
  $message.='<p>You forgot to repeat the password!';
 }else
  $pw2=$_POST['pw2'];

 if ($_POST['pw']!=$_POST['pw2'])
  $message.='<p>Password and repeat password does not match!';


if(!isset($message)){
require_once('../mysql_connect.php');
$flag=1;
$query="select user_id from users where username='{$username}'";
$result=mysqli_query($dbc,$query);
if ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
$message.="<b><p>Username {$username} already exists! Please input another!";}
else {
$query="insert into users (username,pw,usertype,fullname,address) values ('{$username}',password('{$pw}'),'{$_POST['usertype']}','{$fullname}','{$address}')";
$result=mysqli_query($dbc,$query);
$message="<b><p>Username: {$username}<br>Fullname: {$fullname}<br>Address: {$address}<br>added! </b>";

}
} 

}/*End of main Submit conditional*/

if (isset($message)){
 echo '<font color="red">'.$message. '</font>';
}

?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset><legend>Add New Account: </legend>

<p>UserName: <input type="text" name="username" size="20" maxlength="30" value="<?php if (isset($_POST['username']) && !$flag) echo $_POST['username']; ?>"/>
<p>Password: <input type="password" name="pw" size="20" maxlength="30" />
<p>Repeat Password: <input type="password" name="pw2" size="20" maxlength="30" />
<p>Usertype
<select name="usertype">
<option value="101" selected>Customer</option>
<option value="102">Admin</option>
<option value="103">Shipper</option>
</select><br>
<p>Fullname: <input type="text" name="fullname" size="20" maxlength="30" value="<?php if (isset($_POST['fullname']) && !$flag) echo $_POST['fullname']; ?>"/>
<p>Address: <input type="text" name="address" size="20" maxlength="30" value="<?php if (isset($_POST['address']) && !$flag) echo $_POST['address']; ?>"/>
<div align="center"><input type="submit" name="submit" value="Add!" /></div>
</fieldset>
</form>
<p>
<a href="admin.php">Return to dashboard</a>
