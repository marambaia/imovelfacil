<?php 
	echo doctype('html5');
	echo '<html>';
	echo '<head>';
	echo '<title>Página não encontrada</title>';
	$meta = array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv');
	echo meta($meta);
	echo link_tag(array('href' => 'assets/css/formatacao.css', 'rel' => 'stylesheet', 'type' => 'text/css'));
	echo '<head>';
?>
<body>
	<h2>HTTP Error 404!</h2>
	<hr />
	<h3>A página solicitada não foi encontrada</h3>
	<a href="javascript:history.go(-1)">Voltar</a> | <?php echo anchor(base_url(), 'Home'); ?>
</body>
</html>