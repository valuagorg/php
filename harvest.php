<?php
/**
 * Template Name: Harvest
 */

get_header(); 
global $wpdb
?>

<div>
<center>
<form method="post" enctype="multipart/form-data">

	<?php 
		global $current_user; get_currentuserinfo();
		$current_user=$current_user->display_name
	?>

	<h6>Available Units and Levels</h6>
	<select name="unitlevel_name" class="form-control" id="exampleFormControlSelect1">
	<?php
	//Query Operations
	
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
	//Query Operations
	?>
	</select>
	<br>
	<br>
	<h6>Harvested Pots / Weight</h6>
	
	<input type='text' name='total_pots' class='form-control' placeholder='Enter number'>
	<br>
	<br>
		<button name="harvest" type="submit" class="btn btn-primary">Harvest</button>				 
	<br>
<style>
.btn {width: 150px;}
.form-control {width: 210px; text-align: center;}
</style>
	
</form>
</center>
</div>
				
<!-- Getting user specifics from DB -->
<?php
//Querry Operations
if(isset($_POST['harvest'])){ 	
	
	$unitlevel_name = $_POST['unitlevel_name'];
	
	$total_pots=$_POST['total_pots'].' pots';
	$harvested_weight=$total_pots.' oz';
	
	date_default_timezone_set('America/New_York');
	$t=time();
	$post_date = date("m-d-Y h:i A",$t);
	$harvest_date =  date("m-d-Y", $t);
	

			
	if(empty($unitlevel_name) OR empty($total_pots)){
		echo '<script>alert("Enter number of Pots harvested")</script>';
		exit();
	}

	$sql = "SELECT * FROM `unitlevel_table` WHERE unitlevel_id = $unitlevel_name";
	if($result = $wpdb->get_results($sql, ARRAY_A)){
		foreach($result as $row){
			$seed_id = $row['unit_seed_id'];
		}
	}
	else{
		$seed_id='error';
		}
	
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
	
	
	
	if( $type == "classic"){
		$wpdb->insert('actions_table', array(
		'employee_name' => $current_user,
		'unitlevel_name' => $unitlevel_name,
		'seed_id' => $seed_id,
		'harvest' => 'Harvested',
		'harvested_pots' => $total_pots,
		'action_date' => $post_date
		));
		
		$wpdb->update('unitlevel_table', array(
		'stage'=>'empty', 
		'unit_seed_id'=>'empty'), 
		array('unitlevel_id'=>$unitlevel_name));
		
		$wpdb->update('seed_id_table', array( 
		'seed_stage'=>'Harvested',
		'harvest_date'=>$harvest_date,
		'harvest_amount'=>$total_pots,
		'seed_location'=>'4444',
		'seed_expected_date'=>'5555'), 
		array('seed_id'=>$seed_id));
	}
	
	else if( $type == "sprout"){
		$wpdb->insert('actions_table', array(
		'employee_name' => $current_user,
		'unitlevel_name' => $unitlevel_name,
		'seed_id' => $seed_id,
		'harvest' => 'Harvested',
		'harvested_weight' => $harvested_weight,
		'action_date' => $post_date
		));
		
		$wpdb->update('unitlevel_table', array(
		'stage'=>'empty', 
		'unit_seed_id'=>'empty'), 
		array('unitlevel_id'=>$unitlevel_name));
		
		$wpdb->update('seed_id_table', array( 
		'seed_stage'=>'Harvested',
		'harvest_date'=>$harvest_date,
		'harvest_amount'=>$harvested_weight,
		'seed_location'=>'4444',
		'seed_expected_date'=>'5555'), 
		array('seed_id'=>$seed_id));
	}
	
	echo "<meta http-equiv='refresh' content='0'>";
}

//Querry Operations		
//?id=unit4_level1

//onemli kod navigation icin


?>


<?php

get_footer();
?>