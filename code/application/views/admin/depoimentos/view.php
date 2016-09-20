<?php setlocale(LC_ALL, 'pt_BR'); ?>
<div id="content">
	<div class="row-fluid">
		<div class="box span5" onTablet="span7" onDesktop="span5">
			<div class="box-header">
				<h2><i class="icon-wrench"></i>Depoimentos</h2>
				<div class="box-icon">
					<a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
				</div>
			</div>
			<div class="box-content">
				<div>
					<strong style="margin-left: 70px;">Autor:</strong> <a href="#" style="margin-left: 7px;"><?php echo $depoimento->autor; ?></a><br>
					<strong style="margin-left: 70px;">E-mail:</strong> <a href="#" style="margin-left: 7px;"><?php echo $depoimento->email; ?></a><br>
					<strong style="margin-left: 64px;">Ordem:</strong> <span style="margin-left: 7px;"><?php echo $depoimento->ordem; ?></span><br>
					<strong style="margin-left: 30px;">Depoimento:</strong>
					
					<div style="margin-left: 120px; margin-top: -20px">
					<blockquote>
						<p><?php echo $depoimento->texto; ?></p>
						<small>Escrito por: <cite title=""><?php echo $depoimento->autor; ?></cite></small>
					</blockquote>
					</div>
					<?php 
						if ( ! empty($depoimento->status) && $depoimento->status == 1 ):
							$depoimento->status = '<span class="label label-success">Ativo</span>';
						else: 
							$depoimento->status = '<span class="label">Inativo</span>';
						endif;
					?>
					<strong style="margin-left: 69px;">Status:</strong><span style="margin-left: 7px;"><?php echo $depoimento->status; ?></span><br>
					<strong style="margin-left: 4px;">Última alteração:</strong> <span style="margin-left: 2px;"><?php echo strftime ("%d de %B de %Y", strtotime($depoimento->data_alteracao)); ?></span><br>
				</div>
			</div>
		</div><!--/span-->
	</div>
</div>