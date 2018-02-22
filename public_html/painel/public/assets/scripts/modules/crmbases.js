$(document).ready(function()
{   
    var token = $('meta[name="csrf-token"]').attr('content');

    $('#ToggleMenu').trigger('click');

    $('#dp').datepicker({
        format: 'yyyy-mm-dd',
        defaultDate: "+1w",
        startDate:'01/01/2013',
        inline:true,
        autoclose: true
    });

    var ct_field = 1;

    filds = "";

    $(document).on('click', '#ConsultarCrm', function(){

    	var base = $("#id_base").val();

    	if (!base)
    	{
    		notification('Selecione uma bese!','error','bottomRight',3000,'icon-error');
    		return false;
    	}

    	$("#base").val(base);
    	
    	var filtros = $('#buscarCrm');

    	filtros.trigger('click');
   	});

   	$(document).on('click', '.regerarCrm', function(){

    	var base = $('.regerarCrm').data('base');
    	var data = $('.regerarCrm').data('data');

    	swal({
            title: 'Aguarde!',
            text: '<div class="sk-rotating-plane center-block m-y-lg"></div><br>Dentro de alguns minutos os dados serão atualizados!!',
            html: true
        });

        swal.disableButtons();

        $.ajax({
            headers:{'X-CSRF-TOKEN':token},
            url:'/crm-bases-regerar',
            data:{"base":base,"data":data},
            method:'POST',
            dataType:'json'
        }).done(function(ret) {
            if(ret.response)
            {            
                swal.close();
                notification('Base regerada com sucesso!','success','bottomRight',3000,'icon-success');
            } 
            else 
            {
                swal.close();
                notification('Erro ao regerar base!','error','bottomRight',3000,'icon-error');          
            }
        });

   	});

   	$('#gerar').click(function(){

    	var base = $("#id_base").val();
    	var data = $("#dp").val();

    	if (!base)
    	{
    		notification('Selecione uma bese!','error','bottomRight',3000,'icon-error');
    		return false;
    	}
    	
    	if(!data)
    	{
    		notification('Selecione um dia!','error','bottomRight',3000,'icon-error');
    		return false;
    	}

        swal({
            title: 'Aguarde!',
            text: '<div class="sk-rotating-plane center-block m-y-lg"></div><br>Dentro de alguns minutos os dados serão atualizados!!',
            html: true
        });

        swal.disableButtons();

        $.ajax({
            headers:{'X-CSRF-TOKEN':token},
            url:'/crm-bases-regerar',
            data:{"base":base,"data":data},
            method:'POST',
            dataType:'json'
        }).done(function(ret) {
            if(ret.response)
            {            
                swal.close();
                notification('Base gerada com sucesso!','success','bottomRight',3000,'icon-success');
            } 
            else 
            {
                swal.close();
                notification('Erro ao gerar base!','error','bottomRight',3000,'icon-error');          
            }
        });


   	});

   	$('.regerarCrm').click(function(){

    	var base = $("#id_base").val();
    	var data = $("#dp").val();

    	if (!base)
    	{
    		notification('Selecione uma bese!','error','bottomRight',3000,'icon-error');
    		return false;
    	}
    	
    	if(!data)
    	{
    		notification('Selecione um dia!','error','bottomRight',3000,'icon-error');
    		return false;
    	}
   	});

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
     		html+='<select name="colunas['+ct_field+']" id="filtro_'+ct_field+'" class="select2 colunas" style="min-width:210px;">';
     		html+='<option value="">Campo</option>';

     		$.each(filds, function(index,value)
     		{
     			html+='<option value="' + value + '">' + value + '</option>';
     		});

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

    $('#id_base').change(function()
    {
    	var base = $("#id_base").val();

    	$("#id_base_regerar").val(base);

    	$('.filtrosPara').html("Configurar filtros para a base: <b><i>" + base + "</i></b>");

    	$('.regerarPara').html("Regerar a base: <b><i>" + base + "</i></b>");

        swal({
            title: 'Aguarde!',
            text: '<div class="sk-rotating-plane center-block m-y-lg"></div><br>Dentro de alguns minutos os dados serão atualizados!!',
            html: true
        });

        swal.disableButtons();

        $.ajax({
            headers:{'X-CSRF-TOKEN':token},
            url:'/get-filds-name-table',
            data:{"base":base},
            method:'POST',
            dataType:'json'
        }).done(function(ret) {
            if(ret.response)
            {
            	filds = ret.filds;

            	$.each(ret.filds, function(index,value)
        		{
        			$(".colunas").append("<option value='" + value + "'>" + value + "</option>");
        		});
            
                swal.close();
                notification('Base selecionada com sucesso!','success','bottomRight',3000,'icon-success');
            } 
            else 
            {
                swal.close();
                notification('Erro ao selecionar base!','error','bottomRight',3000,'icon-error');          
            }
        });

        $("#addLinhas").html("");

        $.ajax({
            headers:{'X-CSRF-TOKEN':token},
            url:'/get-base',
            data:{"id_base_regerar":base},
            method:'POST',
            dataType:'json'
        }).done(function(ret) {
            if(ret.response)
            {
            	base = ret.base;

            	$.each(ret.base, function(index,value)
        		{
        			$("#addLinhas").append("<tr><td>" + value.data_base + "</td><td>" + value.editado_em + "</td><td>" + value.acoes + "</td></tr>");
        		});
           
            }
        });

        return false;
        
    });

});