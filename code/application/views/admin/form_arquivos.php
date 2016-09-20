<script type="text/javascript">
$( document ).ready( function() {
	$('#tipo').change(function(){
		var tipo = $('#tipo').val();
		if ( tipo == "destaques" ) {
			$('#pertence_a').fadeOut(0);
			$('#destaque').fadeIn(0);
		}
	});	
});
</script>
<div id="content">
<?php
	$array_conteudos[0] = 'Escolha um conteúdo';
	foreach ($conteudos as $conteudo) {
		$array_conteudos[$conteudo->id_conteudo] = $conteudo->titulo;
	}

	echo heading('Inserir arquivos - 2° Passo ' . img(base_url('assets/images/novo.gif')), 2, 'class="divisor"');

	$data = array('class' => 'formcadastros', 'id' => 'form_arquivo');
	echo form_open_multipart('admin/arquivos/adicionar', $data);
		echo '<span class="validacoes">' . validation_errors() . '</span>';
		echo '<span class="validacoes">' . $this->session->flashdata('msg') . '</span>';
		echo form_fieldset('Inserir arquivos');
		
			echo '<p>';
			echo form_label('Tipo', 'tipo');
			$array_tipos = array(
					'0' 	 	=> 'Escolha um tipo',
					'docs' 	 	=> 'Documentos',
					'imgs'		=> 'Imagens',
					'destaques'	=> 'Imagens do Destaque',
					'videos' 	=> 'Videos & Banners',
			);
			echo form_dropdown('tipo', $array_tipos, '0', 'class="input_md" id="tipo"');
			echo '</p>';

			echo '<p id="pertence_a">';
			echo form_label('Pertence à', 'id_conteudo');
			echo form_dropdown('id_conteudo', $array_conteudos, '0', 'class="input_md"');
			echo '</p>';
			
			echo '<p id="destaque" style="display:none;">';
				echo form_label('titulo_destaque', 'titulo_destaque');
				$data = array('name' => 'titulo_destaque', 'id' => 'titulo_destaque');
				echo form_input($data);
				
				echo form_label('texto_destaque', 'texto_destaque');
				$data = array('name' => 'texto_destaque', 'id' => 'texto_destaque');
				echo form_input($data);
			echo '</p>';
			
			echo '<p>';
			echo form_label('Arquivos & Imagens', 'userfile');
			$data = array('name' => 'userfile', 'id' => 'userfile');
			echo form_upload($data);
			echo '</p>';
			
			echo form_submit('btn_inserir', 'Gravar');
		echo form_fieldset_close();
	echo form_close();
?>