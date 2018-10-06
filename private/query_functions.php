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

function find_subject_by_id($subject_id) {
	global $db;

	$query = "SELECT * FROM subjects WHERE id='" . $subject_id . "'";
	$result = mysqli_query($db, $query);
	confirm_result($result);

	$subject = mysqli_fetch_assoc($result);
	mysqli_free_result($result);

	return $subject;
}

function insert_subject($menu_name, $position, $visible) {
	global $db;

	$query = "INSERT INTO subjects (menu_name, position, visible) ";
	$query .= "VALUES (";
	$query .= "'" . $menu_name . "',";
	$query .= "'" . $position. "',";
	$query .= "'" . $visible . "'";
	$query .= ")";

	$result = mysqli_query($db, $query);
	// For INSERT statements, $result is true/false
	if($result) {
		return true;
	} else {
		// INSERT failed
		// Display the error message, disconnect the database and quit everything
		echo mysqli_error($db);
		db_disconnect($db);
		exit;
	}
}

function update_subject($subject) {
	global $db;

	$query = "UPDATE subjects SET ";
	$query .= "menu_name='" . $subject['menu_name'] . "', ";
	$query .= "position='" . $subject['position'] . "', ";
	$query .= "visible='" . $subject['visible'] . "' ";
	$query .= "WHERE id='" . $subject['id'] . "' ";
	$query .= "LIMIT 1";

	$update_subject = mysqli_query($db, $query);
	// For UPDATE statements, $result is true/false
	if($update_subject) {
		return true;
	} else {
		// UPDATE failed
		// Display the error message, disconnect the database and quit everything
		echo mysqli_error($db);
		db_disconnect($db);
		exit;
	}
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