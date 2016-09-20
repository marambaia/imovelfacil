<?php setlocale(LC_ALL, 'pt_BR'); ?>
<div id="content">
	<div class="row-fluid">
		<div class="box span5" onTablet="span7" onDesktop="span5">
			<div class="box-header">
				<h2><i class="icon-wrench"></i>Opções do Sistema</h2>
				<div class="box-icon">
					<a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
				</div>
			</div>
			<div class="box-content">
				<div>
					<strong style="margin-left: 70px;">Título:</strong> <a href="#" style="margin-left: 7px;"><?php echo $opcao->nome; ?></a><br>
					<strong style="margin-left: 64px;">Ordem:</strong> <span style="margin-left: 7px;"><?php echo $opcao->ordem; ?></span><br>
					<strong style="margin-left: 71px;">Autor:</strong><span style="margin-left: 7px;"><?php echo $opcao->autor; ?></span><br>
					<strong style="margin-left: 74px;">Valor:</strong><div style="margin-left: 120px; margin-top: -20px"><?php echo $opcao->valor; ?></div>
					<strong style="margin-left: 4px;">Última alteração:</strong> <span style="margin-left: 2px;"><?php echo strftime ("%d de %B de %Y", strtotime($opcao->data_alteracao)); ?></span><br>
				</div>
			</div>
		</div><!--/span-->
	</div>
</div>