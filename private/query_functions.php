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

function insert_subject($subject) {
	global $db;

	$query = "INSERT INTO subjects (menu_name, position, visible) ";
	$query .= "VALUES (";
	$query .= "'" . $subject['menu_name'] . "',";
	$query .= "'" . $subject['position'] . "',";
	$query .= "'" . $subject['visible'] . "'";
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

function delete_subject($id) {
	global $db;

	$query = "DELETE FROM subjects WHERE id='" . $id . "' LIMIT 1";
	$result = mysqli_query($db, $query);

	// For DELETE statements, $result is true/false
	if($result) {
		return true;
	} else {
		// DELETE failed
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

function find_page_by_id($page_id) {
	global $db;

	$query = "SELECT * FROM pages WHERE id='" . $page_id . "'";
	$result = mysqli_query($db, $query);
	confirm_result($result);

	$page = mysqli_fetch_assoc($result);
	mysqli_free_result($result);

	return $page; // returns an associative array
}

function update_page($page) {
	global $db;

	$query = "UPDATE pages SET ";
	$query .= "subject_id='" . $page['subject_id'] .  "', ";
	$query .= "menu_name='" . $page['menu_name'] . "', ";
	$query .= "position='" . $page['position'] . "', ";
	$query .= "visible='" . $page['visible'] . "', ";
	$query .= "content='" . $page['content'] . "' ";
	$query .= "WHERE id='" . $page['id'] . "' ";
	$query .= "LIMIT 1";

	$update_page = mysqli_query($db, $query);

	if($update_page) {
		return true;
	} else {
		// UPDATE failed
		// Display the error message, disconnect the database and quit everything
		echo mysqli_error($db);
		db_disconnect($db);
		exit;
	}
}

function insert_page() {
	global $db;

	$query = "INSERT INTO pages (subject_id, menu_name, position, visible, content) ";
	$query .= "VALUES (";
	$query .= "'" . $page['subject_id'] .  "', ";
	$query .= "'" . $page['menu_name'] .  "', ";
	$query .= "'" . $page['position'] .  "', ";
	$query .= "'" . $page['visible'] .  "', ";
	$query .= "'" . $page['content'] .  "'";
	$query .= ")";

	$insert_page = mysqli_query($db, $query);

	if($insert_page) {
		return true;
	} else {
		// INSERT failed
		// Display the error message, disconnect the database and quit everything
		echo mysqli_error($db);
		db_disconnect($db);
		exit;
	}
}

function delete_page($page_id) {
	global $db;

	$query = "DELETE FROM pages WHERE id='" . $page_id . "' LIMIT 1";
	$delete_page = mysqli_query($db, $query);

	if($delete_page) {
		return true;
	} else {
		// DELETE failed
		// Display the error message, disconnect the database and quit everything
		echo mysqli_error($db);
		db_disconnect($db);
		exit;
	}
}

?>