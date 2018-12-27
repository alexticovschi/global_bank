<?php 

require_once('../../../private/initialize.php');

require_login();

if(!isset($_GET['id'])) {
	redirect_to(url_for('/staff/admins/index.php'));
}

$id = $_GET['id'];

if(is_post_request()) {

    $result = delete_admin($id);
    redirect_to(url_for('/staff/admins/index.php'));

} else {
    $page = find_admin_by_id($id);
}

?>

<?php $page_title = 'Delete Admin'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
	<a class="btn btn-sm btn-info back-link" href="<?php echo url_for('/staff/admins/index.php'); ?>">&laquo; Back to List</a>

	<div class="row">
		<div class="col-md-6 mx-auto text-center">
			<div class="card mt-4">
				<h2 class="mt-4">Delete Admin</h2>

				<div class="card-body">
				    <p class="bg-danger" style="color: #fff; padding:10px;">Are you sure you want to delete this admin?</p>
	    			<h4 class="item"><?php echo h($admin['username']); ?></h4>
				</div>
				<hr>
				<div class="card-body">
					<form action="<?php echo url_for('/staff/admins/delete.php?id=' . h(u($page['id']))); ?>" method="post">
						<input class="btn btn-info" type="submit" name="commit" value="Delete Admin" />
				    </form>				    
				</div>				
			</div>
		</div>
	</div>	

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
