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
<!DOCTYPE html>
<html>
<body>
<div>

<center>
<nav >
<a href="all-seeds/">All Seeds</a> |
<a href="search-seed-by-id/">Search Seeds</a> |
<a href="action-history/">Action History</a> |
<a href="report-v1/">Report v1</a>
 
</nav>
</center>
<br>

<div>

<center>

	<button name="plant" type="submit" onclick="window.location.href='plant'" class="btn btn-primary btn-lg ">Plant</button>
	<br>
	<br>	
	<button name="treat" type="submit" onclick="window.location.href='treat'" class="btn btn-primary btn-lg ">Treat</button>
	<br>
	<br>
	<button  name="transplant" type="submit" onclick="window.location.href='transplant'"  class="btn btn-primary btn-lg">Transplant</button>
	<br>
	<br>
	<button name="harvest" type="submit" onclick="window.location.href='harvest'"  class="btn btn-success btn-lg">Harvest</button>
</center>	
	
<style>
.btn {width: 150px;}
</style>

	

</body>
</html>





<?php
get_footer();
?>


