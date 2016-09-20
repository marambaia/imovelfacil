<script type="text/javascript">
$( document ).ready( function() {
	$('#tipo').change(function(){
		var tipo = $('#tipo').val();
		switch ( tipo ) {
		case "destaque_img":
			$('#imagem').fadeIn(2000);
		break;
		}
	});	
});
</script>
<div id="content">
<?php 
	foreach ($conteudos as $conteudo) 
	{
		$array_conteudos[$conteudo->id_conteudo] = $conteudo->titulo;
	}
	echo heading('Destaques Cadastrados ' . img(base_url('assets/images/novo.gif')), 2, 'class="divisor"');
	$array_arquivos = array();
	foreach ($arquivos as $arquivo) {
		$push = array(
				anchor(
						base_url('admin/arquivos/excluir/' . $arquivo->id_arquivo), 
						img('assets/images/xis.gif'), 
						array('onclick' => "return confirm('Confirma a exclusão deste arquivo?');")
				),
				anchor(
						base_url('admin/arquivos/editar/' . $arquivo->id_arquivo),
						img('assets/images/gear.gif')),
				$array_conteudos[$arquivo->id_conteudo],
				$arquivo->tipo,
				img(base_url('conteudo/'.$arquivo->tipo.'/'.$arquivo->nome.'_50x50'.$arquivo->extensao)),
		);
		array_push($array_arquivos, $push);
	}
	
	echo '<div class="wrapper_table">';
	$this->table->set_heading('Excluir', 'Editar', 'Pertence à', 'Tipo', 'Preview');
	$template = array('table_open' => '<table>');
	$this->table->set_template($template);
	echo $this->table->generate($array_arquivos);
	echo '</div>';
?>
</div>