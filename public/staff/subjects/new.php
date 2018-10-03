<?php 

require_once('../../../private/initialize.php'); 

$test = $_GET['test'] ?? '';

if ($test == '404') {
	error_404();
} elseif ($test == '500') {
	error_500();
} elseif ($test == 'redirect') {
	redirect_to(url_for('/staff/subjects/index.php'));
	exit;
}

?>

<?php $page_title = 'Create Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
	
	<a class="btn btn-sm btn-info back-link" href="<?php echo url_for('/staff/subjects/index.php'); ?>">&laquo; Back to List</a>

	<div class="subject new">
		<h2 class="mt-4">Create Subject</h2>

		<form action="<?php echo url_for('/staff/subjects/create.php'); ?>" method="post">
		  <fieldset>
		    <div class="form-group">
		      <label for="menu-mame">Menu Name</label>
		      <input type="text" name="menu_name" class="form-control" placeholder="">
		    </div>
		    <div class="form-group">
		      <label for="">Position</label>
		      <select name="position" class="form-control">
		        <option value="1">1</option>
		      </select>
		    </div>
		    <div class="form-check">
		      <input class="form-check-input" type="hidden" name="visible" value="0">
		      <input class="form-check-input" type="checkbox" name="visible" value="1">
		      <label class="form-check-label" for="">
		        Visible
		      </label>
		    </div>
		    <button type="submit" class="btn btn-info mt-4">Create Subject</button>
		  </fieldset>
		</form>
	</div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
