<?php
/**
 * Template Name: Treat
 */

get_header(); 
global $wpdb
?>
<?php include_once "topnav.php"; ?>
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
	//Query Operations
	?>
	</select>
	<br>
</select>
		

		<input class="form-check-input" type="checkbox" name="check_list[]" value="Water">
		<label>Water</label>
		<br>
		
		<input class="form-check-input" type="checkbox" id="checkbox1" name="check_list[]" value="Feed">
		<label>Feed</label>
		<br>
		
		<input class="form-check-input" type="checkbox" name="check_list[]" value="Neem">
		<label>Neem</label>
		<br>
		
		<input class="form-check-input" type="checkbox" name="check_list[]" value="Organocide">			
		<label>Organocide</label>
		<br>
		
		
	<label>Humidity</label>
	<br>
	<input type='text' name='humidity' class='form-control' placeholder='Enter humidity'>
	<br>
	<label>Temperature</label>
	<br>
	<input type='text' name='temperature' class='form-control' placeholder='Enter temperature'>
	<br>
	<br>
	<button name="treat" type="submit" class="btn btn-primary">Treat</button>
	
<style>
.btn {width: 150px;}
.form-control {width: 195px; text-align: center;}
.form-check-input {width: 195px; text-align: center;}
</style>	
	
	
</form>
</center>

<?php
if(isset($_POST['treat'])){ 	
	
	$unitlevel_name = $_POST['unitlevel_name'];
	$deneme='';
	date_default_timezone_set('America/New_York');
	$t=time();
	$post_date = date("m-d-Y h:i A",$t);
	
	$humidity = $_POST['humidity'];
	$humidity_new= $humidity.'%';
	
	$temperature=$_POST['temperature'];
	
	$temperature= $temperature.'&deg'.'F';

			
	$sql = "SELECT * FROM `unitlevel_table` WHERE unitlevel_id = $unitlevel_name";
	if($result = $wpdb->get_results($sql, ARRAY_A)){
		foreach($result as $row){
			$seed_id = $row['unit_seed_id'];
		}
	}
	else{
		$seed_id='error';
		}
	
	if(!empty($_POST['check_list'])) {
		foreach($_POST['check_list'] as $check) {
			$deneme=$deneme.$check.' ';			
		}
	}
	if(empty($unitlevel_name) OR empty($humidity) OR empty($temperature)){
		echo '<script>alert("Empty Fields")</script>';
		exit();
	}
	
	$wpdb->insert('actions_table', array(
    'employee_name' => $current_user,
	'unitlevel_name' => $unitlevel_name,
	'treat' => $deneme,
	'humidity' => $humidity_new,
	'temperature' => $temperature,
	'seed_id' => $seed_id,
	'action_date' => $post_date
	));
	
	echo "<meta http-equiv='refresh' content='0'>";
}
//Querry Operations		


//onemli kod navigation icin
//echo "<script>window.location = 'http://localhost/wordpress_byg/deneme/?id=unit20_level4'</script>";

?>

<?php

get_footer();
?>