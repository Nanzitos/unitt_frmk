$(document).ready(function(){

	$('#FormBuscaCidades').on('submit', function(){
		$('#ModalSearch').modal('hide');
		$.blockUI();
	});
	
});