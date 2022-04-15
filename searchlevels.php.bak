<?php
/**
 * Template Name: Search Level
 */
get_header(); 
global $wpdb
?>

<div>
<center>
<form method="post" enctype="multipart/form-data">
					
	<h6>Select a Unit to Inspect</h6>
	<select name="unitlevel_name" class="form-control" id="exampleFormControlSelect1">	
	<?php
	//Query Operations
	
	$sql = "SELECT * FROM `unitlevel_table`";
	$result = $wpdb->get_results($sql, ARRAY_A) or die(mysql_error());
	
	foreach($result as $row){
		$unitlevel_id = $row['unitlevel_id'] ;
		$unit_name = $row['unit_name'];
		$unit_color = $row['unit_color'];
		$unit_seed = $row['unit_seed'];
	?>
	<option value="<?php echo $unit_name; ?>"><?php echo $unit_name; ?></option>
	<?php
	}
	//Query Operations
	?>
	</select>
	
		<button name="go" type="submit" class="btn btn-primary">Go</button>

</form>
</center>
</div>

			
<!-- Getting user specifics from DB -->
<?php
//Querry Operations

if(isset($_POST['go'])){
	$unitlevel_name = $_POST['unitlevel_name'];
	echo "<script>
	window.location = 'http://localhost/wordpress_byg/units/?id=$unitlevel_name'
	</script>";
}
//Querry Operations		
//?id=unit4_level1

//onemli kod navigation icin
?>


<?php
get_footer();
?>