<?php
//incluye wp-load para tener instancias de los objetos Wordpress utilizados


class quote_db extends wpdb{
	
	function __construct(){
		parent::__construct('root', '', 'opusx', 'localhost');
	}
	
	public function get_aeropuertos(){
		return $this->get_results("SELECT * FROM aeropuerto");
	}
	
	public function get_puertos(){
		return $this->get_results("SELECT * FROM puerto");
	}
	
	public function get_contenedores(){
		return $this->get_results("SELECT * FROM contenedor");
	}
	
	
	/**
	 * Obtiene una lsita de fletes aéreos usando como parametros el identificador del aeropuerto de destino, el peso y el volumen de la carga
	 * 
	 * @param array() $params Arreglo con los parametros de busqueda
	 * 							'idaeropuerto'
	 * 							'peso'
	 * 							'volumen'
	 */
	public function get_aerial_quote($params){
		extract($params);
		$peso_volumen = (($volumen * 1000000)/6000);
		
		if($peso_volumen > $peso)
			$param = $peso_volumen;
		else	
			$param = $peso;
		

		$results = $this->get_results("SELECT * FROM flete_aereo 
									   LEFT JOIN intervalo ON flete_aereo.idflete_aereo = intervalo.idflete_aereo LEFT JOIN aeropuerto ON flete_aereo.aod = aeropuerto.idaeropuerto 
		    						   WHERE aod = $idaeropuerto AND  precio != 0 AND min <= $param AND max >= $param");
		
	    $result_array = array();
		
		foreach($results as $result){
			
			$result_aol = $this->get_results("SELECT code, pais, ciudad, aeropuerto FROM aeropuerto WHERE idaeropuerto = $result->aol");
			
			$result_aod = $this->get_results("SELECT code, pais, ciudad, aeropuerto FROM aeropuerto WHERE idaeropuerto = $result->aod");
			
			$result_via = $this->get_results("SELECT * FROM via2 
												LEFT JOIN aeropuerto ON via2.idaeropuerto = aeropuerto.idaeropuerto 
												WHERE idflete_aereo = $result->idflete_aereo");
												
			$result_recargos = $this->get_results("SELECT * FROM rel_flete_aereo_recargo_aereo 
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
		}//concluye el ciclo foreach
		
		return $result_array;			
	}//Termina la funcnión get_aerial_quote
	
	
	
	
	/**
	 * Obtiene una lsita de fletes maritimos usando como parametros el identificador del puerto de carga y de  descarga, el peso y el volumen de la carga o
	 * bien el tipo de contenedor si asó lo selecciono el usuario
	 * 
	 * @param array() $params Arreglo con los parametros de busqueda
	 * 							'pol'
	 * 							'pod'
	 * 							'idcontenedor'
	 * 							'tipo_carga'
	 * 							'peso'
	 * 							'volumen'
	 */
	public function get_maritime_quote($params){
		extract($params);
		if($tipo_carga == 'contenerizada')
			$tipo_carga_int = 2;
		else if($tipo_carga == 'consolidada')
		    $tipo_carga_int = 1;
		
	    $result_array = array();
		if($tipo_carga == 'contenerizada'){//Caso para cotizar cargas contenerizadas
			$results = $this->get_results("SELECT * FROM flete_maritimo  
											LEFT JOIN naviera ON flete_maritimo.idnaviera = naviera.idnaviera 
											LEFT JOIN region ON flete_maritimo.idregion = region.idregion
											LEFT JOIN rel_flete_maritimo_carga ON flete_maritimo.idflete_maritimo = rel_flete_maritimo_carga.idflete_maritimo
											LEFT JOIN carga ON carga.idcarga = rel_flete_maritimo_carga.idcarga
											LEFT JOIN contenedor ON carga.idcarga = contenedor.idcarga
											WHERE rel_flete_maritimo_carga.tipo = $tipo_carga_int
											AND flete_maritimo.pol = $pol
											AND flete_maritimo.pod = $pod 
											AND contenedor.idcarga = $idcontenedor");			
			foreach($results as $result){
				$result_pol = $this->get_results("SELECT locode,puerto FROM puerto WHERE idpuerto = $result->pol");
				$result_pod = $this->get_results("SELECT locode,puerto FROM puerto WHERE idpuerto = $result->pod");	
				$result_via = $this->get_results("SELECT * FROM via1 
												  LEFT JOIN puerto ON via1.idpuerto = puerto.idpuerto 
												  WHERE idfletemaritimo = $result->idflete_maritimo");
				$result_recargos = $this->get_results("SELECT * FROM rel_flete_maritimo_recargo_maritimo 
													 LEFT JOIN recargo_maritimo ON rel_flete_maritimo_recargo_maritimo.idrecargo_maritmo = recargo_maritimo.idrecargo_maritimo 
													 LEFT JOIN naviera ON recargo_maritimo.idnaviera = naviera.idnaviera
													 LEFT JOIN recargo ON recargo_maritimo.idrecargo = recargo.idrecargo
													 WHERE idflete_maritimo = $result->idflete_maritimo");
				$result_contenedor = $this->get_results("SELECT * FROM carga LEFT JOIN contenedor ON carga.idcarga=contenedor.idcontenedor 
														WHERE contenedor.idcarga = $result->idcarga");												  		
				array_push($result_array,array(
					'flete_maritimo' => $result,
					'via' => $result_via,
					'recargos' => $result_recargos,
					'pol' => $result_pol[0],
					'pod' => $result_pod[0],
					'carga' => $result_contenedor
				));
			}//concluye el ciclo foreach
		}else if($tipo_carga == 'consolidada'){//Caso par acotizar cargas consolidadas
			$results = $this->get_results("SELECT * FROM flete_maritimo  
											LEFT JOIN naviera ON flete_maritimo.idnaviera = naviera.idnaviera 
											LEFT JOIN region ON flete_maritimo.idregion = region.idregion
											LEFT JOIN rel_flete_maritimo_carga ON flete_maritimo.idflete_maritimo = rel_flete_maritimo_carga.idflete_maritimo
											LEFT JOIN carga ON carga.idcarga = rel_flete_maritimo_carga.idcarga
											WHERE rel_flete_maritimo_carga.tipo = $tipo_carga_int
											AND flete_maritimo.pol = $pol
											AND flete_maritimo.pod = $pod");		
			foreach($results as $result){
				$result_pol = $this->get_results("SELECT locode,puerto FROM puerto WHERE idpuerto = $result->pol");
				$result_pod = $this->get_results("SELECT locode,puerto FROM puerto WHERE idpuerto = $result->pod");	
				$result_via = $this->get_results("SELECT * FROM via1 
												  LEFT JOIN puerto ON via1.idpuerto = puerto.idpuerto 
												  WHERE idfletemaritimo = $result->idflete_maritimo");
				$result_recargos = $this->get_results("SELECT * FROM rel_flete_maritimo_recargo_maritimo 
													 LEFT JOIN recargo_maritimo ON rel_flete_maritimo_recargo_maritimo.idrecargo_maritmo = recargo_maritimo.idrecargo_maritimo 
													 LEFT JOIN naviera ON recargo_maritimo.idnaviera = naviera.idnaviera
													 LEFT JOIN recargo ON recargo_maritimo.idrecargo = recargo.idrecargo
													 WHERE idflete_maritimo = $result->idflete_maritimo");
				$result_contenedor = $this->get_results("SELECT * FROM carga WHERE idcarga = $result->idcarga");												  		
				array_push($result_array,array(
					'flete_maritimo' => $result,
					'via' => $result_via,
					'recargos' => $result_recargos,
					'pol' => $result_pol[0],
					'pod' => $result_pod[0],
					'carga' => $result_contenedor
				));
			}//concluye el ciclo foreach
		}
		
		return $result_array;			
	}//Termina la funcnión get_aerial_quote	
}