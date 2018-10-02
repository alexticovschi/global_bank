<?php require_once('../../../private/initialize.php'); ?>

<?php  

$id = $_GET['id'] ?? '1';
$page_id = h($id);

?>

<?php $page_title = 'Show Pages'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

	<div id="content">

		<a class="btn btn-sm btn-info" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>
		<br>

		<div class="page show">
			Page ID: <?php echo $page_id; ?>
		</div>

	</div>



<?php include(SHARED_PATH . '/staff_footer.php'); ?>