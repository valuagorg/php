<?php
/**
 * Template Name: Add New Seeds
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
	echo '<h4>  Add New Seeds </h4>';
	echo '<br>' ;	
	
	// Multipart form
	echo '<form method="post" enctype="multipart/form-data">';
	
	// Select seed type, 2 options Classic and Sprout
	echo '<h6>Choose Seed Type</h6>';	
	echo '<select name="seed_type" class="form-control" id="exampleFormControlSelect1">';
	  echo '<option value="classic">Classic</option>';
	  echo '<option value="sprout">Sprout</option>';
	echo '</select>';
	echo '<br>';
	
	// Input part for admin to enter name of the new seed in plain text.
	echo '<h6>Enter Seed Name</h6>';			
	echo "<input type='text' autocomplete='off' name='seed_name' class='form-control'>";
	echo '<br>';
	
	// Input part for admin to enter expected days of Harvest
	echo '<h6>Expected Days of Harvest</h6>';			
	echo "<input type='text' autocomplete='off' name='expected_days' class='form-control'>";
	echo '<br>';

	// Button, when clicked it goes to SQL operations below.
	echo '<button name="btnn" type="submit" class="btn btn-primary">Add New Seed</button>';
	echo '</form>';
	echo '</center>';

};
?>

<!-- SQL operations, done in PHP -->
<?php
if(isset($_POST['btnn'])){
	
	// Data from the form is set to variables here.
	$seed_name = $_POST['seed_name'];
	$expected_days = $_POST['expected_days'];
	$seed_type = $_POST['seed_type'];
	
    // Changing the string to show " days" next to it. (28 days) 	
	$new_days = $expected_days.' days';
	
	// Check for empty fields and stop if there is one.
	if(empty($expected_days) OR empty($seed_name )){
		echo '<script>alert("Empty Fields")</script>';
		exit();
	}
	
	// Connect to wpdb, then insert variables to seed_table
	$wpdb->insert('seed_table', array(
	'seed_name' => $seed_name,
	'expected_time' => $new_days,
	'type' => $seed_type,
	));
	
	}
	?>

<!-- CSS Styling -->	
<style>
.form-control {width: 230px; text-align: center;}
.btn {width: 200px;}
</style>

<!-- Wordpress function get_footer() is called here -->	
<?php
get_footer();
?>
