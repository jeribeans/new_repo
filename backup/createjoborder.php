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


<legend>Create Job Order</legend>





<div class="form-group">
  <label class="col-md-4 control-label" for="productname">Product Name</label>
  <div class="col-md-4">
    <select id="productname" name="productname" class="form-control">
      <?php 
		$products = "select * from products_detail GROUP BY product_name";
		$getproducts = mysqli_query($conn, $products);
		
		if($getproducts){
			$resultNo = mysqli_num_rows($getproducts);
			if($resultNo > 0){
			
				while($row = mysqli_fetch_assoc($getproducts)){
				$product = $row['product_name'];
				?>
				<option value="<?php echo $product;?>"><?php echo $product;?></option>
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

		
		$quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
        $unit = mysqli_real_escape_string($conn, $_POST['unit']);
        $productname = mysqli_real_escape_string($conn, $_POST['productname']);
        $date = date('Y-m-d');
        $location = "Under Manufacturing";
		$username = $_SESSION['username'];
		
		
		
		
		
		$track_id= mt_rand(100000,999999);
		
		$checker = mysqli_query($conn,"SELECT * from job_order where jo_trackID = '$track_id'");
		$stat = mysqli_fetch_array($checker, MYSQLI_ASSOC);
		$statreport_id = $stat['jo_trackID'];
		
		
		
		while($track_id == $stat['jo_trackID']){
			if($checker){
				$track_id=  mt_rand(100000,999999);			
			}
		}
	
	
		$query = "INSERT INTO job_order(jo_date_issued, jo_requested_by, jo_manustatus, jo_trackID, jo_packstatus, jo_delstatus) VALUES('$date','$username','$location', '$track_id', 'Packaging: Pending', 'Delivery: Pending')";
		
	

		if(mysqli_query($conn, $query)){
			
			echo '<center>'."product has been ordered!".'</center>';
			echo '<center>'."your tracking ID is " . $track_id.'</center>';
			
			
			$idcheck = mysqli_query($conn,"SELECT * FROM job_order WHERE jo_trackID = '$track_id'");
			$stat2 = mysqli_fetch_array($idcheck, MYSQLI_ASSOC);
			$jo_id = $stat2['job_order_id'];
			
			
			$namecheck = mysqli_query($conn,"SELECT * from products_detail where product_name = '$productname'");
			$nameres = mysqli_fetch_array($namecheck, MYSQLI_ASSOC);
			$detail_id = $nameres['product_detail_id'];
			
			
			if(mysqli_query($conn, "INSERT INTO products(product_quantity, product_accessed_by, product_accessed_date, product_joid, product_detailid) VALUES('$quantity','$username','$date', '$jo_id', '$detail_id')")){
				
				echo '<center>'."product has been added to inventory!".'</center>';
			}	else{
					echo 'error'.mysqli_error($conn);
			}
			
			
			
			
			
			$prodcheck = mysqli_query($conn,"SELECT * from products where product_detailid = '$detail_id'");
			$stat3 = mysqli_fetch_array($prodcheck, MYSQLI_ASSOC);
			$prod_id = $stat3['product_detailid'];
			
			
			$query1 = "INSERT INTO order_details(order_joborder_id, order_purchaseorder_qty, order_unit, order_prod_detail) VALUES('$jo_id','$quantity', '$unit', '$prod_id')";
			
			
			
			if ($jo_id != NULL && $prod_id != NULL){
				mysqli_query($conn, $query1);
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