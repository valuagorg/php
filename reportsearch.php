<?php
/**
 * Template Name: Report Search v1
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

<h5>Report v1</h5>
<br>
					
	<h6>Enter date</h6>
	<input type='text' name='input_date' class='form-control' placeholder='ex: 04-01-2022'>
	
	<h6>Choose Color</h6>					
	<select name="color" class="form-control" id="exampleFormControlSelect1">
	  <option value="Red">Red 🔴</option>
	  <option value="Blue">Blue 🔵</option>
	  <option value="Yellow">Yellow 🟡</option>
	  <option value="Green">Green 🟢</option>
	  <option value="Orange">Orange 🟠</option>
	  <option value="Brown">Brown 🟤</option>
	<option value="Black">Black ⚫</option>
	</select>
	
	<br>
		<button name="go" type="submit" class="btn btn-primary">Go</button>
</form>
</center>
</div>
				
<!-- Getting user specifics from DB -->
<?php
//Querry Operations

if(isset($_POST['go'])){
	$input_date = $_POST['input_date'];
	$color = $_POST['color'];
	
	$new_string = $color.'+'.$input_date;
	
	echo "<script>
	window.location = 'http://localhost/wordpress_byg/report-v-1/?id=$new_string'
	</script>";
	
	
}
//Querry Operations		
//?id=unit4_level1

//onemli kod navigation icin


?>
	
<style>
.btn {width: 200px;}
.form-control {width: 200px; text-align: center;}
</style>


<?php

get_footer();
?>