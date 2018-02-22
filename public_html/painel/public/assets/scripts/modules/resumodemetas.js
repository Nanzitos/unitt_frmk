$(document).ready(function(){

   var token = $('meta[name="csrf-token"]').attr('content');

    //Seta para português
    moment.lang('pt-br')

    $('#dp').datepicker({
        format: 'yyyy-mm-dd',
        defaultDate: "+1w",
        startDate:'01/01/2013',
        inline:true,
        autoclose: true
    });

    $('#CarregarData').on('click', function() {
        dia = $('#dp').datepicker().val();
        $.ajax({
            headers: {'X-CSRF-TOKEN': token},
            url: '/custosrm',
            data: {"dia": dia},
            method: 'POST',
            dataType: 'json'
        }).done(function (ret) {
            console.log("funcionou");
        });
    });

    $('.Custo').on('paste', function(){

        var element = $(this);

        setTimeout(function(){
            var rows = element.val().split(" ");
            var cont = 0;

            console.log(rows[0]);

            $.each($('.Rows'), function(key,val){
                $(this).val('');
            });

            $.each($('.Rows'), function(key,val){

                var InputsCopiados = $(this).find('.InputCopiado');

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

    $('.EnviarEmail').on('click', function(){

        var data   = [];
        
        $.blockUI();
        
        $.ajax({
         headers:{'X-CSRF-TOKEN':token},
         url:'/custosrm/enviaremail',
         data:{"data":data},
         method:'POST',
         dataType:'json'
        }).done(function(ret) {
            if(ret.response){
                $.unblockUI();
                notification('Email enviado com sucesso!','success','bottomRight',5000,'icon-success');
            } else {
                $.unblockUI();
                notification('Não foi possível enviar o e-mail, tente novamente.','error','bottomRight',5000,'icon-error');
            }
        });
        return false;
    });

    $('.SalvaLista').on('click', function(){
        swal({
            title: 'Você tem certeza?',
            text: 'Este processo irá alterar o resultado do Resumo de Metas!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#6FC080',
            confirmButtonText: 'Sim, salvar!',
            cancelButtonText: 'Não, cancelar!',
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                var data   = [];
                var enviar = $(this).data('enviar');

                swal({
                    title: 'Aguarde!',
                    text: '<div class="sk-rotating-plane center-block m-y-lg"></div><br>Dentro de alguns minutos os dados serão atualizados!!',
                    html: true
                });

                $.each($('.Rows'), function(key,val)
                {
                    if ($(this).find('.Custo').val() != '') 
                    {
                        var id    = $(this).data('id');
                        var custo  = $(this).find('.Custo').val();

                        data.push({"id":id,"custo":custo});
                    }
                });


                $.ajax({
                 headers:{'X-CSRF-TOKEN':token},
                 url:'/custosrm/updateCostsByList',
                 data:{"data":data,"enviar":enviar},
                 method:'POST',
                 dataType:'json'
             }).done(function(ret) {
                if(ret.response)
                {
                    swal({
                        title: 'Sucesso =)',
                        text: 'Dados atualizados com sucesso!',
                        html: true
                    });
                } 
                else 
                {
                    swal({
                        title: 'Erro =(',
                        text: 'Erro ao atualizar dados, tente novamente!',
                        html: true
                    });
                }
            });
         } else {
            swal('Cancelado :(', 'Processo cancelado!', 'error');
        }
    });
});

    $("#CheckMidiaPai").on('change', function(){
        $('.CheckMidia').prop('checked', $(this).prop('checked'));
    });

    $('#AtualizarMidias').on('click', function(){

        ids_midias = new Array();

        $('.CheckMidia:checked').each(function(){
            ids_midias.push($(this).val());
        });

        if( ids_midias.length == 0 ){
            notification('Nenhuma Midía foi selecionada!.','warning','bottomRight',5000,'icon-error');
            return false;
        }

        swal({
            title: 'Você tem certeza?',
            text:  'Apenas as Midías selecionadas aparecerão nos custo hardinput!',
            type:  'warning',
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }, function (confirm) {

            if(confirm){

                $.blockUI();

                $.ajax({
                    headers:{'X-CSRF-TOKEN':token},
                    url:'/custosrm-config-midias',
                    data:{"ids_midias":ids_midias},
                    method:'POST',
                    dataType:'json'
                }).done(function(ret) {
                    if(ret.response == true)
                    {
                        setTimeout(function () {
                            swal('Sucesso :)', 'Dados atualizados com sucesso!', 'success');
                            $(location).attr('href', 'http://painel.the8co.com.br/custosrm');
                        }, 2000);
                    }else{
                        setTimeout(function () {
                            swal('Falha :(', 'Erro ao atualizar dados!', 'error');
                        }, 2000);
                    }
                });

                $.unblockUI();
            }
        });
        return false;
    });
});
