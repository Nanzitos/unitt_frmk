$(document).ready(function(){

	var token = $('meta[name="csrf-token"]').attr('content');
	var filtros_js = JSON.parse($('#FiltrosJs').val());

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

		$.blockUI();

		var de  = document.getElementsByName('daterangepicker_start')[0].value;
		var ate = document.getElementsByName('daterangepicker_end')[0].value;

		$.ajax({
          headers:{'X-CSRF-TOKEN':token},
          url:'/relatorios/banners',
          data:{"de":de,"ate":ate,"filtros":filtros_js},
          method:'POST',
          dataType:'json'
        }).done(function(ret) {

        	if(ret.response){

        		var data = ret.data;
        		var html = '';

        		$.each(data.range, function(key,val){

        			html+='<tr>';
        				html+='<td><img src= "'+val.image_url+'" width="100" /></td>';
        				html+='<td>'+val.title+'</td>';
		                html+='<td>'+val.ctr+'</td>';
		                html+='<td>'+val.impressions+'</td>';
		                html+='<td>'+val.clicks+'</td>';
						html+='<td>'+val.cost+'</td>';
						html+='<td>'+val.conversions+'</td>';
						html+='<td>'+val.cpa+'</td>';
						html+='<td>'+val.taxa_conversao+'</td>';
						html+='<td>'+val.marca+'</td>';
						html+='<td>'+val.source+'</td>';
						html+='<td>'+val.msn+'</td>';
						html+='<td>'+val.campaign+'</td>';
						html+='<td>'+val.criado_em+'</td>';
        			html+='</tr>';
        		});

        		$('#RangeCustomizado').html(html);

        	}	

        });

        $.unblockUI();

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

    $('#selecionarCampanhas').on('click', function(){

        var ids = [];

        $.blockUI();

        $.each($('.check'), function(key,val){

            if($(this).prop('checked'))
                ids.push($(this).val());
        });

        if(ids.length > 0) {
            notification('Banners enviados com sucesso para a fila de upload!','success','bottomRight',5000,'icon-success');
            $('#campanhas').val(ids);
            $('#campo').submit();
        } else {
            notification('Selecione ao menos uma campanha, amigo...','error','bottomRight',5000,'icon-error');
        }

        $.unblockUI();

        return false;

    });

});