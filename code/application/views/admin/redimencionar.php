<div id="content">
	<?php
		echo heading('Redimencionar imagem' . img(base_url('assets/images/novo.gif')), 2, 'class="divisor"');
		$data = array('class' => 'formcadastros', 'id' => 'form_redimencionar');
		echo form_open_multipart('admin/arquivos/crop', $data);
			echo '<input type="hidden" name="tipo" id="tipo" value="'.$tipo.'">';
			echo '<input type="hidden" name="nome" id="nome" value="'.$nome.'">';
			echo '<input type="hidden" name="extensao" id="extensao" value="'.$extensao.'">';
			echo '<input type="hidden" name="x" id="x" value="" />';
			echo '<input type="hidden" name="y" id="y" value="" />';
			echo '<input type="hidden" name="x2" id="x2" value="" />';
			echo '<input type="hidden" name="y2" id="y2" value="" />';
			echo '<input type="hidden" name="w" id="w" value="" />';
			echo '<input type="hidden" name="h" id="h" value="" />';
			echo '<span class="validacoes">' . validation_errors() . '</span>';
			echo '<span class="validacoes">' . $this->session->flashdata('msg') . '</span>';
			echo form_fieldset('Redimencionar imagem');
				$data = array(
						'src' => base_url($path),
						'class' => '',
						'id' => 'jcrop',
				);
				echo img($data);
			echo form_submit('btn_inserir', 'Gravar');
		echo form_fieldset_close();
	echo form_close();
?>
</div>
<script type="text/javascript">
function setCoords(c) {
    jQuery('#x').val(c.x);
    jQuery('#y').val(c.y);
    jQuery('#x2').val(c.x2);
    jQuery('#y2').val(c.y2);
    jQuery('#w').val(c.w);
    jQuery('#h').val(c.h);
}
$(function(){ 
	$('#jcrop').Jcrop({
		onChange: setCoords,
		onSelect: setCoords,
		setSelect: [ 205, 205, 155, 155 ],
		minSize: [205, 155],
		maxSize: [656, <?php echo $altura; ?>],
		aspectRatio: 41 / 31
	}); 
});
</script>