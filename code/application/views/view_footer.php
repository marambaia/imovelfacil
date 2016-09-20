<!-- Footer -->
<footer>
	<div id="footer">
		<div id="inner-footer">
			<div class="footer_cols">
				<div id="contact-widget-2" class="widget footer-widget contact">
					<div class="widget-container">
						<h3 class="widget-title">Entre em Contato</h3>
						<div class="reach-us">
							<div class="address">
								<p><?php echo $rodape['endereco_principal']; ?></p>
							</div>
							<div class="reach-image">
								<?php echo img('assets/images/my-location.png'); ?>
							</div>
							<div class="other-info">
								<div class="reach rphone"><?php echo $rodape['tel_celular1']; ?></div>
								<div class="reach rphone"><?php echo $rodape['tel_celular2']; ?></div>
								<div class="reach rfax"><?php echo $rodape['tel_fixo1']; ?></div>
								<div class="reach remail">
									<a href="mailto:<?php echo $rodape['email_principal']; ?>"><?php echo $rodape['email_principal']; ?></a>
								</div>
							</div>
							<div class="clear"></div>
							<div class="extra-text">
								<p>Copyright © 2013 Max Imóveis Todos os Direitos Reservados.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php 
				$design_based = array(
          			'src' => 'assets/images/design_based_md.png',
          			'alt' => 'Orgulhosamente desenvolvido por Marambaia.Info',
          			'class' => 'design_by',
					'title' => 'Orgulhosamente desenvolvido por Marambaia.Info',
				);
			?>
			<div id="footer_cols">
				<a href="http://www.marambaia.info/" target="_blank"><?php echo img($design_based); ?></a>
			</div>
		</div>
		<div id="back-to-top">
			<a href="#back-to-top"><?php echo img('assets/images/back-to-top.png'); ?></a>
		</div>
	</div>
</footer>
<!-- End Footer -->
	

