<?php 
	echo heading('Detalhes Cadastrados ' . img(base_url('assets/images/novo.gif')), 2, 'class="divisor"');
	$array_detalhes = array();
	foreach ($detalhes as $detalhe) 
	{
		$push = array(
				anchor(
						base_url('admin/detalhes/excluir/' . $detalhe->id_detalhe.'/'.$slug), 
						img('assets/images/xis.gif'), 
						array('onclick' => "return confirm('Confirma a exclusão deste item?');")
				),
				anchor(
						base_url('admin/detalhes/editar/' . $detalhe->id_detalhe.'/'.$slug),
						img('assets/images/gear.gif')
				),
				$detalhe->preco,
				$detalhe->iptu,
				$detalhe->condominio,
				$detalhe->quartos,
				$detalhe->banheiros,
				$detalhe->suites,
				$detalhe->garagem,
				$detalhe->area_construida,
				$detalhe->area_total,
				$detalhe->status
		);
		array_push($array_detalhes, $push);
	}
	
	echo '<div class="wrapper_table">';
	$this->table->set_heading(
								'Excluir', 
								'Editar', 
								'Preço',
								'IPTU',
								'Condomínio',
								'Quartos', 
								'Banheiros', 
								'Suites', 
								'Garagem', 
								'Área Construída', 
								'Área Total', 
								'Status'
			);
	$template = array('table_open' => '<table>');
	$this->table->set_template($template);
	echo $this->table->generate($array_detalhes);
	echo '</div>';
?>
</div>