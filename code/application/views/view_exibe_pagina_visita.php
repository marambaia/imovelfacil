<?php setlocale(LC_ALL, 'pt_BR'); ?>
<article>
	<div class="post clearfix" id="sobre-nos">
		<h1 class="post-title"><?php echo $item->nome; ?></h1>
		<div class="post-wrapper">
			<div class="post-details alt-details">
				<div class="post-date"><span>Atualizado em: </span><?php echo strftime ("%d de %B de %Y", strtotime($item->data_alteracao)); ?></div>
				<div class="post-author"><span>Escrito por: </span><?php echo $item->criador_titulo.' '.$item->criador_nome; ?></div>
			</div>
			<div class="clear"></div>
			<div class="post-content">
				<?php echo $item->descricao; ?>
			</div>
			<div id="contact-wrapper" class="comment-form-container">
			<?php 
				$data = array('id'=>'contactform');
				$campos_hidden = array('contact_type'=>$item->slug);
				echo form_open(base_url('contato/enviar_visita'), $data, $campos_hidden);
				echo "<span class='validacoes'>" . validation_errors() . "</span>"; 
			?>
			
			<div class="row first form-name">
				<?php 
					echo form_label('Nome:', 'contact_name');
					$data = array('name'=>'contact_name', 'id'=>'contact_name', 'class'=>'required form-name input-text', 'size'=>'50');
					echo form_input($data);
				?>
				<div class="clear"></div>
				<span class="contact_error" id="name_error">* Digite seu nome</span>
			</div>
			
			<div class="row form-name">
				<?php 
					echo form_label('E-mail:', 'contact_email');
					$data = array('name'=>'contact_email', 'id'=>'contact_email', 'class'=>'email form-name input-text', 'size'=>'50');
					echo form_input($data);
				?>
				<div class="clear"></div>
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
					echo form_label('Endereço:', 'contact_address');
					$data = array('name'=>'contact_address', 'id'=>'contact_address', 'class'=>'required txtarea-comment', 'cols'=>'20', 'rows'=>'6');
					echo form_textarea($data);
				?>
				<div class="clear"></div>
				<span class="contact_error" id="address_error">* Digite o endereço do imóvel e referências para encontrá-lo.</span>
			</div>
			
			<div class="clear"></div>

			<div class="contact_error alert_success" id="mail_success">E-mail enviado! Nós entraremos em contato com você o mais breve possível.</div>
			<div class="contact_error alert_error" id="mail_fail">Desculpe, o e-mail nao foi enviado. Tente novamente mais tarde.</div>
			
			<p id="cf_submit_p">
				<?php echo form_submit('btn_cadastro', 'Enviar Mensagem', 'id="send_message_visita" class="button"'); ?>
			</p>

		<?php echo form_close(); ?>
	</div>
	</div>
	<div class="clearfix seperator"></div>
	<div class="clear"></div>
	</div>
</article>