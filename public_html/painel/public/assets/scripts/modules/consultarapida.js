$(document).ready(function(){

	var token = $('meta[name="csrf-token"]').attr('content');

    $('#open-exemplos').on('click', function() {
        $('#popup-exemplos').modal('show');
    });

	$('#ToggleMenu').trigger('click'); //Fecha o menu para obter mais espaço na tela




    /**
     * Incremento de informações dinamicas
     *
     */
     var ct_field = 1;

     $(document).on('click', '.ActionButton', function(){

        var obj           = $(this);  
        var action        = obj.data('action');
        var content       = obj.parent().parent().parent().parent().parent();
        var type          = obj.data('type');

          if( action == 'add' ){

            ct_field = $('.FiltroRow').length+1;

            html='<div class="row FiltroRow">';
            html+='<div class="col-sm-12">';
            html+='<div class="row" style="margin-bottom:10px;">';
            html+='<div class="col-xs-2" style="min-width:225px;">';
            html+='<select name="colunas['+ct_field+']" id="filtro_'+ct_field+'" class="select2" style="min-width:210px;">';
            html+='<option value="">Selecione:</option>';
            html+='<option value="id_pedido-int">id_pedido</option>';
            html+='<option value="cid-string">cid</option>';
            html+='<option value="id_marca-int">id_marca</option>';
            html+='<option value="criado_por-int">criado_por</option>';
            html+='<option value="dispositivo-string">dispositivo</option>';
            html+='<option value="valor-double">valor</option>';
            html+='<option value="valor_total-double">valor_total</option>';
            html+='<option value="valor_frete-int">valor_frete</option>';
            html+='<option value="utm_source-string">utm_source</option>';
            html+='<option value="utm_medium-string">utm_medium</option>';
            html+='<option value="utm_campaign-string">utm_campaign</option>';
            html+='<option value="utm_term-string">utm_term</option>';
            html+='<option value="utm_content-string">utm_content</option>';
            html+='<option value="kit_nome-string">kit_nome</option>';
            html+='<option value="kit_preco-double">kit_preco</option>';
            html+='<option value="cliente_id-int">cliente_id</option>';
            html+='<option value="cliente_nome-string">cliente_nome</option>';
            html+='<option value="cliente_sobrenome-string">cliente_sobrenome</option>';
            html+='<option value="cliente_email-string">cliente_email</option>';
            html+='<option value="cliente_cep-string">cliente_cep</option>';
            html+='<option value="cliente_logradouro-string">cliente_logradouro</option>';
            html+='<option value="cliente_numero-string">cliente_numero</option>';
            html+='<option value="cliente_complemento-string">cliente_complemento</option>';
            html+='<option value="cliente_bairro-string">cliente_bairro</option>';
            html+='<option value="cliente_cidade-string">cliente_cidade</option>';
            html+='<option value="cliente_estadocliente_estado-string">cliente_estado</option>';
            html+='<option value="cliente_telefone-string">cliente_telefone</option>';
            html+='<option value="pagamento_id-string">pagamento_id</option>';
            html+='<option value="pagamento_tipo-string">pagamento_tipo</option>';
            html+='<option value="pagamento_gateway-string">pagamento_gateway</option>';
            html+='<option value="pagamento_gateway_response-string">pagamento_gateway_response</option>';
            html+='<option value="pagamento_txn_id-string">pagamento_txn_id</option>';
            html+='<option value="pagamento_valor-int">pagamento_valor</option>';
            html+='<option value="pagamento_valor_parcela-int">pagamento_valor_parcela</option>';
            html+='<option value="is_televendas-int">is_televendas</option>';
            html+='<option value="user_agent-string">user_agent</option>';
            html+='</select>';
            html+='</div>';
            html+='<div class="col-xs-2" style="min-width:225px;">';
            html+='<select name="operador['+ct_field+']" id="operador_'+ct_field+'" class="select2" style="min-width:210px;">';
            html+='<option value="">Selecione:</option>';
            html+='<option value="=">=</option>';
            html+='<option value="!=">!=</option>';
            html+='<option value=">">></option>';
            html+='<option value=">=">>=</option>';
            html+='<option value="<"><</option>';
            html+='<option value="<="><=</option>';
            html+='</select>';
            html+='</div>';
            html+='<div class="col-xs-2">';
            html+='<input type="text" name="valor['+ct_field+']" id="valor_'+ct_field+'" class="form-control float_number" placeholder="Valor">';
            html+='</div>';
            html+='<div class="col-xs-2">';
            html+='<button type="button" data-action="add" class="btn btn-success btn-round btn-icon-icon mr5 ActionButton" data-type="filtros">';
            html+='<i class="icon-plus"></i>';
            html+='</button>';
            html+='</div>';
            html+='</div>';
            html+='</div>';
            html+='</div>';

            content.append(html);
            ct_field++;

            obj.removeClass('btn-success');
            obj.addClass('btn-danger');
            obj.find('i').removeClass('icon-plus');
            obj.find('i').addClass('icon-close');
            obj.data('action','del');

            defineMasks();
            

          } else {

            if($('.FiltroRow').length > 1){
              obj.parent().parent().remove();
            }

          }

      }); 
    


















	/*
	* Inicializa o range
	*/

	//Seta para português
	moment.lang('pt-br');

	$('#daterange').daterangepicker({
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

	});

    $('#query').on('submit', function(){
        console.log('CU');
        $.blockUI();

        var de  = document.getElementsByName('daterangepicker_start')[0].value;
        var ate = document.getElementsByName('daterangepicker_end')[0].value;
        var id_marca = $('#id_marca').val();
     
        $('#ModalSearch').modal('toggle'); 

        $.ajax({
          headers:{'X-CSRF-TOKEN':token},
          url:'/consulta-mongo',
          data:{"de":de,"ate":ate,"id_marca":id_marca},
          method:'POST',
          dataType:'json'
        }).done(function(ret) {

            if(ret.response){

                console.log('mah rodooou');
                var data = ret.data;
                var html = '';
            }
        });

        $.unblockUI();
       

    });
});