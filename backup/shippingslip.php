<?php include('includes/header.php'); ?>
<?php 
 if ($_SESSION['usertype']!=101) 
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
?>
<style type="text/css"><?php include('includes/common.css'); ?></style>
<?php include('includes/navbar.php'); ?>
<?php include('includes/sidebar.php'); ?>

	
	
	


<div class="container">
	<form class="form-horizontal" id="dischargeform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<fieldset>


<legend>Shipping Slip</legend>


<div class="form-group">
  <label class="col-md-4 control-label" for="statusreport">Purchase Order ID</label>  
	  <div class="col-md-4">
	  	<input id="statusreport" name="statusreport" type="text" placeholder="Enter code" class="form-control input-md" required="">  
	  </div>
</div>



<div class="form-group">
	<input type="submit" name="submit" class="input-md btn btn-success center-block" value="submit" id="Form">
</div>




<?php if(isset($_POST['submit'])){
		
		$status = mysqli_real_escape_string($conn, $_POST['statusreport']);

		
		$select = mysqli_query($conn,"SELECT * from customer_purchase_order where po_trackID = '$status'");
		$stat = mysqli_fetch_array($select, MYSQLI_ASSOC);
		$statreport_id = $stat['po_trackID'];
		$statreport_customer = $stat['po_customer_name'];
		$statreport_address = $stat['po_address'];
		$statreport_manu = $stat['po_manustatus'];
		$statreport_pack = $stat['po_packstatus'];
		$statreport_del = $stat['po_delstatus'];
		
		if($select){
			mysqli_query($conn,"UPDATE customer_purchase_order SET po_packstatus = 'Under Packaging', po_manustatus='Success' WHERE po_trackID = '$status'");
			?>
			<table class="table table-hover">
					<thead>
						<tr>
							<th>ID</th>
							<th>Customer Name</th>
							<th>Address</th>
							<th>Manufacturing Status</th>
							<th>Packaging Status</th>
							<th>Delivery Status</th>
						</tr>
					</thead>
					
					<tbody>
						<tr>
			
							<td><?php echo $statreport_id;?></td>
							<td><?php echo $statreport_customer;?></td>
							<td><?php echo $statreport_address;?></td>
							<td><?php echo $statreport_manu;?></td>
							<td><?php echo $statreport_pack;?></td>
							<td><?php echo $statreport_del;?></td>
							
						</tr>
			</table>
			<form>
				<input type="button" value="Print this page" onClick="window.print()">
			</form>
			<?php
		} else {
			echo 'ERROR: '. mysqli_error($conn);
		}
	}
	?>
	



</fieldset>
</form>


<?php include('includes/footer.php'); ?>