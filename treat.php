<?php
/**
 * Template Name: Treat
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

<!-- Center everything -->
<center>

<!-- Label -->
<h4>  Treat </h4>
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
	<!--  Only units shown are either Plug/Pot stage or sprouts -->
	<select name="unitlevel_name" class="form-control" id="exampleFormControlSelect1">	
	<?php
	$sql = "SELECT * FROM `unitlevel_table` WHERE stage='Plug' OR stage='Pot' OR stage='sproutstage'";
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

	<!-- Add clickable checkboxes with same id -->
	<center>
	<div class="checkboxes">
		<label><input class="form-check-input" type="checkbox" id="checkboxes" name="check_list[]" value="Water">
		Water</label>

		<label><input class="form-check-input" type="checkbox" id="checkboxes" name="check_list[]" value="Feed">
		Feed</label>

		<label><input class="form-check-input" type="checkbox" name="check_list[]" value="Neem">
		<span>Neem</span></label>
	
		
		<label><input class="form-check-input" type="checkbox" name="check_list[]" value="Organocide">			
		Organocide</label>
	<br>
	</div>	
	</center>	
	
	<!-- Enter humidity, input type is plain text or integer. -->
	<label>Humidity</label>
	<input type='text' autocomplete="off" name='humidity' class='form-control' placeholder='Enter humidity'>
	<br>
	
	<!-- Enter temperature, input type is plain text or integer. -->
	<label>Temperature</label>
	<input type='text' autocomplete="off" name='temperature' class='form-control' placeholder='Enter temperature'>
	<br>
	
	<button name="treat" type="submit" class="btn btn-primary">Treat</button>

<!-- CSS Styling -->
<style>
.btn {width: 150px;}
.form-control {width: 195px; text-align: center;}
.form-check-input {width: 195px; text-align: center;}
input[type=checkbox] {
  vertical-align: middle;
  float: left;
}
label {
  display: block;
  width: 150px;
}
</style>	
	
<!-- Close form -->
</form>
</center>

<!-- SQL operations, done in PHP -->
<?php
if(isset($_POST['treat'])){ 	
	
	//set variables from the form
	$unitlevel_name = $_POST['unitlevel_name'];
	$deneme='';
	
	// add date
	date_default_timezone_set('America/New_York');
	$t=time();
	$post_date = date("m-d-Y h:i A",$t);
	
	// string concatenation for humidity and temperature
	$humidity = $_POST['humidity'];
	$humidity_new= $humidity.'%';
	$temperature=$_POST['temperature'];
	$temperature= $temperature.'&deg'.'F';

	// using unitlevel_name to access unitlevel_table
	$sql = "SELECT * FROM `unitlevel_table` WHERE unitlevel_id = $unitlevel_name";
	if($result = $wpdb->get_results($sql, ARRAY_A)){
		foreach($result as $row){
			$seed_id = $row['unit_seed_id'];
		}
	}
	else{
		$seed_id='error';
		}
	
	// check for empty checkboxes
	if(!empty($_POST['check_list'])) {
		foreach($_POST['check_list'] as $check) {
			$deneme=$deneme.$check.' ';			
		}
	}
	
	// check for empty fields
	if(empty($unitlevel_name) OR empty($humidity) OR empty($temperature)){
		echo '<script>alert("Empty Fields")</script>';
		exit();
	}
	
	
	// insert variables into actions_table
	$wpdb->insert('actions_table', array(
    'employee_name' => $current_user,
	'unitlevel_name' => $unitlevel_name,
	'treat' => $deneme,
	'humidity' => $humidity_new,
	'temperature' => $temperature,
	'seed_id' => $seed_id,
	'action_date' => $post_date
	));
	
	//refresh page, used for refreshing form data
	echo "<meta http-equiv='refresh' content='0'>";
}
?>

<!-- Wordpress function get_footer() is called here -->
<?php

get_footer();
?>