(function($){

/**
 * nimbusScrollHandler(event)
 * Esta funcion se ejecuta cuando ocurre un evento onclick sobre un objeto de la clase '.nimbus-scroll'
 * 
 * @param {Object} event 
 */
function nimbusScrollHandler(event){
	if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {
	
	    var target = $(this.hash);
	    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
	    if (target.length) {
	        $('html,body').animate({
	            scrollTop: target.offset().top - 50
	        }, 1000);
	        return false;
	    }
	}
}//Termina la funcion nimbusScrollHandler

$(document).ready(function(event){
	$('a.nimbus-scroll').click(nimbusScrollHandler);
});

})(jQuery);