<?php
/**
 * Template Name: Transplant
 */

get_header(); 
global $wpdb
?>
<?php include_once "topnav.php"; ?>
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
	
	$sql = "SELECT * FROM `unitlevel_table` WHERE stage='Plug'";
	$result = $wpdb->get_results($sql, ARRAY_A);
	
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
	
	<h6>Transplant To</h6>
	<select name="transplant_name" class="form-control" id="exampleFormControlSelect1">	
	<?php
	//Query Operations
	
	$sql = "SELECT * FROM `unitlevel_table` WHERE stage='empty'";
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
	

	<h6>Transplanted Pots</h6> 
	<input type='text' autocomplete="off" name='total_pots' class='form-control' placeholder='example: 50'>
	<br>
	<br>
		<button name="transplant" type="submit" class="btn btn-primary">Transplant</button>
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
if(isset($_POST['transplant'])){ 	
	
	$unitlevel_name = $_POST['unitlevel_name'];
	
	$total_pots=$_POST['total_pots'];
	$transplant_name=$_POST['transplant_name'];
	date_default_timezone_set('America/New_York');
	$t=time();
	$post_date = date("m-d-Y h:i A",$t);

			
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

	
	$wpdb->insert('actions_table', array(
    'employee_name' => $current_user,
	'unitlevel_name' => $unitlevel_name,
	'seed_id' => $seed_id,
	'transplant' => 'Transplanted',
	'transplanted_to' => $transplant_name,
	'transplanted_pots' => $total_pots,
	'action_date' => $post_date
	));
	
	$wpdb->update('unitlevel_table', array( 
	'stage'=>'empty', 
	'unit_seed_id'=>'empty'), 
	array('unitlevel_id'=>$unitlevel_name));
	
	$wpdb->update('seed_id_table', array( 
	'seed_stage'=>'Pot',
	'seed_location'=>$transplant_name), 
	array('seed_id'=>$seed_id));
	
	$wpdb->update('unitlevel_table', array(
	'stage'=>'Pot', 
	'unit_seed_id'=>$seed_id), 
	array('unitlevel_id'=>$transplant_name));
	
	echo "<meta http-equiv='refresh' content='0'>";
}
?>
<?php
get_footer();
?>