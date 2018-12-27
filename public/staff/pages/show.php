<?php require_once('../../../private/initialize.php'); ?>

<?php  

require_login();

$id = $_GET['id'] ?? '1';
$page_id = h($id);

$page = find_page_by_id($page_id);

$subject = find_subject_by_id($page['subject_id']);

?>

<?php $page_title = 'Show Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

	<div id="content">
		<br>

		<div class="page show text-center container">
			
			<h3>Page: <?php echo h($page['menu_name']); ?></h3>

			<div class="actions mt-4">
				<a class="btn btn-block" style="background-color: #ff6600; color: #fff" href="<?php echo url_for('/index.php?id=' . h(u($page['id'])) . '&preview=true'); ?>" target="_blank">Preview Page</a>
				<a class="btn btn-info btn-block mt-2" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>
			</div>

			<div class="row">
				<div class="col-md-12 mx-auto">
					<div class="card mt-2 mb-5">
						<div class="card-body">
				    		<h5 class="card-title">Subject</h5>
				      		<p class="card-text"><?php echo h($subject['menu_name']); ?></p>
				    	</div>
						<hr>
				    	<div class="card-body">
				    		<h5 class="card-title">Menu Name</h5>
				      		<p class="card-text"><?php echo h($page['menu_name']); ?></p>
				    	</div>
						<hr>
						<div class="card-body">
				    		<h5 class="card-title">Position</h5>
				      		<p class="card-text"><?php echo h($page['position']); ?></p>
				    	</div>
						<hr>
				    	<div class="card-body">
				    		<h5 class="card-title">Visible</h5>
				      		<p class="card-text"><?php echo $page['visible']== 1 ? 'true' : 'false'; ?></p>
				    	</div>
						<hr>
						<div class="card-body">
				    		<h5 class="card-title">Content</h5>
				      		<p class="card-text"><?php echo h($page['content']); ?></p>
				    	</div>
				    </div>
				</div>
			</div>
		</div>
	</div>



<?php include(SHARED_PATH . '/staff_footer.php'); ?>