<?php 

require_once('../../../private/initialize.php'); 

require_login();


if(is_post_request()) {

	// Handle form values sent by new.php
	$subject = [];
	$subject['menu_name'] = $_POST['menu_name'] ?? '';
	$subject['position'] = $_POST['position'] ?? '';
	$subject['visible'] = $_POST['visible'] ?? '';

	$result = insert_subject($subject);
	if($result === true) {
		$new_id = mysqli_insert_id($db);
		$_SESSION['message'] = 'The subject was created successfully.';
		redirect_to(url_for('/staff/subjects/show.php?id=' . $new_id));
	} else {
		$errors = $result;
	}

} else {
	// display the blank form
}

$subject_set = find_all_subjects();
$subject_count = mysqli_num_rows($subject_set) + 1;
mysqli_free_result($subject_set);

$subject = [];

$subject['position'] = $subject_count;

?>

<?php $page_title = 'Create Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
	
	<div class="row">
		<div class="col-md-6 mx-auto">
			<a class="btn btn-sm btn-info back-link" href="<?php echo url_for('/staff/subjects/index.php'); ?>">&laquo; Back to List</a>

			<div class="subject new">
				<h2 class="mt-4">Create Subject</h2>

				<?php echo display_errors($errors); ?>
				<form action="<?php echo url_for('/staff/subjects/new.php'); ?>" method="post">
				  <fieldset>
				    <div class="form-group">
				      <label for="menu-mame">Menu Name</label>
				      <input type="text" name="menu_name" class="form-control" placeholder="">
				    </div>
				    <div class="form-group">
				      <label for="">Position</label>
				      <select name="position" class="form-control">
				      	<?php  
				      		for($i=1; $i <= $subject_count; $i++) {
				      			echo "<option value=\"${i}\"";
				      			if ($subject['position'] == $i) {
				      				echo ' selected';
				      			}
				      			echo ">${i}</option>";
				      		}
				      	?>
				        
				      </select>
				    </div>
				    <div class="form-check">
				      <input class="form-check-input" type="hidden" name="visible" value="0">
				      <input class="form-check-input" type="checkbox" name="visible" value="1">
				      <label class="form-check-label" for="">
				        Visible
				      </label>
				    </div>
				    <button type="submit" class="btn btn-block btn-info mt-4">Create Subject</button>
				  </fieldset>
				</form>
			</div>
		</div>
	</div>
	

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
