<?php 
# Set PHP's internal character encoding to UTF-8
mb_internal_encoding('UTF-8');

# Set the character encoding to UTF-8 for all page output
header('Content-type: text/html; charset=UTF-8'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?= $title ?></title>
	<link rel="stylesheet" type="text/css" href="<?= $base_url ?>less/animation.css">
	<link rel="stylesheet" type="text/css" href="<?= $base_url ?>less/form.css">
	<script type="text/javascript" src="<?= $base_url ?>js/jquery.js"></script>
	<script type="text/javascript" src="<?= $base_url ?>js/jquery.address.js"></script>
	<script type="text/javascript" src="<?= $base_url ?>js/jquery.url.js"></script>
	<script type="text/javascript" src="<?= $base_url ?>js/song.js"></script>
</head>
<body>
<div id="animation-wrapper" style="display:block;">
	<div class="animation">
		<div class="circle one"></div>
		<div class="circle two"></div>
	</div>
</div>
<div id="pagewrapper">
	<div id="content" class="clearfix" style="display:none;">
	</div>
	<div id="footer">
		<div class="content">
		</div>
	</div>
</div>
</body>
</html>