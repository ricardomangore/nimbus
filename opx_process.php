<?php
	//incluye wp-load para tener instancias de los objetos Wordpress utilizados
	include_once('../../../wp-load.php' );
	//Crea una instancia de Wordpress DB para manejar base de datos
	$gestor = new wpdb('root','','opusx','localhost');
	
	$type_quote = $_POST['type-quote'];
	
	
	
	echo $type_quote;
	
	
	set_query_var('proccess', 'ya paso pro el script de procesamiento');
	//Redirecciona a la página success
	header('Location: '.get_site_url().'/'.$_POST['success']);