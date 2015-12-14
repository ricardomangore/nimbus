<?php


/**
 * Cotizador Short Code
 */
add_shortcode('nbcotizador', 'nimbus_cotizador');
function nimbus_cotizador($atts , $content ){
	extract($atts);
	set_query_var('success',$action);
	$template = locate_template("/templates/quote.php");
	load_template($template);
}


/**
 * Modal Window Short Code
 * 
 * Crea un boton para desplegar un modal window
 * 
 * @param array   $atts       Arreglo de atributos para el  shortcode
 * 							  'btntype'      establece el tipo  de botón 
 *               							 valores admitidos: default, primary, success, info, warnign, danger, link
 *         					  'btnsize'      establece el tamaño del botón
 *  										 valores admitidos: lg, sm, '' (vacio) para medium
 * 							  'btnvalue'     texto del botón
 * 							  'target'       Identificador unico interno para vincular el botón con el modal
 * 							  'title'        Título de la ventana modal
 * 							  'size'         Tamaño de la ventana modal
 *                  						 valores admitidos: lg, sm, '' (vacio) para medium
 * 
 * 
 * @param string  $content    Contenido del cuerpo del shortcode
 * 
 */
 add_shortcode('nbmodal', 'nimbus_modal');
 function nimbus_modal($atts = null, $content = ''){
 	
	
	if(isset($atts['btntype']))
		$atts['btntype'] = 'btn-' . $atts['btntype'];
	if(isset($atts['btnsize']))
		$atts['btnsize'] = 'btn-' . $atts['btnsize'];
	if(isset($atts['size']))
		$atts['size'] = 'modal-' . $atts['size'];		

	extract( shortcode_atts( array(
				'btntype'    => 'btn-primary',
				'btnsize'    => '', //default
				'btnvalue'   => 'Modal',
				'target'     => 'MyModal',
				'title'      => 'Title',
				'size'       => '' //default
			), $atts ) );		
	$content = do_shortcode($content);
 	
	return '<button type="button" class="btn '. $btntype .' '. $btnsize .'" data-toggle="modal" data-target="#'. $target .'">'. $btnvalue .'</button>
			<div class="modal fade" id="'. $target .'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog '. $size .'" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="myModalLabel">'. $title .'</h4>
			      </div>
			      <div class="modal-body">'. $content .'</div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      </div>
			    </div>
			  </div>
			</div>';
 }

/**
 * Popup Window Short Code
 * 
 * Crea un popup al cargase la página
 * 
 * @param array   $atts       Arreglo de atributos para el  shortcode
 * 							  'title'        Título de la ventana modal
 * 							  'size'         Tamaño de la ventana modal
 *                  						 valores admitidos: lg, sm, '' (vacio) para medium
 * 
 * 
 * @param string  $content    Contenido del cuerpo del shortcode
 * 
 */
 add_shortcode('nbpopup', 'nimbus_popup');
 function nimbus_popup($atts = null, $content = ''){
 	
	
	if(isset($atts['btntype']))
		$atts['btntype'] = 'btn-' . $atts['btntype'];
	if(isset($atts['btnsize']))
		$atts['btnsize'] = 'btn-' . $atts['btnsize'];
	if(isset($atts['size']))
		$atts['size'] = 'modal-' . $atts['size'];		

	extract( shortcode_atts( array(
				'title'      => 'Title',
				'size'       => '' //default
			), $atts ) );		
	$content = do_shortcode($content);
 	
	return '
			<div class="modal fade nbpopup" id="popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog '. $size .'" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="myModalLabel">'. $title .'</h4>
			      </div>
			      <div class="modal-body">'. $content .'</div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      </div>
			    </div>
			  </div>
			</div>';
 }








/**
 * Contextual Background
 *  
 * Proporciona un fondo de cierto colo al texto
 * 
 * @param      string     $content   texo
 * @param      array      $atts      Arreglo de atributos validos para el shortcode
 *            						 type:    tipo de contextual
 * 									 valores admitidos: default, primary, success, info, warnign, danger
 * 
 */
add_shortcode('nbcontextual', nimbus_contextual);
function nimbus_contextual($atts, $content = ''){
	if(isset($atts['type']))
		$atts['type'] = 'bg-' . $atts['type'];
	extract(shortcode_atts(array('type' => 'bg-primary'),$atts));
	$content = do_shortcode($content);
	return "<p class='$type'>$content</p>";
}

/**
 * Nimbus Shape
 * 
 * Proporciona un aspecto circular, rectangular o de thumbnail a una imagen
 * 
 * @param	   array	$atts	  Arreglo de atributos validos para el shortcode
 *      						  type:    tipo de Shape
 * 								  valores admitidos: rounded, circle, thumbnail
 * 							      
 */
 add_shortcode('nbshape', 'nimbus_shape');
 function nimbus_shape($atts, $content = ''){
 	if(isset($atts['type']))
		$atts['type'] = 'img-' . $atts['type'];
	extract(shortcode_atts(array(
		'type' => 'img-rounded',
		'src'  => 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgdmlld0JveD0iMCAwIDE0MCAxNDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzE0MHgxNDAKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNGVmZjg5MGI5ZCB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE0ZWZmODkwYjlkIj48cmVjdCB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjQ0LjA0MTY2NjAzMDg4Mzc5IiB5PSI3NC44Ij4xNDB4MTQwPC90ZXh0PjwvZz48L2c+PC9zdmc+',
		'alt'  => ''
		),$atts));
 	return "<img src='$src' alt='. $alt .' class='$type'/>";
 }

/**
 * Nimbus Thumbnail
 * 
 * Muestra una imagen que opcionalmente puede mostrar información
 * 
 * @param		string		$content	Contenido del componente
 * @param		array		$array		Arreglo de atributos validos para el componente
 * 										src:    url de la imágen
 * 										alt:    atributo alt de la imagen
 * 										title:  título del thumbnail
 * 										col:    número de columnas por renglón
 * 												3 columnas imagenes de 242X200
 * 												4 columnas imágenes 
 */
 add_shortcode('nbthumbnail', 'nibus_nbthumbnail');
 function nibus_nbthumbnail($atts, $content = ''){
 	extract(shortcode_atts(array(
		'title' => 'Title',
		'col'   => '3'
	),$atts));
	
	$content = do_shortcode($content);
	
	/*if(!isset($src)){
		if($col == '4'){
			$col = '3';
			$width = '242';
			$height = '200';
			$src = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMjQyIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDI0MiAyMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzEwMCV4MjAwCkNyZWF0ZWQgd2l0aCBIb2xkZXIuanMgMi42LjAuCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQooYykgMjAxMi0yMDE1IEl2YW4gTWFsb3BpbnNreSAtIGh0dHA6Ly9pbXNreS5jbwotLT48ZGVmcz48c3R5bGUgdHlwZT0idGV4dC9jc3MiPjwhW0NEQVRBWyNob2xkZXJfMTRmMDNkZDBlMWMgdGV4dCB7IGZpbGw6I0FBQUFBQTtmb250LXdlaWdodDpib2xkO2ZvbnQtZmFtaWx5OkFyaWFsLCBIZWx2ZXRpY2EsIE9wZW4gU2Fucywgc2Fucy1zZXJpZiwgbW9ub3NwYWNlO2ZvbnQtc2l6ZToxMnB0IH0gXV0+PC9zdHlsZT48L2RlZnM+PGcgaWQ9ImhvbGRlcl8xNGYwM2RkMGUxYyI+PHJlY3Qgd2lkdGg9IjI0MiIgaGVpZ2h0PSIyMDAiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSI4OS42NDk5OTk2MTg1MzAyNyIgeT0iMTA1Ljc2MDAwMDIyODg4MTg0Ij4yNDJ4MjAwPC90ZXh0PjwvZz48L2c+PC9zdmc+';
		}elseif($col == '3'){
			$col = '4';
			$width = '350';
			$height = '235';
			$src = 'data:image/png;base64,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';
		}
	}else{*/
		if($col == '3'){
			$col = '4';
			$width = '350';
			$height = '235';
		}elseif($col == '4'){
			$width = '242';
			$height = '200';
			$col = '3';
		}
	//}

 	return '<div class="col-xs-6 col-md-'. $col .'">
			    <div class="thumbnail">
			      <img src="'. $atts['src'] .'" alt="'. $alt .'" width="'. $width .'" height="'. $height .'">
			      <div class="caption">
			        <h3>'. $title .'</h3>
			        '. $content .'
			      </div>
			    </div>
			  </div>';
 }

/**
 * Nimbus Info
 * 
 * Componente para mostrar informacion acompañada de una imagen con shape circular
 */
add_shortcode('nbinfo','nimbus_info');
function nimbus_info($atts, $content = ''){
	extract(shortcode_atts(array(
		'src'    => 'data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==',
		'title'  => 'Title'
	),$atts));
	$content = do_shortcode($content);
	return "<div class='col-md-4 text-center'>
				<img class='img-circle' src='$src' alt=''  width='140' height='140'/>
				<h2>$title</h2>
				$content
			</div>";
}

/**
 * Nimbus Link
 * 
 * Link con apariencia de boton
 * 
 * tipos default, link, primary, success, warning, info
 */
 add_shortcode('nblink', 'nimbus_link');
 function nimbus_link($atts, $content = ''){
 	extract(shortcode_atts(array(
		'type'	=> 'link',
		'href'  => '#',
		'size'  => ''
	),$atts));
	if($size != '')
		$size = 'btn-' . $size;
	$content = do_shortcode($content);
	return "<a class='btn btn-$type $size' href='$href'>$content</a>";
 }


/**
 * Nimbus Row
 * 
 * Genera un reglón de la plantilla Bootstrap
 */
 add_shortcode('row', 'nimbus_row');
 function nimbus_row($atts, $content){
 	$content = do_shortcode($content);
 	return "<div class='row'>$content</div>";
 }
 
 /*
  * Nimbus Slider
  * 
  * Inserta un cuerpo para insertar slides
  * @param	array	indicators   indica el numero de indicadores e items que tendra el carousel
  */
add_shortcode('nbslider' ,'nimbus_slider');
function nimbus_slider($atts, $content){
	extract(shortcode_atts(array(
		'indicators'	=> '0',
		'target'        => ''
	),$atts));
	$html_indicator = '';
	$html_item = '';
	for($i = 0 ; $i < $indicators; $i++){
		if($i == 0)
			$html_indicator .= '<li data-target="#'. $target .'" data-slide-to="'. $i .'" class="active"></li>';
		else
			$html_indicator .= '<li data-target="#'. $target .'" data-slide-to="'. $i .'"></li>';
	}

	$content = do_shortcode($content);
	return '<div id="'. $target .'" class="carousel slide" data-ride="carousel">
			  <!-- Indicators -->
			  <ol class="carousel-indicators">
			    '. $html_indicator .'
			  </ol>
			  
			  <!-- Wrapper for slides -->
			  <div class="carousel-inner" role="listbox">
			    '. $content .'
			  </div>
			  
			  <!-- Controls -->
			  <a class="left carousel-control" href="#'. $target .'" role="button" data-slide="prev">
			    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="right carousel-control" href="#'. $target .'" role="button" data-slide="next">
			    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>
			</div>';
}

/**
 * Nimbus Slider Item
 */
add_shortcode('nbslider-item','nimbus_slider_item');
function nimbus_slider_item($atts, $content){
	extract(shortcode_atts(array(
		'alt'	 => '',
		'src'    => '',
		'status' => ''
	),$atts));
	$content = do_shortcode($content);
	return '<div class="item '. $status .'">
		      <img src="'. $src .'" alt="'. $alt .'">
		      <div class="carousel-caption">'. $content .'</div></div>';
}

/**
 * Nimbus news
 */
 
add_shortcode('nbnews', 'nimbus_news');
function nimbus_news($atts, $content){
	extract(shortcode_atts(array(),$atts));
	$content = do_shortcode($content);
	return '<div class="nbnews">'. $content .'</div>';
}
/**
 * Nimbus News Slider
 */
add_shortcode('nbnewslider', 'nimbus_news_slider');
function nimbus_news_slider($atts, $content){
	extract(shortcode_atts(array(
		'target' => ''
	),$atts));
	$content = do_shortcode($content);
	return '<div id="'. $target .'" class="carousel slide" data-ride="carousel">
      <!-- Wrapper for slides -->
	'. $content .'

      <!-- Controls -->
      <div class="carousel-controls">
          <a class="left carousel-control" href="'. $target .'" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
          </a>
          <a class="right carousel-control" href="'. $target .'" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
          </a>
      </div>

    </div><!-- End Carousel -->';
}

/**
 * Nimbus nbnewslider-inner
 */
 add_shortcode('nbnewslider-inner', 'nimbus_news_slider_inner');
 function nimbus_news_slider_inner($atts, $content){
 	extract(shortcode_atts(array(),$atts));
	$content = do_shortcode($content);
	return '<div class="carousel-inner">'. $content .'</div><!-- .carousel-inner -->';
 }

/**
 * Nimbus nbnewslider Item
 */
add_shortcode('nbnewslider-item', 'nbnewslider_item');
function nbnewslider_item($atts, $content){
	extract(shortcode_atts(array(
		'status' => '',
		'src'    => ''
	),$atts));
	$content = do_shortcode($content);
	return '<div class="item '. $status.'">
	          <img src="'. $src .'">
	           <div class="carousel-caption">
	            '. $content .'
	          </div>
	        </div><!-- End Item -->';
}

/**
 * Nimbus nbnewslider-list
 */
 
 add_shortcode('nbnewslider-list', 'nimbus_news_slider_list');
 function nimbus_news_slider_list($atts, $content){
 	extract(shortcode_atts(array(),$atts));
	$content = do_shortcode($content);
	return '<ul class="list-group col-sm-4 hidden-xs">'. $content .'</ul>';
 }

/**
 * Nimbus nbnewslider-list-item
 */
add_shortcode('nbnewslider-list-item','nimbus_news_slider_list_item');
function nimbus_news_slider_list_item($atts, $content){
 	extract(shortcode_atts(array(
 		'num' => '',
 		'target' => ''
	),$atts));
	$content = do_shortcode($content);
	return '<li data-target="#'. $target .'" data-slide-to="'. $num .'" class="list-group-item active"><h4>'. $content .'</h4></li>';
}







