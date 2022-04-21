<?php
/**
 * Template Name: Add New Seeds
 */

get_header(); 
global $wpdb
?>
<?php include_once "topnav.php"; ?>

<?php
if( current_user_can('administrator') ) {
	
	echo "<center>";
	echo '<h4>  Add New Seeds </h4>';
	echo '<br>' ;	
	echo '<form method="post" enctype="multipart/form-data">';
	
	echo '<h6>Choose Seed Type</h6>';			
	echo '<select name="seed_type" class="form-control" id="exampleFormControlSelect1">';
	  echo '<option value="classic">Classic</option>';
	  echo '<option value="sprout">Sprout</option>';
	echo '</select>';
	echo '<br>';
	
	echo '<h6>Enter Seed Name</h6>';			
	echo "<input type='text' autocomplete='off' name='seed_name' class='form-control'>";
	echo '<br>';
	
	echo '<h6>Expected Day of Harvest</h6>';			
	echo "<input type='text' autocomplete='off' name='expected_days' class='form-control'>";
	echo '<br>';

	echo '<button name="btnn" type="submit" class="btn btn-primary">Add New Seed</button>';
	echo '</form>';
	echo '</center>';

};
?>


<?php
if(isset($_POST['btnn'])){
	$seed_name = $_POST['seed_name'];
	$expected_days = $_POST['expected_days'];
	$seed_type = $_POST['seed_type'];
		
	$new_days = $expected_days.' days';
	
	if(empty($expected_days) OR empty($seed_name )){
		echo '<script>alert("Empty Fields")</script>';
		exit();
	}
	
	$wpdb->insert('seed_table', array(
	'seed_name' => $seed_name,
	'expected_time' => $new_days,
	'type' => $seed_type,
	));
	
	}
	?>
	
<style>
.form-control {width: 230px; text-align: center;}
.btn {width: 200px;}
</style>

<?php
get_footer();
?>
