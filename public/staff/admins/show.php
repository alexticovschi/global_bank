<?php require_once('../../../private/initialize.php'); ?>

<?php  

$id = $_GET['id'] ?? '1';
$admin_id = h($id);

$admin = find_admin_by_id($admin_id);

?>

<?php $page_title = 'Show Admin'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

	<div id="content">

		<div class="admin show text-center container">

			<h3 cl>Admin: <?php echo h($admin['username']); ?></h3>
			<div class="row">
				<div class="col-md-6 mx-auto">
					<div class="card mt-4">
				    	<div class="card-body">
				    		<h5 class="card-title">First Name</h5>
				      		<p class="card-text"><?php echo h($admin['first_name']); ?></p>
				    	</div>
						<hr>
						<div class="card-body">
				    		<h5 class="card-title">Last Name</h5>
				      		<p class="card-text"><?php echo h($admin['last_name']); ?></p>
				    	</div>
						<hr>
                        <div class="card-body">
				    		<h5 class="card-title">Email</h5>
				      		<p class="card-text"><?php echo h($admin['email']); ?></p>
				    	</div>
						<hr>
                        <div class="card-body">
				    		<h5 class="card-title">Username</h5>
				      		<p class="card-text"><?php echo h($admin['username']); ?></p>
				    	</div>
				    </div>
					<div class="actions mt-4 mb-4">
						<a href="<?php echo url_for('/staff/admins/edit.php?id=' . h(u($admin['id']))); ?>" class="action btn btn-outline-info">Edit</a>
						<a href="<?php echo url_for('/staff/admins/delete.php?id=' . h(u($admin['id']))); ?>" class="action btn btn-danger">Delete</a>
					</div>

				    <a class="btn btn-info btn-block mt-2" href="<?php echo url_for('/staff/admins/index.php'); ?>">&laquo; Back to List</a>
				</div>
			</div>
		</div>
	</div>


<?php include(SHARED_PATH . '/staff_footer.php'); ?>