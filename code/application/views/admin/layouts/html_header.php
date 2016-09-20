<!DOCTYPE html>
<html lang="pt_BR">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Max Imóveis - Administração de conteúdo</title>
	<meta name="description" content="Max Imóveis - Administração de conteúdo">
	<meta name="author" content="Łukasz Holeczek">
	<meta name="keyword" content="Max Imóveis, Dashboard, Bootstrap, Admin">
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<?php 
		echo link_tag(array('href' => base_url('assets/admin/css/bootstrap.min.css'), 'rel' => 'stylesheet', 'type' => 'text/css'));
		echo link_tag(array('href' => base_url('assets/admin/css/bootstrap-responsive.min.css'), 'rel' => 'stylesheet', 'type' => 'text/css'));
		echo link_tag(array('href' => base_url('assets/admin/css/style.min.css'), 'rel' => 'stylesheet', 'type' => 'text/css'));
		echo link_tag(array('href' => base_url('assets/admin/css/style-responsive.min.css'), 'rel' => 'stylesheet', 'type' => 'text/css'));
		echo link_tag(array('href' => base_url('assets/admin/css/retina.css'), 'rel' => 'stylesheet', 'type' => 'text/css'));
		echo link_tag(array('href' => base_url('assets/admin/css/jquery.jcrop.css'), 'rel' => 'stylesheet', 'type' => 'text/css'));
		echo link_tag(array('href' => base_url('assets/admin/css/prettyPhoto.css'), 'rel' => 'stylesheet', 'type' => 'text/css', 'media' => 'screen', 'charset' => 'utf-8'));
	?>
	<!-- end: CSS -->
	

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="css/ie.css" rel="stylesheet">
	<![endif]-->
	
	<!--[if IE 9]>
		<link id="ie9style" href="css/ie9.css" rel="stylesheet">
	<![endif]-->
	
	<!-- start: Favicon and Touch Icons -->
	<?php 
		echo link_tag(array('href' => base_url('assets/admin/ico/apple-touch-icon-144-precomposed.png'), 'rel' => 'apple-touch-icon-precomposed', 'sizes' => '144x144'));
		echo link_tag(array('href' => base_url('assets/admin/ico/apple-touch-icon-72-precomposed.png'), 'rel' => 'apple-touch-icon-precomposed', 'sizes' => '72x72'));
		echo link_tag(array('href' => base_url('assets/admin/ico/apple-touch-icon-57-precomposed.png'), 'rel' => 'apple-touch-icon-precomposed'));
		echo link_tag(array('href' => base_url('assets/admin/ico/favicon.png'), 'rel' => 'shortcut icon'));
	?>
	<!-- end: Favicon and Touch Icons -->	
	
	<!-- start: Favicon and Touch Icons -->
	<?php 
		//echo '<script type="text/javascript" src="'.base_url('assets/admin/js/jquery.min.js').'"></script>';
		echo '<script type="text/javascript" src="'.base_url('assets/admin/js/jquery-1.10.2.min.js').'"></script>';
		echo '<script type="text/javascript" src="'.base_url('assets/admin/js/jquery.prettyPhoto.js').'"></script>';
		echo '<script type="text/javascript" src="'.base_url('assets/admin/js/jquery.jcrop.js').'"></script>';
	?>
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function(){
			$("td a[rel^='prettyPhoto']").prettyPhoto({theme:'pp_default', social_tools: false, default_width: '90%', default_height: '90%',});
		});
	</script>
	<!-- end: Javascript -->
	
</head>

<body style="<?php if (isset($style)) echo $style; ?>">