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
<?php include_once "topnav.php"; ?>

<body>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<body>


<div>
<center>
<h4>  Report </h4>
<br>
<form method="post" enctype="multipart/form-data">

		
	<h6>Select date</h6>
	<input class="form-control" id="date" name="date" autocomplete="off" placeholder="Click Here" type="text"/>
	
	<br>
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

<script>
    $(document).ready(function(){
      var date_input=$('input[name="date"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'mm-dd-yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
    })
</script>	
	<br>
		<button name="go" type="submit" class="btn btn-primary">Go</button>
</form>
</center>
</div>
				
<!-- Getting user specifics from DB -->
<?php
//Querry Operations

if(isset($_POST['go'])){
	$date = $_POST['date'];
	$color = $_POST['color'];
	
	
	if(empty($date)){
		echo '<script>alert("Empty Fields")</script>';
		exit();
	}
	
	$new_string = $color.'+'.$date;
	
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