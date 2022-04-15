<?php
/**
 * Template Name: Search Seed by ID
 */

get_header(); 
global $wpdb
?>
<?php
include_once "add/func.php";
include_once "add/conn.php";
?>
<div>
<center>
<form method="post" enctype="multipart/form-data">
					
	<h6>Enter a Seed ID to Inspect</h6>
	<input type='text' name='seed_id' class='form-control' placeholder='ex: 84'>
	<br>
		<button name="go" type="submit" class="btn btn-primary">Go</button>
</form>
</center>
</div>
				
<!-- Getting user specifics from DB -->
<?php
//Querry Operations

if(isset($_POST['go'])){
	$seed_id = $_POST['seed_id'];
	
	$sql = "SELECT * FROM `seed_id_table` WHERE seed_id=$seed_id ";
	if($result = $wpdb->get_results($sql, ARRAY_A)){
		foreach($result as $row){
			$seed_type=$row['seed_type'];
		}
	}
	$sql = "SELECT * FROM `seed_table` WHERE seed_id=$seed_type ";
	if($result = $wpdb->get_results($sql, ARRAY_A)){
		foreach($result as $row){
			$type=$row['type'];
		}
	}
	
	if( $type == "classic"){
		echo "<script>
	window.location = 'http://localhost/wordpress_byg/seeds/?id=$seed_id'
	</script>";
	}
	else if( $type == "sprout"){
		echo "<script>
	window.location = 'http://localhost/wordpress_byg/sprouts/?id=$seed_id'
	</script>";
	}
	
}
//Querry Operations		
//?id=unit4_level1

//onemli kod navigation icin


?>
	
<style>
.btn {width: 200px;}
.form-control {width: 200px;}
</style>


<?php

get_footer();
?>