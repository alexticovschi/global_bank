<?php  
	if (!isset($page_title)) $page_title = 'Staff Area';	
?>

<!doctype html>

<html lang="en">
  <head>
    <title>GBI - <?php echo h($page_title); ?></title>
    <meta charset="utf-8">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo url_for('/stylesheets/staff.css'); ?>">
  </head>

  <body class="Site">

	<header>
		<h1>GBI Staff Area</h1>
	</header>

	<nav>
		<ul>
			<li><a class="btn btn-outline-primary" href="<?php echo url_for('/staff/index.php'); ?>">Menu</a></li>
		</ul>
	</nav>