<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>	
		<meta content="pt-br" http-equiv="Content-Language" />
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<title>Solicitação de visita encaminhada pelo website</title>
	</head>
	<body>
		<h4>Solicitação de visita encaminhada pelo website</h4>
		<table style="width: 100%">
			<tr>
				<td style="width: 145px">Nome:</td>
				<td><?php echo $nome; ?></td>
			</tr>
			<tr>
				<td style="width: 145px">E-mail:</td>
				<td><?php echo $email; ?></td>
			</tr>
			<tr>
				<td style="width: 145px">Telefone:</td>
				<td><?php echo $telefone; ?></td>
			</tr>
			<tr>
				<td style="width: 145px">Endereço:</td>
				<td><?php echo nl2br($texto); ?></td>
			</tr>
			<tr>
				<td style="width: 145px">Enviada em:</td>
				<td><?php echo date("d/m/Y H:i:s"); ?></td>
			</tr>
		</table>
	</body>
</html>