$(document).ready(function(){

	var token = $('meta[name="csrf-token"]').attr('content');
	
	$('#gerar_token').on('click', function(){

		var login = $('#login');
		var pass  = $('#password');

		if( !login.val() || !pass.val() ){

			swal('Ops!', 'Você precisa preencher o login e senha para gerar um token.', 'warning');
			return false;
		}

		$('#token').val('Aguarde...');

		$.ajax({
          headers:{'X-CSRF-TOKEN':token},
          url:'/gerarTokenOutbrain',
          data:{"login":login.val(),"password":pass.val()},
          method:'POST',
          dataType:'json'
        }).done(function(ret) {

        	if(ret.response){
        		$('#token').val(ret.token);	
        	} else {

        	}

            
        });

	});

})