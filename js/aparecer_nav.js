$(document).ready(function(){
	$('.espacio-nav-lateral').hide();
	$('.espacio-nav-lateral-perfil').hide();
	$('.legenda-ver-nav').click(function(){
		$('.espacio-nav-lateral').slideToggle();
	});
	$('.legenda-ver-nav-perfil').click(function(){
		$('.espacio-nav-lateral-perfil').slideToggle();
	});

	
})