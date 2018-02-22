$(document).ready(function(){

	var token   		= $('meta[name="csrf-token"]').attr('content');
	var novoBoletoToken = 'novoBoleto-)@*#9*#(@(99@*#&(&$(@!!!!!Jo0as(D2)@H983';
	var emailCliente    = '';

	var BackofficeAcao     = '';
	var BackofficeDesc     =  '';
	var BackofficeIdPedido = '';

	$('.AbrirBackofficeInteracao').on('click', function (e) {
		
		var id_pedido 		 = $(this).data('id-pedido');
		var PedidoMarca      = $('#PedidoMarca');
	  	var PedidoKit 		 = $('#PedidoKit');
		var PedidoData 		 = $('#PedidoData');
		var PedidoNome 		 = $('#PedidoNome');
		var PedidoTelefone 	 = $('#PedidoTelefone');
		var PedidoEmail 	 = $('#PedidoEmail');
		var PedidoSemContato = $('#PedidoSemContato');
		var BackofficeDescricao = $('#BackofficeDescricao');
		var PedidoPagamento  = $('#PedidoPagamento');

		$.ajax({
           headers:{'X-CSRF-TOKEN':token},
           url:'/backofficePedidoById',
           data:{"id":id_pedido},
           method:'POST',
           dataType:'json'
         }).done(function(ret) {

         	$('#BackofficeIdPedido').val(id_pedido);
	  		$('#ModalBackofficeCancelados').modal();

	  		var pagamento='<span class="label label-success" style="font-size:12px;">R$ '+number_format(ret.valor, 2, ',', '.')+'</span> ';
	  			pagamento+='<span class="label label-danger" style="font-size:12px;">R$ '+number_format(ret.desconto, 2, ',', '.')+'</span> ';
	  			pagamento+='<span class="label label-warning" style="font-size:12px;">R$ '+number_format(ret.valor_frete, 2, ',', '.')+'</span> ';

	  		PedidoMarca.html(ret.marca.nome);
	  		PedidoKit.html(ret.Kits); 		 
			PedidoData.html(ret.data_pedido); 		
			PedidoNome.html(ret.Cliente.nome+' '+ret.Cliente.sobrenome); 		
			PedidoTelefone.html(ret.Cliente.telefone+' / '+ret.Cliente.celular);
			PedidoEmail.html(ret.Cliente.email);
			PedidoSemContato.html('Sem contato ('+ret.ja_liguei+'x)');
			BackofficeDescricao.val(ret.descricao);
			PedidoPagamento.html(pagamento);
			emailCliente = ret.Cliente.email;

         });

	})

	$('.backofficebuttons').on('click', function(){

		var obj       		= $(this);
		var desc      		= $('#BackofficeDescricao');
		var acao      		= obj.data('acao');
		var id_pedido 		= $('#BackofficeIdPedido').val();

		BackofficeAcao     = acao;
		BackofficeIdPedido = id_pedido;

		$('.backofficebuttons').removeClass('ativo');
		obj.addClass('ativo');
		desc.focus();

	});

	$('#BackofficeSalvar').on('click', function(){

		var BackofficeDesc 		  = $('#BackofficeDescricao').val();
		var BackofficeAgendamento = $('#PedidoAgendar').val();
		var BackofficeIdPedido    = $('#BackofficeIdPedido').val();

		if( !BackofficeAcao && $('#PedidoAgendar').val() == '' ){

			swal({
		      title: 'Ops!',
		      text: 'Você precisa selecionar uma ação para continuar.',
		      type: 'warning',
		      showCancelButton: false,
		      confirmButtonColor: '#DD6B55',
		      confirmButtonText: 'Ok, entendi.',
		      closeOnConfirm: true,
		    });

		    return false;

		}

		if( !BackofficeDesc && $('#PedidoAgendar').val() == '' ){
			
			swal({
		      title: 'Ops!',
		      text: 'Você precisa explicar brevemente para continuar.',
		      type: 'warning',
		      showCancelButton: false,
		      confirmButtonColor: '#DD6B55',
		      confirmButtonText: 'Ok, entendi.',
		      closeOnConfirm: true,
		    });

		    return false;
		}

		$('#ModalBackofficeCancelados').modal('toggle');
		$.blockUI();

		$.ajax({
           headers:{'X-CSRF-TOKEN':token},
           url:'/backoffice/interagir',
           data:{"acao":BackofficeAcao,
           		 "descricao":BackofficeDesc,
           		 "id_pedido":BackofficeIdPedido,
           		 "agendar":BackofficeAgendamento},
           method:'POST',
           dataType:'json'
         }).done(function(ret) {
			
			if(!ret.response){
				alert('Ocorreu um erro desconhecido, tente novamente.');
				$.unblockUI();
			} else {

				window.location='/backoffice/cancelados';
				return false;
			}



         });

	});

	$('#GerarNovoBoleto').on('click', function(){

		$('#ModalBackofficeCancelados').modal('toggle');

		swal({
	      title: 'Segunda via de boleto',
	      text: 'Confirma a emissão de um novo boleto para o email:',
	      type: 'input',
	      showCancelButton: true,
	      confirmButtonColor: '#DD6B55',
	      confirmButtonText: 'Sim',
	      cancelButtonText: 'Não',
	      closeOnConfirm: true,
	      inputPlaceholder:'Digite o e-mail do cliente'
	    }, function(email){

	    	if( email ){

	    		$.blockUI();

	    		var id_pedido = $('#BackofficeIdPedido').val();

	    		$.ajax({
		           url:'http://televendas.the8co.com.br/novo-boleto',
		           data:{"id_pedido":id_pedido,'token':novoBoletoToken,"senderHash":PagSeguroDirectPayment.getSenderHash(),"email":email},
		           method:'GET',
		           dataType:'json'
		        }).done(function(ret) {

		        	if(ret.response){

						$.ajax({
				           headers:{'X-CSRF-TOKEN':token},
				           url:'/backoffice/interagir',
				           data:{"acao":'segunda_via',"descricao":'Novo boleto emitido para o cliente.','id_pedido':id_pedido,"email":email},
				           method:'POST',
				           dataType:'json'
				         }).done(function(ret) {
				         	swal("Boleto emitido!", "O novo boleto foi emitido com sucesso e será enviado em instantes no e-mail do cliente.", "success");
				         	setTimeout(function(){
				         		location.reload();
				         	},1000);
				         });
						

					} else {

						setTimeout(function(){
							swal("Boleto não emitido!", "Ocorreu um erro na emissão da segunda via, tente novamente.", "warning");
						},100);

						$.unblockUI();
						
					}

		        });

	    	}

	    });

	    $('.show-input').find('input').val(emailCliente);

	});

	$('#PedidoAgendar').datetimepicker({value:'', format: 'd/m/Y H:i'});

});