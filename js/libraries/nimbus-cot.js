(function($){

	$(document).ready(function() {
		$maritimeQuoteForm = $('[name=maritime_quote_form]');
		$aerialQuoteForm   = $('[name=aerial_quote_form]');
		$cargaContenerizada = $('.carga_contenerizada');
		$cargaConsolidada = $('.carga_consolidada');
		$opxWizard = $('#opx_wizard').wizard();
	  	$aeropuerto_selectpicker = $('.opt_aeropuerto').selectpicker();
	  	$btnOpxServicioMaritimo = $('.opx_btn_maritimo');
	  	$btnOpxServicioAereo    = $('.opx_btn_aereo');
	  	$cargaContenerizada.hide();
	  	$cargaConsolidada.hide();
	  	
	  	$btnOpxServicioMaritimo.click(function(event){
		  	$aerialQuoteForm.hide();
		  	$maritimeQuoteForm.show();
		  	$opxWizard.wizard('next');
	  	});
	  	
	  	$btnOpxServicioAereo.click(function(event){
		  	$aerialQuoteForm.show();
		  	$maritimeQuoteForm.hide();
		  	$opxWizard.wizard('next');
	  	});
	  	
	  	$btnRadioTipoCarga = $('[name=opx_tipo_carga]');
	  	$btnRadioTipoCarga.click(function(event){
	  		var tipo = $(this).val();
	  		switch( tipo ){
	  			case 'consolidada' : {
									$cargaConsolidada.show();
									$cargaContenerizada.hide();
	  								break;
	  			}
	  			case 'contenerizada'	: {
									$cargaContenerizada.show();
									$cargaConsolidada.hide();
	  								break;
	  			}
	  		}
	  	});
	  	
	});

})(jQuery);