<?php include('includes/header.php'); ?>
<?php 
 if ($_SESSION['usertype']!=102) 
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
?>
<style type="text/css"><?php include('includes/common.css'); ?></style>
<?php include('includes/navbar.php'); ?>
<?php include('includes/adminsidebar.php'); ?>

<?php if(isset($_POST['submit'])){

		$supplier_name = mysqli_real_escape_string($conn, $_POST['supplier_name']);
		$supplier_contactperson = mysqli_real_escape_string($conn, $_POST['supplier_contactperson']);
		$supplier_contactNum = mysqli_real_escape_string($conn,$_POST['supplier_contactNum']);
        $ingredient_name = mysqli_real_escape_string($conn,$_POST['ingredient_name']);
		$ingredient_price = mysqli_real_escape_string($conn,$_POST['ingredient_price']);
		$date = date('Y-m-d');
		
		
		
		$query1 = "INSERT INTO suppliers(supplier_name, supplier_contactperson, supplier_contactNum) VALUES('$supplier_name','$supplier_contactperson','$supplier_contactNum')";
    
        $query = "INSERT INTO ingredient(ingredient_name, ingredient_price) VALUES('$ingredient_name', '$ingredient_price')";
		

		if(mysqli_query($conn,$query) && mysqli_query($conn,$query1)){
			
			$select1 = mysqli_query($conn,"SELECT * from suppliers where supplier_name = '$supplier_name'");
			$id1 = mysqli_fetch_array($select1, MYSQLI_ASSOC);
			$ing_supplier_name = $id1['supplier_id'];
			
			$select = mysqli_query($conn,"SELECT * from ingredient where ingredient_name = '$ingredient_name'");
			$id = mysqli_fetch_array($select, MYSQLI_ASSOC);
			$ingredient_id = $id['ingredient_id'];
			
			$query2 = "INSERT INTO ingredients_supplied(ingredient_accessed_date, ingredient_supplier_id, ingredient_id) VALUES('$date','$ing_supplier_name','$ingredient_id')";
			if(mysqli_query($conn, $query2)){
				echo 'ADDED!';
			}else{
				echo 'ERROR: '. mysqli_error($conn);
			}
		} else {
			echo 'ERROR: '. mysqli_error($conn);
		}
	}
?>

<div class="container-fluid">
	<form class="form-horizontal" id="dischargeform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<fieldset>


<legend>Add Supplier</legend>


<div class="form-group">
  <label class="col-md-4 control-label" for="product_name">Supplier Name</label>  
	  <div class="col-md-4">
	  	<input id="supplier_name" name="supplier_name" type="text" placeholder="Supplier Name" class="form-control input-md" required="">  
	  </div>
</div>
    
<div class="form-group">
  <label class="col-md-4 control-label" for="product_name">Supplier Contact Person</label>  
	  <div class="col-md-4">
	  	<input id="supplier_contactperson" name="supplier_contactperson" type="text" placeholder="Supplier Contact Person" class="form-control input-md" required="">  
	  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="quantity">Supplier Contact Number</label>  
	  <div class="col-md-2">
	  	<input id="supplier_contactNum" name="supplier_contactNum" type="number" placeholder="Contact Number" class="form-control input-md" required="" onkeyup="this.value=this.value.replace(/[^\d]/,'')">
	  </div>
</div>
    
<div class="form-group">
  <label class="col-md-4 control-label" for="product_name">Item Supplied</label>  
	  <div class="col-md-4">
	  	<input id="ingredient_name" name="ingredient_name" type="text" placeholder="Item Supplied" class="form-control input-md" required="">  
	  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="ingredient_price">Price</label>  
	  <div class="col-md-4">
	  	<input id="ingredient_price" name="ingredient_price" type="text" placeholder="Ingredient Price" class="form-control input-md" required="">  
	  </div>
</div>



<div class="form-group">
	<input type="submit" name="submit" class="input-md btn btn-success center-block" value="submit" id="Form">
</div>
</fieldset>
</form>


<?php include('includes/footer.php'); ?>