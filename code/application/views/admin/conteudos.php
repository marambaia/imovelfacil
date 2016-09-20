<div id="content">
<?php 
	foreach ($categorias as $categoria) {
		$array_categorias[$categoria->id_categoria] = $categoria->nome;
	}
	echo heading('Conteúdos Cadastrados ' . img(base_url('assets/images/novo.gif')), 2, 'class="divisor"');
	echo '<span class="validacoes">' . $this->session->flashdata('msg') . '</span>';
	$array_conteudos = array();
	foreach ($conteudos as $conteudo) {
		$push = array(
				anchor(
						base_url('admin/conteudos/excluir/' . $conteudo->id_conteudo), 
						img('assets/images/xis.gif'), 
						array('onclick' => "return confirm('Confirma a exclusão deste conteúdo?');")
				),
				anchor(
						base_url('admin/conteudos/editar/' . $conteudo->id_conteudo),
						img('assets/images/gear.gif')),
				$array_categorias[$conteudo->id_categoria],
				anchor(
						base_url('imoveis/' . $conteudo->slug),
						$conteudo->titulo,
						array('target' => '_blank')
				),
				word_limiter(wordwrap($conteudo->descricao, 30, "<br>\n", true), 3),
				$conteudo->autor,
				$conteudo->status,
				$conteudo->ordem,
		);
		array_push($array_conteudos, $push);
	}
	
	echo '<div class="wrapper_table">';
	$this->table->set_heading('Excluir', 'Editar', 'Pertence à', 'Título', 'Descrição', 'Autor', 'Status', 'Ordem');
	$template = array('table_open' => '<table>');
	$this->table->set_template($template);
	echo $this->table->generate($array_conteudos);
	echo '</div>';
	echo '<div id="paginacao">' . $paginacao . '</div>';
?>
</div>