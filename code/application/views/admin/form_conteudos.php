<div id="content">
	<?php 
		$array_categorias[0] = 'Escolha uma categoria';
		foreach ($categorias as $categoria) {
			$array_categorias[$categoria->id_categoria] = $categoria->nome;
		}
		
		echo heading('Cadastrar conteúdo - 1° Passo ' . img(base_url('assets/images/novo.gif')), 2, 'class="divisor"');
		
		$data = array('class' => 'formcadastros', 'id' => 'form_conteudo');
		$hidden = array('autor' => $autor);
		
		echo form_open('admin/conteudos/adicionar', $data, $hidden);			
			echo '<span class="validacoes">' . validation_errors() . '</span>';
			echo form_fieldset('Cadastrar conteudo');
			
			echo form_label('Título', 'titulo');
			$data = array('name' => 'titulo', 'id' => 'titulo');
			echo form_input($data);
			
			echo form_label('Slug', 'slug');
			$data = array('name' => 'slug', 'id' => 'slug');
			echo form_input($data);

			echo '<p>';
			echo '<span>';
			echo form_label('Pertence à', 'id_categoria');
			echo form_dropdown('id_categoria', $array_categorias, 0, 'class="input_md"');
			echo '</span>';
				
			echo '<span style="margin-left: 20px;">';
			echo form_label('Status', 'status');
			echo '<span style="margin-left: 14px; margin-right: 7px;">';
			echo form_radio('status', '1', TRUE);
			echo 'Ativo';
			echo form_radio('status', '0', FALSE);
			echo 'Inativo';
			echo '</span>';
			
			echo '<!--';
			echo '<span>';
			echo form_label('Valor R$', 'valor');
			$data = array('name' => 'valor', 'id' => 'valor', 'style' => 'width: 158px; margin-left: 20px;');
			echo form_input($data);
			echo '</span>';
			echo '-->';
			
			echo '<span>';
			echo form_label('Ordem', 'ordem');
			$data = array('name' => 'ordem', 'id' => 'ordem', 'style' => 'width: 50px; margin-left: 20px; margin-right: 4px;');
			echo form_input($data);
			echo '</span>';
			echo '</p>';
			
			echo form_label('Descrição', 'descricao');
			$data = array('name' => 'descricao', 'id' => 'descricao');
			echo form_textarea($data);
			
			echo form_submit('btn_cadastro', 'Próximo passo');
			
			echo form_fieldset_close();
		echo form_close();
	?>
</div>