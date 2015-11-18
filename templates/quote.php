<?php
	$obj_quote = new quote_db();
	$type_quote = $_POST['type-quote'];
	if($type_quote == 'aerial'){
		$idaeropuerto = $_POST['opx_aeropuerto'];
		$peso = $_POST['opx_peso'];
		$volumen = $_POST['opx_volumen'];
		$result_aerial_quote = $obj_quote->get_aerial_quote(array(
			'idaeropuerto' => $idaeropuerto,
			'peso' => $peso,
			'volumen' => $volumen
		));
	}else if($type_quote == 'maritime'){
		$param = array(
			'pol' => $_POST['opx_origen'],
			'pod' => $_POST['opx_destino'],
			'tipo_carga' => $_POST['opx_tipo_carga'],
			'idcontenedor' => isset($_POST['opx_contenedor'])? $_POST['opx_contenedor']:NULL,
			'peso' => isset($_POST['opx_peso'])?$_POST['opx_contenedor']:NULL,
			'volumen' => isset($_POST['opx_volumen'])?$_POST['opx_volumen']:NULL
		);
		$result_maritime_quote = $obj_quote->get_maritime_quote($param);
	}
?>
 <div class='wizard fuelux'  id='opx_wizard'>
  <div class='steps-container'>
    <ul class='steps'>
      <li data-step='1' data-name='campaign' class='active'><span class='badge'>1</span>Seleccione un Servicio<span class='chevron'></span></li>
      <li data-step='2'><span class='badge'>2</span>Cotiza<span class='chevron'></span></li>
    </ul>
  </div>

  <div class='step-content'>
    <div class='step-pane active sample-pane alert' data-step='1'>
      <div class='row text-center'><h2>Seleccione uno de nuestros servicios</h2></div>
      <div class='row' style='margin-top: 20px'>
      	<div class='col-md-4 col-md-offset-1 text-center'>
	      	<button class='btn btn-primary btn-lg btn-block opx_btn_aereo'>
	      		<i class='fa fa-plane fa-5x'></i>
	      		<br/><h3>Aéreo</h3>
	      	</button><br/><br/>

		</div>
      	<div class='col-md-4 col-md-offset-2 text-center'>
	      	<button class='btn btn-success btn-lg btn-block opx_btn_maritimo'>
	      		<i class='fa fa-ship fa-5x'></i>
	      		<br><h3>Marítimo</h3>
	      	</button><br/><br/>
		</div>
      </div>
    </div>
    <div class='step-pane sample-pane' data-step='2'>
    	<div class='row component-aereo'>	
    		<div class='col-md-12'>
    			<form class='form-inline'name='aerial_quote_form' style='height:200px; padding: 50px 0px 50px 0px' method='post' action='<?php echo get_site_url().'/'.$success;?>'>
    				<input type='hidden' name='type-quote' value='aerial'>
    				<div class='form-group col-md-4'>
    					<label>Destino: </label>
				      	<select name='opx_aeropuerto' class='opt_aeropuerto' data-live-search='true'>
				      		<option value="none">Seleccione un aeropuerto</option>
				      		<?php foreach($obj_quote->get_aeropuertos() as $aeropuerto):?>
				      		<option value="<?php echo $aeropuerto->idaeropuerto ;?>"><?php echo $aeropuerto->aeropuerto . ' - ' . $aeropuerto->code;?></option>
				      		<?php endforeach; ?>
				      	</select>
			      	</div>
			      	<div class='form-group col-md-4'>
			      		<label>Peso: </label>
			      		<div class='input-group'>
				      		<input type='text' name='opx_peso' class='form-control'>
				      		<div class='input-group-addon'>Kg</div>
			      		</div>
			      	</div>
			      	<div class='form-group col-md-4'>
			      		<label>Volumen: </label>
			      		<div class='input-group'>
			      			<input type='text' name='opx_volumen' class='form-control'>
			      			<div class='input-group-addon'>m3</div>
			      		</div>
			      	</div>
			      	<div class='form-group col-md-2 col-md-offset-9' style='padding-top: 30px;'>
			      		<button class='btn btn-success btn-lg btn-block'><i class='fa fa-calculator'></i> Cotizar</button>
			      	</div>
		      	</form>
		      	<form  role='form' class='form-horizontal' name='maritime_quote_form' method='post' action='<?php echo get_site_url().'/'.$success;?>' style='padding-top: 50px; height: 250px;'>
		      			<input type='hidden' name='type-quote' value='maritime'>
			      		<div class='form-group'>
			      			<label class='control-label col-sm-1'>Origen: </label>
			      			<div class='col-sm-3'>
			      				<select name='opx_origen' class='opt_aeropuerto' data-live-search='true'>
			      					<option value="none">Seleccione un puerto</option>
						      		<?php foreach($obj_quote->get_puertos() as $puerto):?>
						      		<option value="<?php echo $puerto->idpuerto ;?>"><?php echo $puerto->puerto . '  ' . $puerto->locode;?></option>
						      		<?php endforeach; ?>
						      	</select>
			      			</div>
			      			<label class='control-label col-sm-1'>Destino: </label>
			      			<div class='col-sm-3'>
			      				<select name='opx_destino' class='opt_aeropuerto' data-live-search='true'>
			      					<option value="none">Seleccione un puerto</option>
						      		<?php foreach($obj_quote->get_puertos() as $puerto):?>
						      		<option value="<?php echo $puerto->idpuerto ;?>"><?php echo $puerto->puerto . '  ' . $puerto->locode;?></option>
						      		<?php endforeach; ?>
						      	</select>
			      			</div>	
			      			<label class='col-sm-2'>
			      				<input type='radio' name='opx_tipo_carga' value='contenerizada'> Contenedor
			      			</label>
			      			<label lass='col-sm-2'>
			      				<input type='radio' name='opx_tipo_carga' value='consolidada'> Consolidada
			      			</label>			      					      			
			      		</div>
			      		
			      		<div class='form-group carga_contenerizada'>
			      			<label class='control-label col-sm-2'>Tipo de Contenedor: </label>
			      			<div class='col-sm-3'>
			      				<select name='opx_contenedor' class='opt_aeropuerto' data-live-search='true'>
						      		<?php foreach($obj_quote->get_contenedores() as $contenedor):?>
						      		<option value="<?php echo $contenedor->idcontenedor ;?>"><?php echo $contenedor->tipo . ' - ' . $contenedor->pies;?></option>
						      		<?php endforeach; ?>
						      	</select>
			      			</div>
			      		</div>
				      	<div class='form-group carga_consolidada'>
				      		<label class='control-label col-sm-1'>Peso: </label>
				      		<div class='col-sm-3'>
					      		<div class='input-group'>
						      		<input type='text' name='opx_peso' class='form-control'>
						      		<div class='input-group-addon'>Kg</div>
					      		</div>
				      		</div>
				      		<label class='control-label col-sm-1'>Volumen: </label>
				      		<div class='col-sm-3'>
					      		<div class='input-group'>
					      			<input type='text' name='opx_volumen' class='form-control'>
					      			<div class='input-group-addon'>m3</div>
					      		</div>
							</div>					      	
				      	</div>
				      	<div class='form-group'>
				      		<div class='col-sm-2 col-sm-offset-10'>
				      			<button class='btn btn-success btn-lg btn-block'><i class='fa fa-calculator'></i> Cotizar</button>
				      		</div>
				      	</div>
		      	</form>
		    </div>
      	</div>
    </div>
  </div>
</div>
<?php if(isset($type_quote) && $type_quote=='aerial'): ?>
<div class="section">
	<div class="container">
		<table class="table">
			<thead>
				<tr>
					<th>Origen</th>
					<th>Destino</th>
					<th>Precio</th>
					<th>Detalles</th>
				</tr>
			</thead>
			<?php if(empty($result_aerial_quote)): ?>
				<tr><td><h3>No se encontraron fletes ...!!</h3></td></tr>
			<?php else: ?>
				<?php foreach($result_aerial_quote as $result): ?>
						<tr>
							<td>
								Aeropuerto: <?php echo $result['aol']->aeropuerto; ?><br>
								Code: <?php echo $result['aol']->code; ?><br>
								País: <?php echo $result['aol']->pais; ?><br>
							</td>
							<td>
								Aeropuerto: <?php echo $result['aod']->aeropuerto; ?><br>
								Code: <?php echo $result['aod']->code; ?><br>
								País: <?php echo $result['aod']->pais; ?><br>
							</td>
							<td>
								$ <?php echo $result['flete_aereo']->precio; ?> USD
							</td>
							<td>
								<?php foreach($result['recargos'] as $recargo): ?>
									<?php echo $recargo->descripcion . ': $ ' . $recargo->costo;  ?> USD
									<br>
								<?php endforeach; ?>
							</td>
						</tr>
				<?php endforeach; ?>
			<?php endif;?>
		</table>
	</div>
</div>
<?php endif; ?>
<?php if(isset($type_quote) && $type_quote == 'maritime'): ?>
<div class="section">
	<div class="container">
		<table class="table">
			<thead>
				<tr>
					<th>Origen</th>
					<th>Destino</th>
					<th>Precio</th>
					<th>Detalles</th>
				</tr>
			</thead>
			<?php if(empty($result_maritime_quote)): ?>
				<tr><td><h3>No se encontraron fletes ...!!</h3></td></tr>
			<?php else: ?>
				<?php foreach($result_maritime_quote as $result): ?>
						<tr>
							<td>
								Puerto: <?php echo $result['pol']->puerto; ?><br>
								Lode: <?php echo $result['pol']->locode; ?><br>
							</td>
							<td>
								Puerto: <?php echo $result['pod']->puerto; ?><br>
								Locode: <?php echo $result['pod']->locode; ?><br>
							</td>
							<td>
								$ <?php echo $result['flete_maritimo']->precio; ?> USD
							</td>
							<td>
								<?php foreach($result['recargos'] as $recargo): ?>
									<?php echo $recargo->descripcion . ': $ ' . $recargo->costo;  ?> USD
									<br>
								<?php endforeach; ?>
							</td>
						</tr>
				<?php endforeach; ?>
			<?php endif;?>
		</table>
	</div>
</div>
<?php endif; ?>
