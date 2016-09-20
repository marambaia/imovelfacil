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
	echo heading('Cadastrar Destaque ' . img(base_url('assets/images/novo.gif')), 2, 'class="divisor"');
	$data = array('class' => 'formcadastros', 'id' => 'form_arquivo');
	echo form_open_multipart('admin/arquivos/adicionar', $data);
		echo '<span class="validacoes">' . validation_errors() . '</span>';
		echo '<span class="validacoes">' . $this->session->flashdata('msg') . '</span>';
		echo form_fieldset('Inserir destaques');
			echo '<div id="imagem">';
				echo '<p>';
					echo form_label('Título do Destaque', 'titulo_destaque');
					$data = array('name' => 'titulo_destaque', 'id' => 'titulo_destaque');
					echo form_input($data);
				echo '</p>';
				echo '<p>';
					echo form_label('Texto do Destaque', 'texto_destaque');
					$data = array('name' => 'texto_destaque', 'id' => 'texto_destaque');
					echo form_input($data);
				echo '</p>';
				echo '<p>';
					echo form_label('Imagens do Destaque', 'userfile');
					$data = array('name' => 'userfile', 'id' => 'userfile');
					echo form_upload($data);
				echo '</p>';
			echo '</div>';
			
			echo form_submit('btn_inserir', 'Gravar');
		echo form_fieldset_close();
	echo form_close();
?>