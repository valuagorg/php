<?php
include_once "add/func.php";
include_once "add/conn.php";
?>
<?php
/**
 * Template Name: Seeds
 */

get_header(); 
global $wpdb
?>
<?php include_once "topnav.php"; ?>
<?php
if(isset($_GET['id'])){
	$seed_id = $_GET['id'];
	
	$sql = "SELECT * FROM `seed_id_table` WHERE seed_id=$seed_id ";
	if($result = $wpdb->get_results($sql, ARRAY_A)){
		foreach($result as $row){
			$seed_type=$row['seed_type'];
		}
	}
	$sql = "SELECT * FROM `seed_table` WHERE seed_id=$seed_type ";
	if($result = $wpdb->get_results($sql, ARRAY_A)){
		foreach($result as $row){
			$type=$row['type'];
		}
	}
	
	if ( $type == "classic"){
		$sql = "SELECT * FROM seed_id_table WHERE seed_id='$seed_id'";
		$result = mysqli_query($conn, $sql);
		while($row=mysqli_fetch_assoc($result)){		
			$seed_type = $row['seed_type'] ;
			$seed_stage = $row['seed_stage'];
			$seed_color = $row['seed_color'];
			$seed_location = $row['seed_location'];	
			$seed_expected_date = $row['seed_expected_date'];
	}
		
	?>
	
<div>
<center>
<form method="post" enctype="multipart/form-data">	
	<h6>Selected Seed ID : <?php echo $seed_id; ?></h6>
	<br>			
	<h6>Location Now : <?php echo unitlevel_name_converter($seed_location); ?></h6>
	<br>
	<h6>Type : <?php echo seed_name_converter($seed_type); ?></h6>
	<br>
	<h6>Stage : <?php echo $seed_stage; ?></h6>
	<br>
	<h6>Color : <?php 
	if($seed_color == "Red"){
		$newcolor=$seed_color." 🔴";
		echo $newcolor; 
	}
	else if($seed_color == "Green"){
		$newcolor=$seed_color." 🟢";
		echo $newcolor; 
	}
	else if($seed_color == "Blue"){
		$newcolor=$seed_color." 🔵";
		echo $newcolor; 
	}
	else if($seed_color == "Orange"){
		$newcolor=$seed_color." 🟠";
		echo $newcolor; 
	}
	else if($seed_color == "Yellow"){
		$newcolor=$seed_color." 🟡";
		echo $newcolor; 
	}
	else if($seed_color == "Brown"){
		$newcolor=$seed_color." 🟤";
		echo $newcolor; 
	}
	else if($seed_color == "Black"){
		$newcolor=$seed_color." ⚫";
		echo $newcolor; 
	}
	?></h6>
	
	
	<br>
	<h6>Expected Harvest Date : <?php
	
	if($seed_expected_date==5555){
		$seed_expected_date='--';
		echo $seed_expected_date;
	}
	else{
		echo $seed_expected_date; 
	}
	
	?>
	</h6>
	<br>


</form>

<hr>
<table class="table table-striped">
	<thead class="thead-dark">
		<tr>
			<th scope="col">Action Id</th>
			<th scope='col'>Employee</th>
			<th scope="col">Unit-Level</th>
			<th scope="col">Treat</th>
			<th scope="col">Humidity</th>
			<th scope="col">Temperature</th>
			<th scope="col">Plant</th>
			<th scope="col">Planted Plugs</th>
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
		$sql = "SELECT * FROM `actions_table` WHERE seed_id='$seed_id'";
		$result = mysqli_query($conn, $sql);
			while($row=mysqli_fetch_assoc($result)){
				$actions_id = $row['actions_id'];
				$employee_name = $row['employee_name'];
				$unitlevel_name = $row['unitlevel_name'];
				$seed_id = $row['seed_id'];
				$treat = $row['treat'];
				$humidity = $row['humidity'];
				$temperature = $row['temperature'];
				$plant = $row['plant'];
				$planted_plugs=$row['planted_plugs'];
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
				<td><?php echo $humidity; ?></td>
				<td><?php echo $temperature; ?></td>
				<td><?php echo $plant; ?></td>
				<td><?php echo $planted_plugs; ?></td>
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

<style>
.table {text-align: center;}
</style>


<?php
	}

}
?>
<?php
get_footer();
?>