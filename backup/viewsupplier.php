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
				
					
			$getsupplier = mysqli_query($conn, "SELECT *	FROM suppliers");
			$getsupplyid = mysqli_query($conn, "SELECT * FROM ingredients_supplied");
			$getsupplyname = mysqli_query($conn, "SELECT * FROM ingredient");
					
			$resultNo = mysqli_num_rows($getsupplier);
					
				if (!$resultNo){
					echo 'Sorry, no resutls were found';
						
				} else{
					?>
					
					<table class="table table-hover table-condensed" >
						<thead>
							<tr>
								<th>Supplier Name</th>
								<th>Contact Person</th>
								<th>Contact Number</th>
								<th>Ingredient Supplied</th>
							</tr>
						</thead>
						
					
					<?php
					
					
					if($resultNo > 0){
						
						while($row = mysqli_fetch_assoc($getsupplier)){
							$row2 = mysqli_fetch_assoc($getsupplyid);
							$row3 = mysqli_fetch_assoc($getsupplyname);
							
							$name = $row['supplier_name'];
							$contactperson = $row['supplier_contactperson'];
							$contactnumber = $row['supplier_contactNum'];
							if ($row['supplier_id'] == $row2['ingredient_supplier_id']){
								$id = $row2['ingredient_id'];
								if ($id == $row3['ingredient_id']){
									$supply = $row3['ingredient_name'];
								}
							}
							?>
				<div style="overflow-x:auto;">
					
					<tbody>
							<tr>
								<td><?php echo $name;?></td>
								<td><?php echo $contactperson;?></td>
								<td><?php echo $contactnumber;?></td>
								<td><a href="supplierdisplay.php?name=<?php echo $supply?>"><?php echo $supply;?></a></td>
							</tr>

					
				<?php 
							}
						}
					}
				
				?>
					</tbody>
				</table>	
	
	
	
	
	
	
	

	

</div>
				
		
		
		
		




<?php include('includes/footer.php'); ?>