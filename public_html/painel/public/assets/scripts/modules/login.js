$(document).ready(function(){

	/**
     * EsqueciForm
     *
     * Função que recupera a senha do usuário por e-mail.
     *
     */

	$('#EsqueciForm').on('submit', function(e){

		e.preventDefault();

		var buttons = $('.ModalButtonGroup');
		var email   = $('#EsqueciEmail');
		var token   = $('meta[name="csrf-token"]').attr('content');
		
		email.parent().removeClass('has-error');

		$.blockUI();

		if(!validateEmail(email.val())){
			$.unblockUI();
			email.focus();
			email.parent().addClass('has-error');
			return false;
		}

		$.ajax({
		  url: 'esqueci',
		  headers:{'X-CSRF-TOKEN':token},
		  data: {"email":email.val()},
		  method: 'POST',
		  dataType:'json'
		}).done(function(ret) {

			$.unblockUI();
			email.val('');

			if(ret.response){
				$('.close').trigger('click');
				swal('Successo!', 'Uma nova senha foi enviada para o e-mail de cadastro.', 'success');
			} else {
				email.focus();
				swal('Ops!', 'Não encontramos seu e-mail na nossa base.', 'warning');
			}
 
		});

	});

	runValidator($('#LoginForm')); //Inicia a validação.

});