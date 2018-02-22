$(document).ready(function(){

	$('#FormContent').on('submit',function(){

		if( !$('#nome_planilha').val() ){
			alert('Selecione um tipo de planilha!!!');
			return false;
		}

		if( !$('#UploadFile').val() ){
			alert('Selecione um arquivo para enviar!!!');
			return false;
		}


		return true;

	});

	$('#DownloadPlanilha').on('submit',function(){

		if( !$('#nome_planilha2').val() ){
			alert('Selecione um tipo de planilha!!!');
			return false;
		}
		
		return true;

	});


	$('#AplicarBids').on('click',function(e){

		var obj = $(this);

		e.preventDefault();

		 swal({
			 title: 'Você tem certeza?',
			 text: 'Os bids serão enviados para o parceiro.',
			 type: 'warning',
			 showCancelButton: true,
			 confirmButtonColor: '#DD6B55',
			 confirmButtonText: 'Sim, tenho certeza.',
			 closeOnConfirm: true,
			 }, function (confirm) {

				 if(confirm)
					 window.location = obj.attr('href');
		 	}

		);

		return false;

	});

	if( $_GET['sucesso'] ){
		notification('Planilha upada com sucesso!','success','bottomRight',5000,'icon-success');
	}

	if( $_GET['sucesso_bids'] ){
		notification('Bids alterados com sucesso!','success','bottomRight',5000,'icon-success');
	}

	if( $_GET['falha_bids'] || $_GET['falha_download']) {
		notification('A planilha não existe!', 'error', 'bottomRight', 5000, 'icon-close');
	}


});