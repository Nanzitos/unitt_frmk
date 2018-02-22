$(document).ready(function(){

    var token = $('meta[name="csrf-token"]').attr('content');

    //$('#ToggleMenu').trigger('click'); //Fecha o menu para obter mais espaço na tela

    /*
    * Inicializa o range
    */

    //Seta para português
    moment.locale('pt-br');

    $('.ESP').datepicker({
        format: "yyyy-mm-dd",
        multidate: true,
        todayHighlight: true

    }, 
    function(start, end, label) {

        console.log('hello');

    });

    $('.drp').datepicker({
        format: "yyyy-mm",
        viewMode: "months", 
        minViewMode: "months",
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

            var id_meta_fds         = $(this).find('.meta_fds').data('id_fds');
            var id_meta_sem         = $(this).find('.meta_sem').data('id_sem');
            var meta_fds            = $(this).find('.meta_fds').val();
            var meta_sem            = $(this).find('.meta_sem').val();
            var costrev_meta_fds    = $(this).find('.costrev_meta_fds').val();
            var costrev_meta_sem    = $(this).find('.costrev_meta_sem').val();

            data.push({"id_meta_fds":id_meta_fds,
                        "id_meta_sem":id_meta_sem,
                        "meta_fds":meta_fds,
                        "meta_sem":meta_sem,
                        "costrev_meta_fds":costrev_meta_fds,
                        "costrev_meta_sem":costrev_meta_sem});          

        });

        console.log(data);

        $.ajax({
           headers:{'X-CSRF-TOKEN':token},
           url:'/metas/salvar',
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


    $('#SalvarMetaEsp').on('click', function(){

        var data = [];

        $.blockUI();

        var tipo    = $('#FdsOuSem').val();
        var dias    = $('.ESP').val();

        data.push({"tipo":tipo,
                   "dias":dias});  

        $.each($('.Rows'),function(key,val){

            var id         = $(this).data('id');
            var meta       = $(this).find('.meta_sem').val();
            var costrev    = $(this).find('.costrev_meta_sem').val();

            data.push({"id_marca":id,
                        "meta":meta,
                        "costrev":costrev});
        });

        console.log(data);

        $.ajax({
           headers:{'X-CSRF-TOKEN':token},
           url:'/metas/salvar-esp',
           data:{"data":data},
           method:'POST',
           dataType:'json'
         }).done(function(ret) {

                if(ret.response){
                    notification('Meta especial criada com sucesso!','success','bottomRight',5000,'icon-success');
                } else {
                    notification('Já existe uma meta especial definida para os dias escolhidos!.','error','bottomRight',5000,'icon-error');
                }
         });

         $.unblockUI();


        return false;

    });

    $('.DEL').on('click', function(){

        $.blockUI();

        var ids    = $(this).data('ids');

        console.log(ids);

        $('.confirm').on('click',function(){
            $.ajax({
               headers:{'X-CSRF-TOKEN':token},
               url:'/metas/deletar-meta-esp',
               data:{"ids":ids},
               method:'POST',
               dataType:'json'
             }).done(function(ret) {

                    location.reload(true);
                    $.unblockUI();
                    
                    if(ret.response){
                        notification('Meta especial deletada com sucesso!','success','bottomRight',5000,'icon-success');
                    } else {
                        notification('Não foi possível excluir a meta selecionada!.','error','bottomRight',5000,'icon-error');
                    }
             });
        });

        $.unblockUI();

        return false;
    });

    $('#Configurar').on('click', function(){

        var data = [];

        var mes = $('.mes').val();

        if(mes == ""){
            window.alert('Selecione o mês!','success','bottomRight',5000,'icon-success');
            
            return false;
        }
    });

    $('#MetasEspeciais').on('click', function(){

        var data = [];

        $.blockUI();

        var mes = $('#Mes').val();    

        console.log(data);

        $.ajax({
           headers:{'X-CSRF-TOKEN':token},
           url:'/metas/metas-esp',
           data:{"data":mes},
           method:'POST',
           dataType:'json'
         }).done(function(ret) {

         });

         $.unblockUI();

        return false;

    });

});