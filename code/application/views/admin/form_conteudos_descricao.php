<div id="content">
<?php 
	echo heading('Cadastrar conteúdo - 2° Passo ' . img(base_url('assets/images/novo.gif')), 2, 'class="divisor"');
	$hidden = array('id_conteudo' => $id_conteudo);
	$data = array('class' => 'formcadastros', 'id' => 'form_conteudo');
	echo form_open_multipart('admin/conteudos/adicionar_descricao/'.$slug, $data, $hidden);
		echo '<span class="validacoes">' . validation_errors() . '</span>';
		echo form_fieldset('Cadastrar conteudo');
			echo '<p>';
				echo '<span>';
					
					echo form_label('Imagem','userfile');
					$data = array('name'	=>	'userfile', 'id'	=>	'userfile');
					echo form_upload($data);
					
					//$data = array(
					//		'name' => 'btn_arquivos',
					//		'id' => 'btn_arquivos',
					//		'class' => 'input_md',
					//		'value' => 'true',
					//		'type' => 'button',
					//		'content' => 'Escolha um arquivo'
					//);
					//echo form_button($data);
				echo '</span>';
				echo '<div id="cortar_imagem" style="margin-top: 20px; margin-bottom: 20px;">';
					echo img(array('src' => base_url('fotos/catedral.jpg'), 'class' => 'jcrop', 'style' => 'max-width: 800px; margin-top: 20px;'));
				echo '</div>';
				echo '<div id="cortar_imagem" style="margin-top: 20px; margin-bottom: 20px;">';
					echo img(array('src' => base_url('conteudo/img/CARRIAGE-HOUSE-2-676x290.jpg'), 'class' => 'jcrop', 'style' => 'max-width: 800px; margin-top: 20px;'));
				echo '</div>';
			echo '</p>';
			echo form_label('Descrição', 'descricao');
			$data = array('name' => 'descricao', 'id' => 'descricao');
			echo form_textarea($data);
			echo form_submit('btn_cadastro', 'Finalizar');
		echo form_fieldset_close();
	echo form_close();
?>
<script type="text/javascript">
$(function(){ 
	$('.jcrop').Jcrop({
			aspectRatio: 1
	}); 
});
</script>