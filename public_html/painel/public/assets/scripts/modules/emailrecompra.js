$(document).ready(function(){
	$('.btn-primary').on('click', function(){
		data_completa = $('#daterange').val();
		$(location).attr('href', 'email-recompra?data_completa='+data_completa);
	});
});