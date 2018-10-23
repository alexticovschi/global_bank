<?php 

require_once('../../../private/initialize.php');

$admin_set = find_all_admins();

?>

<?php $page_title = 'Admins'; ?>
<?php include(SHARED_PATH . '/staff_header.php') ?>

<div id="content">
    <div class="admins listing">
        <h1>Admins</h1>

        <div class="actions">
            <a class="action btn btn-outline-info" href="<?php echo url_for('/staff/admins/new.php'); ?>">Create New Admin</a>
		</div>
			
        <div class="table-responsive">
            <table class="table list table-striped table-sm">
				<thead>
				    <tr>
				      <th scope="col">ID</th>
				      <th scope="col">First</th>
				      <th scope="col">Last</th>
				      <th scope="col">Email</th>
				      <th scope="col">Username</th>
				      <th scope="col">&nbsp;</th>
				      <th scope="col">&nbsp;</th>
				      <th scope="col">&nbsp;</th>
				    </tr>
                </thead>
				<tbody>

				  	<?php while($admin = mysqli_fetch_assoc($admin_set)) { ?>
				  		<tr>
						    <td><?php echo h($admin['id']); ?></td>
						    <td><?php echo h($admin['first_name']); ?></td>
                            <td><?php echo h($admin['last_name']); ?></td>
						    <td><?php echo h($admin['email']); ?></td>
						    <td><?php echo h($admin['username']); ?></td>
                            <td><a href="<?php echo url_for('/staff/admins/show.php?id=' . h(u($admin['id']))); ?>" class="action btn btn-sm btn-outline-info">View</a></td>
						    <td><a href="<?php echo url_for('/staff/admins/edit.php?id=' . h(u($admin['id']))); ?>" class="action btn btn-sm btn-outline-info">Edit</a></td>
						    <td><a href="<?php echo url_for('/staff/admins/delete.php?id=' . h(u($admin['id']))); ?>" class="action btn btn-sm btn-outline-info">Delete</a></td>
						</tr>
				  	<?php  } ?>
				    
				</tbody>
			</table>
            <?php mysqli_free_result($admin_set); ?>
		</div>
    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php') ?>
