$(document).ready(function(){

    var token = $('meta[name="csrf-token"]').attr('content');

    //$('#ToggleMenu').trigger('click'); //Fecha o menu para obter mais espaço na tela

    /*
    * Inicializa o range
    */    

    $('.drp').datepicker({
        format: "dd/mm/yyyy",        
        'locale':{
            applyLabel: 'Aplicar',
        }

    }, 
    function(start, end, label) {

    });

    $('#SalvarLista').on('click', function(){

        var data = [];

        $.blockUI();

        $.each($('.Rows'),function(key,val){

            var id    = $(this).data('id');
            var gasto = $(this).find('.Gasto').val();
            var qtd   = $(this).find('.Qtd').val();
            var mes   = $(this).data('mes');

            data.push({"id":id,"gasto":gasto,"qtd":qtd,"mes":mes});           

        });

        console.log(data);

        $.ajax({
           headers:{'X-CSRF-TOKEN':token},
           url:'/logistica-fechamento/salvarlista',
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

    $('#GerarRelatorio').on('click', function(){

        var data = [];

        $.blockUI();

        $('#token_gerar').val(token);

        $('#gerar').submit();
    });

});