<?php
/**
 * Template Name: Add New Units
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

<!-- To access this page, user needs to be an admin -->
<!-- 
To add restriction current_user_can() function from Wordpress, which checks if the user is an admin or not.
However, we could only use this function inside PHP which makes the next step really tricky. We cant just use HTML inside PHP, 
so to get over this issue we used PHP echo which is usually used for output of a form, we echoe'd the form itself.
 -->
<?php
if( current_user_can('administrator') ) {
	
	// Center the table
	echo "<center>";

	// Label
	echo '<h4>  Add New Units </h4>';
	echo '<br>' ;	
	
	// Multipart form
	echo '<form method="post" enctype="multipart/form-data">';

	// Enter a name for the unit, input type is plain text or integer.
	echo '<h6>Enter Unit Name</h6>';			
	echo "<input type='text' autocomplete='off' name='unit_name' class='form-control' placeholder='Enter an integer.'>";
	echo '<br>';
	
	// Select level count, 2 options "3" and "4", this will later be used in a for loop
	echo '<h6>Select Levels</h6>';				
	echo '<select name="levels" class="form-control" id="exampleFormControlSelect1">';
	  echo '<option value="4">4</option>';
	  echo '<option value="3">3</option>';
	echo '</select>';
	echo '<br>';
	
	// Button, when clicked it goes to SQL operations below.
	echo '<button name="btnn" type="submit" class="btn btn-primary">Add New Unit</button>';
	echo '</form>';
	echo '</center>';

};
?>

<!-- SQL operations, done in PHP -->
<?php
if(isset($_POST['btnn'])){
	
	// Data from the form is set to variables here.
	$unit_name = $_POST['unit_name'];
	$levels = $_POST['levels'];
	
	// Check for empty fields and stop if there is one.
	if(empty($unit_name)){
		echo '<script>alert("Empty Fields")</script>';
		exit();
	}
	
	// We should only be able to add unique units in here so this field needs to have a restriction
	// First select just_unitname, this field contains unique names of each unitlevel
	$sql = "SELECT just_unitname FROM `unitlevel_table` ";
	$result = $wpdb->get_results($sql, ARRAY_A) ;
	
	// Second, add this result into a for loop to check if there is a duplicate, depending on the result change $var
	for ( $i=0 ; $i < count($result); $i++){
		if ($result[$i]['just_unitname'] == $unit_name ){
			$var = 0;
			break;
		}
		else{
			$var = -1;
		}
	}
	
	// Third if our variable is -1, which means it is a unique unit, we add this unit.
	if ( $var == -1 ){
		
		// if selected level is 4, add 4 levels
		if ($levels == "4"){	
			for ($i = 1; $i<5 ; $i++){
				// String concatenation: unit, _level and 1/2/3/4 as "unitX_level1", "unitX_leve2" ...
				$new_name = 'unit'.$unit_name.'_level'.$i;
				
				// Insert the variables from the form
				$wpdb->insert('unitlevel_table', array(
				'unit_name' => $new_name,
				'unit_seed_id' => "empty",
				'stage' => "empty",
				'just_unitname'  => $unit_name,
				));
				
				// change variable back to data we got from the form 
				$new_name = $_POST['unit_name']; 
			}
		}
		
		// if selected level is 3, add 3 levels		
		else{
				for ($i = 1; $i < 4; $i++){
				// String concetanation: unit, _level and 1/2/3/4 as "unitX_level1", "unitX_leve2" ...
				$new_name = 'unit'.$unit_name.'_level'.$i;
				
				// Insert the variables from the form
				$wpdb->insert('unitlevel_table', array(
				'unit_name' => $new_name,
				'unit_seed_id' => "empty",
				'stage' => "empty",
				'just_unitname'  => $unit_name,
				));
				
				// change variable back to data we got from the form 
				$new_name = $_POST['unit_name'];
			}
		}
	}
	
	// Empty else loop, didn't worked without it
	else{
	}	
}
?>

<!-- CSS Styling --> 
<style>
.form-control {width: 220px; text-align: center;}
.btn {width: 200px;}
</style>

<!-- Wordpress function get_footer() is called here -->	
<?php
get_footer();
?>