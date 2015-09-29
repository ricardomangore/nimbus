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
		$result_via = $gestor->get_results("SELECT * FROM via2 
											LEFT JOIN aeropuerto ON via2.idaeropuerto = aeropuerto.idaeropuerto 
											WHERE idflete_aereo = $result->idflete_aereo");
											
		$result_recargos = $gestor->get_results('SELECT * FROM rel_flete_aereo_recargo_aereo 
												 LEFT JOIN recargo_aereo ON rel_flete_aereo_recargo_aereo.idrecargo_aereo = recargo_aereo.idrecargo_aereo 
												 LEFT JOIN aerolinea ON recargo_aereo.idaerolinea = recargo_aereo.idaerolinea 
												 LEFT JOIN recargo_aereo.idrecargo = recargo.idrecargo');							
		array_push($result_array,array(
			'flete_aereo' => $result,
			'via' => $result_via,
			'recargos' => $result_recargos
		));
	}
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
			<?php if(empty($results)): ?>
				<tr><td><h3>No se encontraron fletes ...!!</h3></td></tr>
			<?php else: ?>
				<?php foreach($results as $result): ?>
						<tr>
							<td>
								<div class='row'>
									<div class='col-md-2'>Destino: <?php echo $result->pais; ?></div>
									<div class='col-md-2'>Code: <?php echo $result->code; ?></div>
									<div class='col-md-2'>Aeropuerto: <?php echo $result->aeropuerto; ?></div>
									<div class='col-md-2'>Precio: $ <?php echo $result->precio * $param; ?> USD</div>
								</div>
							</td>
						</tr>
				<?php endforeach; ?>
			<?php endif;?>
		</table>
	</div>
</div>

