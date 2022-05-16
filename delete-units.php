<?php
/**
 * Template Name: Delete Units
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

<!-- Center the table -->
<center>

<!-- Label -->
<h4>  Delete Unit </h4>
<br>

<!--  Multipart form -->
<form method="post" enctype="multipart/form-data">
	<h6>Available Units and Levels</h6>
	<!--  Select units to delete, we need to get units from our database -->
	<select name="just_unitname" class="form-control" id="exampleFormControlSelect1">

	<!-- To get data we used PHP before closing the select HTML tags -->	
	<?php
	$sql = "SELECT DISTINCT just_unitname FROM `unitlevel_table` ";
	$result = $wpdb->get_results($sql, ARRAY_A) ;
	foreach($result as $row){
		$just_unitname  = $row['just_unitname'];
	?>
	<option value="<?php echo $just_unitname; ?>"><?php echo 'Unit '.$just_unitname; ?></option>
	<?php
	}
	?>
	</select>
	<br>				

<!-- To access this button, user needs to be an admin
Didn't have enough time to make everything restricted.
 -->
<?php
if( current_user_can('administrator') ) {
	echo '<button name="btnn" type="submit" class="btn btn-primary">Delete Unit</button>';
};
?>
</form>
</center>

<!-- If button is clicked delete the selected unit -->
<?php
if(isset($_POST['btnn'])){
	$just_unitname = $_POST['just_unitname'];
	
	// SQL Operation
	$wpdb->delete('unitlevel_table', array(
	'just_unitname' => $just_unitname,
	));
	
	//refresh page, used for refreshing form data
	echo "<meta http-equiv='refresh' content='0'>";
	
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
