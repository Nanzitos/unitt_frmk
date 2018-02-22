/**
 * Created by alvar on 29/06/2016.
 */

$(document).ready(function(){

	var token = $('meta[name="csrf-token"]').attr('content');

    $('.Texto').on('paste', function(){
        
        var element = $(this);

        setTimeout(function(){
            var rows = element.val().split("\n");
            var cont = 0;
            /*var cells = [];
            $.each(rows, function(key, val){
                var info  = val.split("\t");
                var texto = info[0];
                var card  = info[1];
               cells.push({"0":texto, "1":card});
            });
            //console.log(cells);
            */
            $.each($('.Rows'), function(key,val){
                $(this).val('');
            });
            $.each($('.Rows'), function(key,val){

                var InputsCopiados = $(this).find('.InputCopiado');
                //console.log(InputsCopiados);
                var info           = (typeof(rows[cont])!='undefined')?rows[cont].split("\t"):'';
                var ct_fields      = 0;

                $.each(InputsCopiados, function(key, val){
                    var valor = (typeof(info[ct_fields])!='undefined')?info[ct_fields]:'';

                    $(this).val(valor);
                    ct_fields++;

                });
                info = '';
                cont++;
            });


        },2000);



    });

    $('#SalvarLista').on('click', function(){

    	var data = [];

    	$.blockUI();

    	$.each($('.Rows'), function(key,val){

    		var id    = $(this).data('id');
    		var texto = $(this).find('.Texto').val();

    		data.push({"id":id,"descricoes":texto});

    	});

    	
    	$.ajax({
           headers:{'X-CSRF-TOKEN':token},
           url:'/tabbanners/updateBannersByList',
           data:{"data":data},
           method:'POST',
           dataType:'json'
         }).done(function(ret) {

         		if(ret.response){
					notification('Dados atualizados com sucesso!','success','bottomRight',5000,'icon-success');
         		} else {

         			notification('Erro ao atualizar dados, tente novamente.','error','bottomRight',5000,'icon-error');
         		}
         });

         $.unblockUI();


    	return false;

    });

    $('#selecaoTotal').on('click', function(){

        if($(this).prop('checked')){
            $('.check').prop('checked', true);
        } else {
            $('.check').prop('checked', false);
        }
    });

    $('#DeletarBanners').on('click', function(){

        var ids = [];

        //$.blockUI();

        $.each($('.check'), function(key,val){

            if($(this).prop('checked'))
                ids.push($(this).val());

        });

        if(ids.length > 0) {
            $.ajax({
                headers: {'X-CSRF-TOKEN': token},
                url: '/banners/deletarBanners',
                data: {"ids": ids},
                method: 'POST',
                dataType: 'json'
            }).done(function (ret) {

                if (ret.response) {
                    location.reload(true);
                    //$.unblockUI();
                    notification('Banners excluídos com sucesso!', 'success', 'bottomRight', 5000, 'icon-success');
                } else {
                    location.reload(true);
                    //$.unblockUI();
                    notification('Os banners selecionados não puderam ser excluídos!', 'success', 'bottomRight', 5000, 'icon-error');                    
                }
            });

            //$.blockUI();
        
        } else {
            
            notification('Nenhum banner selecionado!', 'error', 'bottomRight', 5000, 'icon-error');
            //$.blockUI();

        }        

        return false;

    });

    $('#EnviaParceiro').on('click', function(){

        var ids = [];

        $.blockUI();

        $.each($('.check'), function(key,val){

            if($(this).prop('checked'))
                ids.push($(this).val());


        });

        if(ids.length > 0) {
            $.ajax({
                headers: {'X-CSRF-TOKEN': token},
                url: '/tabbanners/sendBannersToTaboola',
                data: {"ids": ids},
                method: 'POST',
                dataType: 'json'
            }).done(function (ret) {

                if (ret.response) {
                    $.unblockUI();
                    notification('Banners enviados com sucesso!', 'success', 'bottomRight', 5000, 'icon-success');
                } else {

                    var html = '';
                    var conteudo = $('#conteudo');

                    $.unblockUI();

                    $('#ModalSearch').modal('show');

                    $.each( ret.erros, function( key, val ) {
      
                        html+='<tr>';
                        html+='<td>'+val.id_banner+'</td>';
                        html+='<td>'+val.id_jump+'</td>';
                        html+='<td>'+val.id_parceiro+'</td>';
                        html+='<td>'+val.id_campanha+'</td>';
                        html+='<td>'+val.ativo+'</td>';
                        html+='<td>'+val.erro+'</td>';
                        html+='<td>'+val.etapa+'</td>';
                        html+='<td>'+val.mensagem+'</td>';
                        html+='<td><a href="javascript: ;" class="ButtonEditar" data-id="'+val.id_banner+'">Editar</a> | <a href="javascript: ;" class="ButtonDeletar" data-id="'+val.id_banner+'">Deletar</a></td>';
                        html+='</tr>';

                    });

                    conteudo.html(html);
                }
            });
        
        } else {

            $.unblockUI();

            notification('Nenhum banner selecionado', 'error', 'bottomRight', 5000, 'icon-error');

        }

        return false;

    });

    $('#Atualizar').on('click', function(){

        $.blockUI();

        setTimeout(function(){

            $.ajax({
                headers:{'X-CSRF-TOKEN':token},
                url:'/tabbanners/getBannersDbx',
                method:'POST'
            }).done(function(ret) {
                
                if(ret.response){
                    $.unblockUI();
                    notification('Banners atualizados com sucesso!','success','bottomRight',5000,'icon-success');
                } else {
                    $.unblockUI();
                    notification('Erro ao baixar, tente novamente.','error','bottomRight',5000,'icon-error');
                }

                

            });

        },200);

        return false;

    });
    
    
});

$(document).on('click', '.ButtonEditar', function(){
    var id = $(this).data('id_banner');
    //
    //
});

$(document).on('click', '.ButtonDeletar', function(){
    var id = $(this).data('id_banner');
    //
    //
});
