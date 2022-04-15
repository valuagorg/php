<?php
/**
 * Template Name: All Seeds
 */

get_header(); 
global $wpdb
?>
<?php
include_once "add/func.php";
include_once "add/conn.php";
include_once "topnav.php";
?>
<table class="table table-striped">
	<thead class="thead-dark">
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
$sql = "SELECT * FROM `seed_id_table` ORDER BY seed_id DESC";
					
$result = mysqli_query($conn, $sql);
while($row=mysqli_fetch_assoc($result)){
	$seed_id = $row['seed_id'] ;
	$seed_type = $row['seed_type'];
	$seed_color = $row['seed_color'];
	$seed_stage = $row['seed_stage'];
	$seed_location = $row['seed_location'];	
	?>					
	<tr>
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
			<td><?php echo $seed_stage; ?></td>
			<td><?php echo unitlevel_name_converter($seed_location); ?></td>
		</tr>			
	<?php }?>				  
	</tbody>
</table>	

<style>
.table {text-align: center;}
</style>

<?php
get_footer();
?>