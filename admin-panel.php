<?php
/**
 * Template Name: Admin Panel
 */

get_header(); 
global $wpdb
?>
<?php include_once "topnav.php"; ?>

<?php
if( current_user_can('administrator') ) {
	
	echo "<center>";
	echo '<h4>  Admin Panel </h4>';
	
	echo '<br>' ;	
	echo '<br>' ;
	
	echo '<div class="container">';
		echo ' <div class="row">';
		
			echo '<div class="col-sm">';
				echo '<a class="btn btn-success btn-lg" id="optbtn" href="add-new-seeds">Add New Seeds<a/>';
				echo "<br>";

				echo '<a class="btn btn-success btn-lg" id="optbtn" href="delete-seeds">Delete Seeds<a/>';
			echo '</div>';
			echo '<div class="col-sm">';
				echo '<a class="btn btn-success btn-lg" id="optbtn" href="add-new-units">Add New Units<a/>';
				echo "<br>";

				echo '<a class="btn btn-success btn-lg" id="optbtn" href="delete-units">Delete Units<a/>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
	
	echo '</center>';
};
?>

<style>
#optbtn{
    background-color: rgb(6, 180, 6);
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
    text-align: center;
    border-radius: 12px;
    font-size: 10px 24px;
    color: black;
    border-color: darkgreen;
    margin-bottom: 10px;
    width: 200px;
}

</style>

<?php
get_footer();
?>