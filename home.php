<?php
/**
 * Template Name: home1
 */

get_header(); 
global $wpdb
?>
<?php
include_once "add/func.php";
include_once "add/conn.php";
?>
<style><?php include 'plant_style.css'; ?></style>


<!DOCTYPE html>
<html>
<body>
<div>

<center>
<img src="<?php echo get_template_directory_uri(); ?>/BYG.jpg/>
<nav >
<a href="all-seeds/" id="seeds">All Seeds</a> |
<a href="search-seed-by-id/" id="search">Search Seeds</a> |
<a href="action-history/" id="action">Action History</a> |
<a href="report-v1/" id="reportv1">Report v1</a>
 
</nav>
</center>
<br>

<div>

<center>

	<button name="plant" type="submit" onclick="window.location.href='plant'" class="btn btn-primary btn-lg " id="plant">Plant</button>
	<br>
	<br>	
	<button name="treat" type="submit" onclick="window.location.href='treat'" class="btn btn-primary btn-lg " id="treat">Treat</button>
	<br>
	<br>
	<button  name="transplant" type="submit" onclick="window.location.href='transplant'"  class="btn btn-primary btn-lg" id="transplant">Transplant</button>
	<br>
	<br>
	<button name="harvest" type="submit" onclick="window.location.href='harvest'"  class="btn btn-success btn-lg" id="harvest">Harvest</button>
</center>	
	
<style>
.btn {width: 150px;}
</style>

	

</body>
</html>





<?php
get_footer();
?>


