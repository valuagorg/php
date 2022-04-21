<?php
/**
 * Template Name: Delete Units
 */

get_header(); 
global $wpdb
?>


<?php include_once "topnav.php"; ?>

<center>
<h4>  Delete Unit </h4>
<br>
<form method="post" enctype="multipart/form-data">
	<h6>Available Units and Levels</h6>
	<select name="just_unitname" class="form-control" id="exampleFormControlSelect1">	
	<?php
	//Query Operations
	
	$sql = "SELECT DISTINCT just_unitname FROM `unitlevel_table` ";
	$result = $wpdb->get_results($sql, ARRAY_A) ;
	foreach($result as $row){
		$just_unitname  = $row['just_unitname'];
	?>
	<option value="<?php echo $just_unitname; ?>"><?php echo 'Unit '.$just_unitname; ?></option>
	<?php
	}
	//Query Operations
	?>
	</select>
	<br>				




<?php
if( current_user_can('administrator') ) {
	
	echo '<button name="btnn" type="submit" class="btn btn-primary">Delete Unit</button>';

};
?>
</form>
</center>

<?php
if(isset($_POST['btnn'])){
	$just_unitname = $_POST['just_unitname'];
		
	
	$wpdb->delete('unitlevel_table', array(
	'just_unitname' => $just_unitname,
	));
	echo "<meta http-equiv='refresh' content='0'>";
	}
	
	?>
	
<style>
.form-control {width: 230px; text-align: center;}
.btn {width: 200px;}
</style>

<?php
get_footer();
?>
