<?php include('includes/header.php'); ?>
<?php 
 if ($_SESSION['usertype']!=102) 
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
?>
<style type="text/css"><?php include('includes/common.css'); ?></style>
<?php include('includes/navbar.php'); ?>
<?php include('includes/adminsidebar.php'); ?>

<div class="container-fluid">
	<?php $nem = $_GET['name']; ?>
	<legend>Ingredient list for <?php echo $nem; ?></legend>
		<table class="table table-hover table-condensed">
			<thead>
				<tr>
					<th>Ingredient Name</th>
					<th>Ingredient Price</th>
					<th>Supplier</th>
				</tr>
			</thead>	
		<?php
			//get product detail id
			$sqly = "SELECT product_ingredient_id FROM products_detail WHERE product_name = '$nem'";
			$selecta = mysqli_query($conn, $sqly);
			for($i = mysqli_num_rows($selecta);$i>0;$i--){
				$rowi = mysqli_fetch_assoc($selecta); 
				$id[$i] = $rowi['product_ingredient_id'];
				

			//get ingredient deets
			$sql = "SELECT * FROM ingredient WHERE ingredient_id = '$id[$i]'";
			$select = mysqli_query($conn, $sql);

			$sqlt = "SELECT * FROM ingredients_supplied WHERE ingredient_id = '$id[$i]'";
			$select3 = mysqli_query($conn, $sqlt);
			$row3 = mysqli_fetch_assoc($select3);
			$supid = $row3['ingredient_supplier_id'];

			//get supplier deets
			$sql1 = "SELECT * FROM suppliers WHERE supplier_id = '$supid'";
			$select2 = mysqli_query($conn, $sql1);
			$row2 = mysqli_fetch_assoc($select2);
		
		?>
		
			<tbody>
				<?php
					while($row = mysqli_fetch_assoc($select)){
						echo '<tr>';
						echo '<td>'.$row['ingredient_name'].'</td>';
						echo '<td>'.$row['ingredient_price'].'</td>';
						echo '<td>'.$row2['supplier_name'].'</td>';
						echo '</tr>';
					}
				}
				?>
			</tbody>

		</table>

</div>
				

<?php include('includes/footer.php'); ?>