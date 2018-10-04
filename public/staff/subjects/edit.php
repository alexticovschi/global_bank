<?php 

require_once('../../../private/initialize.php'); 

if(!isset($_GET['id'])) {
	redirect_to(url_for('/staff/subjects/new.php'));
}

$id = $_GET['id'];
$menu_name = '';
$position = '';
$visible = '';

if(is_post_request()) {

	// Handle form values sent by new.php

	$menu_name = $_POST['menu_name'] ?? '';
	$position = $_POST['position'] ?? '';
	$visible = $_POST['visible'] ?? '';

	echo "Form parameters <br />";
	echo "Menu name: " . $menu_name . "<br />";
	echo "Position: " . $position . "<br />";
	echo "Visible: " . $visible . "<br />";

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
		      <input type="text" name="menu_name" class="form-control" value="<?php echo h($menu_name); ?>">
		    </div>
		    <div class="form-group">
		      <label for="">Position</label>
		      <select name="position" class="form-control">
		        <option value="1" <?php if ($position == 1) echo 'selected'; ?>>1</option>
		      </select>
		    </div>
		    <div class="form-check">
		      <input class="form-check-input" type="hidden" name="visible" value="0">
		      <input class="form-check-input" type="checkbox" name="visible" value="1" <?php if ($visible == 1) echo 'checked'; ?>>
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
 