<?php include('includes/header.php'); ?>
<?php 
 if ($_SESSION['usertype']!=101) 
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
?>
<style type="text/css"><?php include('includes/common.css'); ?></style>
<?php include('includes/navbar.php'); ?>
<?php include('includes/sidebar.php'); ?>

<?php if(isset($_POST['submit'])){
		// Get form data
		$product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
		$productprice = mysqli_real_escape_string($conn, $_POST['productprice']);
		$ingredientid = mysqli_real_escape_string($conn, $_POST['ingredientid']);
		$username = $_SESSION['username'];
		$date = date('Y-m-d');
		
		$query1 = "SELECT * from ingredient where ingredient_name = '$ingredientid'";
		$var = mysqli_query($conn, $query1);
		$row1 = mysqli_fetch_array($var, MYSQLI_ASSOC);
		$ingredient_name = $row1['ingredient_id'];
		
		
		
		$query = "INSERT INTO products_detail(product_name, product_price, product_ingredient_id) VALUES('$product_name','$productprice','$ingredient_name')";
		
		if(mysqli_query($conn, $query)){
			echo "product added!";
		} else {
			echo 'ERROR: '. mysqli_error($conn);
		}
	}
?>

<div class="container-fluid">
	<form class="form-horizontal" id="dischargeform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<fieldset>


<legend>Add Product</legend>

<div class="form-group">
  <label class="col-md-4 control-label" for="product_name">Product Name</label>  
	  <div class="col-md-4">
	  	<input id="product_name" name="product_name" type="text" placeholder="Product Name" class="form-control input-md" required="">  
	  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="productprice">Product Price</label>  
	  <div class="col-md-2">
	  	<input id="productprice" name="productprice" type="number" placeholder="product price" class="form-control input-md" required="">
	  </div>
</div>



<div class="form-group">
  <label class="col-md-4 control-label" for="ingredientid">Ingredients</label>
  <div class="col-md-4">
    <select id="ingredientid" name="ingredientid" class="form-control">
      <?php 
		$ingredient = "select * from ingredient";
		$getingredients = mysqli_query($conn, $ingredient);
		
		if($getingredients){
			$resultNo = mysqli_num_rows($getingredients);
			if($resultNo > 0){
			
				while($row = mysqli_fetch_assoc($getingredients)){
				$ingredient_name = $row['ingredient_name'];
				?>
				<option value="<?php echo $ingredient_name;?>"><?php echo $ingredient_name;?></option>
				<?php
				}
			}
		}
	  ?>
	  
    </select>
  </div>
</div>



<div class="form-group">
	<input type="submit" name="submit" class="input-md btn btn-success center-block" value="submit" id="Form">
</div>
</fieldset>
</form>



<?php include('includes/footer.php'); ?>