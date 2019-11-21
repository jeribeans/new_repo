<?php include('includes/header.php'); ?>
<?php 
 if ($_SESSION['usertype']!=102) 
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
?>
<style type="text/css"><?php include('includes/common.css'); ?></style>
<?php include('includes/navbar.php'); ?>
<?php include('includes/adminsidebar.php'); ?>

<div class="container-fluid">
<?php $prod_name = $_GET['name']; ?>
<legend>Sales for <?php echo $prod_name;?></legend>
<?php 

	//details for product bought
	$sql1 = "SELECT * FROM products_detail WHERE product_name = '$prod_name'";
	$select1 = mysqli_query($conn, $sql1);
	$row1 = mysqli_fetch_assoc($select1);

	$sql = "SELECT * FROM order_details";
	$select = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($select);
	$prod_det = $row['order_prod_detail'];

	//details for cpo
	$sql2 = "SELECT * FROM customer_purchase_order";
	$select2 = mysqli_query($conn, $sql2);
	$row2 = mysqli_fetch_assoc($select2);
	$poid = $row2['purchase_order_id'];
	
	//get cpo deets
	$sql4 = "SELECT * FROM order_details WHERE order_purchaseorder_id = '$poid'";
	$select4 = mysqli_query($conn, $sql4);
	$row4 = mysqli_fetch_assoc($select4);

	//details for walkin
	$sql3 = "SELECT * FROM walkin_order";
	$select3 = mysqli_query($conn, $sql3);
	$row3 = mysqli_fetch_assoc($select3);
	$woid = $row3['walkinorder_id'];

	//get walkin deets
	$sql5 = "SELECT * FROM order_details WHERE order_walkinorder_id = '$woid'";
	$select5 = mysqli_query($conn, $sql5);
	$row5 = mysqli_fetch_assoc($select5);

?>
<h4>Purchase Order sales table</h4>
<table class="table table-hover table-condensed table-bordered">
	<thead>
		<tr>
			<th>Purchase Order Customer Name</th>
			<th>Product Quantity purchased</th>
			<th>Product Cost total</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			for($i = mysqli_num_rows($select4); $i>0; $i--){
				echo '<tr>';
				echo '<td>'.$row2['po_customer_name'].'</td>';
				echo '<td>'.$row['order_purchaseorder_qty'].'</td>';
				echo '<td>'.$row1['product_price']*$row['order_purchaseorder_qty'].'</td>';
				echo '</tr>';
			}
		?>
	</tbody>
</table><br><br><br>

<h4>Walk-In sales table</h4>
<table class="table table-hover table-condensed table-bordered">
	<thead>
		<tr>
			<th>Walk-in Handler</th>
			<th>Walk-in Quantity purchased</th>
			<th>Walk-in Payed</th>
		</tr>
	</thead>
	<tbody>
		<?php
			for($i = mysqli_num_rows($select5); $i>0; $i--){
				echo '<tr>';
				echo '<td>'.$row3['walkin_accessed_by'].'</td>';
				echo '<td>'.$row5['order_purchaseorder_qty'].'</td>';
				echo '<td>'.$row1['product_price']*$row5['order_purchaseorder_qty'].'</td>';
				echo '</tr>';
			}
		?>
	</tbody>
</table>
<?php include('includes/footer.php'); ?>