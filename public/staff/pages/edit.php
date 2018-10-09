<?php 

require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
	redirect_to(url_for('/staff/pages/new.php'));
}
$page_id = $_GET['id'];

if(is_post_request()) {

	// Handle form values sent by new.php
	$page = [];
	$page['id'] = $page_id;
	$page['subject_id'] = $_POST['subject_id'] ?? '';
	$page['menu_name'] = $_POST['menu_name'] ?? '';
	$page['position'] = $_POST['position'] ?? '';
	$page['visible'] = $_POST['visible'] ?? '';
	$page['content'] = $_POST['content'] ?? '';

	$result = update_page($page);
	if($result === true) {
		redirect_to(url_for('/staff/pages/show.php?id=' . $page_id));
	} else {
		$errors = $result;
	}

} else {

	$page = find_page_by_id($page_id);

}

$pages = find_all_pages();
$page_count = mysqli_num_rows($pages);
mysqli_free_result($pages);

?>

<?php $page_title = 'Edit Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
	<div class="row">
		<div class="col-md-6 mx-auto">
			<a class="btn btn-sm btn-info back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>

			<div class="page edit">
				<h2 class="mt-4 mb-4">Edit Page</h2>
				
				<?php echo display_errors($errors); ?>
				<form action="<?php echo url_for('/staff/pages/edit.php?id=' . h(u($page_id))); ?>" method="post">
					<fieldset>
						<div class="form-group">
							<select name="subject_id" class="form-control">
								<?php  
									$subjects = find_all_subjects();
									while($subject = mysqli_fetch_assoc($subjects)) {
										echo "<option value=\"" . h($subject['id']) . "\"";
										if ($page['subject_id'] == $subject['id']) {
											echo ' selected';
										}
										echo ">" . h($subject['menu_name']) . "</option>";
									}
									mysqli_free_result($subjects);
								?>
							</select>
						</div>					
						<div class="form-group">
							<label for="menu-mame">Menu Name</label>
							<input type="text" name="menu_name" class="form-control" value="<?php echo h($page['menu_name']); ?>">
						</div>
						<div class="form-group">
							<label for="">Position</label>
							<select name="position" class="form-control">
								<?php  
									for($i=1; $i <= $page_count; $i++) {
										echo "<option value=\"${i}\"";
										if ($page['position'] == $i) {
											echo ' selected';
										}
										echo ">${i}</option>";
									}
								?>
							</select>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="hidden" name="visible" value="0">
							<input class="form-check-input" type="checkbox" name="visible" value="1" <?php if($page['visible'] == 1) echo 'checked'; ?>>
							<label class="form-check-label" for="">
								Visible
							</label>
						</div>
						
							<label for="content">Content</label>
							<textarea name="content" class="form-control" rows="8">
								<?php echo h($page['content']); ?>
							</textarea>
						<button type="submit" class="btn btn-info mt-4">Edit Page</button>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>