<div class="span10" id="content" style="min-height: 565px;">
	<div class="row-fluid">
		<div class="box span12">
			<div data-original-title="" class="box-header">
				<h2><i class="icon-envelope"></i><span class="break"></span>Mensagens</h2>
				<div class="box-icon">
					<a class="btn-minimize" href="#"><i class="icon-chevron-up"></i></a>
				</div>
			</div>
			<div class="box-content">
				<div role="grid" class="dataTables_wrapper" id="DataTables_Table_0_wrapper">
					<?php 
						$array_paginas = array();
						foreach ($paginas as $pagina) {
							switch ($pagina->nivel_exibicao) {
								case 1:
									$pagina->nivel_exibicao = 'Menu Destaques';
								break;
								case 2:
									$pagina->nivel_exibicao = 'Menu Principal';
								break;
								case 3:
									$pagina->nivel_exibicao = 'Menu lateral';
								break;
								case 4:
									$pagina->nivel_exibicao = 'Submenu';
								break;
								case 5:
									$pagina->nivel_exibicao = 'Nenhum';
									break;
								default:
									$pagina->nivel_exibicao = 'Nenhum';
								break;
							}
							
							if ($pagina->status === '1') {
								$pagina->status = '<span class="label label-success">Ativo</span>';
							} else {
								$pagina->status = '<span class="label">Inativo</span>';
							}
							
							$push = array(
									$pagina->nome,
									$pagina->slug,
									ellipsize($pagina->descricao, 30, .5),
									$pagina->status,
									$pagina->ordem,
									$pagina->nivel_exibicao,
									anchor(
										base_url('admin/paginas/ver/' . $pagina->id_pagina),
										'<i class="icon-zoom-in "></i>',
										array( 'class' => 'btn btn-success')
									) .' '.
									anchor(
										base_url('admin/paginas/editar/' . $pagina->id_pagina),
										'<i class="icon-edit "></i>',
										array( 'class' => 'btn btn-info')
									) .' '.
									anchor(
										base_url('admin/paginas/excluir/' . $pagina->id_pagina),
										'<i class="icon-trash "></i>',
										array( 'class' => 'btn btn-danger', 'onclick' => "return confirm('Confirma a exclusão desta pagina?');")
									)
							);
							array_push($array_paginas, $push);
						}
						echo '<div class="wrapper_table">';
						$this->table->set_heading('Página', 'Slug', 'Descrição', 'Status', 'Ordem', 'Exibida em', 'Ações');
						$template = array(
							'table_open' => '<table class="table table-striped table-bordered bootstrap-datatable datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">',
					
							'heading_row_start'   => '<tr role="row">',
							'heading_row_end'     => '</tr>',
							'heading_cell_start'  => '<th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">',
							'heading_cell_end'    => '</th>',
					
							'row_start'           => '<tr class="odd">',
							'row_end'             => '</tr>',
							'cell_start'          => '<td>',
							'cell_end'            => '</td>',
							
							'row_alt_start'       => '<tr class="even">',
							'row_alt_end'         => '</tr>',
							'cell_alt_start'      => '<td>',
							'cell_alt_end'        => '</td>',
							
							'table_close'         => '</table>'
						);
						$this->table->set_template($template);
						echo $this->table->generate($array_paginas);
						echo '</div>';
					?>
				</div>
			</div>
		</div><!--/span-->
	</div><!--/row-->
</div>