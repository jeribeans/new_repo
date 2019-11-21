<?php include('includes/header.php'); ?>
<?php 
 if ($_SESSION['usertype']!=102) 
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
?>
<style type="text/css"><?php include('includes/common.css'); ?></style>
<?php include('includes/navbar.php'); ?>
<?php include('includes/adminsidebar.php'); ?>

<div class="container-fluid">

	<legend>View Product Report</legend>	
		<?php
			$sql = "SELECT DISTINCT(product_name),product_price FROM products_detail";
			$select = mysqli_query($conn, $sql);
		?>
		<table class="table table-hover table-condensed">
			<thead>
				<tr>
					<th>Product name</th>
					<th>Product price</th>
				</tr>
			</thead>
			<tbody>
				<?php
					while($row = mysqli_fetch_assoc($select)){
						echo '<tr>';
						echo '<td><a href="viewproductsdetail.php?name='. $row['product_name'].'">'.$row['product_name'].'</a></td>';
						echo '<td>'.$row['product_price'].'</td>';
						echo '</tr>';
					}
				?>
			</tbody>

		</table>

</div>
				

<?php include('includes/footer.php'); ?>