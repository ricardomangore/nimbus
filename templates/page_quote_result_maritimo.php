<?php
	
	$gestor = new wpdb('root','','opusx','localhost');
	$pol = $_GET['opx_origen'];
	$pod = $_GET['opx_destino'];
	$peso	= $_GET['opx_peso'];
	$volumen = $_GET['opx_volumen'];
	$idcontenedor = $_GET['opx_contenedor'];
	$tipo_carga = $_GET['opx_tipo_carga'];
	
	
	if($tipo_carga == 'contenerizada'){
		$contenedor = $gestor->get_results("SELECT * FROM contenedor LEFT JOIN carga ON contenedor.idcarga = carga.idcarga WHERE idcontenedor = $idcontenedor");
		var_dump($contenedor->idcarga);
		$results = $gestor->get_results("SELECT * FROM flete_maritimo  
										 LEFT JOIN naviera ON flete_maritimo.idnaviera = naviera.idnaviera 
										 LEFT JOIN region ON flete_maritimo.idregion = region.idregion
										 LEFT JOIN rel_flete_maritimo_carga ON flete_maritimo.idflete_maritimo = rel_flete_maritimo_carga.idflete_maritimo
										 LEFT JOIN carga ON carga.idcarga = rel_flete_maritimo_carga.idcarga
										 WHERE rel_flete_maritimo_carga.idcarga = $contenedor->idcarga");
										 var_dump($results);
		foreach($results as $result){
			$result_pol = $gestor->get_results("SELECT locode,puerto FROM puerto WHERE idpuerto = $result->pol");
		
			$result_pod = $gestor->get_results("SELECT locode,puerto FROM puerto WHERE idpuerto = $result->pod");
			
			$result_via = $gestor->get_results("SELECT * FROM via1 
												LEFT JOIN puerto ON via1.idpuerto = puerto.idpuerto 
												WHERE idflete_maritimo = $result->idflete_maritimo");
												
			$result_recargos = $gestor->get_results("SELECT * FROM rel_flete_maritimo_recargo_maritimo 
													 LEFT JOIN recargo_maritimo ON rel_flete_maritimo_recargo_maritimo.idrecargo_maritimo = recargo_maritimo.idrecargo_maritimo 
													 LEFT JOIN naviera ON recargo_maritimo.idnaviera = naiera.idnaviera
													 LEFT JOIN recargo ON recargo_maritimo.idrecargo = recargo.idrecargo
													 WHERE idflete_maritimo = $result->idflete_maritimo");
			array_push($result_array,array(
				'flete_maritimo' => $result,
				'via' => $result_via,
				'recargos' => $result_recargos,
				'pol' => $result_pol[0],
				'pod' => $result_pod[0],
				'carga' => $contenedor
			));
		}										 		
	}else{
		echo "";
	}

	
	

	

	
	$result_array = array();
	



	/*if($tipo_carga == 'consolidada'){
			$result_pol = $gestor->get_results("SELECT locode,puerto FROM puerto WHERE idpuerto = $result->pol");
		
			$result_pod = $gestor->get_results("SELECT locode,puerto FROM puerto WHERE idpuerto = $result->pod");
			
			$result_via = $gestor->get_results("SELECT * FROM via2 
												LEFT JOIN aeropuerto ON via2.idaeropuerto = aeropuerto.idaeropuerto 
												WHERE idflete_aereo = $result->idflete_aereo");
												
			$result_recargos = $gestor->get_results("SELECT * FROM rel_flete_maritimo_recargo_maritimo 
													 LEFT JOIN recargo_maritimo ON rel_flete_maritimo_recargo_maritimo.idrecargo_maritimo = recargo_maritimo.idrecargo_maritimo 
													 LEFT JOIN naviera ON recargo_maritimo.idnaviera = naiera.idnaviera
													 LEFT JOIN recargo ON recargo_maritimo.idrecargo = recargo.idrecargo
													 WHERE idflete_maritimo = $result->idflete_maritimo");
			array_push($result_array,array(
				'flete_maritimo' => $result,
				'via' => $result_via,
				'recargos' => $result_recargos,
				'pol' => $result_pol[0],
				'pod' => $result_pod[0]
			));
	}*/
	
	var_dump($result_array);
?>
	
<div class="section">
	<div class="container">
		<?php echo do_shortcode('[nbcotizador][/nbcotizador]'); ?>
	</div>
</div> 
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
			<?php if(empty($result_array)): ?>
				<tr><td><h3>No se encontraron fletes ...!!</h3></td></tr>
			<?php else: ?>
				<?php foreach($result_array as $result): ?>
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

