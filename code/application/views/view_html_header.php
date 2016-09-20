<!doctype html>
<html lang="pt-BR">
	<head>
		<!-- Meta Tags -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="UTF-8" />
		<meta name="description" content="<?php echo $description; ?>" />
		<meta name="author" content="<?php echo $author; ?>" />
		<meta name="keywords" content="<?php echo $keywords; ?>" />
		
		<!-- Title -->
		<title><?php echo $title; ?></title>
		
		<!--[if lt IE 9]>
			<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
		<![endif]-->
		
		<!-- Link Tags -->
		<link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.png'); ?>" />
		<link rel='canonical' href='<?php echo base_url(); ?>' />
		
		<!-- Styles -->
		<link rel="stylesheet" href="<?php echo base_url('assets/styles/style.css'); ?>" type="text/css" />
		<link rel="stylesheet" href="<?php echo base_url('assets/styles/lightbox.css'); ?>" type="text/css" />
		
		<!-- JS for jQuery -->
		<script type="text/javascript">	var mysiteurl = "<?php echo base_url(); ?>"; </script>
		<script type='text/javascript' src='<?php echo base_url('assets/js/jquery.js'); ?>'></script>
	</head>
	<body class="<?php echo $body_class; ?>">
	