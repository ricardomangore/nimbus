<?php
	
	$gestor = new wpdb('root','','opusx','localhost');
	$idaeropuerto = $_GET['opx_aeropuerto'];
	$peso	= $_GET['opx_peso'];
	$volumen = $_GET['opx_volumen'];
	
	$peso_volumen = (($volumen * 1000000)/6000);
	
	if($peso_volumen > $peso)
		$param = $peso_volumen;
	else	
		$param = $peso;
	
	$results = $gestor->get_results('SELECT * FROM flete_aereo 
									LEFT JOIN intervalo ON flete_aereo.idflete_aereo = intervalo.idflete_aereo 
									LEFT JOIN aeropuerto ON flete_aereo.aod = aeropuerto.idaeropuerto 
									WHERE aod = '.$idaeropuerto.' AND  precio != 0 AND min < '.$param.' AND max > '. $param);
	
    $result_array = array();
	
	foreach($results as $result){
		
		$result_aol = $gestor->get_results("SELECT code, pais, ciudad, aeropuerto FROM aeropuerto WHERE idaeropuerto = $result->aol");
		
		$result_aod = $gestor->get_results("SELECT code, pais, ciudad, aeropuerto FROM aeropuerto WHERE idaeropuerto = $result->aod");
		
		$result_via = $gestor->get_results("SELECT * FROM via2 
											LEFT JOIN aeropuerto ON via2.idaeropuerto = aeropuerto.idaeropuerto 
											WHERE idflete_aereo = $result->idflete_aereo");
											
		$result_recargos = $gestor->get_results("SELECT * FROM rel_flete_aereo_recargo_aereo 
												 LEFT JOIN recargo_aereo ON rel_flete_aereo_recargo_aereo.idrecargo_aereo = recargo_aereo.idrecargo_aereo 
												 LEFT JOIN aerolinea ON recargo_aereo.idaerolinea = aerolinea.idaerolinea
												 LEFT JOIN recargo ON recargo_aereo.idrecargo = recargo.idrecargo
												 WHERE idflete_aereo = $result->idflete_aereo");
												 
												 						
		array_push($result_array,array(
			'flete_aereo' => $result,
			'via' => $result_via,
			'recargos' => $result_recargos,
			'aol' => $result_aol[0],
			'aod' => $result_aod[0]
		));
	}
	
	var_dump($result_aod);
	echo "<br>";
	var_dump($result_aol);
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

