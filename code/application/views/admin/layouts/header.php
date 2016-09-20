<div class="navbar">
	<div class="navbar-inner">
		<div class="container-fluid">
			<a data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse" data-toggle="collapse" class="btn btn-navbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="hidden-phone open" id="main-menu-toggle"><i class="icon-reorder"></i></a>		
			<div class="row-fluid">
				<?php echo anchor(base_url('/admin/dashboard/'), '<span> '.TITLE.' </span>', array('class' => 'brand span2'))?>
			</div>
			<!-- start: Header Menu -->
			<div class="nav-no-collapse header-nav">
				<ul class="nav pull-right">
					<li class="dropdown hidden-phone">
						<a href="#" data-toggle="dropdown" class="btn dropdown-toggle">
							<i class="icon-envelope"></i>
						</a>
						<ul class="dropdown-menu notifications">
							<li class="dropdown-menu-title">
 								<span>Você tem 11 mensagens</span>
							</li>	
                            <li>
								<a href="#">
									<span class="icon blue"><i class="icon-user"></i></span>
									<span class="message">New user registration</span>
									<span class="time">1 min</span> 
								</a>
							</li>
							<li>
								<a href="#">
									<span class="icon green"><i class="icon-comment-alt"></i></span>
									<span class="message">New comment</span>
									<span class="time">7 min</span> 
								</a>
							</li>
							<li>
								<a href="#">
									<span class="icon green"><i class="icon-comment-alt"></i></span>
									<span class="message">New comment</span>
									<span class="time">8 min</span> 
								</a>
							</li>
							<li>
								<a href="#">
									<span class="icon green"><i class="icon-comment-alt"></i></span>
									<span class="message">New comment</span>
									<span class="time">16 min</span> 
								</a>
							</li>
							<li>
                            	<a href="#">
									<span class="icon blue"><i class="icon-user"></i></span>
									<span class="message">New user registration</span>
									<span class="time">36 min</span> 
								</a>
							</li>
							<li>
                            	<a href="#">
									<span class="icon yellow"><i class="icon-shopping-cart"></i></span>
									<span class="message">2 items sold</span>
									<span class="time">1 hour</span> 
								</a>
							</li>
							<li class="warning">
                            	<a href="#">
									<span class="icon red"><i class="icon-user"></i></span>
									<span class="message">User deleted account</span>
									<span class="time">2 hour</span> 
								</a>
							</li>
							<li class="warning">
                            	<a href="#">
									<span class="icon red"><i class="icon-shopping-cart"></i></span>
									<span class="message">Transaction was canceled</span>
									<span class="time">6 hour</span> 
								</a>
							</li>
							<li>
                            	<a href="#">
									<span class="icon green"><i class="icon-comment-alt"></i></span>
									<span class="message">New comment</span>
									<span class="time">yesterday</span> 
								</a>
							</li>
							<li>
                            	<a href="#">
									<span class="icon blue"><i class="icon-user"></i></span>
									<span class="message">New user registration</span>
									<span class="time">yesterday</span> 
								</a>
							</li>
							<li class="dropdown-menu-sub-footer">
								<?php echo anchor(base_url('/admin/dashboard'), 'Ver todas as mensagens')?>
							</li>	
						</ul>
					</li>
						
					<li>
						<a href="#" class="btn">
							<i class="icon-wrench"></i>
						</a>
					</li>
					<!-- start: User Dropdown -->
					<li class="dropdown">
						<a href="#" data-toggle="dropdown" class="btn account dropdown-toggle">
							<div class="avatar"><img alt="Avatar" src="<?php echo $avatar; ?>" /></div>
							<div class="user">
								<span class="hello">Bem vindo!</span>
								<span class="name"><?php echo $usuario; ?></span>
							</div>
						</a>
							<ul class="dropdown-menu">
								<li class="dropdown-menu-title">
									
								</li>
								<li><a href="#"><i class="icon-user"></i> Perfil</a></li>
								<li><a href="#"><i class="icon-cog"></i> Configurações</a></li>
								<li><a href="#"><i class="icon-envelope"></i> Mensagens</a></li>
								<li><?php echo anchor(base_url('/admin/home/logout'), '<i class="icon-off"></i> Sair', 'title="Efetuar Logout"'); ?></li>
							</ul>
						</li>
						<!-- end: User Dropdown -->
					</ul>
				</div>
				<!-- end: Header Menu -->
				
			</div>
		</div>
	</div>