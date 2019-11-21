<?php include('includes/header.php'); ?>
<?php 
 if ($_SESSION['usertype']!=102) 
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
?>
<style type="text/css"><?php include('includes/common.css'); ?></style>
<?php include('includes/navbar.php'); ?>
<?php include('includes/adminsidebar.php'); ?>

<div class="container-fluid">

<h2>List of products with sales</h2><hr><br>
<table class="table table-hover table-condensed">
	<thead>
		<tr>
			<th><b>Product Name</b></th>
		</tr>
	</thead>
<?php
	$fromdate = mysqli_real_escape_string($conn, $_POST['fromdate']);
	$todate = mysqli_real_escape_string($conn, $_POST['todate']);

	$sql = "SELECT * FROM products WHERE product_accessed_date BETWEEN '$fromdate' AND '$todate' ORDER BY product_accessed_date DESC";	

	$select2 = mysqli_query($conn, $sql);
	$rowq = mysqli_fetch_assoc($select2);
	
	$detailid = $rowq['product_detailid'];
	if($detailid != NULL){
	$sql_prod_name = "SELECT * FROM products_detail WHERE product_detail_id = '$detailid'";
	$select1 = mysqli_query($conn, $sql_prod_name);
	
	while($rowa = mysqli_fetch_assoc($select1)){
		$name = $rowa['product_name'];
	}

	?>
	
	<tbody>
		<tr>
			<td><a href="viewsalesperproduct.php?name=<?php echo $name;?>"><?php echo $name;?></a></td>

		</tr>
<?php
	}else{
		echo 'No products to show';
	}
?>
	
</tbody>
</table>
<?php include('includes/footer.php'); ?>