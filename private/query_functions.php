<?php  

function validate_subject($subject) {
	$errors = [];

	// menu name
	if(is_blank($subject['menu_name'])) {
		$errors[] = "Name cannot be blank.";
	} elseif(!has_length($subject['menu_name'], ['min' => 2, 'max' => 255])) {
		$errors[] = "Name must be between 2 and 255 characters.";
	}

	// position
	// Make sure we are working with an integer
	$position_int = (int)$subject['position'];
	if($position_int <= 0) {
		$errors[] = "Position must be greter than zero.";
	}
	if($position_int > 999) {
		$errors[] = "Position must be less than 999.";
	}

	// visible
	// Make sure we are working with a string
	$visible_str = (string)$subject['visible'];
	if(!has_inclusion_of($visible_str, ["0", "1"])) {
		$errors[] = "Visible must be true or false.";
	}

	return $errors;
}

function validate_page($page) {
	$errors = [];

	// subject ID
	if(is_blank($page['subject_id'])) {
		$errors[] = "Subject cannot be blank.";
	} 

	// menu name
	if(is_blank($page['menu_name'])) {
		$errors[] = "Name cannot be blank.";
	} elseif(!has_length($page['menu_name'], ['min' => 2, 'max' => 255])) {
		$errors[] = "Name must be between 2 and 255 characters.";
	}
	$current_id = $page['id'] ?? '0';
	if(!has_unique_page_menu_name($page['menu_name'], $current_id)) {
		$errors[] = "Menu name must be unique.";
	}

	// position
	// Make sure we are working with an integer
	$position_int = (int)$page['position'];
	if($position_int <= 0) {
		$errors[] = "Position must be greter than zero.";
	}
	if($position_int > 999) {
		$errors[] = "Position must be less than 999.";
	}

	// visible
	// Make sure we are working with a string
	$visible_str = (string)$page['visible'];
	if(!has_inclusion_of($visible_str, ["0", "1"])) {
		$errors[] = "Visible must be true or false.";
	}

	// content
	if(is_blank($page['content'])) {
		$errors[] = "Content cannot be blank.";
	}

	return $errors;
}

function find_all_subjects($options=[]) {
	global $db;

	// if there's a value for visible, use it, else use false
	$visible = $options['visible'] ?? false;

	$query  = "SELECT * FROM subjects ";
	if($visible) {
		$query .= "WHERE visible = true ";
	}
	$query .= "ORDER BY position ASC";
	// echo $query;
	$result = mysqli_query($db, $query);
	confirm_result($result);
	return $result;
}

function find_subject_by_id($subject_id) {
	global $db;

	$query = "SELECT * FROM subjects WHERE id='" . db_escape($db, $subject_id) . "'";
	$result = mysqli_query($db, $query);
	confirm_result($result);

	$subject = mysqli_fetch_assoc($result);
	mysqli_free_result($result);

	return $subject;
}

function insert_subject($subject) {
	global $db;

	$errors = validate_subject($subject);
	if(!empty($errors)) {
		return $errors;
	}

	$query = "INSERT INTO subjects (menu_name, position, visible) ";
	$query .= "VALUES (";
	$query .= "'" . db_escape($db, $subject['menu_name']) . "',";
	$query .= "'" . db_escape($db, $subject['position']) . "',";
	$query .= "'" . db_escape($db, $subject['visible']) . "'";
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

	$errors = validate_subject($subject);
	if(!empty($errors)) {
		return $errors;
	}

	$query = "UPDATE subjects SET ";
	$query .= "menu_name='" . db_escape($db, $subject['menu_name']) . "', ";
	$query .= "position='" . db_escape($db, $subject['position']) . "', ";
	$query .= "visible='" . db_escape($db, $subject['visible']) . "' ";
	$query .= "WHERE id='" . db_escape($db, $subject['id']) . "' ";
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

	$query = "DELETE FROM subjects WHERE id='" . db_escape($db, $id) . "' LIMIT 1";
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

	$query = "SELECT * FROM pages WHERE id='" . db_escape($db, $page_id) . "'";
	$result = mysqli_query($db, $query);
	confirm_result($result);

	$page = mysqli_fetch_assoc($result);
	mysqli_free_result($result);

	return $page; // returns an associative array
}

function update_page($page) {
	global $db;

	$errors = validate_page($page);
	if(!empty($errors)) {
		return $errors;
	}

	$query = "UPDATE pages SET ";
	$query .= "subject_id='" . db_escape($db, $page['subject_id']) .  "', ";
	$query .= "menu_name='" . db_escape($db, $page['menu_name']) . "', ";
	$query .= "position='" . db_escape($db, $page['position']) . "', ";
	$query .= "visible='" . db_escape($db, $page['visible']) . "', ";
	$query .= "content='" . db_escape($db, $page['content']) . "' ";
	$query .= "WHERE id='" . db_escape($db, $page['id']) . "' ";
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

function insert_page($page) {
	global $db;

	$errors = validate_page($page);
	if(!empty($errors)) {
		return $errors;
	}

	$query = "INSERT INTO pages (subject_id, menu_name, position, visible, content) ";
	$query .= "VALUES (";
	$query .= "'" . db_escape($db, $page['subject_id']) .  "', ";
	$query .= "'" . db_escape($db, $page['menu_name']) .  "', ";
	$query .= "'" . db_escape($db, $page['position']) .  "', ";
	$query .= "'" . db_escape($db, $page['visible']) .  "', ";
	$query .= "'" . db_escape($db, $page['content']) .  "'";
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

	$query = "DELETE FROM pages WHERE id='" .db_escape($db,  $page_id) . "' LIMIT 1";
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

function find_pages_by_subject_id($subject_id, $options=[]) {
	global $db;

	$visible = $options['visible'] ?? false;

	$query = "SELECT * FROM pages WHERE subject_id='" . db_escape($db, $subject_id) . "' ";
	if($visible) {
		$query .= "AND visible = true ";
	}
	$query .= "ORDER BY position ASC";
	$result = mysqli_query($db, $query);
	confirm_result($result);
	return $result; 
}

?>