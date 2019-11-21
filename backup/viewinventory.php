<?php include('includes/header.php'); ?>
<?php 
 if ($_SESSION['usertype']!=102) 
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
?>
<style type="text/css"><?php include('includes/common.css'); ?></style>
<?php include('includes/navbar.php'); ?>
<?php include('includes/adminsidebar.php'); ?>

<div class="container-fluid">
	<form class="form" id="dischargeform" method="post" action="viewinventoryresult.php">
<fieldset>


<legend>View Inventory</legend>
<!-- 	product name[products_detail], 
		product qty[products] = walkin_order - product quantity, 
		indv price[products_detail],
		added date[product]
 -->
	
	<h4>Products inventory</h4><br>
	<table class="table table-hover table-condensed">
		<thead>
			<tr>
				<th>Product Name</th>
				<th>Product Quantity</th>
				<th>Individual Price</th>
				<th>Added Date</th>
			</tr>
		</thead>
		<tbody>
	<?php 
		//get names of products (A.K.A LIST OF PRODUCTS)
		$sql = "SELECT DISTINCT(product_name), product_detail_id, product_price FROM products_detail GROUP BY product_name";
		$select = mysqli_query($conn, $sql);
		
		//get products table for product detail id
			for($i = mysqli_num_rows($select);$i>0;$i--){
				$sql2 = "SELECT * FROM products";
				$select3 = mysqli_query($conn, $sql2);
				$rowp = mysqli_fetch_assoc($select3);
				
				$woid[$i] = $rowp['product_detailid'];
				
				//get walkinorder_id to get quantity for walkin quantity to be subtracted from 
				
				

				while($row = mysqli_fetch_assoc($select)){	
						
						$sql1 = "SELECT * FROM order_details WHERE order_walkinorder_id IS NOT NULL AND order_prod_detail = '$woid[$i]'";
						$select1 = mysqli_query($conn, $sql1);
						
						$row1 = mysqli_fetch_assoc($select1);
						$total = $rowp['product_quantity'] - $row1['order_purchaseorder_qty'];

						echo '<tr>';
						echo '<td>'.$row['product_name'].'</td>';
						echo '<td>'.$total.'</td>';
						echo '<td>'.$row['product_price'].'</td>';
						echo '<td>'.$rowp['product_accessed_date'].'</td>';
						echo '</tr>';	
				}
			}
			?>
		</tbody>
	</table>



	<br><br><br><h4>Rawmats inventory</h4><br>
	 <?php 
	// 	 rawmats name[ingredient], 
	// 	 raw mats qty[rawmats], 
	// 	 rawmats supplier[suppliers],
	// 	 added date[supplier_purchase_order]
 		$query = "SELECT * FROM ingredient";
 		$check = mysqli_query($conn, $query);

	 	$query1 = "SELECT * FROM rawmats";
	 	$check1 = mysqli_query($conn, $query1);

	 	
	?>
	<table class="table table-hover table-condensed">
		<thead>
			<tr>
				<th>Raw Materials Name</th>
				<th>Raw Materials Quantity</th>
				<th>Raw Materials Supplier</th>
				<th>Added on</th>
			</tr>
		</thead>
		<tbody>
			<?php
				// while($rw = mysqli_fetch_assoc($check)){
				// 	$rw1 = mysqli_fetch_assoc($check1);

				// 	$query2 = "SELECT * FROM suppliers";
	 		// 		$check2 = mysqli_query($conn, $query2);
				// 	$rw2 = mysqli_fetch_assoc($check2);
				// 	$supid = $rw2['supplier_id'];

				// 	$query3 = "SELECT * FROM supplier_purchase_order WHERE supplier_id = '$supid'";
	 		// 		$check3 = mysqli_query($conn, $query3);
				// 	$rw3 = mysqli_fetch_assoc($check3);



				// 	echo '<tr>';
				// 	echo '<td>'.$rw['ingredient_name'].'</td>';
				// 	echo '<td>'.$rw1['rawmants_quantity'].'</td>';
				// 	echo '<td>'.$rw2['supplier_name'].'</td>';
				// 	echo '<td>'.$rw3['supplier_accessed_date'].'</td>';
				// 	echo '</tr>';
				// }
			?>









<?php include('includes/footer.php'); ?>