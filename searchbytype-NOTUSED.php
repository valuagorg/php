<?php
/**
 * Template Name: Search By Type
 */

get_header(); 
global $wpdb
?>
<!-- THIS FILE IS NO LONGER IN USE -->
<!-- THIS FILE IS NO LONGER IN USE -->
<!-- THIS FILE IS NO LONGER IN USE -->
<?php
include_once "add/func.php";
include_once "add/conn.php";
?>

<!DOCTYPE html>
<html>
<body>
 <center>
 <div>
	<h5>Color Filtering Example</h5>
    <a href="../seed-by-type/?id=Red">Red</a>
	<a href="../seed-by-type/?id=blue">Blue</a>
	<a href="../seed-by-type/?id=Black">Black</a>
	<a href="../seed-by-type/?id=Yellow">Yellow</a>
	<br>
	<br>
	<h5>Type Filtering Example</h5>
    <a href="../seed-by-type/?id=1">Basil</a>
	<a href="../seed-by-type/?id=14">Cilantro</a>
	<a href="../seed-by-type/?id=26">Broccoli</a>
	<a href="../seed-by-type/?id=28">Afalfa</a>
	<br>
	<br>
	<h5>Stage Filtering Example</h5>
	<a href="../seed-by-type/?id=Pot">Pot</a>
	<a href="../seed-by-type/?id=Plug">Plug</a>
    <a href="../seed-by-type/?id=Harvested">Harvested</a>
  </center>
</div>
</body>
</html>


<?php
get_footer();
?>