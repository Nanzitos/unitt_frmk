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
						//"kit", "ano_compra", "mes_compra", "dia_compra",	"compras", "source", "medium", "campaign", "device", "operatingSystem"
            html='<div class="row FiltroRow">';
            html+='<div class="col-sm-12">';
            html+='<div class="row" style="margin-bottom:10px;">';
            html+='<div class="col-xs-2" style="min-width:225px;">';
            html+='<select name="colunas['+ct_field+']" id="filtro_'+ct_field+'" class="select2" style="min-width:210px;">';
            html+='<option value="">Selecione:</option>';
						html+= '<option value="operatingSystem-string">S. Operacional</option>';
						html+= '<option value="device-string">Device</option>';
						html+= '<option value="email-string">Email</option>';
						html+= '<option value="Cliente-string">Cliente</option>';
						html+= '<option value="phone-string">Telefone</option>';
						html+= '<option value="cpf-string">Cpf</option>';
						html+= '<option value="endereco-string">Endereco</option>';
						html+= '<option value="id_marca-int">Marca</option>';
						html+= '<option value="kit-string">Kit</option>';
						html+= '<option value="compras-int">#Compras</option>';
						html+= '<option value="source-string">Source</option>';
						html+= '<option value="medium-string">Medium</option>';
						html+= '<option value="campaign-string">Campaign</option>';

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
          url:'/clientes-recompra',
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
