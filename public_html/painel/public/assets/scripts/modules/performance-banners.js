$(document).ready(function(){

	var token = $('meta[name="csrf-token"]').attr('content');

	//$('#ToggleMenu').trigger('click'); //Fecha o menu para obter mais espaço na tela

    //console.log('teu cu, carai');

	/*
	* Inicializa o range
	*/

	//Seta para português
	moment.lang('pt-br')

    $('.per').daterangepicker({
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

	$('#selecaoTotal').on('click', function(){

        if($(this).prop('checked')){
            $('.check').prop('checked', true);
        } else {
            $('.check').prop('checked', false);
        }
    });

	$('#selecionarPacotes').on('click', function(){

        var ids = [];

        $.blockUI();

        $.each($('.check'), function(key,val){

            if($(this).prop('checked'))
                ids.push($(this).val());
        });

        if(ids.length > 0) {
        	$('#ids').val(ids);
        	$('#campo').submit();

        } else {
        	notification('Selecione um pacote, jovem...','error','bottomRight',5000,'icon-error');
        }

        $.unblockUI();

        return false;

    });

    $('#selecionarSets').on('click', function(){

        var ids = [];

        $.blockUI();

        $.each($('.check'), function(key,val){

            if($(this).prop('checked'))
                ids.push($(this).val());
        });

        if(ids.length > 0) {
        	$('#ids').val(ids);
        	$('#campo').submit();

        } else {
        	notification('Selecione um set, jovem...','error','bottomRight',5000,'icon-error');
        }

        $.unblockUI();

        return false;

    });

    $('.getPerformance').on('click', function(){

        var ids = [];

        if(ids.length > 0) {
            $('#campo').submit();
            $('#FormPerformanceBanners').submit();
            return true;
        } else {
            notification('Selecione ao menos uma campanha, amigo...','error','bottomRight',5000,'icon-error');
        }

        return false;

    });

    $('.FiltrarBanners').on('click', function(){

        var ids        = [];
        var filtros_js = $('#FiltrosJs').val();

        console.log(filtros_js);

        $.each($('.check'), function(key,val){

            if($(this).prop('checked'))
                ids.push($(this).val());
        });

        if(ids.length > 0) {
            $('#campanhas').val(ids);
            $('#filtros').val(filtros_js);

            return true;
        } else {
            notification('Selecione ao menos uma campanha, amigo...','error','bottomRight',5000,'icon-error');
        }

        return false;

    });

    $('.Pausar').on('click', function(){

        var id = '';

        $.blockUI();

        id = $(this).attr('id');

        $.ajax({
            headers: {'X-CSRF-TOKEN': token},
            url: '/pausar-banner-parceiro',
            data: {"id": id,
                   "status": false},
            method: 'POST',
            dataType: 'json'
        }).done(function (ret) {

            if (ret.response) {
                location.reload(true);
                $.unblockUI();
                notification('Banner pausado com sucesso!', 'success', 'bottomRight', 5000, 'icon-success');
            } else {
                //location.reload(true);
                $.unblockUI();
                notification('O banner selecionado não pode ser pausado!', 'error', 'bottomRight', 5000, 'icon-error');
            }
        });

        return false;

    });

    function updateColors () {
        $("td").css("background-color", "white");
        $("td").each (function () {
           var $cCell = $(this);
           if (Number ($cCell.text()) <= -1) {
              $cCell.css("background-color", "#FF0000");
           }
        });
    }


    $('.Retomar').on('click', function(){

        var id = '';

        $.blockUI();

        id = $(this).attr('id');

        $.ajax({
            headers: {'X-CSRF-TOKEN': token},
            url: '/retomar-banner-parceiro',
            data: {"id": id,
                   "status": true},
            method: 'POST',
            dataType: 'json'
        }).done(function (ret) {

            if (ret.response) {
                location.reload(true);
                $.unblockUI();
                notification('Banner ativado com sucesso!', 'success', 'bottomRight', 5000, 'icon-success');
            } else {
                //location.reload(true);
                $.unblockUI();
                notification('O banner não pode ser pausado!', 'error', 'bottomRight', 5000, 'icon-error');
            }
        });

        return false;

    });

     $('.SelecionarCampanhas').on('click', function(){

        var sel = true;

        $.blockUI();

        if($('.Parceiro').val() == "0")
        {
            sel = false;
        }

        $.unblockUI();

        if(sel) {
            $('.FiltroForm').submit();
            notification('Aguarde o recarregamento da página...','success','bottomRight',5000,'icon-success');
            return true;

        } else {
            notification('O campo Parceiro é obrigatório!','error','bottomRight',5000,'icon-error');
            return false;
        }

        return false;

    });

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
            html+='<div class="col-sm-10">';
            html+='<div class="row" style="margin-bottom:10px;margin-left:135px">';
            html+='<div class="col-xs-2" style="min-width:225px;margin-right:10px">';
            html+='<select name="campos['+ct_field+']" id="filtro_'+ct_field+'" class="form-control" style="min-width:210px;">';
            html+='<option value="">Métrica</option>';
            html+='<option value="base.impressions" <?php echo (isset($_GET["campos['+ct_field+']"]) && $_GET["campos['+ct_field+']"] && $_GET["campos['+ct_field+']"] == "impressoes")?"selected="selected"":"";?>Impressões</option>';
            html+='<option value="base.clicks" <?php echo (isset($_GET["campos['+ct_field+']"]) && $_GET["campos['+ct_field+']"] && $_GET["campos['+ct_field+']"] == "clicks")?"selected="selected"":"";?>Clicks</option>';
            html+='<option value="base.conversions" <?php echo (isset($_GET["campos['+ct_field+']"]) && $_GET["campos['+ct_field+']"] && $_GET["campos['+ct_field+']"] == "conversoes")?"selected="selected"":"";?>Conversões</option>';
            html+='<option value="base.spend" <?php echo (isset($_GET["campos['+ct_field+']"]) && $_GET["campos['+ct_field+']"] && $_GET["campos['+ct_field+']"] == "custo")?"selected="selected"":"";?>Custo</option>';
            html+='<option value="base.ctr" <?php echo (isset($_GET["campos['+ct_field+']"]) && $_GET["campos['+ct_field+']"] && $_GET["campos['+ct_field+']"] == "ctr")?"selected="selected"":"";?>CTR</option>';
            html+='<option value="base.taxa_conversao" <?php echo (isset($_GET["campos['+ct_field+']"]) && $_GET["campos['+ct_field+']"] && $_GET["campos['+ct_field+']"] == "taxa_conversao")?"selected="selected"":"";?>Taxa de Conversão</option>';
            html+='<option value="base.cpa" <?php echo (isset($_GET["campos['+ct_field+']"]) && $_GET["campos['+ct_field+']"] && $_GET["campos['+ct_field+']"] == "cpa")?"selected="selected"":"";?>>CPA</option>';
            html+='<option value="base.receita" <?php echo (isset($_GET["campos['+ct_field+']"]) && $_GET["campos['+ct_field+']"] && $_GET["campos['+ct_field+']"] == "receita")?"selected="selected"":"";?>Receita</option>';
            html+='</select>';
            html+='</div>';
            html+='<div class="col-xs-2" style="margin-right: 10px;">';
            html+='<select name="operador['+ct_field+']" id="operador_'+ct_field+'" class="form-control" style="min-width:100px;">';
            html+='<option value="">Operador</option>';
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

    $('#PausarBanners').on('click', function(){

        var ids = [];

        $.blockUI();

        $.each($('.check'), function(key,val){

            if($(this).prop('checked'))
                ids.push($(this).val());
        });

        if(ids.length > 0) {
            
            $.blockUI();

            $.ajax({
                headers: {'X-CSRF-TOKEN': token},
                url: '/pausar-banners-parceiro',
                data: {"ids": ids,
                       "status": false},
                method: 'POST',
                dataType: 'json'
            }).done(function (ret) {

                if (ret.response) {
                    location.reload(true);
                    $.unblockUI();
                    notification('Banners pausados com sucesso!', 'success', 'bottomRight', 5000, 'icon-success');
                } else {
                    //location.reload(true);
                    $.unblockUI();
                    notification('Os banners selecionados não podem ser pausados!', 'error', 'bottomRight', 5000, 'icon-error');
                }
            });

        return false;
        
        } else {
            notification('Selecione ao menos um banner, jovem san...','error','bottomRight',5000,'icon-error');
        }

        $.unblockUI();

        return false;

    });

     $('#RetomarBanners').on('click', function(){

        var ids = [];

        $.blockUI();

        $.each($('.check'), function(key,val){

            if($(this).prop('checked'))
                ids.push($(this).val());
        });

        if(ids.length > 0) {
            
            $.blockUI();

            $.ajax({
                headers: {'X-CSRF-TOKEN': token},
                url: '/retomar-banners-parceiro',
                data: {"ids": ids,
                       "status": false},
                method: 'POST',
                dataType: 'json'
            }).done(function (ret) {

                if (ret.response) {
                    location.reload(true);
                    $.unblockUI();
                    notification('Banners despausados com sucesso!', 'success', 'bottomRight', 5000, 'icon-success');
                } else {
                    //location.reload(true);
                    $.unblockUI();
                    notification('Os banners selecionados não podem ser despausados!', 'error', 'bottomRight', 5000, 'icon-error');
                }
            });

        return false;
        
        } else {
            notification('Selecione ao menos um banner, jovem san...','error','bottomRight',5000,'icon-error');
        }

        $.unblockUI();

        return false;

    });

});
