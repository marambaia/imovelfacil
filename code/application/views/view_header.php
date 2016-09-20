<div class="top-border"></div>
<!-- Header -->
<header>
	<div id="header">
		<div id="inner-header">
			<div class="top_clearfix">
				<!-- cart BOF -->
				<div class="cart-top">
					<a href="#" class="summary">
						<span class="text">Tel <?php echo $topo['tel_principal']; ?></span>
					</a>
					<div class="details" style="opacity: 0; display: none;">
						<p class="a-center">Outros telefones cadastrados.</p>
					</div>
				</div>
				<!-- cart EOF -->
				
				<!-- LANGUAGES BOF -->
				<div class="language-switch header-switch">
					<a class="selected" href="#"><?php echo $topo['idioma_1']; ?></a><span>|</span>
					<a href="#"><?php echo $topo['idioma_2']; ?></a><span>|</span>
					<a href=""><?php echo $topo['idioma_3']; ?></a>
				</div>
				<!-- LANGUAGES EOF -->
			</div>
			<!-- Logo -->
			<div id="logo">
				<?php echo anchor(base_url(), img(base_url('assets/images/logo.png'))); ?>
    		</div>
    		<!-- End Logo -->
    		
    		<!-- Menu flutuante -->
			<div id="float-menu" style="margin-left:400px;">
				<ul class="links">
					<li class="first"><?php echo anchor(base_url('/pagina/'.$menu_destaque['item_0']['slug']), $menu_destaque['item_0']['nome'], array('class' => 'top-link-account', 'title' => $menu_destaque['item_0']['descricao'])); ?></li>
					<li><?php echo anchor(base_url('/pagina/'.$menu_destaque['item_1']['slug']), $menu_destaque['item_1']['nome'], array('class' => 'top-link-checkout', 'title' => $menu_destaque['item_1']['descricao'])); ?></li>
					<li class="last"><?php echo anchor(base_url('/pagina/'.$menu_destaque['item_2']['slug']), $menu_destaque['item_2']['nome'], array('class' => 'top-link-login', 'title' => $menu_destaque['item_2']['descricao'])); ?>
				</ul>
				<div class="clear"></div>
			</div>
			<!-- End Menu flutuante -->
	    	
			<!-- Menu -->
			<nav>
				<div class="menu-primary-menu-container">
					<?php echo $menu_principal;?>
				</div>
			</nav>
			<!-- End Menu -->
		</div>
	</div>
</header>
<!-- End Header -->