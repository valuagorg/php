<?php
include_once "add/func.php";
include_once "add/conn.php";
?>
<!-- THIS FILE IS NO LONGER IN USE -->
<!-- THIS FILE IS NO LONGER IN USE -->
<!-- THIS FILE IS NO LONGER IN USE -->
<?php
/**
 * Template Name: Units and Levels
 */

get_header(); 
global $wpdb
?>

<?php
if(isset($_GET['id'])){
	$unit_name = $_GET['id'];
	$sql = "SELECT * FROM unitlevel_table WHERE unit_name='$unit_name'";
	$result = mysqli_query($conn, $sql);
	while($row=mysqli_fetch_assoc($result)){		
		$unitlevel_id = $row['unitlevel_id'] ;
		$unit_name = $row['unit_name'];
		$unit_color = $row['unit_color'];
		$unit_seed = $row['unit_seed'];	
		$unit_date = $row['unit_date'];
		$stage = $row['stage'];
	?>
	
<div>
<center>
<form method="post" enctype="multipart/form-data">				
	<h6>Selected Level:<?php echo $unit_name; ?></h6>
	<br>
	
	<h6>Unit Seed:<?php echo seed_name_converter($unit_seed); ?></h6>
	<br>
	<h6>Unit Stage:<?php echo $stage; ?></h6>
	<br>
	<h6>Unit Color:<?php echo $unit_color; ?></h6>
	<br>
	<h6>Last Action Date:<?php echo $unit_date; ?></h6>
	<br>
</form>

<hr>
<table class="table">
	<thead>
		<tr>
			<th scope="col">Id</th>
			<th scope='col'>Employee</th>
			<th scope="col">Unit-Level</th>
			<th scope="col">Treat</th>
			<th scope="col">Plant</th>
			<th scope="col">Transplant</th>
			<th scope="col">Transplanted To</th>
			<th scope="col">Transplanted Pots</th>
			<th scope="col">Harvest</th>
			<th scope="col">Harvested Pots</th>
			<th scope="col">Date</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$sql = "SELECT * FROM `actions_table` WHERE unitlevel_name='$unitlevel_id'";
		$result = mysqli_query($conn, $sql);
			while($row=mysqli_fetch_assoc($result)){
				$actions_id = $row['actions_id'];
				$employee_name = $row['employee_name'];
				$unitlevel_name = $row['unitlevel_name'];
				$treat = $row['treat'];
				$plant = $row['plant'];
				$transplant = $row['transplant'];
				$transplanted_to = $row['transplanted_to'];
				$transplanted_pots = $row['transplanted_pots'];
				$harvest = $row['harvest'];
				$harvested_pots = $row['harvested_pots'];
				$action_date = $row['action_date'];	
	?>	
		<tr>
		<!-- Echoing from DB starts-->
			<th scope="row"><?php echo $actions_id;?></th>
				<td><?php echo $employee_name; ?></td>
				<td><?php echo unitlevel_name_converter($unitlevel_name); ?></td>
				<td><?php echo $treat; ?></td>
				<td><?php echo $plant; ?></td>
				<td><?php echo $transplant; ?></td>
				<td><?php echo unitlevel_name_converter($transplanted_to); ?></td>
				<td><?php echo $transplanted_pots; ?></td>
				<td><?php echo $harvest; ?></td>
				<td><?php echo $harvested_pots; ?></td>
				<td><?php echo $action_date; ?></td>	  
			</tr>
			
<?php }?> 
	</tbody>
</table>
</center>
</div>

<?php
	}
}
?>
<?php
get_footer();
?>