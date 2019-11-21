<?php include('includes/header.php'); ?>
<?php 
 if ($_SESSION['usertype']!=102) 
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
?>
<style type="text/css"><?php include('includes/common.css'); ?></style>
<?php include('includes/navbar.php'); ?>
<?php include('includes/adminsidebar.php'); ?>

<div class="container-fluid">

	<legend>View Supplier Report</legend>	

		<?php
			
			$name = $_GET['name'];
			
			
			$getprice = mysqli_query($conn, "SELECT * FROM ingredient where ingredient_name = '$name'");
			$row = mysqli_fetch_assoc($getprice);
			$id = $row['ingredient_id'];
			$price = $row['ingredient_price'];
			
			
			
			$getrawmats = mysqli_query($conn, "SELECT * FROM rawmats where rawmats_ingredient_id = '$id'");
			$result = mysqli_num_rows($getrawmats);
			
			
			if ($result > 0){
					?>
					
					<table class="table table-hover table-condensed" >
						<thead>
							<tr>
								<th>Item Name</th>
								<th>Item Price</th>
								<th>Quantity</th>
								<th>Total Costs</th>
								<th>Ordered By</th>
								<th>Ordered Date</th>
							</tr>
						</thead>
						
						<?php
				while($row2 = mysqli_fetch_assoc($getrawmats)){
					$spo = $row2['rawmats_supplierpurchaseorder_id'];
					
			
					$getspo = mysqli_query($conn, "SELECT * FROM suppliers_purchase_order where supplier_purchaseorder_id = '$spo'");
					$row3 = mysqli_fetch_assoc($getspo);
					
					$accessedby = $row3['supplier_accessed_by'];
							$accesseddate = $row3['supplier_accessed_date'];
							$unitprice = $price = $row['ingredient_price'];
							$qty = $row2['rawmats_quantity'];
						?><div style="overflow-x:auto;">
					
					<tbody>
							<tr>
								<td><?php echo $name;?></td>
								<td><?php echo $unitprice;?></td>
								<td><?php echo $qty;?></td>
								<td><?php echo $unitprice*$qty;?></td>
								<td><?php echo $accessedby;?></td>
								<td><?php echo $accesseddate;?></td>
							</tr>	
			
							<?php
					
						}
				?><form>
					<input class="btn btn-success" type="button" value="Print this page" onClick="window.print()">
				</form><?php
					}else{
						echo "No results found";
					}
							
				?>
			
					</tbody>
				</table>	
			
	
	
</div>
	
<?php include('includes/footer.php'); ?>