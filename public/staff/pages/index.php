<?php require_once('../../../private/initialize.php'); ?>

<?php
	$pages = find_all_pages();
?>

<?php $page_title = 'Pages'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

	<div id="content">
		<div class="pages listing">
			<h1>Pages</h1>

			<div class="actions">
				<a class="action btn btn-outline-info" href="<?php echo url_for('/staff/pages/new.php'); ?>">Create New Page</a>			
			</div>

			<table class="table list">
				<thead>
					<th scope="col">ID</th>
					<th scope="col">Subject</th>
			     	<th scope="col">Position</th>
			    	<th scope="col">Visible</th>
			     	<th scope="col">Name</th>
			     	<th scope="col">&nbsp;</th>
			     	<th scope="col">&nbsp;</th>
			     	<th scope="col">&nbsp;</th>
				</thead>
				<tbody>
					
					<?php while($page = mysqli_fetch_assoc($pages)) { ?>
						<tr>
							<td><?php echo h($page['id']); ?></td>
							<td>
								<?php 
									$subject = find_subject_by_id($page['subject_id']);
									echo h($subject['menu_name']);
								?>
							</td>
							<td><?php echo h($page['position']); ?></td>
							<td><?php echo $page['visible'] == 1 ? 'true' : 'false'; ?></td>
							<td><?php echo h($page['menu_name']); ?></td>
							<td><a class="action btn btn-sm btn-outline-info" href="<?php echo url_for('/staff/pages/show.php?id=' . h(u($page['id']))); ?>">View</a></td>
							<td><a class="action btn btn-sm btn-outline-info" href="<?php echo url_for('/staff/pages/edit.php?id=' . h(u($page['id']))); ?>">Edit</a></td>
							<td><a class="action btn btn-sm btn-outline-info" href="<?php echo url_for('/staff/pages/delete.php?id=' . h(u($page['id']))); ?>">Delete</a></td>
						</tr>
					<?php } ?>
			
				</tbody>
			</table>
			
			<?php  
				mysqli_free_result($pages);
			?>

		</div>
	</div>


<?php include(SHARED_PATH . '/staff_footer.php'); ?>