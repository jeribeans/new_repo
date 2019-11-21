<?php include('includes/header.php'); ?>
<?php 
 if ($_SESSION['usertype']!=101) 
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
?>
<style type="text/css"><?php include('includes/common.css'); ?></style>
<?php include('includes/navbar.php'); ?>
<?php include('includes/sidebar.php'); ?>


<div class="container-fluid">
	<form class="form-horizontal" id="dischargeform" method="post" action="searchjoborder.php">
<fieldset>


<legend>Order Status Report Result</legend>


<?php if(isset($_POST['submit'])){

		$status = mysqli_real_escape_string($conn, $_POST['statusreport']);

		
		$select = mysqli_query($conn,"SELECT * from job_order where jo_trackID = '$status'");
		$stat = mysqli_fetch_array($select, MYSQLI_ASSOC);
		$statreport_id = $stat['jo_trackID'];
		$statreport_customer = $stat['jo_requested_by'];
		$statreport_manu = $stat['jo_manustatus'];
		$statreport_pack = $stat['jo_packstatus'];
		$statreport_del = $stat['jo_delstatus'];
		
		if(is_null($statreport_id)){
			echo "ID doesn't exist";
		}
		
		else if($select){
			?>
			<table class="table table-hover">
					<thead>
						<tr>
							<th>ID</th>
							<th>Requested By</th>
							<th>Manufacturing Status</th>
							<th>Packaging Status</th>
							<th>Delivery Status</th>
						</tr>
					</thead>
					
					<tbody>
						<tr>
			
							<td><?php echo $statreport_id;?></td>
							<td><?php echo $statreport_customer;?></td>
							<td><?php echo $statreport_manu;?></td>
							<td><?php echo $statreport_pack;?></td>
							<td><?php echo $statreport_del;?></td>
							
						</tr>
			
			<?php
			
			
			
			
		} else {
			echo 'ERROR: '. mysqli_error($conn);
		}
	}
?>





</fieldset>
</form>


<?php include('includes/footer.php'); ?>