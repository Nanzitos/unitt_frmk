$(document).ready(function(){

    var token = $('meta[name="csrf-token"]').attr('content');

    if($('#empresa').val() != 0){
        recuperaDados(
        	$('#empresa').val(),
			$('#marca').attr("data-value"),
			$('#dispositivo').attr("data-value"),
			$('#url').attr("data-value")
		);
    }

    $('#empresa').on('change',function () {
        if($(this).val() != 0){
            $('#marca').html('')
                .append('<option value="0" selected="selected">Selecione:</option>')
                .attr('disabled','disabled');

            /*$('#dispositivo').html('')
                .append('<option value="0" selected="selected">Selecione:</option>')
                .attr('disabled','disabled');*/

            $('#url').html('')
                .append('<option value="0" selected="selected">Selecione:</option>')
                .attr('disabled','disabled');

            returnData({"id":$(this).val()},'/carregaMarcas','#marca','nome','id');
        }
    });

    $('#marca').on('change',function () {
        $('#dispositivo').removeAttr('disabled');

        if($('#dispositivo').val() != 0){
            $('#url').html('')
                .append('<option value="0" selected="selected">Selecione:</option>')
                .attr('disabled','disabled');

            returnData({"idMarca":$('#marca').val(),"idDispositivo":$('#dispositivo').val()},'/carregaURLs','#url','url','id');
        }
    });

    $('#dispositivo').on('change',function () {
        if($(this).val() != 0){
            returnData({"idMarca":$('#marca').val(),"idDispositivo":$(this).val()},'/carregaURLs','#url','url','id');
        }
    });

    function recuperaDados(empresa,marca,dispositivo,url) {
        $.blockUI();
        if(isNaN(id)){
            $.ajax({
                headers:{'X-CSRF-TOKEN':token},
                url:"/recuperaDados",
                data:{"id_empresa":empresa,"id_marca":marca,"id_dispositivo":dispositivo,"id_url":url},
                method:'POST',
                dataType:'json'
            }).done(function(ret) {

                var html = '';
                html += '<option value="0">Selecione:</option>';

                $.each(ret.marcas, function(key,val){
                    if(parseInt(val.id) == parseInt(marca)){
                        html+='<option value="'+val.id+'" selected>'+val.nome+'</option>';
                    }
                    else{
                        html+='<option value="'+val.id+'">'+val.nome+'</option>';
                    }
                });

                $('#marca').html(html);
                $('#marca').removeAttr('disabled');

                html = '<option value="0">Selecione:</option>';
                $.each(ret.urls, function(key,val){
                    if(parseInt(val.id) == parseInt(url)){
                        html+='<option value="'+val.id+'" selected>'+val.url+'</option>';
                    }
                    else{
                        html+='<option value="'+val.id+'">'+val.url+'</option>';
                    }
                });

                $('#url').html(html);
                $('#url').removeAttr('disabled');
                $('#dispositivo').removeAttr('disabled');
                defineMasks();
            });

        }
        $.unblockUI();

    }

    function returnData(obj,url,seletor,label,value)
    {
        $.blockUI();
        $.ajax({
            headers:{'X-CSRF-TOKEN':token},
            url:url,
            data:obj,
            method:'POST',
            dataType:'json'
        }).done(function(ret) {

            $(seletor).empty();

            var html = '';
            html += '<option value="0" selected="selected">Selecione:</option>';
            $.each(ret, function(key,val){
                html+='<option value="'+val[value]+'">'+val[label]+'</option>';
            });
            $(seletor).append(html);
            $(seletor).removeAttr('disabled');
        });
        $.unblockUI();
    }

});
