<?php require_once('../../../private/initialize.php'); ?>

<?php
	
	$subject_set = find_all_subjects();

?>


<?php $page_title = 'Subjects'; ?>
<?php include(SHARED_PATH . '/staff_header.php') ?>

	<div id="content">
		<div class="subjects listing">
			<h1>Subjects</h1>

			<div class="actions">
				<a class="action btn btn-outline-info" href="<?php echo url_for('/staff/subjects/new.php'); ?>">Create New Subject</a>
			</div>

			<div class="table-responsive">
				<table class="table list table-striped table-sm">
				  <thead>
				    <tr>
				      <th scope="col">ID</th>
				      <th scope="col">Position</th>
				      <th scope="col">Visible</th>
				      <th scope="col">Name</th>
				      <th scope="col">&nbsp;</th>
				      <th scope="col">&nbsp;</th>
				      <th scope="col">&nbsp;</th>
				    </tr>
				  </thead>
				  <tbody>

				  	<?php while($subject = mysqli_fetch_assoc($subject_set)) { ?>
				  			<tr>
						      <td><?php echo $subject['id']; ?></td>
						      <td><?php echo $subject['position']; ?></td>
						      <td><?php echo $subject['visible'] == 1 ? 'true' : 'false'; ?></td>
						      <td><?php echo $subject['menu_name']; ?></td>
						      <td><a href="<?php echo url_for('/staff/subjects/show.php?id=' . h(u($subject['id']))); ?>" class="action btn btn-sm btn-outline-info">View</a></td>
						      <td><a href="<?php echo url_for('/staff/subjects/edit.php?id=' . h(u($subject['id']))); ?>" class="action btn btn-sm btn-outline-info">Edit</a></td>
						      <td><a href="" class="action btn btn-sm btn-outline-info">Delete</a></td>
						    </tr>
				  	<?php	} ?>
				    
				  </tbody>
				</table>
			</div>
			<?php  
				mysqli_free_result($subject_set);
			?>
		</div>
	</div>

<?php include(SHARED_PATH . '/staff_footer.php') ?>