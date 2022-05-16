<?php
/**
 * Template Name: home1
 */

//Wordpress function get_header() for styling and Wordpress Database are called here
get_header(); 
global $wpdb
?>

<!-- Including functions, database connections and header of our site included here -->
<?php
include_once "add/func.php";
include_once "add/conn.php";

?>

<!-- CSS Styling included -->
<style><?php include 'plant_style.css'; ?></style>

<!DOCTYPE html>
<html>
<body>
<div>

<!-- Center and add BYG logo -->
<center>
<img width='250px' height='250px' src="<?php echo get_template_directory_uri(); ?>/BYG LOGO_HIGHRES.png"/>
</center>
<br>

<!-- Center and add Navigation Bar -->
<center>
<nav id='nav' >
<a href="all-seeds/" id="optnav">All Seeds</a>
<a href="search-seed-by-id/" id="optnav">Search Seeds</a>
<a href="action-history/" id="optnav">Action History</a>
<a href="report/" id="optnav">Report</a>
<!-- Only admins can see this option in the navbar -->
<?php
if( current_user_can('administrator') ) {
	echo '<a href="admin-panel/" id="optnav">Admin Panel</a>';
};
?>
 
</nav>
</center>
<br>
<div>
<!-- Add different buttons to navigate -->
<center>
	<button name="plant" type="submit" onclick="window.location.href='plant'" class="btn btn-primary btn-lg " id="optbtn">Plant</button>
	<br>
	<br>	
	<button name="treat" type="submit" onclick="window.location.href='treat'" class="btn btn-primary btn-lg " id="optbtn">Treat</button>
	<br>
	<br>
	<button  name="transplant" type="submit" onclick="window.location.href='transplant'"  class="btn btn-primary btn-lg" id="optbtn">Transplant</button>
	<br>
	<br>
	<button name="harvest" type="submit" onclick="window.location.href='harvest'"  class="btn btn-success btn-lg" id="optbtn">Harvest</button>
</center>	

<!-- CSS Styling for button -->	
<style>
.btn {width: 150px;}
</style>

</body>
</html>

<!-- Wordpress function get_footer() is called here -->	
<?php
get_footer();
?>


