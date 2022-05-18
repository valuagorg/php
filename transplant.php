<?php
/**
 * Template Name: Transplant
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
<h4>  Transplant </h4>
<br>

<!--  Multipart form -->
<form method="post" enctype="multipart/form-data">

	<!--  Get user's name from get_currenuserinfo(), a Wordpres function, then set it to a variable -->
	<?php 
		global $current_user; get_currentuserinfo();
		$current_user=$current_user->display_name
	?>
	
	<!--  Select a unit to transplant, we need to get units from our database -->
	<h6>Available Units and Levels</h6>
	<!--  Only units shown are Plug stage -->
	<select name="unitlevel_name" class="form-control" id="exampleFormControlSelect1">	
	<?php
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
	?>
	</select>
	<br>
	
	<!--  Select a unit to transplan to, we need to get units from our database -->
	<h6>Transplant To</h6>
	<!--  Only units shown are Empty  -->
	<select name="transplant_name" class="form-control" id="exampleFormControlSelect1">	
	<?php
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
	?>
	</select>
	<br>
	
	<!-- Enter amount transplanted, input type is plain text or integer. -->
	<h6>Transplanted Pots</h6> 
	<input type='text' autocomplete="off" name='total_pots' class='form-control' placeholder='example: 50'>
	<br>
	<br>
		<button name="transplant" type="submit" class="btn btn-primary">Transplant</button>
	<br>
	
<!-- CSS Styling -->
<style>
.btn {width: 150px;}
.form-control {width: 210px; text-align: center;}
</style>	

<!-- Close form -->
</form>
</center>
</div>

<!-- SQL operations, done in PHP -->
<?php
if(isset($_POST['transplant'])){ 	
	
	//set variables from the form
	$unitlevel_name = $_POST['unitlevel_name'];
	$total_pots=$_POST['total_pots'];
	$transplant_name=$_POST['transplant_name'];
	
	// add date
	date_default_timezone_set('America/New_York');
	$t=time();
	$post_date = date("m-d-Y h:i A",$t);

	// check for empty fields		
	if(empty($unitlevel_name) OR empty($total_pots)){
		echo '<script>alert("Empty Fields")</script>';
		exit();
	}
	
	// use unitlevel_name to get unit_seed_id from unitlevel_table
	$sql = "SELECT * FROM `unitlevel_table` WHERE unitlevel_id = $unitlevel_name";
	if($result = $wpdb->get_results($sql, ARRAY_A)){
		foreach($result as $row){
			$seed_id = $row['unit_seed_id'];
		}
	}
	else{
		$seed_id='error';
		}	

	// insert variables into actions_table
	$wpdb->insert('actions_table', array(
    'employee_name' => $current_user,
	'unitlevel_name' => $unitlevel_name,
	'seed_id' => $seed_id,
	'transplant' => 'Transplanted',
	'transplanted_to' => $transplant_name,
	'transplanted_pots' => $total_pots,
	'action_date' => $post_date
	));
	
	// update unitlevel_table first for where it transplanted from
	$wpdb->update('unitlevel_table', array( 
	'stage'=>'empty', 
	'unit_seed_id'=>'empty'), 
	array('unitlevel_id'=>$unitlevel_name));
	
	// update seed_id_table
	$wpdb->update('seed_id_table', array( 
	'seed_stage'=>'Pot',
	'seed_location'=>$transplant_name), 
	array('seed_id'=>$seed_id));
	
	// update unitlevel_table second for where it transpled to
	$wpdb->update('unitlevel_table', array(
	'stage'=>'Pot', 
	'unit_seed_id'=>$seed_id), 
	array('unitlevel_id'=>$transplant_name));
	
	//refresh page, used for refreshing form data
	echo "<meta http-equiv='refresh' content='0'>";
}
?>

<!-- Wordpress function get_footer() is called here -->
<?php
get_footer();
?>