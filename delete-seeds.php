<?php
/**
 * Template Name: Delete Seeds
 */

get_header(); 
global $wpdb
?>


<?php include_once "topnav.php"; ?>

<center>
<h4>  Delete Seed </h4>
<br>
<form method="post" enctype="multipart/form-data">
	<h6>Seed Type</h6>
	<select name="seed_name" class="form-control" id="exampleFormControlSelect1" 
	onchange='
	let plantId = getElementsByName("seed_name")[0].value ;
	if(plantId == 26 || plantId ==27 || plantId == 28)
		getElementsByName("planted_plugs")[0].placeholder = "Enter weight in ounces."
	else
		getElementsByName("planted_plugs")[0].placeholder = "Enter planted plugs."'>
	<?php
	//Query Operations
	$sql = "SELECT * FROM `seed_table` ORDER BY type";
	$result = $wpdb->get_results($sql, ARRAY_A) ;
	foreach($result as $row){
		$seed_id = $row['seed_id'];
		$seed_name = $row['seed_name'];
		$seed_expected_date= $row['expected_time'];
		$type=$row['type'];
	?>

	<option 
	value="
	<?php echo $seed_id; ?>
	" <?php 
	if ($type=="ds"){
		echo " disabled";
	}
	?>>
	
	
	<?php 
	if ($type == "sprout"){
		echo "S-".$seed_name;
	}

	else{
		if($type == "classic"){
		echo "H-".$seed_name;
		}
		else{
			echo "-----------------------";
		}
	}
	?>
	</option>
	
	<?php
	}
	//Query Operations					
	?>
	</select>								
	<br>



<?php
if( current_user_can('administrator') ) {
	
	echo '<button name="btnn" type="submit" class="btn btn-primary">Delete Seed</button>';

};
?>
</form>
</center>

<?php
if(isset($_POST['btnn'])){
	$seed_name = $_POST['seed_name'];
		
	
	$wpdb->delete('seed_table', array(
	'seed_id' => $seed_name,
	));
	echo "<meta http-equiv='refresh' content='0'>";	
	}
	?>
	
<style>
.form-control {width: 230px; text-align: center;}
.btn {width: 200px;}
</style>

<?php
get_footer();
?>
