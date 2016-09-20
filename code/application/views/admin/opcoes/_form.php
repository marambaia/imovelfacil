<?php 
	$id 	= null;
	$target = null;
	$hidden = array();
	if ( ! empty($editar->id_opcao) ) 
	{
		$id = $editar->id_opcao;
		$hidden = array('id_opcao' => $id);
		$target = 'admin/opcoes/editar/'.$id;
	}
	else 
	{
		$target = 'admin/opcoes/cadastrar';
	}
?>
<!-- start: Content -->
<div id="content" class="span10">
	<div class="row-fluid">
		<div class="box span12">
			<div class="box-header">
				<h2><i class="icon-edit"></i><?php echo empty($id)?'Cadastrar Opção':'Editar Opção'; ?></h2>
				<div class="box-icon">
					<a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
				</div>
			</div>
			<div class="box-content">
				<?php 
					$data = array('class' => 'form-horizontal', 'id' => 'form_pagina');
					echo form_open($target, $data, $hidden);
					
					$errors = validation_errors();
					if( ! empty($errors) )
						echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button>' . $errors . '</div>';
				?>
					<fieldset>
						<div class="control-group">
							<?php echo form_label('Nome', 'nome', array( 'class' => 'control-label' )); ?>
							<div class="controls">
								<?php
									$data = array('name' => 'nome', 'id' => 'nome', 'class' => 'input-xlarge focused', 'value' => empty($editar->nome)?'':$editar->nome);
									echo form_input($data);
								?>
							</div>
						</div>
						
						<div class="control-group">
							<?php echo form_label('Valor', 'valor', array( 'class' => 'control-label' )); ?>
							<div class="controls">
								<?php
									$data = array('name' => 'valor', 'id' => 'valor', 'class' => 'input-xlarge focused', 'value' => empty($editar->valor)?'':$editar->valor);
									echo form_input($data);
								?>
							</div>
						</div>
						
						<div class="control-group">
							<?php echo form_label('Ordem', 'ordem', array( 'class' => 'control-label' )); ?>
							<div class="controls">
								<?php
									$data = array('name' => 'ordem', 'id' => 'ordem', 'class' => 'input-mini focused', 'value' => empty($editar->ordem)?'':$editar->ordem);
									echo form_input($data);
								?>
							</div>
						</div>
												  
						<div class="form-actions">
							<?php echo form_submit('btn_enviar', "   Enviar   ", 'class="btn btn-primary"'); ?>
							<input type="reset" class="btn" value='Cancelar' />
						</div>
					</fieldset>
				<?php echo form_close(); ?>
			</div>
		</div><!--/span-->
	</div><!--/row-->
</div>
<!-- end: Content -->