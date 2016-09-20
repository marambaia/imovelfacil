<!-- Quick Search -->
<div id="quick-search">
	
	<form method="post" action="<?php echo base_url('buscar'); ?>">
		
		<h4 class="head">Busca Rápida</h4>
		
		<div class="slideToggle">
			
			<div class="switcher">
				<a class="off" href="#">Para Vender</a>
				<div class="switcher-bg">
					<span class="circle"></span>
				</div>
				<a class="on" href="#">Para Alugar</a>
			</div>
			
    		<div class="row">
    			<select name="localizacao" class="select normal">
					<option value="">Localização</option>
					<?php echo $lista_localidades; ?>
				</select>
			</div>

			<div class="row">
				<select name="tipo" class="select normal">
					<option value="">Tipo de Imóvel</option>
					<?php echo $lista_tipo_imovel; ?>
				</select>
			</div>
			
			<div class="row">
				<select name="preco" class="select normal">
					<option value="">Valor (R$)</option>
					<option value="30k">até 30.000</option>
					<option value="50k">30.000 a 50.000</option>
					<option value="70k">50.000 a 70.000</option>
					<option value="100k">70.000 a 100.000</option>
					<option value="150k">100.000 a 150.000</option>
					<option value="200k">150.000 a 200.000</option>
					<option value="250k">200.000 a 250.000</option>
					<option value="300k">250.000 a 300.000</option>
					<option value="350k">300.000 a 350.000</option>
					<option value="400k">350.000 a 400.000</option>
					<option value="450k">400.000 a 450.000</option>
					<option value="500k">450.000 a 500.000</option>
					<option value="500k+">acima de 500.000</option>
				</select>
			</div>
			
			<div class="row">
				<select name="quartos" class="select left">
					<option value="">Quartos</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5+</option>
				</select>

				<select name="banheiros" class="select right">
					<option value="">Banheiros</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5+</option>
				</select>
			</div>
			
			<div class="row">
				<select name="suites" class="select left">
					<option value="">Suítes</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5+</option>
				</select>

				<select name="garagem" class="select right">
					<option value="">Garagem</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5+</option>
				</select>
			</div>

			<div class="row">
				<input id="categoria" name="categoria" type="hidden" value="1" />
				<input class="button-blue" type="submit" value="Buscar" />
			</div>
		</div>
	</form>
	<p><img  style="margin-left: -15px; margin-top: 5px;" alt="" src="<?php echo base_url('assets/images/banner.jpg'); ?>"/></p>
</div>
<!-- End Quick Search -->