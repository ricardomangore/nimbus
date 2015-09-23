(function($){

	$(document).ready(function() {
		$maritimeQuoteForm = $('[name=maritime_quote_form]');
		$aerialQuoteForm   = $('[name=aerial_quote_form]');
		$opxWizard = $('#opx_wizard').wizard();
	  	$aeropuerto_selectpicker = $('.opt_aeropuerto').selectpicker();
	  	$btnOpxServicioMaritimo = $('.opx_btn_maritimo');
	  	$btnOpxServicioAereo    = $('.opx_btn_aereo');
	  	
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
	  	
	  	$btnRadioTipoServicio = $('[name=opx_tipo_servicio]');
	  	$btnRadioTipoServicio.click(function(event){
	  		var tipo = $(this).val();
	  		switch( tipo ){
	  			case 'maritimo' : {
	  								$aerialQuoteForm.hide();
	  								$maritimeQuoteForm.show();
	  								$opxWizard.wizard('next');
	  								break;
	  			}
	  			case 'aereo'	: {
	  								$aerialQuoteForm.show();
	  								$maritimeQuoteForm.hide();
	  								$opxWizard.wizard('next');
	  								break;
	  			}
	  		}
	  	});
	  	
	});

})(jQuery);