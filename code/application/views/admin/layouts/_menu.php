<div class="span2" id="sidebar-left" style="display: block;">
	
	<div class="row-fluid actions">
		<input type="text" placeholder="..." class="search span12">
	</div>	
				
	<div class="nav-collapse sidebar-nav">

		<ul class="nav nav-tabs nav-stacked main-menu">

			<li><?php echo anchor(base_url('/admin/dashboard'), '<i class="icon-bar-chart"></i><span class="hidden-tablet"> Dashboard</span>'); ?></li>
			
			<li>
				<?php echo anchor('#', '<i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Páginas</span>', array('class' => 'dropmenu')); ?>
				<ul>
					<li><?php echo anchor(base_url('admin/paginas/cadastrar'), '<i class="icon-folder-open"></i><span class="hidden-tablet"> Cadastrar</span>', array('class' => 'submenu')); ?>
					<li><?php echo anchor(base_url('admin/paginas'), '<i class="icon-edit"></i><span class="hidden-tablet"> Editar</span>', array('class' => 'submenu')); ?>
				</ul>	
			</li>
			
			<li>
				<?php echo anchor('#', '<i class="icon-hdd"></i><span class="hidden-tablet"> Conteúdos</span>', array('class' => 'dropmenu')); ?>
				<ul>
					<li><?php echo anchor(base_url('admin/conteudos/cadastrar'), '<i class="icon-folder-open"></i><span class="hidden-tablet"> Cadastrar</span>', array('class' => 'submenu')); ?>
					<li><?php echo anchor(base_url('admin/conteudos'), '<i class="icon-edit"></i><span class="hidden-tablet"> Editar</span>', array('class' => 'submenu')); ?>
					<li><?php echo anchor(base_url('admin/conteudos/arquivos'), '<i class="icon-list-alt"></i><span class="hidden-tablet"> Arquivos</span>', array('class' => 'submenu')); ?>
				</ul>	
			</li>
			
			<li>
				<?php echo anchor('#', '<i class="icon-star"></i><span class="hidden-tablet"> Destaques</span>', array('class' => 'dropmenu')); ?>
				<ul>
					<li><?php echo anchor(base_url('admin/destaques/cadastrar'), '<i class="icon-picture"></i><span class="hidden-tablet"> Cadastrar</span>', array('class' => 'submenu')); ?>
					<li><?php echo anchor(base_url('admin/destaques'), '<i class="icon-edit"></i><span class="hidden-tablet"> Editar</span>', array('class' => 'submenu')); ?>
				</ul>	
			</li>
			
			
			<li>
				<?php echo anchor('#', '<i class="icon-eye-open"></i><span class="hidden-tablet"> Depoimentos</span>', array('class' => 'dropmenu')); ?>
				<ul>
					<li><?php echo anchor(base_url('admin/depoimentos/cadastrar'), '<i class="icon-folder-open"></i><span class="hidden-tablet"> Cadastrar</span>', array('class' => 'submenu')); ?>
					<li><?php echo anchor(base_url('admin/depoimentos'), '<i class="icon-edit"></i><span class="hidden-tablet"> Editar</span>', array('class' => 'submenu')); ?>
				</ul>	
			</li>
			
			<li>
				<?php echo anchor('#', '<i class="icon-hdd"></i><span class="hidden-tablet"> Opções</span>', array('class' => 'dropmenu')); ?>
				<ul>
					<li><?php echo anchor(base_url('admin/opcoes/cadastrar'), '<i class="icon-folder-open"></i><span class="hidden-tablet"> Cadastrar</span>', array('class' => 'submenu')); ?>
					<li><?php echo anchor(base_url('admin/opcoes'), '<i class="icon-edit"></i><span class="hidden-tablet"> Editar</span>', array('class' => 'submenu')); ?>
				</ul>	
			</li>
			
		</ul>
	
	</div>

</div>