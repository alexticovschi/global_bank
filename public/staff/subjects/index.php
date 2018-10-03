<?php require_once('../../../private/initialize.php'); ?>

<?php
  $subjects = [
    ['id' => '1', 'position' => '1', 'visible' => '1', 'menu_name' => 'About Globe Bank'],
    ['id' => '2', 'position' => '2', 'visible' => '1', 'menu_name' => 'Consumer'],
    ['id' => '3', 'position' => '3', 'visible' => '1', 'menu_name' => 'Small Business'],
    ['id' => '4', 'position' => '4', 'visible' => '1', 'menu_name' => 'Commercial'],
  ];
?>


<?php $page_title = 'Subjects'; ?>
<?php include(SHARED_PATH . '/staff_header.php') ?>

	<div id="content">
		<div class="subjects listing">
			<h1>Subjects</h1>

			<div class="actions">
				<a class="action btn btn-outline-info" href="<?php echo url_for('/staff/subjects/new.php'); ?>">Create New Subject</a>
			</div>


			<table class="table list">
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

			  	<?php foreach($subjects as $subject) { ?>
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
	</div>

<?php include(SHARED_PATH . '/staff_footer.php') ?>