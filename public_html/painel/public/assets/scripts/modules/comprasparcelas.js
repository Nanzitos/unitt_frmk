
$(document).ready(function(){



  var token = $('meta[name="csrf-token"]').attr('content');



    $(".visualizarRegistro").click(function(){
        var id = $(this).attr('id');

      //  $.blockUI();

        $.ajax({
            headers:{'X-CSRF-TOKEN':token},
            url:'/compras-entrega-visualizar',
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

    $(document).on('click', '.btnAprova', function(){
      var idBtn = $(this).attr('id');
      var id = $(this).attr('data-id');
      

        var r = confirm("Confirmar Pagamento?");
        if(r == true){
           $.ajax({
            headers:{'X-CSRF-TOKEN':token},
            url:'/compras-parcela-aprovar',
            data:{"id":id},
            method:'POST',
          }).done(function(ret) {
              $.unblockUI();
              alert("Pagamento confirmado com sucesso!");
              $('#ModalSearchVisualizar').modal('hide');
              location.reload();
          });

        }else return false;
    });     


});
