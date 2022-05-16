<?php
/**
 * Template Name: Sprouts
 */

//Wordpress function get_header() for styling and Wordpress Database are called here
get_header(); 
global $wpdb
?>

<!-- Including functions, database connections and header of our site included here -->
<?php
include_once "add/func.php";
include_once "add/conn.php";
include_once "topnav.php";
?>

<!-- Center the table -->
<center>

<!-- Label -->
<h4>  Result </h4>
<br>

<?php
if(isset($_GET['id'])){
	
	// set variable from page name
	$seed_id = $_GET['id'];
	
	// use foreign key seed_id to get seed_type from seed_id_table
	$sql = "SELECT * FROM `seed_id_table` WHERE seed_id=$seed_id ";
	if($result = $wpdb->get_results($sql, ARRAY_A)){
		foreach($result as $row){
			$seed_type=$row['seed_type'];
		}
	}
	
	// use another foreign key seed_type to get type from seed_table
	$sql = "SELECT * FROM `seed_table` WHERE seed_id=$seed_type ";
	if($result = $wpdb->get_results($sql, ARRAY_A)){
		foreach($result as $row){
			$type=$row['type'];
		}
	}
	
	// if type is sprout get variables
	if ( $type == "sprout"){
		$sql = "SELECT * FROM seed_id_table WHERE seed_id='$seed_id'";
		$result = mysqli_query($conn, $sql);
		
		// Start a while loop, we will do everything inside this loop
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

<!-- Open multipart form to display some data about the seed -->
<form method="post" enctype="multipart/form-data">	

	<h6>Selected Seed ID : <?php echo $seed_id; ?></h6>
	<br>		
	
	<h6>Location Now : <?php echo unitlevel_name_converter($seed_location); ?></h6>
	<br>
	
	<h6>Type : <?php echo seed_name_converter($seed_type); ?></h6>
	<br>
	
	<h6>Stage : <?php echo $seed_stage; ?></h6>
	<br>
	
	<!-- To add colored circles according to harvesting color we used if loops. 
	This basically checks the variables with each color's string name, 
	When it finds the color it concatenate the circle next to it
	-->	
	<h6>Color : <?php if($seed_color == "Red"){
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
	} ?></h6>
	<br>
	
	<h6>Expected Harvest Date : <?php
	// if seed is harvested check for a condition, then print accordingly
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

<!-- Close the form -->
</form>

<!-- We created a table -->
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
			<th scope="col">Planted Weight</th>
			<th scope="col">Harvest</th>
			<th scope="col">Harvested Weight</th>
			<th scope="col">Date</th>
		</tr>
	</thead>
	<tbody>
	
	<!-- To fill the table we will use data from actions_table -->
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
				$planted_weight=$row['planted_weight'];
		
				$harvest = $row['harvest'];
				$harvested_weight = $row['harvested_weight'];
				$action_date = $row['action_date'];	
	?>	

		<!-- We use HTML for each different row, however we need to use PHP inside it to show database data -->
		<!-- We set values of rows and columns from the variables we set earlier  -->
		<tr>

			<th scope="row"><?php echo $actions_id;?></th>
				<td><?php echo $employee_name; ?></td>
				<td><?php echo unitlevel_name_converter($unitlevel_name); ?></td>
				<td><?php echo $treat; ?></td>
				<td><?php echo $humidity; ?></td>
				<td><?php echo $temperature; ?></td>
				<td><?php echo $plant; ?></td>
				<td><?php echo $planted_weight; ?></td>
				<td><?php echo $harvest; ?></td>
				<td><?php echo $harvested_weight; ?></td>
				<td><?php echo $action_date; ?></td>	  
			</tr>
			<?php }?> 

	</tbody>
<!-- Close the table -->
</table>
</center>
</div>

<?php
	}

}
?>

<!-- CSS Styling -->
<style>
.table {text-align: center;}
</style>

<!-- Wordpress function get_footer() is called here -->	
<?php
get_footer();
?>