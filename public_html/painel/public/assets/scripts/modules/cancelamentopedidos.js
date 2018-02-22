$(document).ready(function(){

  $('#ToggleMenu').trigger('click');

	var token = $('meta[name="csrf-token"]').attr('content');

  /****************ENVIAR PEDIDOS PARA O SAC*****************/
  //Captura o valor (ID_PEDIDO) de todos os checkbox's selecionados
  $('#triagem-sac').on('click', function(){

    camposMarcados = new Array();

    $('.CheckFilhoCancelar:checked').each(function(){
        camposMarcados.push($(this).val());
    });

    if( camposMarcados.length == 0 ){
      notification('Nenhum pedido selecionado.','warning','bottomRight',5000,'icon-error');
      return false;
    }

    swal({
        title: 'Você tem certeza?',
        text: 'Deseja enviar os pedidos selecionados para o SAC?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Sim, tenho certeza.',
        closeOnConfirm: true,
      }, function (confirm) {

        if(confirm){

          $.blockUI();

            $.ajax({
              headers:{'X-CSRF-TOKEN':token},
              url:'/enviapedidossac',
              data:{"camposMarcados":camposMarcados},
              method:'POST',
              dataType:'json'
            }).done(function(ret) {
              if(ret.response){

                $.each(camposMarcados, function(key,val){
                  $('#Row'+val).remove();
                });

                notification('Pedidos enviados para a triagem com sucesso!','success','bottomRight',5000,'icon-success');

              }
            });

          $.unblockUI();

        }

      });

      return false;


  });

  /****************CANCELAR PEDIDOS*****************/
	//Captura o valor (ID_PEDIDO) de todos os checkbox's selecionados
	$('#cancelar-pedidos').on('click', function(){

    var camposMarcados = new Array();

		$(".CheckFilhoCancelar:checked").each(function(){
    		camposMarcados.push($(this).val());
		});

    if( camposMarcados.length == 0 ){
      notification('Nenhum pedido selecionado.','warning','bottomRight',5000,'icon-error');
      return false;
    }

    swal({
        title: '!!!! ATENÇÃO !!!!',
        text: 'Você tem certeza que deseja cancelar os pedidos selecionados?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Sim, tenho certeza.',
        closeOnConfirm: true,
      }, function (confirm) {

        if(confirm){

          $.blockUI();

            $.ajax({
              headers:{'X-CSRF-TOKEN':token},
              url:'/cancelarpedidos',
              data:{"camposMarcados":camposMarcados},
              method:'POST',
              dataType:'json'
            }).done(function(ret) {

              if(ret.response){

                $.each(camposMarcados, function(key,val){
                  $('#Row'+val).remove();
                });

                notification('Pedidos cancelados com sucesso!','success','bottomRight',5000,'icon-success');

              }
            });

          $.unblockUI();

        }

      });

    return false;

	});

  /****************LIBERAR PEDIDOS*****************/
	//Captura o valor (ID_PEDIDO) de todos os checkbox's selecionados
	$('#liberar-pedidos').on('click', function(){

		camposMarcados = new Array();

		$(".CheckFilhoCancelar:checked").each(function(){
    		camposMarcados.push($(this).val());
		});

    if( camposMarcados.length == 0 ){
      notification('Nenhum pedido selecionado.','warning','bottomRight',5000,'icon-error');
      return false;
    }

    swal({
        title: 'Você tem certeza?',
        text: 'Deseja liberar os pedidos selecionados?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Sim, tenho certeza.',
        closeOnConfirm: true,
      }, function (confirm) {

        if(confirm){

          $.blockUI();

		        $.ajax({
              headers:{'X-CSRF-TOKEN':token},
              url:'/liberarpedidos',
              data:{"camposMarcados":camposMarcados},
              method:'POST',
              dataType:'json'
            }).done(function(ret) {
                if(ret.response){

                  $.each(camposMarcados, function(key,val){
                    $('#Row'+val).remove();
                  });

                  notification('Pedidos liberados com sucesso!','success','bottomRight',5000,'icon-success');
                }
            });

          $.unblockUI();

        }

      });

    return false;
	});

  $('#suspeita-fraude').on('click', function(){

		camposMarcados = new Array();

		$(".CheckFilhoCancelar:checked").each(function(){
    		camposMarcados.push($(this).val());
		});

    if( camposMarcados.length == 0 ){
      notification('Nenhum pedido selecionado.','warning','bottomRight',5000,'icon-error');
      return false;
    }

    swal({
        title: 'Você tem certeza?',
        text: 'Deseja marcar os pedidos como suspeita de fraude?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Sim, tenho certeza.',
        closeOnConfirm: true,
      }, function (confirm) {

        if(confirm){

          $.blockUI();

		        $.ajax({
              headers:{'X-CSRF-TOKEN':token},
              url:'/pedidos_suspeita_fraude',
              data:{"camposMarcados":camposMarcados},
              method:'POST',
              dataType:'json'
            }).done(function(ret) {
                if(ret.response){

                  $.each(camposMarcados, function(key,val){
                    $('#Row'+val).remove();
                  });

                  notification('Pedidos Marcados como fraude com sucesso!','success','bottomRight',5000,'icon-success');
                }
            });

          $.unblockUI();

        }

      });

    return false;
	});

	//select all checkboxes
  $("#CheckPaiCancelar").on('change', function(){
      $('.CheckFilhoCancelar').prop('checked', $(this).prop('checked'));
	});

});
