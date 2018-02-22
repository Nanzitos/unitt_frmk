$(document).ready(function(){

    /**
     * Incremento de informações dinamicas
     *
     */
     var ct_field = 1;
     var page = $('li.active span').html();

     $(document).on('click', '.ActionButton', function(){

        var obj           = $(this);
        var action        = obj.data('action');
        var example       = obj.parent().parent();
        var content       = obj.parent().parent().parent().parent().parent();
        var type          = obj.data('type');

        if( type == 'precos' ){

          if( action == 'add' ){

            ct_field = $('.PrecosRow').length+1;

            html='<div class="row PrecosRow">';
    			    html+='<div class="col-sm-12">';
    			      html+='<div class="row" style="margin-bottom:10px;">';
    			      	html+='<div class="col-xs-2" style="width:35px;">';
    			      		html+='<div class="cs-radio m-b">';
    			              html+='<input type="radio" id="r'+ct_field+'" name="Precos['+ct_field+'][ativo]" value="0">';
    			              html+='<label for="r'+ct_field+'" data-toggle="tooltip" data-placement="top" title="Ativar preço"></label>';
    			            html+='</div>';
    			      	html+='</div>';
    			        html+='<div class="col-xs-2">';
                    html+='<input type="text" name="Precos['+ct_field+'][preco_de]" class="form-control float_number" placeholder="Preço de" value="">';
                  html+='</div>';
                  html+='<div class="col-xs-2">';
    			          html+='<input type="text" name="Precos['+ct_field+'][preco]" class="form-control float_number" placeholder="Preço" value="">';
    			        html+='</div>';
    			        html+='<div class="col-xs-4">';
    			          html+='<input type="text" name="Precos['+ct_field+'][parcelas]" class="form-control only_numbers" placeholder="Parcelas" value="">';
    			        html+='</div>';
    			        html+='<div class="col-xs-2">';
    			          html+='<button type="button" data-action="add" class="btn btn-success btn-round btn-icon-icon mr5 ActionButton" data-type="precos">';
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

            if($('.PrecosRow').length > 1){
              obj.parent().parent().remove();
            }

          }

        } else if( type == 'descricoes' ){

            if( action == 'add' ){

                ct_field = $('.DescricoesRow').length+1;

                console.log(content);

                html='<div class="row DescricoesRow">';
                    html+='<div class="col-sm-12">';
                      html+='<div class="row" style="margin-bottom:10px;">';
                        html+='<div class="col-xs-10">';
                          html+='<textarea name="Descricoes['+ct_field+'][texto]" rows="5" class="form-control" placeholder="Descrição"></textarea>';
                        html+='</div>';
                        html+='<div class="col-xs-2">';
                          html+='<button type="button" data-action="add" class="btn btn-success btn-round btn-icon-icon mr5 ActionButton" data-type="descricoes">';
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

                if($('.DescricoesRow').length > 1){
                  obj.parent().parent().remove();
                }

            }
        } else if( type == 'produtos' ){

            if( action == 'add' ){

                ct_field = $('.ProdutosRow').length+1;

                var Produtos = JSON.parse($('#ProdutosLista').val());

                html='<div class="row ProdutosRow">';
                  html+='<div class="col-sm-12">';
                    html+='<div class="row" style="margin-bottom:10px;">';
                      html+='<div class="col-xs-2" style="min-width:225px;">';
                        html+='<select name="Produtos['+ct_field+'][id_produto]" class="select2" style="min-width:210px;">';
                          html+='<option value="">Selecione:</option>';
                          $.each(Produtos, function(key,val){
                            html+='<option value="'+val.id+'">'+val.nome+'</option>';
                          });
                        html+='</select>';
                      html+='</div>';
                      html+='<div class="col-xs-2">';
                        html+='<input type="text" name="Produtos['+ct_field+'][preco]" class="form-control float_number" placeholder="Preço">';
                      html+='</div>';
                      html+='<div class="col-xs-2">';
                        html+='<input type="text" name="Produtos['+ct_field+'][parcelas]" class="form-control only_numbers" placeholder="Parcelas">';
                      html+='</div>';
                      html+='<div class="col-xs-2">';
                        html+='<input type="text" name="Produtos['+ct_field+'][qtd]" id="produto-qtd-'+ct_field+'" value="1" class="form-control only_numbers" placeholder="Qtd">';
                      html+='</div>';
                      html+='<div class="col-xs-2">';
                        html+='<button type="button" data-action="add" class="btn btn-success btn-round btn-icon-icon mr5 ActionButton" data-type="produtos">';
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

                if($('.ProdutosRow').length > 1){
                  obj.parent().parent().remove();
                }

            }

        } else if( type == 'imagens' ){

          if( action == 'add' ){

            ct_field = $('.ImagensRow').length+1;

            html='<div class="row ImagensRow">';
              html+='<div class="col-sm-12">';
                html+='<div class="row" style="margin-bottom:10px;">';
                  html+='<div class="col-xs-2">';
                    html+='<input type="text" name="Imagens['+ct_field+'][nome]" class="form-control nome" placeholder="Nome">';
                  html+='</div>';
                  html+='<div class="col-xs-4">';
                    html+='<input type="text" name="Imagens['+ct_field+'][url]" class="form-control" placeholder="URL Imagem">';
                  html+='</div>';
                  html+='<div class="col-xs-2">';
                    html+='<button type="button" data-action="add" class="btn btn-success btn-round btn-icon-icon mr5 ActionButton" data-type="imagens">';
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

            if($('.ImagensRow').length > 1){
              obj.parent().parent().remove();
            }

          }

        }

        return false;

      });


     $('.ProdutosRow .select2-hidden-accessible').each(function(){

        var obj = $(this);
        var valor = obj.val();

        if(!($.isNumeric(valor))){

          var nome = obj.attr('name');
          var id = nome.split('[')[1];

          id = id.replace(']', '');

          $('#produto-qtd-'+id).val('');
        }

     });


     $('.UploadPicture').on('click', function(){
        $('#imagem').trigger('click');
     });

     $('#imagem').on('change', function(){
      $.blockUI();
      $('#FormContent').submit();
     });

     $('.DeletarImagem').on('click', function(){

        var id    = $(this).data('id');
        var token = $('meta[name="csrf-token"]').attr('content');
        var obj   = $(this);

        swal({
          title: 'Você tem certeza?',
          text: 'Você não poderá recuperar esse registro.',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#DD6B55',
          confirmButtonText: 'Sim, tenho certeza.',
          closeOnConfirm: true,
        }, function (confirm) {

          if(confirm){

            $.blockUI();

              $.ajax({
                headers:{'X-CSRF-TOKEN':token},
                url:'/deletarImagemKits',
                data:{"id":id},
                method:'POST',
                dataType:'json'
              }).done(function(ret) {

                $.unblockUI();

                if(ret.response){
                  $('#BlockImage'+id).remove();
                }

              });

          }

        });

        return false;

     });

      if( $('#FormFiltros').length ){

        $('#FormFiltros').on('submit', function(){

          $('#ModalSearch').modal('hide');
          $.blockUI();
          return true;

        });

      }

      $('#FormContent').submit(function(){

          var val = $('[name="Produtos[0][id_produto]"]').val();

          if(val == '' || val == 'undefined'){
            $('[name="Produtos[0][id_produto]"]').next().css('border','red solid 1px');
            $('[name="Produtos[0][id_produto]"]').parent().append('<label style="color: red">Insira um produto antes de salvar o kit</label>');
            return false;
          }
      });

      $('#btnExport').on('click',function(e){
        event.preventDefault();

        $.blockUI();

        var ids = '';

        for (var key in localStorage) {
          var results = localStorage[key].split(',');
          $.each( results, function( key, value ) {
            ids += 'ids[]=' + value + '&';
          });

          $(".selectorKit:checked").prop('checked', false);

          localStorage.removeItem(key);
        }
        var token = $('meta[name="csrf-token"]').attr('content');

        $.unblockUI();

        window.location='/export-kits?' + ids;

      });

      $('.selectorKit').on('click',function(e){

        var dados = new Array();

        $(".selectorKit:checked").each(function(){
            dados.push($(this).data('id'));
        });

        localStorage.setItem('ids[' + page + ']', dados);

      });

      $('#ImportForm').on('submit',function(e){
        e.preventDefault();
        var formData = new FormData(this);

        $.blockUI();

        var token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
          headers:{'X-CSRF-TOKEN':token},
          url:'/import-kits',
          data:formData,
          method:'POST',
          cache: false,
          contentType: false,
          processData: false,
        }).done(function(ret) {

          $('#inputImport').val('');

          $.unblockUI();

          if(ret.status == "error")
          {
              swal("Erro!", ret.message + "<BR> Linhas: " + ret.errors, "warning");
          } else {

            var message = '';

            if(Object.keys(ret.sameId).length >=1)
            {
              message = "<b>Alguns ids ja existiam na base, portanto foram alterados conforme relação abaixo: <BR></b>";
              $.each( ret.sameId, function( key, value ) {
                message += key + ' =>' + value + "<BR>";
              });
            }

            swal({
              title: "Importação concluída!",
              text: ret.message + "<br><br>" + message,
              html: true,
              type: 'success'
            });

            $('#ImportarKits').modal('hide');

          }



        });

      });

if(typeof localStorage["ids[" + page + "]"] != 'undefined')
{
  var results = localStorage["ids[" + page + "]"].split(',');
  $.each( results, function( key, value ) {
    $(".selectorKit[data-id='" + value + "']").prop('checked', true);
  });
}


});
