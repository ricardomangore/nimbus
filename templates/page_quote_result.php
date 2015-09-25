<?php
	$gestor = new wpdb('root','','opusx','localhost');
	$result = $gestor->get_results('SELECT * FROM opx_user');
?>

<div class="section">
	<div class="container">
		<?php echo do_shortcode('[nbcotizador][/nbcotizador]'); ?>
	</div>
</div> 



<?php $results = array(
	array(
			'id' => '1',
			'precio' => '',
			'via'   => array('localidad1', 'localidad2', 'lodalidad3'),
			'aol'   => 'México',
			'aod'   => 'Londres',
			'vigencia' => '12-12-2015',
			'precio' => array(
				'min' => '234',
				'max' => '550',
				'precio' => '234.4'
			)
	),
	array(
			'id' => '2',
			'precio' => '',
			'via'   => array('localidad1', 'localidad2', 'lodalidad3'),
			'aol'   => 'México',
			'aod'   => 'Londres',
			'vigencia' => '12-12-2015',
			'precio' => '9099.234'
	),
			array(
			'id' => '3',
			'precio' => '',
			'via'   => array('localidad1', 'localidad2', 'lodalidad3'),
			'aol'   => 'México',
			'aod'   => 'Londres',
			'vigencia' => '12-12-2015',
			'precio' => '9994.234'
	),
); ?> 


<div class='section">
	<div class="container">
		<?php foreach($results as $result): ?>
	
		<?php endforeach; ?>
	</div>
</div>
