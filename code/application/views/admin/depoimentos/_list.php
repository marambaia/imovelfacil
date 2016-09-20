<div class="span10" id="content" style="min-height: 565px;">
	<div class="row-fluid">
		<div class="box span12">
			<div data-original-title="" class="box-header">
				<h2><i class="icon-list-alt"></i><span class="break"></span>Depoimentos</h2>
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
						$array_depoimentos = array();
						foreach ($depoimentos as $depoimento) 
						{
							if ( ! empty($depoimento->status) && $depoimento->status == 1 )
								$depoimento->status = '<span class="label label-success">Ativo</span>';
							else
								$depoimento->status = '<span class="label">Inativo</span>';
							
							$push = array(
									$depoimento->autor,
									$depoimento->ordem,
									ellipsize($depoimento->texto, 30, .5),
									$depoimento->status,
									date('d/m/Y', strtotime($depoimento->data_alteracao)),
									anchor(
										base_url('admin/depoimentos/ver/'. $depoimento->id_depoimento . '/?iframe=true&width=65%&height=70%'),
										'<i class="icon-zoom-in "></i>',
										array( 'class' => 'btn btn-success', 'rel' => 'prettyPhoto')
									) .' '.
									anchor(
										base_url('admin/depoimentos/editar/' . $depoimento->id_depoimento),
										'<i class="icon-edit "></i>',
										array( 'class' => 'btn btn-info')
									) .' '.
									anchor(
										base_url('admin/depoimentos/excluir/' . $depoimento->id_depoimento),
										'<i class="icon-trash "></i>',
										array( 'class' => 'btn btn-danger', 'onclick' => "return confirm('Confirma a exclusão deste depoimento?');")
									)
							);
							array_push($array_depoimentos, $push);
						}
						echo '<div class="wrapper_table">';
						$this->table->set_heading('Autor','Ordem', 'Depoimento', 'Status', 'Data', 'Ações');
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
						echo $this->table->generate($array_depoimentos);
						echo '</div>';
					?>
				</div>
			</div>
		</div><!--/span-->
	</div><!--/row-->
</div>