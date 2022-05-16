<?php
/**
 * Template Name: Search Seed by ID
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
<h4>  Search Seed </h4>
<br>

<!-- Multipart form -->
<form method="post" enctype="multipart/form-data">

	<!-- Input place to enter seed id -->
	<h6>Enter a Seed ID to Inspect</h6>
	<input type='text' name='seed_id' autocomplete="off" class='form-control' placeholder='ex: 84'>
	<br>
	
	<button name="go" type="submit" class="btn btn-primary">Go</button>
	
</form>
</center>
</div>

<!-- Getting user specifics from DB -->
<?php
//Querry Operations

if(isset($_POST['go'])){
	
	// set variable
	$seed_id = $_POST['seed_id'];
	
	// check for empty field
	if(empty($seed_id)){
		echo '<script>alert("Enter Seed ID")</script>';
		exit();
	}	
	
	// use foreign key seed_id to get seed_type from seed_id_table
	$sql = "SELECT * FROM `seed_id_table` WHERE seed_id=$seed_id ";
	if($result = $wpdb->get_results($sql, ARRAY_A)){
		foreach($result as $row){
			$seed_type=$row['seed_type'];
		}
	}
	
	// use foreign key seed_type to get type from seed_table
	$sql = "SELECT * FROM `seed_table` WHERE seed_id=$seed_type ";
	if($result = $wpdb->get_results($sql, ARRAY_A)){
		foreach($result as $row){
			$type=$row['type'];
		}
	}
	
	// if seed type is classic go to seeds/..
	if( $type == "classic"){
		echo "<script>
	window.location = 'http://localhost/wordpress_byg/seeds/?id=$seed_id'
	</script>";
	}
	
	// if seed type is sprout go to sprouts/..
	else if( $type == "sprout"){
		echo "<script>
	window.location = 'http://localhost/wordpress_byg/sprouts/?id=$seed_id'
	</script>";
	}
	
}

?>
	
<!-- CSS Styling -->
<style>
.btn {width: 200px;}
.form-control {width: 200px;}
</style>

<!-- Wordpress function get_footer() is called here -->	
<?php
get_footer();
?>