<?php
/**
 * Template Name: Delete Seeds
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

<!-- Center -->
<center>

<!-- Label -->
<h4>  Delete Seed </h4>
<br>

<!--  Multipart form -->
<form method="post" enctype="multipart/form-data">
	<h6>Seed Type</h6>
	<!--  Select seed type to delete, we need to get seeds from our database -->
	<select name="seed_name" class="form-control" id="exampleFormControlSelect1" >
	
	<!-- To get data we used PHP before closing the select and 2 option HTML tags -->
	<?php
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

<!-- To access this button, user needs to be an admin
Didn't have enough time to make everything restricted.
 -->
<?php
if( current_user_can('administrator') ) {
	echo '<button name="btnn" type="submit" class="btn btn-primary">Delete Seed</button>';

};
?>
</form>
</center>

<!-- If button is clicked delete the selected seed -->
<?php
if(isset($_POST['btnn'])){
	$seed_name = $_POST['seed_name'];	
	
	// SQL Operation
	$wpdb->delete('seed_table', array(
	'seed_id' => $seed_name,
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
