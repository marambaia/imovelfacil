<div class="span10" id="content" style="min-height: 565px;">
	<div class="row-fluid">
		<div class="box span12">
			<div data-original-title="" class="box-header">
				<h2><i class="icon-list-alt"></i><span class="break"></span>Opções do Sistema</h2>
				<div class="box-icon">
					<a class="btn-minimize" href="#"><i class="icon-chevron-up"></i></a>
				</div>
			</div>
			<div class="box-content">
			
				<?php 
					$success = $this->session->flashdata('msg');
					if ( ! empty($success) )
					{
						echo '<div class="alert alert-success">' .
							 '<button type="button" class="close" data-dismiss="alert">×</button>' .
							 $success . 
							 '</div>';
					}
					$error = $this->session->flashdata('msg_error');
					if ( ! empty($error) )
					{
						echo '<div class="alert alert-error">' . 
							 '<button type="button" class="close" data-dismiss="alert">×</button>' .
							 $error .
							 '</div>';
					}
				?>
			
				<div role="grid" class="dataTables_wrapper" id="DataTables_Table_0_wrapper">
					<?php 
						$array_opcoes = array();
						foreach ($opcoes as $opcao) {
													
							$push = array(
									$opcao->nome,
									ellipsize($opcao->valor, 30, .5),
									$opcao->ordem,
									$opcao->autor,
									anchor(
										base_url('admin/opcoes/ver/'. $opcao->id_opcao . '/?iframe=true&width=65%&height=55%'),
										'<i class="icon-zoom-in "></i>',
										array( 'class' => 'btn btn-success', 'rel' => 'prettyPhoto')
									) .' '.
									anchor(
										base_url('admin/opcoes/editar/' . $opcao->id_opcao),
										'<i class="icon-edit "></i>',
										array( 'class' => 'btn btn-info')
									) .' '.
									anchor(
										base_url('admin/opcoes/excluir/' . $opcao->id_opcao),
										'<i class="icon-trash "></i>',
										array( 'class' => 'btn btn-danger', 'onclick' => "return confirm('Confirma a exclusão deste ítem?');")
									)
							);
							array_push($array_opcoes, $push);
						}
						echo '<div class="wrapper_table">';
						$this->table->set_heading('Nome', 'Valor', 'Ordem', 'Autor', 'Ações');
						$template = array(
							'table_open' => '<table class="table table-striped table-bordered bootstrap-datatable datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">',
					
							'heading_row_start'   => '<tr role="row">',
							'heading_row_end'     => '</tr>',
							'heading_cell_start'  => '<th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">',
							'heading_cell_end'    => '</th>',
					
							'row_start'           => '<tr class="odd">',
							'row_end'             => '</tr>',
							'cell_start'          => '<td nowrap="nowrap">',
							'cell_end'            => '</td>',
							
							'row_alt_start'       => '<tr class="even">',
							'row_alt_end'         => '</tr>',
							'cell_alt_start'      => '<td nowrap="nowrap">',
							'cell_alt_end'        => '</td>',
							
							'table_close'         => '</table>'
						);
						$this->table->set_template($template);
						echo $this->table->generate($array_opcoes);
						echo '</div>';
					?>
				</div>
			</div>
		</div><!--/span-->
	</div><!--/row-->
</div>