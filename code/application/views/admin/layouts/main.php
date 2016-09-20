<?php echo $html_header; ?>
<?php echo $header; ?>
<div class="container-fluid-full">
	<div class="row-fluid">
		<!-- start: Main Menu -->
		<?php echo $menu; ?>
		<!-- end: Main Menu -->
		
		<!-- start: Content -->
		<?php echo $body; ?>
		<!-- end: Content -->
				
	</div><!--/fluid-row-->
	
	<div id="myModal" class="modal hide fade">
		<div class="modal-header">
			<button data-dismiss="modal" class="close" type="button">×</button>
			<h3>Settings</h3>
		</div>
		<div class="modal-body">
			<p>Here settings can be configured...</p>
		</div>
		<div class="modal-footer">
			<a data-dismiss="modal" class="btn" href="#">Close</a>
			<a class="btn btn-primary" href="#">Save changes</a>
		</div>
	</div>
	
	<div class="clearfix"></div>

	<?php echo $footer; ?>
</div>
<?php echo $html_footer; ?>