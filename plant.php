<?php
/**
 * Template Name: Plant
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
	$sql = "SELECT * FROM `seed_table`";
	$result = $wpdb->get_results($sql, ARRAY_A) ;
	foreach($result as $row){
		$seed_id = $row['seed_id'];
		$seed_name = $row['seed_name'];
		$seed_expected_date= $row['expected_time'];
		$type=$row['type'];
	?>

	<option value="<?php echo $seed_id; ?>"><?php 
	if ($seed_id != 26 AND $seed_id!=27 AND $seed_id!=28){
		echo "H-".$seed_name;
	}
	else{
		echo "S-".$seed_name;
	}
	?></option>
	
	<?php
	}
	//Query Operations					
	?>
	</select>								
	<br>	
	
	<h6>Choose Color</h6>					
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



<h6>Planted Plugs / Weight</h6>
<input type='text' autocomplete="off" name='planted_plugs' class='form-control' placeholder='Enter planted plugs.'>
	<br>
	
	
	
	<br>
	<button name="plant" type="submit" class="btn btn-primary">Plant</button>
	<br>

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

	$unitlevel_name = $_POST['unitlevel_name'];
	$seed_name = $_POST['seed_name'];
	$color = $_POST['color'];
	$planted_plugs = $_POST['planted_plugs'];
	
	$planted_weight = $planted_plugs.' oz';
	
	date_default_timezone_set('America/New_York');
	$t=time();
	$post_date = date("m-d-Y h:i A",$t);
	
	$sql = "SELECT * FROM `seed_table` WHERE seed_id=$seed_name ";
	if($result = $wpdb->get_results($sql, ARRAY_A)){
		foreach($result as $row){
			$seed_expected_date = $row['expected_time'];
			$type = $row['type'];
		}
	}
	
	//bugged
	else{
		$seed_expected_date='error';
	}
	
	$x='+'.$seed_expected_date;
	$expected_date = date("m/d/y", strtotime($x));
	
	
	$sql = "SELECT * FROM `seed_id_table`";
	if($result = $wpdb->get_results($sql, ARRAY_A)){
		foreach($result as $row){
			$seed_id = $row['seed_id'];
			$seed_id += 1;
			
		} 
	}
	
	
	
	//bugged
	else{
		$seed_id='error';
	}
	// tum seed_id_table'daki seedleri silince yarra yiyor aratma kismi else'e
	// gelince 1e ayarliyor, halbuki id farkli bi sayi
	// anlik cozum, oyle bisi olursa elle duzeltmen lazim phpmyadminden, yani databaseden. 


	if(empty($unitlevel_name) OR empty($planted_plugs)){
		echo '<script>alert("Enter number of plugs planted")</script>';
		exit();
	}
	
	if( $type == "sprout"){
		$wpdb->insert('actions_table', array(
		'employee_name' => $current_user,
		'unitlevel_name' => $unitlevel_name,
		'plant' => 'Planted',
		'planted_weight' => $planted_weight,
		'seed_id' => $seed_id,
		'action_date' => $post_date
		));
		
		$wpdb->insert('seed_id_table', array(
		'seed_type' => $seed_name,
		'seed_stage' => 'sproutstage',
		'seed_location' => $unitlevel_name,
		'seed_color' => $color,
		'seed_expected_date' => $expected_date
		));
		
		$wpdb->update('unitlevel_table', array(
		'stage'=>'sproutstage', 
		'unit_seed_id'=>$seed_id), 
		array('unitlevel_id'=>$unitlevel_name));
	}
	
	else if ( $type == "classic"){
		$wpdb->insert('actions_table', array(
		'employee_name' => $current_user,
		'unitlevel_name' => $unitlevel_name,
		'plant' => 'Planted',
		'planted_plugs' => $planted_plugs,
		'seed_id' => $seed_id,
		'action_date' => $post_date
		));
		
		$wpdb->insert('seed_id_table', array(
		'seed_type' => $seed_name,
		'seed_stage' => 'Plug',
		'seed_location' => $unitlevel_name,
		'seed_color' => $color,
		'seed_expected_date' => $expected_date
		));
		
		$wpdb->update('unitlevel_table', array(
		'stage'=>'Plug', 
		'unit_seed_id'=>$seed_id), 
		array('unitlevel_id'=>$unitlevel_name));
	}
	

	
	echo "<meta http-equiv='refresh' content='0'>";
}
//Querry Operations		


//onemli kod navigation icin
//echo "<script>window.location = 'http://localhost/wordpress_byg/deneme/?id=unit20_level4'</script>";
	
?>


<?php

get_footer();
?>