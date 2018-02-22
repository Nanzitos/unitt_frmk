$(document).ready(function(){

	//Esconde o menu para aproveitar a tela.
	$('#ToggleMenu').trigger('click');

	$('#FormBuscaPedidos').on('submit', function(){
		$('#ModalSearch').modal('hide');
		$.blockUI();
	});

	if( $('#filtros').length ){

		$('#filtros').tagsInput({
		    width: 'auto',
		    "onRemoveTag":function(e){

		    	var filtro = e;
		    	
		    	$('.filtros_fields').each(function(key,val){
		    		var obj = $(this);

					if( obj.val() == filtro ){
						obj.val('');
						$('.FiltroForm').submit();
					}
				});

		    },
		});

		$('#filtros_tagsinput').css({'background':'none','border':'none'});
		$('#filtros_tag').remove();
	}


	if( $('#FormContent').length == 1 ){

		var submit = 0;

		$('#FormContent').on('submit', function(){

			if( !submit ){

				swal({
			      title: 'Deseja realmente continuar?',
			      text: 'As alterações dessas informações irão sobreescrever os dados originais.',
			      type: 'warning',
			      showCancelButton: true,
			      confirmButtonColor: '#DD6B55',
			      confirmButtonText: 'Sim, tenho certeza.',
			      closeOnConfirm: true,
			    }, function (confirm) {
			      	
			    	if(confirm){
			    		submit = 1;
			    		$('#FormContent').trigger('submit');
			    	}

			    });

				return false;

			} else {
				return true;
			}

		});

	}

});