<div class="container-fluid-full">
	<div class="row-fluid">
				
		<div class="row-fluid">
			<div class="login-box">
				<h2>Acesse sua conta</h2>
				<?php 
					$data = array('class' => 'form-horizontal', 'id' => 'formlogin');
					echo form_open('admin/home/login', $data);
						echo '<fieldset>';
							
							$data = array('name' => 'usuario', 'id' => 'usuario', 'class' => 'input-large span12', 'placeholder' => 'digite seu login');
							echo form_input($data);

							$data = array('name' => 'senha', 'id' => 'senha', 'class' => 'input-large span12', 'placeholder' => 'digite sua senha');
							echo form_password($data);

							echo '<div class="clearfix"></div>';
							
							echo form_submit('btn_login', 'Login', 'class="btn btn-primary span12" style="margin-top: 30px;"');
						
							echo '</fieldset>';
							
					echo form_close();
				?>

				<hr>
				<h3>Esqueceu sua senha?</h3>
				<p>
					Sem problema, <a href="#">clique aqui</a> e crie uma nova senha.
				</p>	
			</div>
		</div><!--/row-->
	</div><!--/fluid-row-->
</div><!--/.fluid-container-->
