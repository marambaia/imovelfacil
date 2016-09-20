<div id="content">
<?php 
echo heading('Editar Detalhes ' . img(base_url('assets/images/novo.gif')), 2, 'class="divisor"');
$data = array('class' => 'formcadastros', 'id' => 'form_detalhes');
$hidden = array('id_conteudo' => $detalhes->id_conteudo, 'slug' => $slug);
echo form_open('admin/detalhes/alterar', $data, $hidden);			
	echo '<span class="validacoes">' . validation_errors() . '</span>';
	echo form_fieldset('Cadastrar detalhes: ' . $titulo_conteudo);
		echo '<p>';
			echo '<span>';
				echo form_label('Valor do Imóvel R$', 'preco');
				$data = array(
								'name' => 'preco', 
								'id' => 'preco', 
								'value' => $detalhes->preco, 
								'style' => 'width: 158px; margin-left: 20px;'
				);
				echo form_input($data);
			echo '</span>';
			echo '<span style="margin-left: 20px;">';
			echo form_label('Status', 'status');
			echo '<span style="margin-left: 14px; margin-right: 7px;">';
				echo form_radio('status', '1', TRUE);
				echo 'Ativo';
				echo form_radio('status', '0', FALSE);
				echo 'Inativo';
			echo '</span>';
			echo '<span>';
				echo form_label('Valor do IPTU R$', 'iptu');
				$data = array(
								'name' => 'iptu', 
								'id' => 'iptu', 
								'value' => $detalhes->iptu,
								'style' => 'width: 158px; margin-left: 20px;'
				);
				echo form_input($data);
			echo '</span>';
			echo '<span style="margin-left: 20px;">';
				echo form_label('Quant. de Quartos', 'quartos');
				$data = array(
								'name' => 'quartos', 
								'id' => 'quartos',
								'value' => $detalhes->quartos,
								'style' => 'width: 50px; margin-left: 20px; margin-right: 4px;'
				);
				echo form_input($data);
			echo '</span>';
			echo '<span>';
				echo form_label('Valor do Condomínio R$', 'condominio');
				$data = array(
								'name' => 'condominio', 
								'id' => 'condominio',
								'value' => $detalhes->condominio,
								'style' => 'width: 158px; margin-left: 20px;'
				);
				echo form_input($data);
			echo '</span>';
			echo '<span style="margin-left: 20px;">';
				echo form_label('Quant. de Banheiros', 'banheiros');
				$data = array(
								'name' => 'banheiros', 
								'id' => 'banheiros',
								'value' => $detalhes->banheiros, 
								'style' => 'width: 50px; margin-left: 20px; margin-right: 4px;'
				);
				echo form_input($data);
			echo '</span>';
			echo '<span>';
				echo form_label('Área Total', 'area_total');
				$data = array(
								'name' => 'area_total', 
								'id' => 'area_total', 
								'value' => $detalhes->area_total,
								'style' => 'width: 50px; margin-left: 20px; margin-right: 4px;'
				);
				echo form_input($data);
				echo 'm²';
			echo '</span>';
			echo '<span style="margin-left: 109px;">';
				echo form_label('Quant. de Suites', 'suites');
				$data = array(
								'name' => 'suites', 
								'id' => 'suites',
								'value' => $detalhes->suites, 
								'style' => 'width: 50px; margin-left: 20px; margin-right: 4px;'
				);
				echo form_input($data);
			echo '</span>';
			echo '<span>';
				echo form_label('Área Construída', 'area_construida');
				$data = array(
								'name' => 'area_construida', 
								'id' => 'area_construida',
								'value' => $detalhes->area_construida, 
								'style' => 'width: 50px; margin-left: 20px; margin-right: 4px;'
				);
				echo form_input($data);
				echo 'm²';
			echo '</span>';
			echo '<span style="margin-left: 109px;">';
				echo form_label('Vagas de Garagem', 'garagem');
				$data = array(
								'name' => 'garagem', 
								'id' => 'garagem',
								'value' => $detalhes->garagem, 
								'style' => 'width: 50px; margin-left: 20px; margin-right: 4px;'
				);
				echo form_input($data);
			echo '</span>';
			echo form_submit('btn_cadastro', 'Alterar');
		echo '</p>';
	echo form_fieldset_close();
echo form_close();
?>
</div>