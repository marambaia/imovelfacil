<?php setlocale(LC_ALL, 'pt_BR'); ?>
<article>
	<div class="post clearfix" id="sobre-nos">
		<h1 class="post-title"><?php echo $item->nome; ?></h1>
		<div class="post-wrapper">
			<div class="post-details alt-details">
				<div class="post-date"><span>Atualizado em: </span><?php echo strftime ("%d de %B de %Y", strtotime($item->data_alteracao)); ?></div>
				<div class="post-author"><span>Escrito por: </span><?php echo $item->criador_titulo.' '.$item->criador_nome; ?></div>
			</div>
			<div class="clear"></div>
			<div class="post-content">
				<?php echo $item->descricao; ?>
			</div>
		</div>
		<div class="clearfix seperator"></div>
		<div class="clear"></div>
	</div>
</article>