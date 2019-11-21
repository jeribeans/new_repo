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


<legend>Create Purchase Order</legend>


<div class="form-group">
    <label class="col-md-4 control-label" for="customer_name">Customer Name</label> 
	  <div class="col-md-4">
	  	<input id="cName" name="cName" type="text" placeholder="Name" class="form-control input-md" required="">  
	  </div>
</div>
    
<div class="form-group">
    <label class="col-md-4 control-label" for="location">Address</label> 
	  <div class="col-md-4">
	  	<input id="address" name="address" type="text" placeholder="Address" class="form-control input-md" required="">  
	  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="cNum">Contact Number</label>  
	  <div class="col-md-4">
	  	<input id="cNum" name="cNum" type="text" placeholder="ex. 09101234123" class="form-control input-md" required="" onkeyup="this.value=this.value.replace(/[^\d]/,'')">
	  </div>
</div>
    





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

		$customername = mysqli_real_escape_string($conn, $_POST['cName']);
		$address = mysqli_real_escape_string($conn, $_POST['address']);
		$cNum = mysqli_real_escape_string($conn,$_POST['cNum']);
		$quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
        $unit = mysqli_real_escape_string($conn, $_POST['unit']);
        $productname = mysqli_real_escape_string($conn, $_POST['productname']);
        $date = date('Y-m-d');
        $location = "Under Manufacturing";
		
		
		
		
		
		$track_id= mt_rand(100000,999999);
		
		$checker = mysqli_query($conn,"SELECT * from customer_purchase_order where po_trackID = '$track_id'");
		$stat = mysqli_fetch_array($checker, MYSQLI_ASSOC);
		$statreport_id = $stat['po_trackID'];
		
		
		//checker for duplicate tracker id
		while($track_id == $stat['po_trackID']){
			if($checker){
				$track_id=  mt_rand(100000,999999);			
			}
		}
	
	
		$query = "INSERT INTO customer_purchase_order(po_customer_name, po_address, po_contactNum, po_date_issued, po_manustatus, po_trackID, po_packstatus, po_delstatus) VALUES('$customername','$address','$cNum','$date','$location', '$track_id', 'Packaging: Pending', 'Delivery: Pending')";
		
	

		if(mysqli_query($conn, $query)){
			
			echo '<center>'."product has been ordered!".'</center>';
			echo '<center>'."your tracking ID is " . $track_id.'</center>';
			
			// should be in a modal
			echo '<center>'.$customername.'</center>';
			echo '<center>'.$address.'</center>';
			echo '<center>'.$cNum.'</center>';
			echo '<center>'.$quantity.'</center>';
			echo '<center>'.$unit.'</center>';
			echo '<center>'.$productname.'</center>';
			
		$idcheck = mysqli_query($conn,"SELECT * FROM customer_purchase_order WHERE po_trackID = '$track_id'");
		$stat2 = mysqli_fetch_array($idcheck, MYSQLI_ASSOC);
		$po_id = $stat2['purchase_order_id'];
		
		
		
		
		$prodcheck = mysqli_query($conn,"SELECT * from products_detail where product_name = '$productname'");
		$stat3 = mysqli_fetch_array($prodcheck, MYSQLI_ASSOC);
		$prod_id = $stat3['product_detail_id'];
			
		$query1 = "INSERT INTO order_details(order_purchaseorder_id, order_purchaseorder_qty, order_unit, order_prod_detail) VALUES('$po_id','$quantity', '$unit', '$prod_id')";
		
		
			if ($po_id != NULL && $prod_id != NULL){
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