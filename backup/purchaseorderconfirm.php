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
		$customername = mysqli_real_escape_string($conn, $_POST['cName']);
		$address = mysqli_real_escape_string($conn, $_POST['address']);
		$cNum = mysqli_real_escape_string($conn,$_POST['cNum']);
		$quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
        $unit = mysqli_real_escape_string($conn, $_POST['unit']);
        $productname = mysqli_real_escape_string($conn, $_POST['productname']);
        $date = date('Y-m-d');
        $location = "Under Manufacturing";
		
		
		
		
		
		$track_id= mt_rand(100000,999999);
		
		$checker = mysqli_query($conn,"SELECT * from customer_purchase_order where po_manustatus = '$track_id'");
		$stat = mysqli_fetch_array($checker, MYSQLI_ASSOC);
		$statreport_id = $stat['po_trackID'];
		
		
		
		while($track_id == $stat['po_trackID']){
			if($checker){
				$track_id=  mt_rand(100000,999999);			
			}
		}
	
	
		$query = "INSERT INTO customer_purchase_order(po_customer_name, po_address, po_contactNum, po_date_issued, po_manustatus, po_trackID) VALUES('$customername','$address','$cNum','$date','$location', '$track_id')";
		

		//$conn->query($query);
		if(mysqli_query($conn, $query)){
			
			echo '<center>'."product has been ordered!".'</center>';
			echo '<center>'."your tracking ID is" . $track_id.'</center>';
		} else {
			echo 'ERROR: '. mysqli_error($conn);
		}
	}
?>



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
	  	<input id="productname" name="productname" type="text" placeholder="Item Name" class="form-control input-md" required="">  
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
    
 
  


<!-- Select Basic / dropdown choose items-->
<!-- <div class="form-group">
  <label class="col-md-4 control-label" for="store">Store</label>
  <div class="col-md-4">
    <select id="store" name="store" class="form-control">
      <option value="Store 1">Store 1</option>
      <option value="Store 2">Store 2</option>
    </select>
  </div>
</div> -->



<!-- Text input with guide-->
<!-- <div class="form-group">
  <label class="col-md-4 control-label" for="shippingDays">Shipping Days</label>  
	  <div class="col-md-4">
		  <input id="shippingDays" name="shippingDays" type="text" placeholder="Shipping Days" class="form-control input-md">
		  <span class="help-block">It identify how many days it takes for deliver</span>  
	  </div>
</div>
 -->
<!-- Form submit-->
<div class="form-group">
	<input type="submit" name="submit" class="input-md btn btn-success center-block" value="Submit" id="Form">
</div>

<div class="form-group">
	<input type="print" name="print" class="input-md btn btn-success center-block" value="print" id="Form">
</div>


</fieldset>
</form>
<script>
// 	var el = document.getElementById('Form');
// 	el.addEventListener('submit', function(){
//     return confirm('Are you sure you want to submit this form?');
// }, false);
// 
</script>
<hr>
<footer>
        <p><b>© Mario's Bro's</b></p>
    </footer>


<?php include('includes/footer.php'); ?>