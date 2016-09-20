<?php 
	$id 	= null;
	$target = null;
	$hidden = array();
	if ( ! empty($editar->id_pagina) ) 
	{
		$id = $editar->id_pagina;
		$hidden = array('id_pagina' => $id);
		$target = 'admin/paginas/editar/'.$id;
	}
	else 
	{
		$target = 'admin/paginas/cadastrar';
	}
?>
<!-- start: Content -->
<div id="content" class="span10">
	<div class="row-fluid">
		<div class="box span12">
			<div class="box-header">
				<h2><i class="icon-edit"></i><?php echo empty($id)?'Cadastrar Página':'Editar Página'; ?></h2>
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
							<?php echo form_label('Slug', 'slug', array( 'class' => 'control-label' )); ?>
							<div class="controls">
								<?php
									$data = array('name' => 'slug', 'id' => 'slug', 'class' => 'input-xlarge focused', 'value' => empty($editar->slug)?'':$editar->slug);
									echo form_input($data);
								?>
							</div>
						</div>
						
						<div class="control-group">
							<?php echo form_label('Exibida em', 'nivel_exibicao', array( 'class' => 'control-label' )); ?>
							<div class="controls">
								<?php 
									$options = array(
													'0' => 'Escolha uma área', 
													'1' => 'Menu destaques', 
													'2' => 'Menu principal', 
													'3' => 'Menu lateral', 
													'4' => 'Submenu',
													'5' => 'Nenhum',
									);
									echo form_dropdown('nivel_exibicao', $options, empty($editar->nivel_exibicao)?'0':$editar->nivel_exibicao);
								?>
							</div>
						</div>
						
						<div class="control-group">
							<?php echo form_label('Pertence à', 'filho_de', array( 'class' => 'control-label' )); ?>
							<div class="controls">
								<?php
									$lista = array('0' => 'Escolha uma pagina');
									foreach ($paginas as $pagina) {
										$lista[$pagina->id_pagina] = $pagina->nome;
									}
									echo form_dropdown('filho_de', $lista, empty($editar->filho_de)?'0':$editar->filho_de);
								?>
							</div>
						</div>
						
						<div class="control-group">
							<?php echo form_label('Status', 'status', array( 'class' => 'control-label' )); ?>
							<div class="controls">
								<label class="radio">
									<?php 
										echo form_radio('status', '1', TRUE);
										echo 'Ativo';
									?>
								</label>
								<div style="clear:both"></div>
								<label class="radio">
									<?php 
										echo form_radio('status', '0', FALSE);
										echo 'Inativo';
									?>
								</label>
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
						
						<div class="control-group hidden-phone">
							<?php echo form_label('Descrição', 'descricao', array( 'class' => 'control-label' )); ?>
							<div class="controls">
								<?php 
									$data = array( 'name' => 'descricao', 'id' => 'descricao', 'class' => 'cleditor', 'rows' => '3', 'value' => empty($editar->descricao)?'':$editar->descricao );
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