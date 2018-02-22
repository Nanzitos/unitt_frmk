$(document).ready(function(){

    var token = $('meta[name="csrf-token"]').attr('content');

     /**
     * Verifica parametros do $_GET na URL
     *
     */
     $(window).on('load', function () {

          if(d = $_GET.d){

               msg      = 'Registro removido com sucesso.';
               type     = 'success';
               position = 'bottomRight';

               if(d == '0'){
                    msg  = 'Ops! não foi possível realizar a operação.';
                    type = 'error';
               }


             if($('body').hasClass('page-loaded')){
               notification(msg,type,position);
             }

          }
     });

     /**
     * Incremento de responsáveis
     *
     */
     var ct_field = 1;

     $(document).on('click', '.ActionButton', function(){

        var obj           = $(this);
        var action        = obj.data('action');
        var example       = obj.parent().parent();
        var content       = obj.parent().parent().parent().parent().parent();
        var type          = obj.data('type');
        var id_empresa    = obj.data('id-empresa');

        if( type == 'responsaveis' ){

          if( action == 'add' ){

            ct_field = $('.ResponsaveisRow').length+1;

            html = '<div class="row ResponsaveisRow">';
              html+='<div class="col-sm-12">';
                html+='<div class="row" style="margin-bottom:10px;">';
                  html+='<div class="col-xs-2">';
                    html+='<input type="text" name="Responsaveis['+ct_field+'][nome]" class="form-control nome" placeholder="Nome">';
                  html+='</div>';
                  html+='<div class="col-xs-2">';
                    html+='<input type="text" name="Responsaveis['+ct_field+'][telefone]" class="form-control celular" placeholder="Telefone/Celular">';
                  html+='</div>';
                  html+='<div class="col-xs-2">';
                    html+='<input type="text" name="Responsaveis['+ct_field+'][funcao]" class="form-control funcao" placeholder="Função">';
                  html+='</div>';
                  html+='<div class="col-xs-4">';
                    html+='<input type="text" name="Responsaveis['+ct_field+'][email]" class="form-control email" placeholder="E-mail">';
                  html+='</div>';
                  html+='<div class="col-xs-2">';
                    html+='<button type="button" data-action="add" class="btn btn-success btn-round btn-icon-icon mr5 ActionButton" data-type="responsaveis">';
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
            obj.data('action', 'del');

            defineMasks();

          } else {

            if($('.ResponsaveisRow').length > 1){
              obj.parent().parent().remove();
            }

          }

        } else if( type == 'email' ){

          if( action == 'add' ){

            ct_field = $('.EmailsRow').length+1;

            html='<div class="row EmailsRow">';
              html+='<div class="col-sm-12">';
                html+='<div class="row" style="margin-bottom:10px;">';
                  html+='<div class="col-xs-2">';
                    html+='<input type="text" name="Emails['+ct_field+'][nome]" class="form-control nome" placeholder="Nome">';
                  html+='</div>';
                  html+='<div class="col-xs-4">';
                    html+='<input type="text" name="Emails['+ct_field+'][email]" class="form-control email" placeholder="E-mail">';
                  html+='</div>';
                  html+='<div class="col-xs-2">';
                    html+='<button type="button" data-action="add" class="btn btn-success btn-round btn-icon-icon mr5 ActionButton" data-type="email">';
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
            obj.data('action', 'del');

            defineMasks();

          } else {

            if($('.EmailsRow').length > 1){
              obj.parent().parent().remove();
            }

          }
        } else if( type == 'filiais' ) {

            if (action == 'add') {

                var Estados;
                var Marcas;
                var Filiais;

                $.blockUI();

                $.ajax({
                    headers:{'X-CSRF-TOKEN':token},
                    url:'/getFiliaisByIdEmpresa',
                    data:{'id_empresa':id_empresa},
                    method:'GET',
                    dataType:'json'
                }).done(function(ret) {
                    Filiais = ret;
                });

                $.ajax({
                    headers:{'X-CSRF-TOKEN':token},
                    url:'/dne-estados',
                    method:'GET',
                    dataType:'json'
                }).done(function(ret) {
                    Estados = ret;

                    $.ajax({
                        headers:{'X-CSRF-TOKEN':token},
                        url:'/getMarcas',
                        method:'GET',
                        dataType:'json'
                    }).done(function(ret) {

                        Marcas = ret;

                        ct_field = $('.EmailsRow').length + 1;

                        html = '<div class="row EmailsRow">';
                        html += '<div class="col-sm-12">';
                        html += '<div class="row" style="margin-bottom:10px;">';
                        html += '<div class="col-xs-2">';

                        html += '<select name="Filiais['+ct_field+'][id_filial]" data-placeholder="Selecione a filial" style="width: 100%;" class="select2">';

                        $.each(Filiais, function(key3,val3){
                            html+='<option value="'+val3.id+'">'+val3.nome+'</option>';
                        });

                        html += '</select>';

                        html += '</div>';
                        html += '<div class="col-xs-4">';
                        html += '<select name="Filiais['+ct_field+'][estados][]" data-placeholder="Selecione os estados" multiple class="chosen" style="width: 100%;">';

                        $.each(Estados, function(key,val){
                            $.each(Marcas, function(key2,val2){
                                console.log(val,val2);
                                var value = val.ufe_sg+'|'+val2.id;
                                html+='<option value="'+value+'">'+val.ufe_sg+' - '+val2.nome+'</option>';
                            })
                        });

                        html += '</select>';
                        html += '</div>';
                        html += '<div class="col-xs-2">';
                        html += '<button type="button" data-action="add" class="btn btn-success btn-round btn-icon-icon mr5 ActionButton" data-id-empresa="'+id_empresa+'" data-type="filiais">';
                        html += '<i class="icon-close"></i>';
                        html += '</button>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';

                        console.log(html);


                        content.append(html);
                        ct_field++;

                        obj.removeClass('btn-success');
                        obj.addClass('btn-danger');
                        obj.find('i').removeClass('icon-plus');
                        obj.find('i').addClass('icon-close');
                        obj.data('action', 'del');

                        defineMasks();

                        $('.chosen').chosen({
                            width: '100%'
                        });

                        $.unblockUI();

                    });

                });

            } else {

                if ($('.EmailsRow').length > 1) {
                    obj.parent().parent().remove();
                }

            }
        }
        return false;

      });

      $('.chosen').chosen({
         width: '100%'
      });
});
