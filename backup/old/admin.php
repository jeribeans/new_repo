<html>
<body>

<?php
session_start();

if ($_SESSION['usertype']!=102) 
       header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
else{

echo "WELCOME ".$_SESSION["username"]."!";

require_once('../mysql_connect.php');

}

?>
<p><p>
Show dashboard of administrator, etc, here
<br><br><center><b>
list of Customers</b>
<?php 
$query="select fullname,address,username,usertype from users where usertype='101'";
$result=mysqli_query($dbc,$query);
echo '<table width="75%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
<tr>
<td width="10%"><div align="center"><b>Full Name
</div></b></td>
<td width="50%"><div align="center"><b>Address
</div></b></td>
<td width="10%"><div align="center"><b>Username
</div></b></td>
</tr>';

while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){

echo "<tr>
<td width=\"10%\"><div align=\"center\">{$row['fullname']}
</div></td>
<td width=\"50%\"><div align=\"center\">{$row['address']}
</div></td>
<td width=\"10%\"><div align=\"center\">{$row['username']}
</div></td>
</tr>";

}
echo '</table>';
echo '<br><br><b>
list of Admins</b>';
$query="select fullname,address,username,usertype from users where usertype='102'";
$result=mysqli_query($dbc,$query);
echo '<table width="75%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
<tr>
<td width="10%"><div align="center"><b>Full Name
</div></b></td>
<td width="50%"><div align="center"><b>Address
</div></b></td>
<td width="10%"><div align="center"><b>Username
</div></b></td>
</tr>';

while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){

echo "<tr>
<td width=\"10%\"><div align=\"center\">{$row['fullname']}
</div></td>
<td width=\"50%\"><div align=\"center\">{$row['address']}
</div></td>
<td width=\"10%\"><div align=\"center\">{$row['username']}
</div></td>
</tr>";

}
echo '</table>';
echo '<br><br><b>
list of Shippers</b>';
$query="select fullname,address,username,usertype from users where usertype='103'";
$result=mysqli_query($dbc,$query);
echo '<table width="75%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
<tr>
<td width="10%"><div align="center"><b>Full Name
</div></b></td>
<td width="50%"><div align="center"><b>Address
</div></b></td>
<td width="10%"><div align="center"><b>Username
</div></b></td>
</tr>';

while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){

echo "<tr>
<td width=\"10%\"><div align=\"center\">{$row['fullname']}
</div></td>
<td width=\"50%\"><div align=\"center\">{$row['address']}
</div></td>
<td width=\"10%\"><div align=\"center\">{$row['username']}
</div></td>
</tr>";

}
echo '</table>';
?>


</body>
</html>