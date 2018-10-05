<?php  

function find_all_subjects() {
	global $db;
	
	$query  = "SELECT * FROM subjects ";
	$query .= "ORDER BY position ASC";
	$result = mysqli_query($db, $query);
	return $result;
}

?>