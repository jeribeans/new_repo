<?php include('includes/header.php'); ?>
<?php 
 if ($_SESSION['usertype']!=101) 
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
?>
<style type="text/css"><?php include('includes/common.css'); ?></style>
<?php include('includes/navbar.php'); ?>
<?php include('includes/sidebar.php'); ?>

<div class="container-fluid">

<?php
	$c = $_SESSION['numb'];
	$t = $_SESSION['track_id'];
?>

<h1>

<?php echo 'For: '.$_POST['cName']; ?>

<form class="form-horizontal" id="dischargeform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<fieldset>
</h1>
<?php 
	for($c; $c<=0; $c--){
?>
	<hr>
	<!-- Prod list select  -->
	<!-- name: productname -->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="productname">Product Name</label>
	  <div class="col-md-4">
	    <select id="productname" name="productname" class="form-control">
	      <?php 
			$products = "select * from products GROUP BY product_name ORDER BY product_name";
			$getproducts = mysqli_query($conn, $products);

			if($getproducts){
				$resultNo = mysqli_num_rows($getproducts);
				if($resultNo > 0){
				
					while($row = mysqli_fetch_assoc($getproducts)){
					$product = $row['product_name'];
					?>
					<option value="<?php echo $product;?>"><?php echo $product; ?></option>
					<?php
					}
				}
			}
		  ?>
		  
	    </select>
	  </div>
	</div>
		
	
		
	    <!-- Quantity submit form only-->
	    <!-- name: quantity -->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="quantity">Quantity</label>  
		  <div class="col-md-2">
		  	<input id="quantity" name="quantity" type="number" placeholder="Quantity" class="form-control input-md" required="" onkeyup="this.value=this.value.replace(/[^\d]/,'')">
		  </div>
	</div>

<?php 
	}
	$_SESSION['count'] = NULL;
	$_SESSION['track_id'] = NULL;

?>
	
	<div class="form-group">
		<input type="submit" name="submit" class="input-md btn btn-success center-block" value="Submit" id="Form">
	</div>
<?php if(isset($_POST['submit'])){
		// Get form data
		$quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
        $unit = mysqli_real_escape_string($conn, $_POST['unit']);
        $productname = mysqli_real_escape_string($conn, $_POST['productname']);
        $date = date('Y-m-d');
        $location = "Under Manufacturing";
		
		$idcheck = mysqli_query($conn,"SELECT * FROM customer_purchase_order WHERE po_trackID = '$track_id'");
		$stat2 = mysqli_fetch_array($idcheck, MYSQLI_ASSOC);
		$po_id = $stat2['purchase_order_id'];
		
		$prodcheck = mysqli_query($conn,"SELECT * from products where product_name = '$productname'");
		$stat3 = mysqli_fetch_array($prodcheck, MYSQLI_ASSOC);
		$prod_id = $stat3['product_id'];
			
		$query1 = "INSERT INTO order_details(order_product_id, order_purchaseorder_id, order_purchaseorder_qty) VALUES('$prod_id','$po_id','$quantity')";
			if ($po_id != NULL && $prod_id != NULL){
				mysqli_query ($conn, $query1);
			}
		 else {
			echo 'ERROR: '. mysqli_error($conn);
		}
	}
?>



<?php include('includes/footer.php'); ?>