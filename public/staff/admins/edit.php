<?php 

require_once('../../../private/initialize.php');

require_login();

if(!isset($_GET['id'])) {
	redirect_to(url_for('/staff/admins/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {
	$admin = [];
	$admin['id'] = $id;
	$admin['first_name'] = $_POST['first_name'] ?? '';
	$admin['last_name'] = $_POST['last_name'] ?? '';
	$admin['email'] = $_POST['email'] ?? '';
	$admin['username'] = $_POST['username'] ?? '';
	$admin['password'] = $_POST['password'] ?? '';
	$admin['confirm_password'] = $_POST['confirm_password'] ?? '';

	$result = update_admin($admin);
	if($result === true) {
        $_SESSION['message'] = 'Admin updated.';
		redirect_to(url_for('/staff/admins/show.php?id=' . $id));
	} else {
		$errors = $result;
	}

} else {

	$page = find_admin_by_id($id);

}

?>

<?php $page_title = 'Edit Admin'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
		<div class="row">
			<div class="col-md-6 mx-auto">
				<a class="btn btn-sm btn-info bak-link" href="<?php echo url_for('/staff/admins/index.php') ?>">&laquo; Back to List</a>
				
				<div class="admin new">
					<h2 class="mt-4">Edit Admin</h2>

					<?php echo display_errors($errors); ?>
					<form action="<?php echo url_for('/staff/admins/new.php'); ?>" method="post">
						<fieldset>
                            <div class="form-group">
								<label for="menu-name">First Name</label>
								<input type="text" name="first_name" class="form-control" value="<?php echo h($admin['first_name']); ?>">
							</div>
                            <div class="form-group">
								<label for="menu-name">Last Name</label>
								<input type="text" name="last_name" class="form-control" value="<?php echo h($admin['last_name']); ?>">
							</div>
                            <div class="form-group">
								<label for="menu-name">Username</label>
								<input type="text" name="username" class="form-control" value="<?php echo h($admin['username']); ?>">
							</div>
                            <div class="form-group">
								<label for="menu-name">Email</label>
								<input type="text" name="email" class="form-control" value="<?php echo h($admin['email']); ?>">
							</div>
                            <div class="form-group">
								<label for="menu-name">Password</label>
								<input type="password" name="password" class="form-control" value="">
							</div>
                            <div class="form-group">
								<label for="menu-name">Confirm Password</label>
								<input type="password" name="confirm_password" class="form-control" value="">
							</div>
                            <p>
                            Passwords should be at least 12 characters and include at least one uppercase letter, lowercase letter, number, and symbol.
                            </p>
							<button type="submit" class="btn btn-block btn-info mt-2">Edit Admin</button>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
</div>


<?php include(SHARED_PATH . '/staff_footer.php'); ?>