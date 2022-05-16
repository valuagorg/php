<?php
/**
 * Template Name: reportv1
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

<!-- Center the table -->
<center>

<!-- Label -->
<h4>  Report </h4>
<br>
<br>

<!-- Top of the table is set here -->
<table class="table table-striped">
	<thead class="thead-dark">
		<tr>
			<th scope="col">Id</th>
			<th scope='col'>Type</th>
			<th scope="col">Color</th>
			<th scope="col">Harvest Amount</th>
			<th scope="col">Harvest Date</th>
		</tr>
	</thead>
<tbody>


<?php
if(isset($_GET['id'])){
	
	// set variable from page name
	$id = $_GET['id']; #ex: Red+04-27-2022
	$str = $id;
	// set a delimiter to explode our variable
	$delimiter = ' ';
	$words = explode($delimiter, $str);

	// after exploding, use it in SQL to specifically select the set color and date, also harvested ones of course
	$sql = "SELECT * FROM seed_id_table WHERE  seed_color='$words[0]' AND seed_stage='harvested' AND harvest_date='$words[1]' ORDER BY seed_id DESC";
	$result = mysqli_query($conn, $sql);
	// Start a while loop, we will do everything inside this loop
	while($row=mysqli_fetch_assoc($result)){		
		$seed_id = $row['seed_id'] ;
		$seed_type = $row['seed_type'] ;
		$seed_stage = $row['seed_stage'];
		$seed_color = $row['seed_color'];
		$seed_location = $row['seed_location'];	
		$harvest_date = $row['harvest_date'];
		$harvest_amount = $row['harvest_amount'];
		$seed_expected_date = $row['seed_expected_date'];	

	?>
	

	<!-- We use HTML for each different row, however we need to use PHP inside it to show database data -->
	<!-- We set values of rows and columns from the variables we set earlier  -->
	<th scope="row"><?php echo $seed_id;?></th>
	
		<td><?php echo seed_name_converter($seed_type); ?></td>
		
		<!-- To add colored circles according to harvesting color we used if loops. 
		This basically checks the variables with each color's string name, 
		When it finds the color it concatenate the circle next to it
		-->
		<td><?php if($seed_color == "Red"){
		$newcolor=$seed_color." 🔴";
		echo $newcolor; 
		}
		else if($seed_color == "Green"){
			$newcolor=$seed_color." 🟢";
			echo $newcolor; 
		}
		else if($seed_color == "Blue"){
			$newcolor=$seed_color." 🔵";
			echo $newcolor; 
		}
		else if($seed_color == "Orange"){
			$newcolor=$seed_color." 🟠";
			echo $newcolor; 
		}
		else if($seed_color == "Yellow"){
			$newcolor=$seed_color." 🟡";
			echo $newcolor; 
		}
		else if($seed_color == "Brown"){
			$newcolor=$seed_color." 🟤";
			echo $newcolor; 
		}
		else if($seed_color == "Black"){
			$newcolor=$seed_color." ⚫";
			echo $newcolor; 
		} ?></td>
		
		<td><?php echo $harvest_amount; ?></td>
		
		<td><?php echo $harvest_date; ?></td>
		
	</tr>
	
	<?php }?>
</tbody>
<!-- Close the table -->
</table>	
</center>
<?php }?>

<!-- CSS Styling -->
<style>
.table {text-align: center;}
</style>

<!-- Wordpress function get_footer() is called here -->	
<?php
get_footer();
?>