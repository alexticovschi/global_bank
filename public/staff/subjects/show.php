<?php require_once('../../../private/initialize.php'); ?>

<?php  

require_login();


$id = $_GET['id'] ?? '1';
$subject_id = h($id);

$subject = find_subject_by_id($subject_id);

?>

<?php $page_title = 'Show Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

	<div id="content">
		<br>

		<div class="subject show text-center container">
			
			<h3 cl>Subject: <?php echo h($subject['menu_name']); ?></h3>
			<div class="row">
				<div class="col-md-6 mx-auto">
					<div class="card mt-4">
				    	<div class="card-body">
				    		<h5 class="card-title">Menu Name</h5>
				      		<p class="card-text"><?php echo h($subject['menu_name']); ?></p>
				    	</div>
						<hr>
						<div class="card-body">
				    		<h5 class="card-title">Position</h5>
				      		<p class="card-text"><?php echo h($subject['position']); ?></p>
				    	</div>
						<hr>
				    	<div class="card-body">
				    		<h5 class="card-title">Visible</h5>
				      		<p class="card-text"><?php echo $subject['visible']== 1 ? 'true' : 'false'; ?></p>
				    	</div>
				    </div>

				    <a class="btn btn-info btn-block mt-2" href="<?php echo url_for('/staff/subjects/index.php'); ?>">&laquo; Back to List</a>
				</div>
			</div>
		</div>
	</div>



<?php include(SHARED_PATH . '/staff_footer.php'); ?>