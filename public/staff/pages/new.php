<?php 

require_once('../../../private/initialize.php');

require_login();

if(is_post_request()) {

	$page = [];
	$page['subject_id'] = $_POST['subject_id'] ?? '';
	$page['menu_name'] = $_POST['menu_name'] ?? '';
	$page['position'] = $_POST['position'] ?? '';
	$page['visible'] = $_POST['visible'] ?? '';
	$page['content'] = $_POST['content'] ?? '';

	$result = insert_page($page);
	if($result === true) {
		$new_id = mysqli_insert_id($db);
		redirect_to(url_for('/staff/pages/show.php?id' . $new_id));
	} else {
		$errors = $result;
	}
	
} else {

	$page = [];
	$page['subject_id'] = '';
	$page['menu_name'] = '';
	$page['position'] = '';
	$page['visible'] = '';
	$page['content'] = '';

}

$pages = find_all_pages();
$page_count = mysqli_num_rows($pages) + 1;
mysqli_free_result($pages);

?>

<?php $page_title = 'Create Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

	<div id="content">
		<div class="row">
			<div class="col-md-6 mx-auto">
				<a class="btn btn-sm btn-info bak-link" href="<?php echo url_for('/staff/pages/index.php') ?>">&laquo; Back to List</a>
				
				<div class="page new">
					<h2 class="mt-4">Create Page</h2>

					<?php echo display_errors($errors); ?>
					<form action="<?php echo url_for('/staff/pages/new.php'); ?>" method="post">
						<fieldset>
							<div class="form-group">
								<label class="mt-2" for="subject-name">Subject Name</label>
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
								<label for="menu-name">Menu Name</label>
								<input type="text" name="menu_name" class="form-control" value="">
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
								<input class="form-check-input" type="checkbox" name="visible" value="1">
								<label class="form-check-label" for="">
									Visible
								</label>
							</div>
							<div class="form-group mt-2">
								<label for="content">Content</label>
								<textarea name="content" class="form-control" rows="8">
									<?php echo h($page['content']); ?>
								</textarea>
							</div>
							<button type="submit" class="btn btn-block btn-info mt-2">Create Page</button>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>

