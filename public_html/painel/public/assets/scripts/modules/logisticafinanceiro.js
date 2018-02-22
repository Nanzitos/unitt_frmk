$(document).ready(function(){

	var token = $('meta[name="csrf-token"]').attr('content');

	$('#ToggleMenu').trigger('click'); //Fecha o menu para obter mais espaço na tela

	/*
	* Inicializa o range
	*/

	//Seta para português
	moment.lang('pt-br')

	$('.drp').daterangepicker({
	    format: 'YYYY-MM-DD',
	    opens: 'left',
	    'locale':{
	    	applyLabel: 'Aplicar',
            cancelLabel: 'Cancelar',
            fromLabel: 'De',
            toLabel: 'Até'
	    }

	}, 
	function(start, end, label) {

		$.blockUI();

		var de  = document.getElementsByName('daterangepicker_start')[0].value;
		var ate = document.getElementsByName('daterangepicker_end')[0].value;

		window.location="/logistica-funil-financeiro?de="+de+"&ate="+ate;

	});

});