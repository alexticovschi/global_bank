<?php  

function find_all_subjects() {
	global $db;

	$query  = "SELECT * FROM subjects ";
	$query .= "ORDER BY position ASC";
	// echo $query;
	$result = mysqli_query($db, $query);
	confirm_result($result);
	return $result;
}

function find_all_pages() {
	global $db;

	$query = "SELECT * FROM pages ";
	$query .= "ORDER BY subject_id ASC, position ASC";
	# echo $query;
	$result = mysqli_query($db, $query);
	confirm_result($result);
	return $result;
}

?>