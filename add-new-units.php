<?php
/**
 * Template Name: Add New Units
 */

get_header(); 
global $wpdb
?>
<?php include_once "topnav.php"; ?>

<?php
if( current_user_can('administrator') ) {

	echo "<center>";
	echo '<form method="post" enctype="multipart/form-data">';
	echo '<h4>  Add New Units </h4>';
	echo '<br>' ;	

	echo '<h6>Enter Unit Name</h6>';			
	echo "<input type='text' autocomplete='off' name='unit_name' class='form-control' placeholder='Enter an integer.'>";
	echo '<br>';
	
	echo '<h6>Select Levels</h6>';				
	echo '<select name="levels" class="form-control" id="exampleFormControlSelect1">';
	  echo '<option value="4">4</option>';
	  echo '<option value="3">3</option>';
	echo '</select>';
	echo '<br>';

	echo '<button name="btnn" type="submit" class="btn btn-primary">Add New Unit</button>';
	echo '</form>';
	echo '</center>';

};
?>



<?php
if(isset($_POST['btnn'])){
	$unit_name = $_POST['unit_name'];
	$levels = $_POST['levels'];
	
	$sql = "SELECT just_unitname FROM `unitlevel_table` ";
	$result = $wpdb->get_results($sql, ARRAY_A) ;

	if(empty($unit_name)){
		echo '<script>alert("Empty Fields")</script>';
		exit();
	}
    
	for ( $i=0 ; $i < count($result); $i++){
		if ($result[$i]['just_unitname'] == $unit_name ){
			$var = 0;
		}
		else{
			$var = -1;
		}
	}
	

	if ( $var == -1 ){
		if ($levels == "4"){	
			for ($i = 1; $i<5 ; $i++){
				$new_name = 'unit'.$unit_name.'_level'.$i;
						
				$wpdb->insert('unitlevel_table', array(
				'unit_name' => $new_name,
				'unit_seed_id' => "empty",
				'stage' => "empty",
				'just_unitname'  => $unit_name,
				));
						
				$new_name = $_POST['unit_name']; 
			}


		}		
		else{
				for ($i = 1; $i < 4; $i++){
				$new_name = 'unit'.$unit_name.'_level'.$i;
					
				$wpdb->insert('unitlevel_table', array(
				'unit_name' => $new_name,
				'unit_seed_id' => "empty",
				'stage' => "empty",
				'just_unitname'  => $unit_name,
				));
				
				$unit_name = $_POST['unit_name'];
			}
		}
	}
	else{

	}
	
	
}
	?>

<style>
.form-control {width: 220px; text-align: center;}
.btn {width: 200px;}
</style>

<?php
get_footer();
?>