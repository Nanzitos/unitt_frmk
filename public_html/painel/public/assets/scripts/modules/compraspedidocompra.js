
$(document).ready(function(){



  var token = $('meta[name="csrf-token"]').attr('content');



    $(".visualizarRegistro").click(function(){
        var id = $(this).attr('id');

      //  $.blockUI();

        $.ajax({
            headers:{'X-CSRF-TOKEN':token},
            url:'/compras-pedido-visualizar',
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
      var id = $("#idPedido").val();
      var status;

      if(idBtn == 'finalizado'){
        var r = confirm("Finalizar Pedido de compra?");
        if(r == true){
            status = 2;
        }else return false;
      }else{
        var r = confirm("Cancelar Pedido de compra?");
        if(r == true){
          status = 3;
        }else return false;
      }

      $.ajax({
            headers:{'X-CSRF-TOKEN':token},
            url:'/compras-pedido-aprovar',
            data:{"id":id, "status": status},
            method:'POST',
          }).done(function(ret) {
              $.unblockUI();
              alert("Pedido de Compra "+ idBtn +" com sucesso!");
              $('#ModalSearchVisualizar').modal('hide');
              location.reload();
          });

    });

  /*  $(document).on("click", ".documentoPedido", function(){
          $.ajax({
            headers:{'X-CSRF-TOKEN':token},
            url:'/compras-gerar-documento',
            data:{"id":1},
            method:'POST',
          }).done(function(ret) {
          //  alert(1);
          });
          return false;
    }); */


});
