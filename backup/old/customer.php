<a href="logout.php">Logout</a>
<p>
<?php
session_start();
if ($_SESSION['usertype']!=101) 
       header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
else{

echo "WELCOME ".$_SESSION["username"]."!";

require_once('../mysql_connect.php');
$query="select * from products";
$result=mysqli_query($dbc,$query);

echo '<table width="75%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
<tr>
<td width="10%"><div align="center"><b>PRODUCT NAME
</div></b></td>
<td width="50%"><div align="center"><b>DESCRIPTION
</div></b></td>
<td width="10%"><div align="center"><b>PRICE (IN PHP)
</div></b></td>
<td width="5%"><div align="center"><b>STOCKS AVAILABLE
</div></b></td>
</tr>';


while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){

echo "<tr>
<td width=\"10%\"><div align=\"center\">{$row['name']}
</div></td>
<td width=\"50%\"><div align=\"center\">{$row['description']}
</div></td>
<td width=\"10%\"><div align=\"center\">{$row['price']}
</div></td>
<td width=\"5%\"><div align=\"center\">{$row['quantity']}
</div></td>
</tr>";

}
echo '</table>';

}

?>
