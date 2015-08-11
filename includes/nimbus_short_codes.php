<?php


/**
 * Cotizador Short Code
 */
add_shortcode('nbcotizador', 'nimbus_cotizador');
function nimbus_cotizador(){
	return 	'<div class="wizard" data-initialize="wizard" id="myWizard">
  <div class="steps-container">
    <ul class="steps">
      <li data-step="1" data-name="campaign" class="active"><span class="badge">1</span>Campaign<span class="chevron"></span></li>
      <li data-step="2"><span class="badge">2</span>Recipients<span class="chevron"></span></li>
      <li data-step="3" data-name="template"><span class="badge">3</span>Template<span class="chevron"></span></li>
    </ul>
  </div>
  <div class="actions">
    <button type="button" class="btn btn-default btn-prev"><span class="glyphicon glyphicon-arrow-left"></span>Prev</button>
    <button type="button" class="btn btn-default btn-next" data-last="Complete">Next<span class="glyphicon glyphicon-arrow-right"></span></button>
  </div>
  <div class="step-content">
    <div class="step-pane active sample-pane alert" data-step="1">
      <h4>Setup Campaign</h4>
      <p>Veggies es bonus vobis, proinde vos postulo essum magis kohlrabi welsh onion daikon amaranth tatsoi tomatillo melon azuki bean garlic. Beetroot water spinach okra water chestnut ricebean pea catsear courgette.</p>
    </div>
    <div class="step-pane sample-pane bg-info alert" data-step="2">
      <h4>Choose Recipients</h4>
      <p>Celery quandong swiss chard chicory earthnut pea potato. Salsify taro catsear garlic gram celery bitterleaf wattle seed collard greens nori. Grape wattle seed kombu beetroot horseradish carrot squash brussels sprout chard. </p>
    </div>
    <div class="step-pane sample-pane bg-danger alert" data-step="3">
      <h4>Design Template</h4>
      <p>Nori grape silver beet broccoli kombu beet greens fava bean potato quandong celery. Bunya nuts black-eyed pea prairie turnip leek lentil turnip greens parsnip. Sea lettuce lettuce water chestnut eggplant winter purslane fennel azuki bean earthnut pea sierra leone bologi leek soko chicory celtuce parsley jÃ­cama salsify. </p>
    </div>
  </div>

</div>';
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
