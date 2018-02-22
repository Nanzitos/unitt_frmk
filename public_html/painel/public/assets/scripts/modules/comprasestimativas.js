$(document).ready(function(){

  var token   = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
          headers:{'X-CSRF-TOKEN':token},
          url:'/get-produto-venda',
          data:{"id":1},
          method:'POST',
        }).done(function(ret) {
            $("#id_produto").html(ret);
        });


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

          if( type == 'estimativas' ){

            if( action == 'add' ){

              ct_field = $('.EstimativasRow').length+1;

              html='<div class="row EstimativasRow">';
      			    html+='<div class="col-sm-12">';
      			      html+='<div class="row" style="margin-bottom:10px;">';
      			      	html+= '<div class="col-sm-12">';
                      html+= '<div class="row" style="margin-bottom:10px;">';
                        html+= '<div class="col-xs-1">';
                          html+= '<input type="text" name="Estimativas['+ ct_field +'][ano]" value="2017" class="form-control" placeholder="Ano">';
                        html+= '</div>';
                        html+= '<div class="col-xs-2">';
                          html+= '<select name="Estimativas['+ ct_field +'][mes]" class="form-control" style="min-width:210px;">';
                            html+= '<option value="">Selecione</option>';
                            html+= '<option value="1">Janeiro</option>';
                            html+= '<option value="2">Fevereiro</option>';
                            html+= '<option value="3">Março</option>';
                            html+= '<option value="4">Abril</option>';
                            html+= '<option value="5">Maio</option>';
                            html+= '<option value="6">Junho</option>';
                            html+= '<option value="7">Julho</option>';
                            html+= '<option value="8">Agosto</option>';
                            html+= '<option value="9">Setembro</option>';
                            html+= '<option value="10">Outubro</option>';
                            html+= '<option value="11">Novembro</option>';
                            html+= '<option value="12">Dezembro</option>';
                          html+= '</select>';
                        html+= '</div>';
                        html+= '<div class="col-xs-2">';
                          html+= '<input type="text" name="Estimativas['+ ct_field +'][preco_medio]" readonly="readonly" class="form-control float_number precoMedio" placeholder="Preço Médio">';
                        html+= '</div>';
                        html+= '<div class="col-xs-2">';
                          html+= '<input type="text" name="Estimativas['+ ct_field +'][kit_medio]" readonly="readonly" class="form-control kitMedio" placeholder="Kit Médio">';
                        html+= '</div>';
                        html+= '<div class="col-xs-2">';
                          html+= '<input type="text" name="Estimativas['+ ct_field +'][estimativa]" class="form-control estimativaMes" placeholder="Estimativa">';
                        html+= '</div>';
                        html+= '<div class="col-xs-2">';
                          html+= '<input type="text" name="Estimativas['+ ct_field +'][qtd]" readonly="readonly" class="form-control" placeholder="Quantidade">';
                        html+= '</div>';
                        html+= '<div class="col-xs-1">';
                          html+= '<button type="button" data-action="add" class="btn btn-success btn-round btn-icon-icon mr5 ActionButton" data-type="estimativas">';
                            html+= '<i class="icon-plus"></i>';
                          html+= '</button>';
                        html+= '</div>';
                      html+= '</div>';
                    html+= '</div>';
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

              if($('.EstimativasRow').length > 1){
                obj.parent().parent().remove();
              }

            }

          }
          return false;

        });
    }

    $('#id_produto').change(function(){

      var id = $(this).val();

      $.blockUI();

        $.ajax({
          headers:{'X-CSRF-TOKEN':token},
          url:'/calcula-medias-estimativas',
          data:{"id":id},
          method:'POST',
        }).done(function(ret) {

            $.unblockUI();
            data = ret.split('--');
            $('.precoMedio').val(data[0]);
            $('.kitMedio').val(data[1]);
        });
    });

    $('.estimativaMes').change(function(){

      var idProd = $('#id_produto').val();

      var obj = $(this);
      var estimativa = obj.val();

      $.blockUI();

      $.ajax({
          headers:{'X-CSRF-TOKEN':token},
          url:'/calcula-qtd-estimativa',
          data:{"estimativa":estimativa,"id": idProd},
          method:'POST',
        }).done(function(ret) {
            $.unblockUI();
            obj.parent().next().find('input').val(ret);
        });
    });

    $(".visualizarRegistro").click(function(){
        var id = $(this).attr('id');

      //  $.blockUI();

        $.ajax({
            headers:{'X-CSRF-TOKEN':token},
            url:'/compras-estimativas-visualizar',
            data:{"id":id},
            method:'POST',
          }).done(function(ret) {
            //  $.unblockUI();
             $("#modalVisualizar").html(ret);
          });


      $('#ModalSearchVisualizar').modal();


    });


    if( $('#FormFiltros').length ){

      $('#FormFiltros').on('submit', function(){

        $('#ModalSearch').modal('hide');
        $.blockUI();
        return true;

      });
    }

});
