<?php  
	if (!isset($page_title)) $page_title = 'Staff Area';
?>

<!doctype html>

<html lang="en">
  <head>
    <title>GBI - <?php echo h($page_title); ?></title>
    <meta charset="utf-8">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo url_for('/stylesheets/staff.css'); ?>">
  </head>

  <body class="Site">

	<header>
		<h1>GBI Staff Area</h1>
	</header>

	<nav>
		<ul>
			<li>User: <?php echo $_SESSION['username'] ?? ''; ?></li>
			<li><a class="btn btn-outline-primary" href="<?php echo url_for('/staff/index.php'); ?>">Menu</a></li>
			<li><a class="btn btn-outline-primary" href="<?php echo url_for('/staff/logout.php'); ?>">Logout</a></li>
		</ul>
	</nav>

  <?php echo display_session_message(); ?>
