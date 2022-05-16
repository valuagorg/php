<?php
/**
 * Template Name: Plant
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
<!-- Center -->
<center>

<!-- Label -->
<h4>  Plant </h4>
<br>

<!--  Multipart form -->
<form method="post" enctype="multipart/form-data">

	<!--  Get user's name from get_currenuserinfo(), a Wordpres function, then set it to a variable -->
	<?php 
		global $current_user; get_currentuserinfo();
		$current_user=$current_user->display_name
	?>
	
	<!--  Select a unit to plant, we need to get units from our database -->
	<h6>Available Units and Levels</h6>
	<select name="unitlevel_name" class="form-control" id="exampleFormControlSelect1">	
	<!--  Only units shown are the empty ones -->
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
	
	<!--  Select seed type to plant, we need to get seeds from our database -->
	<!--  Also we added Javascript code in onchange, it changes input text's placeholder -->
	<h6>Seed Type</h6>
	<select name="seed_name" class="form-control" id="exampleFormControlSelect1" 
	onchange='
	let plantId = getElementsByName("seed_name")[0].value ;
	if(plantId == 26 || plantId ==27 || plantId == 28)
		getElementsByName("planted_plugs")[0].placeholder = "Enter weight in ounces."
	else
		getElementsByName("planted_plugs")[0].placeholder = "Enter planted plugs."
	'>
	
	<!-- To get data we used PHP before closing the select and 2 option HTML tags -->
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

	<option value="<?php echo $seed_id; ?>" 	
	<?php 
	// Make the line option unclickable
	if ($type=="ds"){
		echo " disabled";
	}
	?>
	>
	
	<!-- Add labels front of according to seed's type, variables we got earlier -->
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
	?>
	</select>								
	<br>	
	
	<!--  Select color -->
	<h6>Choose Harvesting Color</h6>					
	<select name="color" class="form-control" id="exampleFormControlSelect1">
	  <option value="Red">Red 🔴</option>
	  <option value="Blue">Blue 🔵</option>
	  <option value="Yellow">Yellow 🟡</option>
	  <option value="Green">Green 🟢</option>
	  <option value="Orange">Orange 🟠</option>
	  <option value="Brown">Brown 🟤</option>
	<option value="Black">Black ⚫</option>
	</select>
	<br>	

	<!-- Enter amount planted, input type is plain text or integer. -->
	<h6>Planted Plugs / Weight</h6>
	<input type='text' autocomplete="off" name='planted_plugs' class='form-control' placeholder='Enter planted plugs.'>
	<br>
	<br>
	
	<button name="plant" type="submit" class="btn btn-primary">Plant</button>
	<br>

<!-- CSS Styling -->
<style>
.btn {width: 150px;}
.form-control {width: 230px; text-align: center;}
</style>

</form>
</center>
</div>
	
<!-- Getting user specifics from DB -->
<?php
//Querry Operations
if(isset($_POST['plant'])){ 	

	//set variables from the form
	$unitlevel_name = $_POST['unitlevel_name'];
	$seed_name = $_POST['seed_name'];
	$color = $_POST['color'];
	$planted_plugs = $_POST['planted_plugs'];
	$planted_weight = $planted_plugs.' oz';
	
	// add date
	date_default_timezone_set('America/New_York');
	$t=time();
	$post_date = date("m-d-Y h:i A",$t);
	
	// use seed_name to acces type from seed_table
	$sql = "SELECT * FROM `seed_table` WHERE seed_id=$seed_name ";
	if($result = $wpdb->get_results($sql, ARRAY_A)){
		foreach($result as $row){
			$seed_expected_date = $row['expected_time'];
			$type = $row['type'];
		}
	}
	
	//fix might be needed later on, error is caused when there is 0 seeds in the seed_table 
	else{
		$seed_expected_date='error';
	}
	
	// string concatenation to show better date
	$x='+'.$seed_expected_date;
	$expected_date = date("m/d/y", strtotime($x));
	
	// increment seed id by +1 for the next seed
	$sql = "SELECT * FROM `seed_id_table`";
	if($result = $wpdb->get_results($sql, ARRAY_A)){
		foreach($result as $row){
			$seed_id = $row['seed_id'];
			$seed_id += 1;
			
		} 
	}
	
	//fix might be needed later on, error is caused when there is 0 seeds in the seed_table 
	else{
		$seed_id='error';
	}

	// check for empty fields
	if(empty($unitlevel_name) OR empty($planted_plugs)){
		echo '<script>alert("Empty Fields")</script>';
		exit();
	}
	
	// if seed type is sprout
	if( $type == "sprout"){
		// insert data into acctions_table
		$wpdb->insert('actions_table', array(
		'employee_name' => $current_user,
		'unitlevel_name' => $unitlevel_name,
		'plant' => 'Planted',
		'planted_weight' => $planted_weight,
		'seed_id' => $seed_id,
		'action_date' => $post_date
		));
		
		// insert data in the seed_id_table, to track unique ids
		$wpdb->insert('seed_id_table', array(
		'seed_type' => $seed_name,
		'seed_stage' => 'sproutstage',
		'seed_location' => $unitlevel_name,
		'seed_color' => $color,
		'seed_expected_date' => $expected_date
		));
		
		// update data in the unitlevel_table, so we don't need to add different units each time
		$wpdb->update('unitlevel_table', array(
		'stage'=>'sproutstage', 
		'unit_seed_id'=>$seed_id), 
		array('unitlevel_id'=>$unitlevel_name));
	}
	
	// if seed type is classic
	else if ( $type == "classic"){
		// insert data into acctions_table
		$wpdb->insert('actions_table', array(
		'employee_name' => $current_user,
		'unitlevel_name' => $unitlevel_name,
		'plant' => 'Planted',
		'planted_plugs' => $planted_plugs,
		'seed_id' => $seed_id,
		'action_date' => $post_date
		));
		
		// insert data in the seed_id_table, to track unique ids
		$wpdb->insert('seed_id_table', array(
		'seed_type' => $seed_name,
		'seed_stage' => 'Plug',
		'seed_location' => $unitlevel_name,
		'seed_color' => $color,
		'seed_expected_date' => $expected_date
		));
		
		// update data in the unitlevel_table, so we don't need to add different units each time
		$wpdb->update('unitlevel_table', array(
		'stage'=>'Plug', 
		'unit_seed_id'=>$seed_id), 
		array('unitlevel_id'=>$unitlevel_name));
	}
	
	//refresh page, used for refreshing form data
	echo "<meta http-equiv='refresh' content='0'>";
}	
?>

<!-- Wordpress function get_footer() is called here -->	
<?php
get_footer();
?>