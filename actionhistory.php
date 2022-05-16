<?php
/**
 * Template Name: Action History
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
<h4>  Action History </h4>
<br>
<br>

<!-- Top of the table is set here -->
<table class="table table-striped">
	<thead class="thead-dark">
		<tr>
			<th scope="col">Id</th> <!-- One column is set here, each one is a column -->	
			<th scope='col'>Employee</th>
			<th scope="col">Unit-Level</th>
			<th scope="col">Seed ID</th>
			<th scope="col">Type</th>
			<th scope="col">Treat</th>
			<th scope="col">Humidity</th>
			<th scope="col">Temperature</th>
			<th scope="col">Plant</th>
			<th scope="col">Planted Weight</th>
			<th scope="col">Planted Plugs</th>
			<th scope="col">Transplant</th>
			<th scope="col">Transplanted To</th>
			<th scope="col">Transplanted Pots</th>
			<th scope="col">Harvest</th>
			<th scope="col">Harvested Weight</th>
			<th scope="col">Harvested Pots</th>
			<th scope="col">Date</th>
		</tr>
	</thead>

<!-- CSS Styling -->
<style>
.table {text-align: center;}
</style>

<!-- SQL operations, done in PHP -->
<?php
$sql = "SELECT * FROM `actions_table` ORDER BY actions_id DESC";
$result = mysqli_query($conn, $sql);
// Start a while loop, we will do everything inside this loop.
while($row=mysqli_fetch_assoc($result)){
	$actions_id = $row['actions_id'];  // one variable can be seen here, each one is a variable
	$employee_name = $row['employee_name'];
	$unitlevel_name = $row['unitlevel_name'];
	$seed_id = $row['seed_id'];
	$treat = $row['treat'];
	$humidity = $row['humidity'];
	$temperature = $row['temperature'];
	$plant = $row['plant'];
	$planted_plugs=$row['planted_plugs'];
	$planted_weight=$row['planted_weight'];
	$transplant = $row['transplant'];
	$transplanted_to = $row['transplanted_to'];
	$transplanted_pots = $row['transplanted_pots'];
	$harvest = $row['harvest'];
	$harvested_pots = $row['harvested_pots'];
	$harvested_weight = $row['harvested_weight'];
	$action_date = $row['action_date'];	
?>

<!-- We use HTML for each different row, however we need to use PHP inside it to show database data -->
<!-- We set values of rows and columns from the variables we set earlier  -->
<tr>
	<th scope="row"><?php echo $actions_id;?></th>
		<td><?php echo $employee_name; ?></td>	
		<td><?php echo unitlevel_name_converter($unitlevel_name); ?></td>
		<td><?php echo $seed_id; ?></td>
		<td><?php echo seed_name_converter(seed_type_converter($seed_id)); ?></td>
		<td><?php echo $treat; ?></td>
		<td><?php echo $humidity; ?></td>
		<td><?php echo $temperature; ?></td>
		<td><?php echo $plant; ?></td>
		<td><?php echo $planted_weight; ?></td>
		<td><?php echo $planted_plugs; ?></td>
		<td><?php echo $transplant; ?></td>
		<td><?php echo unitlevel_name_converter($transplanted_to); ?></td>
		<td><?php echo $transplanted_pots; ?></td>
		<td><?php echo $harvest; ?></td>
		<td><?php echo $harvested_weight; ?></td>
		<td><?php echo $harvested_pots; ?></td>
		<td><?php echo $action_date; ?></td>
	</tr>
	
<!-- Stop the while loop -->			
<?php }?>
				  
<!-- Close the table -->
</table>	
</center>
	
<!-- Wordpress function get_footer() is called here -->	
<?php
get_footer();
?>