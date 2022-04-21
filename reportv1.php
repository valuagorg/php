<?php
/**
 * Template Name: reportv1
 */

get_header(); 
global $wpdb
?>
<?php
include_once "add/func.php";
include_once "add/conn.php";
?>
<?php include_once "topnav.php"; ?>
<center>
<h4>  Report </h4>
<br>
<br>

<table class="table table-striped">
	<thead class="thead-dark">
		<tr>
			<th scope="col">Id</th>
			<th scope='col'>Type</th>
			<th scope="col">Color</th>
			
			<th scope="col">Harvest Amount</th>
			<th scope="col">Harvest Date</th>
		</tr>
	</thead>
<tbody>
<?php

if(isset($_GET['id'])){
	$id = $_GET['id']; #blue+harvested
	
	$str = $id;
	$delimiter = ' ';
	$words = explode($delimiter, $str);
	 
	#echo $words[0]; #color
	#echo "<br>";
	#echo $words[1]; #state


	
	
	$sql = "SELECT * FROM seed_id_table WHERE  seed_color='$words[0]' AND seed_stage='harvested' AND harvest_date='$words[1]' ORDER BY seed_id DESC";
	$result = mysqli_query($conn, $sql);
	while($row=mysqli_fetch_assoc($result)){		
		$seed_id = $row['seed_id'] ;
		$seed_type = $row['seed_type'] ;
		$seed_stage = $row['seed_stage'];
		$seed_color = $row['seed_color'];
		$seed_location = $row['seed_location'];	
		$harvest_date = $row['harvest_date'];
		$harvest_amount = $row['harvest_amount'];
		$seed_expected_date = $row['seed_expected_date'];	

	?>
	

	<!-- Echoing from DB starts-->
	<th scope="row"><?php echo $seed_id;?></th>
		<td><?php echo seed_name_converter($seed_type); ?></td>
		<td><?php if($seed_color == "Red"){
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
		} ?></td>
		
		<td><?php echo $harvest_amount; ?></td>
		<td><?php echo $harvest_date; ?></td>
	</tr>
	
	<?php }?>

	</tbody>
</table>	
</center>
<?php }?>

<style>
.table {text-align: center;}
</style>
<?php
get_footer();
?>