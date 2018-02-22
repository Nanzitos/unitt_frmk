$(document).ready(function(){


  var token = $('meta[name="csrf-token"]').attr('content');


   $("#cep").change(function(){

     var cep = $(this).val();
     $.blockUI();

     $.ajax({
         headers:{'X-CSRF-TOKEN':token},
         url:'/consulta-cep',
         data:{"cep":cep},
         dataType:'json',
         method:'POST',
     }).done(function(ret) {
         $('#endereco').val(ret.endereco);
         $('#cidade').val(ret.cidade);
         $('#estado').val(ret.estado);
         $('#bairro').val(ret.bairro);
         $.unblockUI();
     });
   });


    $(".visualizarRegistro").click(function(){
        var id = $(this).attr('id');

        $.blockUI();

        $.ajax({
            headers:{'X-CSRF-TOKEN':token},
            url:'/compras-fornecedores-visualizar',
            data:{"id":id},
            method:'POST',
          }).done(function(ret) {
              $.unblockUI();
             $("#modalVisualizar").html(ret);
          });


      $('#ModalSearchVisualizar').modal();


    });

    $(document).on('click', '.ActionButton', function(){

      var obj           = $(this);
      var action        = obj.attr('data-action');
      var example       = obj.parent().parent();
      var content       = obj.parent().parent().parent().parent().parent();
      var type          = obj.data('type');

      if( type == 'telefones' && action == 'add'){

        ct_field = $('.TelefonesRow').length+1;

        html='<div class="row TelefonesRow">';
          html+='<div class="col-sm-12">';
            html+='<div class="row" style="margin-bottom:10px;">';
              html+='<div class="col-xs-4">';
                html+='<input type="text" name="telefone['+ct_field+'][telefone]" class="form-control celular" placeholder="Telefone">';
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
        obj.attr('data-action','del');
        defineMasks();

      }else{

        if($('.TelefonesRow').length > 1){
          obj.parent().parent().remove();
        }

      }

    });

});
