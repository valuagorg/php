<?php
include_once "conn.php";

//NOT USED
function bs_jumbotron(){
	echo '<div class="jumbotron jumbotron">
			  <div class="container">
				<h1 class="display-3">Big Yield Growers</h1>
				<p2 class="lead">This is our homepage, you can perform actions below.</p2>
			  </div>
			</div>'; 
}

// converts seed id to seed name
function seed_name_converter($id){
	global $conn;
	$sql = "SELECT * FROM seed_table WHERE seed_id='$id'";
	$result = mysqli_query($conn, $sql);
	while($row=mysqli_fetch_assoc($result)){
		$name = $row['seed_name'];
		echo $name; 
	}
}

// converts foreign key id to type 
function seed_type_converter($id){
	global $conn;
	$sql = "SELECT * FROM seed_id_table WHERE seed_id='$id'";
	$result = mysqli_query($conn, $sql);
	while($row=mysqli_fetch_assoc($result)){
		$type = $row['seed_type'];
		return $type; 
	}
}

// converts foreign key id to name
function unitlevel_name_converter($id){
	if($id==4444){
		echo 'In Store';
	}
	else{
		global $conn;
		$x = "SELECT * FROM unitlevel_table WHERE unitlevel_id='$id'";
		$y = mysqli_query($conn, $x);
		while($row=mysqli_fetch_assoc($y)){
			$name = $row['unit_name'];
			echo $name; 
		}
	}
}

//NOT USED
function username($id){
	global $conn;
	$x = "SELECT * FROM employee_table WHERE employee_id='$id'";
	$y = mysqli_query($conn, $x);
	while($row=mysqli_fetch_assoc($y)){
		$name = $row['employee_id'];
		echo $name;
	}
}

?>