<?php include('includes/header.php'); ?>
<?php 
 if ($_SESSION['usertype']!=101) 
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
?>
<style type="text/css"><?php include('includes/common.css'); ?></style>
<?php include('includes/navbar.php'); ?>
<?php include('includes/sidebar.php'); ?>



<div class="container-fluid">
	<form class="form-horizontal" id="dischargeform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<fieldset>


<legend>Create Supplier Purchase Order</legend>


<div class="form-group">
  <label class="col-md-4 control-label" for="suppliername">Supplier Name</label>
  <div class="col-md-4">
    <select id="suppliername" name="suppliername" class="form-control">
      <?php 
		$suppliers = "select * from suppliers GROUP BY supplier_name ORDER BY supplier_name";
		$getsuuppliers = mysqli_query($conn, $suppliers);
		
		if($getsuuppliers){
			$resultNo = mysqli_num_rows($getsuuppliers);
			if($resultNo > 0){
			
				while($row = mysqli_fetch_assoc($getsuuppliers)){
				$supplier = $row['supplier_name'];
				?>
				<option value="<?php echo $supplier;?>"><?php echo $supplier;?></option>
				<?php
				}
			}
		}
	  ?>
	  
    </select>
  </div>
</div>
	
    

<div class="form-group">
  <label class="col-md-4 control-label" for="ingredientname">Ingredient Name</label>
  <div class="col-md-4">
    <select id="ingredientname" name="ingredientname" class="form-control">
      <?php 
		$ingredients = "select * from ingredient";
		$getingredients = mysqli_query($conn, $ingredients);
		
		if($getingredients){
			$resultNo = mysqli_num_rows($getingredients);
			if($resultNo > 0){
			
				while($row = mysqli_fetch_assoc($getingredients)){
				$ingredient = $row['ingredient_name'];
				?>
				<option value="<?php echo $ingredient;?>"><?php echo $ingredient;?></option>
				<?php
				}
			}
		}
	  ?>
	  
    </select>
  </div>
</div>
	
		
	

<div class="form-group">
  <label class="col-md-4 control-label" for="quantity">Quantity</label>  
	  <div class="col-md-2">
	  	<input id="quantity" name="quantity" type="number" placeholder="Quantity" class="form-control input-md" required="" onkeyup="this.value=this.value.replace(/[^\d]/,'')">
	  </div>
</div>





    
<div class="form-group">
  <label class="col-md-4 control-label" for="unit">Unit</label>
  <div class="col-md-4">
    <select id="unit" name="unit" class="form-control">
      <option value="box">Box/es</option>
      <option value="bottle">Bottle/s</option>
      <option value="liter">Liter/s</option>
      <option value="milliliter">Milliliter/s</option>
    </select>
  </div>
</div>
    
 
  

	
	
<?php if(isset($_POST['submit'])){

		$suppliername = mysqli_real_escape_string($conn, $_POST['suppliername']);
		$ingredientname = mysqli_real_escape_string($conn, $_POST['ingredientname']);
		$quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
        $unit = mysqli_real_escape_string($conn, $_POST['unit']);
        $date = date('Y-m-d');
        $username = $_SESSION['username'];
		
		
		
		$track_id= mt_rand(100000,999999);
		
		$checker = mysqli_query($conn,"SELECT * from suppliers_purchase_order where supplier_trackID = '$track_id'");
		$stat = mysqli_fetch_array($checker, MYSQLI_ASSOC);
		$statreport_id = $stat['supplier_trackID'];
		
		
		//checker for duplicate tracker id
		while($track_id == $stat['supplier_trackID']){
			if($checker){
				$track_id=  mt_rand(100000,999999);			
			}
		}
		
		
		$prodcheck = mysqli_query($conn,"SELECT * from suppliers where supplier_name = '$suppliername'");
		$stat = mysqli_fetch_array($prodcheck, MYSQLI_ASSOC);
		$supp_id = $stat['supplier_id'];
		
		
		
	
		$query = "INSERT INTO suppliers_purchase_order(supplier_id, supplier_accessed_by, supplier_accessed_date, supplier_trackID) VALUES('$supp_id', '$username', '$date', '$track_id')";
		
	

		if(mysqli_query($conn, $query)){
			
			echo '<center>'."Raw materials has been ordered!".'</center>';
			
		$idcheck = mysqli_query($conn,"SELECT * FROM suppliers_purchase_order WHERE supplier_trackID = '$track_id'");
		$stat2 = mysqli_fetch_array($idcheck, MYSQLI_ASSOC);
		$so_id = $stat2['supplier_purchaseorder_id'];
		
		
			
		$ingredientcheck = mysqli_query($conn,"SELECT * from ingredient where ingredient_name = '$ingredientname'");
		$stat3 = mysqli_fetch_array($ingredientcheck, MYSQLI_ASSOC);
		$ing_id = $stat3['ingredient_id'];
		
		
		$query1 = "INSERT INTO rawmats(rawmats_quantity, rawmats_unit, rawmats_ingredient_id, rawmats_supplierpurchaseorder_id) VALUES('$quantity', '$unit', '$ing_id', '$so_id')";
			if ($so_id != NULL && $ing_id != NULL){
				mysqli_query ($conn, $query1);
			}
		
		} else {
			echo 'ERROR: '. mysqli_error($conn);
		}
	}
?>




<div class="form-group">
	<input type="submit" name="submit" class="input-md btn btn-success center-block" value="Submit" id="Form">
</div>

</fieldset>
</form>


<?php include('includes/footer.php'); ?>