<?php  

require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
	redirect_to(url_for('/staff/subjects/index.php'));
}

$id = $_GET['id'];

if(is_post_request()) {
	delete_subject($id);
	redirect_to(url_for('/staff/subjects/index.php'));
} else {
	$subject = find_subject_by_id($id);
}

?>

<?php $page_title = 'Delete Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
	<a class="btn btn-sm btn-info back-link" href="<?php echo url_for('/staff/subjects/index.php'); ?>">&laquo; Back to List</a>

	<div class="row">
		<div class="col-md-6 mx-auto text-center">
			<div class="card mt-4">
				<h2 class="mt-4">Delete Subject</h2>

				<div class="card-body">
				    <p class="bg-danger" style="color: #fff; padding:10px;">Are you sure you want to delete this subject?</p>
	    			<h4 class="item"><?php echo h($subject['menu_name']); ?></h4>
				</div>
				<hr>
				<div class="card-body">
					<form action="<?php echo url_for('/staff/subjects/delete.php?id=' . h(u($subject['id']))); ?>" method="post">
						<input class="btn btn-info" type="submit" name="commit" value="Delete Subject" />
				    </form>				    
				</div>				
			</div>
		</div>
	</div>	

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
