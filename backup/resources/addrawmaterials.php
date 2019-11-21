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
		$rawmats_name = mysqli_real_escape_string($conn, $_POST['rawmats_name']);
		$rawmats_price = mysqli_real_escape_string($conn, $_POST['rawmats_price']);
		$rawmats_quantity = mysqli_real_escape_string($conn,$_POST['rawmats_quantity']);

		$query = "INSERT INTO rawmats(rawmats_name, rawmats_price, rawmats_quantity) VALUES('$rawmats_name','$rawmats_price','$rawmats_quantity')";

		//$conn->query($query);
		if(mysqli_query($conn, $query)){
			echo "Raw Material Added!";
		} else {
			echo 'ERROR: '. mysqli_error($conn);
		}
	}
?>

<div class="container">
	<form class="form-horizontal" id="dischargeform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<fieldset>

<!-- Form Name -->
<legend>Add Raw Materials</legend>

<!-- Text input for primary key but not needed-->
<!-- <div class="form-group">
  <label class="col-md-4 control-label" for="giftID">Gift ID</label>  
	  <div class="col-md-4">
	  	<input id="giftID" name="giftID" type="text" placeholder="Gift ID" class="form-control input-md">
	  </div>
</div> -->

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="rawmats_name">Raw Material Name</label>  
	  <div class="col-md-4">
	  	<input id="rawmats_name" name="rawmats_name" type="text" placeholder="Raw Material Name" class="form-control input-md" required="">  
	  </div>
</div>
    
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="unitprice">Unit Price</label>  
	  <div class="col-md-2">
	  	<input id="rawmats_price" name="rawmats_price" type="number" placeholder="Unit Price" class="form-control input-md" required="">
	  </div>
</div>

<!-- Text input for numbers only-->
<div class="form-group">
  <label class="col-md-4 control-label" for="quantity">Quantity</label>  
	  <div class="col-md-2">
	  	<input id="rawmats_quantity" name="rawmats_quantity" type="number" placeholder="Quantity" class="form-control input-md" required="" onkeyup="this.value=this.value.replace(/[^\d]/,'')">
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
	<input type="submit" name="submit" class="input-md btn btn-success center-block" value="submit" id="Form">
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