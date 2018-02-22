/**
 * Created by alvar on 31/08/2016.
 */

$(document).ready(function(){

    var token = $('meta[name="csrf-token"]').attr('content');
    

    $('#NovoMes').on('click', function(){

        var data = new Array();

        $.blockUI();

        $.ajax({
            headers:{'X-CSRF-TOKEN':token},
            url:'/televendasrm/criarNovoMes',
            method:'POST',
            dataType:'json'
        }).done(function(ret) {

            if(ret.response){
                notification('Novas Metas criadas!','success','bottomRight',5000,'icon-success');
            } else {
                notification('Erro ao criar novas metas, tente novamente.','error','bottomRight',5000,'icon-error');
            }
        });

        $.unblockUI();

        return false;

    });

});
