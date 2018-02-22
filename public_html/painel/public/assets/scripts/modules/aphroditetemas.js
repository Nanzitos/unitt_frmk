$(document).ready(function(){

	if( $('.DuplicarRegistro').length ){


		$('.DuplicarRegistro').on('click', function(){

			var href = $(this).attr('href');

	  		swal({
		      title: 'Você tem certeza?',
		      text: 'Todos os registros abaixo do tema serão duplicados.',
		      type: 'warning',
		      showCancelButton: true,
		      confirmButtonColor: '#DD6B55',
		      confirmButtonText: 'Sim, tenho certeza.',
		      closeOnConfirm: true,
		    }, function (confirm) {
		      	
		    	if(confirm){
		    		$.blockUI();
		    		window.location=href;
		    	}

		    });

		    return false;

		});

	}

	if( $_GET['duplicado'] )
     	notification('Tema duplicado com sucesso!.','success','bottomRight',5000,'icon-success');

});