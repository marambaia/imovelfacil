<li class="widget sidebar-widget agent" id="agent-widget-2">
	<div class="widget-container">
		<h3 class="widget-title">Fale Conosco</h3>
		<div class="agent-info">
			<div class="agent-image">
				<?php echo img(array('src' => base_url('assets/images/1.thumbnail.png'), 'width' => '50', 'height' => '50', 'class' => 'photo', 'alt' => 'Max Imóveis')); ?>
			</div>
			<div class="agent-text">
				<h3>Max Imóveis</h3>
				<p>
					Celular: <?php echo $contato['tel_celular1']; ?><br>
					Celular: <?php echo $contato['tel_celular2']; ?><br>
					Tel. / Fax: <?php echo $contato['tel_fixo1']; ?><br>
				</p>
			</div>
			<div class="clear"></div>
			<div id="contact-wrapper" class="comment-form-container">
				<?php 
					$data = array('id'=>'contactform');
					$campos_hidden = array('contact_type'=>'fale-conosco');
					echo form_open(base_url('contato/enviar'), $data, $campos_hidden);
					echo "<span class='validacoes'>" . validation_errors() . "</span>"; 
				?>
					<div class="row first form-name">
						<?php 
							echo form_label('Nome:', 'contact_name');
							$data = array('name'=>'contact_name', 'id'=>'contact_name', 'class'=>'required form-name input-text', 'size'=>'50');
							echo form_input($data);
						?>
						<div class="clear"></div>
						<span class="contact_error" id="name_error">* Campo nome requerido</span>
					</div>
					<div class="row form-name">
						<?php 
							echo form_label('E-mail:', 'contact_email');
							$data = array('name'=>'contact_email', 'id'=>'contact_email', 'class'=>'required email form-name input-text', 'size'=>'50');
							echo form_input($data);
						?>
						<div class="clear"></div>
						<span class="contact_error" id="email_error">* Campo email requerido</span>
					</div>
					<div class="row form-name">
						<?php 
							echo form_label('Telefone:', 'contact_phone');
							$data = array('name'=>'contact_phone', 'id'=>'contact_phone', 'class'=>'phone form-name input-text', 'size'=>'50');
							echo form_input($data);
						?>
					</div>
					<div class="row form-comment">
						<?php 
							echo form_label('Mensagem:', 'contact_message');
							$data = array('name'=>'contact_message', 'id'=>'contact_message', 'class'=>'required txtarea-comment', 'cols'=>'20', 'rows'=>'6');
							echo form_textarea($data);
						?>
						<div class="clear"></div>
						<span class="contact_error" id="message_error">* Escreva sua mensagem</span>
					</div>
					<div class="clear"></div>
					<input type="hidden" value="chetan.7991@gmail.com" name="emailAddress" id="emailAddress">
					<div class="clear"></div>
					<div class="contact_error alert_success" id="mail_success">E-mail enviado! Entraremos em contato o mais breve possível.</div>
					<div class="contact_error alert_error" id="mail_fail">Desculpe, o e-mail nao foi enviado. Tente novamente mais tarde.</div>
					<p id="cf_submit_p">
						<input type="submit" name="submit" value="Enviar Mensagem" class="button" id="send_message">
					</p>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</li>