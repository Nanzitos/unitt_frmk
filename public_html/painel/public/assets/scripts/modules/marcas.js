$(document).ready(function(){

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

        if( type == 'telefones' ){

          if( action == 'add' ){

            ct_field = $('.TelefonesRow').length+1;

            html='<div class="row TelefonesRow">';
              html+='<div class="col-sm-12">';
                html+='<div class="row" style="margin-bottom:10px;">';
                  html+='<div class="col-xs-4">';
                    html+='<input type="text" name="Telefones['+ct_field+'][telefone]" class="form-control" placeholder="Telefone">';
                  html+='</div>';
                  html+='<div class="col-xs-2">';
                    html+='<button type="button" data-action="add" class="btn btn-success btn-round btn-icon-icon mr5 ActionButton" data-type="telefones">';
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

            if($('.TelefonesRow').length > 1){
              obj.parent().parent().remove();
            }

          }

        } else if( type == 'responsaveis' ){

          if( action == 'add' ){

            ct_field = $('.ResponsaveisRow').length+1;

            html='<div class="row ResponsaveisRow">';
              html+='<div class="col-sm-12">';
                html+='<div class="row" style="margin-bottom:10px;" data-id="0">';
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

        } else if( type == 'emails' ){

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
                    html+='<button type="button" data-action="add" class="btn btn-success btn-round btn-icon-icon mr5 ActionButton" data-type="emails">';
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

        } else if( type == 'configuracoes' ){

          if( action == 'add' ){

            ct_field = $('.ConfiguracoesRow').length+1;

            console.log(ct_field);

            html='<div class="row ConfiguracoesRow">';
              html+='<div class="col-sm-12">';
                html+='<div class="row" style="margin-bottom:10px;">';
                  html+='<div class="col-xs-4">';
                    html+='<input type="text" name="Configuracoes['+ct_field+'][nome]" class="form-control nome" placeholder="Nome">';
                  html+='</div>';
                  html+='<div class="col-xs-4">';
                    html+='<input type="text" name="Configuracoes['+ct_field+'][value]" class="form-control" placeholder="Valor">';
                  html+='</div>';
                  html+='<div class="col-xs-2">';
                    html+='<button type="button" data-action="add" class="btn btn-success btn-round btn-icon-icon mr5 ActionButton" data-type="configuracoes">';
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

            if($('.ConfiguracoesRow').length > 1){
              obj.parent().parent().remove();
            }

          }

        }

        return false;

      });

    /*
    * HTML Editor
    */
    EditorMirror = CodeMirror(document.getElementById("codemirror"), {
      mode: "text/json",
      extraKeys: {"Ctrl-Space": "autocomplete"},
      value: $('#seo').val(),
      lineNumbers: true,
      matchBrackets: true,
      showCursorWhenSelecting: true,
      autoComplete:true,
      maxLength:2000000
    });

    $(document).on('keyup', function(){
      $('#seo').val(EditorMirror.getValue());
    });
});
