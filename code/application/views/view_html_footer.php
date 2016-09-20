<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-43785422-1', 'maximoveisrj.com');
  ga('send', 'pageview');

</script>

<?php if ( ! empty($busca)): ?>
<script type="text/javascript">
	/*global jQuery:false */
	jQuery(document).ready(function($) {
	
		"use strict";
		
		// List or grid View
		var animateSpeed = 500;	
		$("a#switch-to-grid").click(function(){
			if(!$(this).hasClass("active-view")) {
				$('#new-listings').fadeOut(animateSpeed,function(){
					$('#new-listings').removeClass('list-view',animateSpeed);
					$('#new-listings').addClass('grid-view',animateSpeed);
				}).fadeIn(animateSpeed);
				$.cookie('products_cookie', 'grid');
			}
			$("a#switch-to-list").removeClass('active-view');
			$(this).addClass('active-view');
			return false;		
		});
		
		$("a#switch-to-list").click(function(){
			if(!$(this).hasClass("active-view")) {
				$('#new-listings').fadeOut(animateSpeed,function(){
					$('#new-listings').removeClass('grid-view',animateSpeed);
					$('#new-listings').addClass('list-view',animateSpeed);
				}).fadeIn(animateSpeed);
				$.cookie('products_cookie', 'list');
			}
			$(this).addClass('active-view');
			$("a#switch-to-grid").removeClass('active-view');		
			return false;		
		});
	
	});
</script>
<?php endif; ?>

<script type='text/javascript' src='<?php echo base_url('assets/js/jquery.slides.min.js'); ?>'></script> <!-- Espelho a frente da imagem do grid -->
<script type='text/javascript' src='<?php echo base_url('assets/js/jquery.selectbox.js'); ?>'></script> <!-- Select box mais bem formatados -->
<script type='text/javascript'>
	/* <![CDATA[ */
	var royal = {"bed":"Quartos","bath":"Banheiros"};
	/* ]]> */
</script>
<script type='text/javascript' src='<?php echo base_url('assets/js/script.js'); ?>'></script>
<script type='text/javascript' src='<?php echo base_url('assets/js/superfish.js'); ?>'></script> <!-- Habilita Submenu do menu principal -->
<script type='text/javascript' src='<?php echo base_url('assets/js/jquery.flexslider.js'); ?>'></script> <!-- Habilita slider principal  -->
<script type='text/javascript' src='<?php echo base_url('assets/js/lightbox-2.6.min.js'); ?>'></script> <!-- Habilita LightBox principal  -->

</body>
</html>