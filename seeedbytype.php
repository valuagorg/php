<?php
/**
 * Template Name: Seed by Type
 */

get_header(); 
global $wpdb
?>
<?php
include_once "add/func.php";
include_once "add/conn.php";
?>
<hr>
<table class="table">
	<thead>
		<tr>
			<th scope="col">Id</th>
			<th scope='col'>Type</th>
			<th scope="col">Color</th>
			<th scope="col">Stage</th>
			<th scope="col">Location Now</th>
		</tr>
	</thead>
<tbody>
<?php

if(isset($_GET['id'])){
	$id = $_GET['id'];
	$sql = "SELECT * FROM seed_id_table WHERE seed_type='$id' OR seed_color='$id' OR seed_stage='$id' ORDER BY seed_id DESC";
	$result = mysqli_query($conn, $sql);
	while($row=mysqli_fetch_assoc($result)){		
		$seed_id = $row['seed_id'] ;
		$seed_type = $row['seed_type'] ;
		$seed_stage = $row['seed_stage'];
		$seed_color = $row['seed_color'];
		$seed_location = $row['seed_location'];	
		$seed_expected_date = $row['seed_expected_date'];	
	?>
	
	<!-- Echoing from DB starts-->
	<th scope="row"><?php echo $seed_id;?></th>
		<td><?php echo seed_name_converter($seed_type); ?></td>
		<td><?php echo $seed_color; ?></td>
		<td><?php echo $seed_stage; ?></td>
		<td><?php echo unitlevel_name_converter($seed_location); ?></td>
	</tr>
	
	<?php }?>

	</tbody>
</table>	
<?php }?>
	
<?php
get_footer();
?>