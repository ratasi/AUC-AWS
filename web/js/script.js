$(document).ready(function(){
	$('.preguntas')
	  .css('margin-left','20px')
	  .css('margin-right','20px')
	  .css('font-weight','bold');

	$('.respuestas')
	  .css('margin-left','20px')
	  .css('margin-right','40px')
	  .css('padding','6px')
	  .css('font-weight','bold');


    //Ocultar las respuestas
    $('.respuestas').hide();

    //evento click para que aparezca cada respuesta
    $('.preguntas').click(function(){
    	$(this).next().slideToggle(1000);
    });
});
