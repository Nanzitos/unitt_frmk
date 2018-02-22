$(document).ready(function(){

	var token = $('meta[name="csrf-token"]').attr('content');

	//$('#ToggleMenu').trigger('click'); //Fecha o menu para obter mais espaço na tela



	/*
	* Inicializa o range
	*/

	//Seta para português
	moment.lang('pt-br')

    $('.drp').daterangepicker({
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

    $('#filaDeUpload').on('click', function(){

        var ids = [];

        $.blockUI();

        $.each($('.check'), function(key,val){

            if($(this).prop('checked'))
                ids.push($(this).val());
        });

        if(ids.length > 0) {
            $('#campanhas').val(ids);
            $('#campo').submit();
        } else {
            notification('Selecione ao menos uma campanha, amigo...','error','bottomRight',5000,'icon-error');
        }

        $.unblockUI();

        return false;

    });

    $('.Pausar').on('click', function(){

        var id = '';

        //$.blockUI();

        id = $(this).attr('id');

        $.ajax({
            headers: {'X-CSRF-TOKEN': token},
            url: '/pausar-banner',
            data: {"id": id},
            method: 'POST',
            dataType: 'json'
        }).done(function (ret) {

            if (ret.response) {
                location.reload(true);
                //$.unblockUI();
                notification('Banner pausado na fila upload com sucesso!', 'success', 'bottomRight', 5000, 'icon-success');
            } else {
                //location.reload(true);
                //$.unblockUI();
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

        //$.blockUI();

        id = $(this).attr('id');

        $.ajax({
            headers: {'X-CSRF-TOKEN': token},
            url: '/retomar-banner',
            data: {"id": id},
            method: 'POST',
            dataType: 'json'
        }).done(function (ret) {

            if (ret.response) {
                location.reload(true);
                //$.unblockUI();
                notification('Banner reinserido na fila upload com sucesso!', 'success', 'bottomRight', 5000, 'icon-success');
            } else {
                //location.reload(true);
                //$.unblockUI();
                notification('O banner selecionado não pode ser reinserido na fila!', 'error', 'bottomRight', 5000, 'icon-error');                    
            }
        });     

        return false;

    });

});