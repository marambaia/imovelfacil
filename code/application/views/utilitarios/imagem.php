<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Manipulando imagens com CodeIgniter</title>
	</head>
	<body>
		<div id="container">
			<h1>Manipulando imagens com CodeIgniter</h1>
			<div id="body">
				<?php 
					echo img(base_url('fotos/catedral_thumb.jpg'));
					echo img(base_url('fotos/catedral_rotated.jpg'));
					echo img(base_url('fotos/marked_catedral_thumb.jpg'));
					echo img(base_url('fotos/overlay_catedral_thumb.jpg'));
				?>
			</div>
			<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
		</div>
	</body>
</html>