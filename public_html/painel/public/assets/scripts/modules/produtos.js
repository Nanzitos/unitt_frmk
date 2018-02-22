$(document).ready(function(){

    if( $('.ActionButton').length ){

      /**
       * Incremento de informações dinamicas
       *
       */
       var ct_field = 1;

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
      			              html+='<input type="radio" id="r'+ct_field+'" name="Precos['+ct_field+'][ativo]" value="">';
      			              html+='<label for="r'+ct_field+'" data-toggle="tooltip" data-placement="top" title="Ativar preço"></label>';
      			            html+='</div>';
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

          }  else if( type == 'descricoes' ){

              if( action == 'add' ){

                  ct_field = $('.DescricoesRow').length+1;

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
                  url:'/deletarImagemProdutos',
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
    }

    if( $('#FormFiltros').length ){

      $('#FormFiltros').on('submit', function(){

        $('#ModalSearch').modal('hide');
        $.blockUI();
        return true;

      });
    }

});
