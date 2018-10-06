<?php 

require_once('../../../private/initialize.php'); 

if(!isset($_GET['id'])) {
	redirect_to(url_for('/staff/subjects/new.php'));
}

$id = $_GET['id'];

if(is_post_request()) {

	// Handle form values sent by new.php
	$subject = [];
	$subject['id'] = $id;
	$subject['menu_name'] = $_POST['menu_name'] ?? '';
	$subject['position'] = $_POST['position'] ?? '';
	$subject['visible'] = $_POST['visible'] ?? '';

	$result = update_subject($subject);
	redirect_to(url_for('/staff/subjects/show.php?id=' . $id));

}  else {

	$subject = find_subject_by_id($id);

	$subject_set = find_all_subjects();
	$subject_count = mysqli_num_rows($subject_set);
	mysqli_free_result($subject_set);
}

?>

<?php $page_title = 'Edit Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
	
	<a class="btn btn-sm btn-info back-link" href="<?php echo url_for('/staff/subjects/index.php'); ?>">&laquo; Back to List</a>

	<div class="subject edit">
		<h2 class="mt-4">Edit Subject</h2>

		<form action="<?php echo url_for('/staff/subjects/edit.php?id=' . h(u($id))); ?>" method="post">
		  <fieldset>
		    <div class="form-group">
		      <label for="menu-mame">Menu Name</label>
		      <input type="text" name="menu_name" class="form-control" value="<?php echo h($subject['menu_name']); ?>">
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
		      <input class="form-check-input" type="checkbox" name="visible" value="1" <?php if ($subject['visible'] == 1) echo 'checked'; ?>>
		      <label class="form-check-label" for="">
		        Visible
		      </label>
		    </div>
		    <button type="submit" class="btn btn-info mt-4">Edit Subject</button>
		  </fieldset>
		</form>
	</div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
 