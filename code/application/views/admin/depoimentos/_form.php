<?php 
	$id 	= null;
	$target = null;
	$hidden = array();
	if ( ! empty($editar->id_depoimento) ) 
	{
		$id = $editar->id_depoimento;
		$hidden = array('id_depoimento' => $id);
		$target = 'admin/depoimentos/editar/'.$id;
	}
	else 
	{
		$target = 'admin/depoimentos/cadastrar';
	}
?>
<!-- start: Content -->
<div id="content" class="span10">
	<div class="row-fluid">
		<div class="box span12">
			<div class="box-header">
				<h2><i class="icon-edit"></i><?php echo empty($id)?'Cadastrar Depoimento':'Editar Depoimento'; ?></h2>
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
							<?php echo form_label('Autor', 'autor', array( 'class' => 'control-label' )); ?>
							<div class="controls">
								<?php
									$data = array('name' => 'autor', 'id' => 'autor', 'class' => 'input-xlarge focused', 'value' => empty($editar->autor)?'':$editar->autor);
									echo form_input($data);
								?>
							</div>
						</div>
						
						<div class="control-group">
							<?php echo form_label('E-mail', 'email', array( 'class' => 'control-label' )); ?>
							<div class="controls">
								<?php
									$data = array('name' => 'email', 'id' => 'email', 'class' => 'input-xlarge focused', 'value' => empty($editar->email)?'':$editar->email);
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
						
						<div class="control-group">
							<?php echo form_label('Status', 'status', array( 'class' => 'control-label' )); ?>
							<div class="controls">
								<label class="radio">
									<?php 
										echo form_radio('status', '1', (!empty($editar->status)) && ($editar->status==1) ? true:false);
										echo 'Ativo';
									?>
								</label>
								<div style="clear:both"></div>
								<label class="radio">
									<?php 
										echo form_radio('status', '0', (empty($editar->status)) || ($editar->status==0) ? true:false);
										echo 'Inativo';
									?>
								</label>
							</div>
						</div>	
						
						<div class="control-group hidden-phone">
							<?php echo form_label('Depoimento', 'texto', array( 'class' => 'control-label' )); ?>
							<div class="controls">
								<?php 
									$data = array( 'name' => 'texto', 'id' => 'texto', 'class' => 'cleditor', 'rows' => '3', 'value' => empty($editar->texto)?'':$editar->texto );
									echo form_textarea($data);
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