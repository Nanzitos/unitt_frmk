
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
      
      var status;

      if(idBtn == 'finalizada'){
        var r = confirm("Finalizar entrega?");
        if(r == true){
            status = 2;
        }else return false;
      }else{
        var r = confirm("Cancelar entrega?");
        if(r == true){
          status = 3;
        }else return false;
      }

      $.ajax({
            headers:{'X-CSRF-TOKEN':token},
            url:'/compras-entrega-aprovar',
            data:{"id":id, "status": status},
            method:'POST',
          }).done(function(ret) {
              $.unblockUI();
              alert("Entrega "+ idBtn +" com sucesso!");
              $('#ModalSearchVisualizar').modal('hide');
              location.reload();
          });

    });


});
