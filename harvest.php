<?php
/**
 * Template Name: Harvest
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
<div>
<!-- Center everything -->
<center>

<!-- Label -->
<h4>  Harvest </h4>
<br>

<!--  Multipart form -->
<form method="post" enctype="multipart/form-data">

	<!--  Get user's name from get_currenuserinfo(), a Wordpres function, then set it to a variable -->
	<?php 
		global $current_user; get_currentuserinfo();
		$current_user=$current_user->display_name
	?>

	<!--  Select a unit to harvest, we need to get units from our database -->
	<h6>Available Units and Levels</h6>
	<select name="unitlevel_name" class="form-control" id="exampleFormControlSelect1">
	<!--  Only units shown are either Pot stage or sprouts -->
	<?php
	$sql = "SELECT * FROM `unitlevel_table` WHERE stage='Pot' OR stage='sproutstage'";
	$result = $wpdb->get_results($sql, ARRAY_A) ;
	foreach($result as $row){
		$unitlevel_id = $row['unitlevel_id'] ;
		$unit_name = $row['unit_name'];
		$unit_color = $row['unit_color'];
		$unit_seed = $row['unit_seed'];
	?>
	<option value="<?php echo $unitlevel_id; ?>"><?php echo $unit_name; ?></option>
	<?php
	}
	?>
	</select>
	<br>
	<br>
	
	<!-- Enter amount harvested, input type is plain text or integer. -->
	<h6>Harvested Pots / Weight</h6>
	<input type='text' autocomplete="off" name='total_pots' class='form-control' placeholder='Enter number'>
	<br>
	<br>
	
	<button name="harvest" type="submit" class="btn btn-primary">Harvest</button>				 
	<br>
	
<!-- CSS Styling -->
<style>
.btn {width: 150px;}
.form-control {width: 210px; text-align: center;}
</style>
	
</form>
</center>
</div>
				
<!-- SQL operations, done in PHP -->
<?php
if(isset($_POST['harvest'])){ 	

	//set variables from the form 
	$unitlevel_name = $_POST['unitlevel_name'];
	$total_pots=$_POST['total_pots'];
	$pots_temp=$total_pots.' pots';
	$harvested_weight=$total_pots.' oz';
	
	// add date
	date_default_timezone_set('America/New_York');
	$t=time();
	$post_date = date("m-d-Y h:i A",$t);
	$harvest_date =  date("m-d-Y", $t);
	
	// check for empty fields
	if(empty($unitlevel_name) OR empty($total_pots)){
		echo '<script>alert("Empty Fields")</script>';
		exit();
	}

	// using foreign key to access unitlevel_table
	$sql = "SELECT * FROM `unitlevel_table` WHERE unitlevel_id = $unitlevel_name";
	if($result = $wpdb->get_results($sql, ARRAY_A)){
		foreach($result as $row){
			$seed_id = $row['unit_seed_id'];
		}
	}
	else{
		$seed_id='error';
		}
	
	// using the seed_id which we got from above as a foreign key to access seed_id_table
	$sql = "SELECT * FROM `seed_id_table` WHERE seed_id=$seed_id ";
	if($result = $wpdb->get_results($sql, ARRAY_A)){
		foreach($result as $row){
			$seed_type=$row['seed_type'];
		}
	}
	
	// using the seed_type which we got from above as a foreign key to access seed_table
	$sql = "SELECT * FROM `seed_table` WHERE seed_id=$seed_type ";
	if($result = $wpdb->get_results($sql, ARRAY_A)){
		foreach($result as $row){
			$type=$row['type'];
		}
	}
		
	// if seed type is classic
	if( $type == "classic"){
		// insert data into acctions_table
		$wpdb->insert('actions_table', array(
		'employee_name' => $current_user,
		'unitlevel_name' => $unitlevel_name,
		'seed_id' => $seed_id,
		'harvest' => 'Harvested',
		'harvested_pots' => $pots_temp,
		'action_date' => $post_date
		));
		
		// update data in the unitlevel_table, so we don't need to add different units each time
		$wpdb->update('unitlevel_table', array(
		'stage'=>'empty', 
		'unit_seed_id'=>'empty'), 
		array('unitlevel_id'=>$unitlevel_name));
		
		// update data in the seed_id_table, so we don't need to add different units each time
		$wpdb->update('seed_id_table', array( 
		'seed_stage'=>'Harvested',
		'harvest_date'=>$harvest_date,
		'harvest_amount'=>$pots_temp,
		'seed_location'=>'4444',
		'seed_expected_date'=>'5555'), 
		array('seed_id'=>$seed_id));
	}
	
	// if seed type is sprout
	else if( $type == "sprout"){
		// insert data into acctions_table
		$wpdb->insert('actions_table', array(
		'employee_name' => $current_user,
		'unitlevel_name' => $unitlevel_name,
		'seed_id' => $seed_id,
		'harvest' => 'Harvested',
		'harvested_weight' => $harvested_weight,
		'action_date' => $post_date
		));
		
		// update data in the unitlevel_table, so we don't need to add different units each time
		$wpdb->update('unitlevel_table', array(
		'stage'=>'empty', 
		'unit_seed_id'=>'empty'), 
		array('unitlevel_id'=>$unitlevel_name));
		
		// update data in the seed_id_table, so we don't need to add different units each time
		$wpdb->update('seed_id_table', array( 
		'seed_stage'=>'Harvested',
		'harvest_date'=>$harvest_date,
		'harvest_amount'=>$harvested_weight,
		'seed_location'=>'4444',
		'seed_expected_date'=>'5555'), 
		array('seed_id'=>$seed_id));
	}
	
	//refresh page, used for refreshing form data
	echo "<meta http-equiv='refresh' content='0'>";
}
?>

<!-- Wordpress function get_footer() is called here -->	
<?php

get_footer();
?>