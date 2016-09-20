<?php echo $html_header; ?>
<?php echo $header; ?>
<!-- Container -->
<div id="container">
	<div class="no-bg" id="content">
		<!-- Quick Search -->
		<?php echo $quick_search_horizontal; ?>
		<!-- End Quick Search -->
	    	
		<!-- Content -->
		<?php echo $content; ?>
		<!-- End Content -->
	</div>
	<!-- Sidebar -->
	<aside>
		<div id="sidebar">
			<ul>
				<?php echo $contato_widget; ?>
				<?php echo $historia_widget; ?>
				<?php echo $depoimentos_widget; ?>
			</ul>
		</div>
	</aside>
	<!-- End Sidebar -->
</div>
<!-- End Container -->
<?php echo $footer; ?>
<?php echo $html_footer; ?>