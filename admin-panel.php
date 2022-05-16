<?php
/**
 * Template Name: Admin Panel
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

<!-- To access this page, user needs to be an admin -->
<!-- 
To add restriction current_user_can() function from Wordpress, which checks if the user is an admin or not.
However, we could only use this function inside PHP which makes the next step really tricky. We cant just use HTML inside PHP, 
so to get over this issue we used PHP echo which is usually used for output of a form, we echoe'd the form itself.
 -->
<?php
if( current_user_can('administrator') ) {
	
	// Center the table
	echo "<center>";
	
	// Label
	echo '<h4>  Admin Panel </h4>';
	echo '<br>' ;	
	echo '<br>' ;
	
	//  Div is divided to 2 in here, to show 4 different buttons 2 by 2.
	echo '<div class="container">';
		echo ' <div class="row">';
		
			// Add and Delete Seeds are set here, id's are "optbtn" this will be used in styling
			echo '<div class="col-sm">';
				echo '<a class="btn btn-success btn-lg" id="optbtn" href="add-new-seeds">Add New Seeds<a/>';
				echo "<br>";
				echo '<a class="btn btn-success btn-lg" id="optbtn" href="delete-seeds">Delete Seeds<a/>';
			echo '</div>';
			
			// Add and Delete Units are set here, id's are "optbtn" this will be used in styling
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

<!-- CSS Styling -->
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

<!-- Wordpress function get_footer() is called here -->	
<?php
get_footer();
?>
