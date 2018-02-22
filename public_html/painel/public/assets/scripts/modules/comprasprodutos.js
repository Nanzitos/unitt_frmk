$(document).ready(function(){

  var token   = $('meta[name="csrf-token"]').attr('content');
  var divHiddenProduto = $('#produto_venda').parent().parent();
  var divHiddenQtd = $('#qtd_potes').parent().parent();
  var divHiddenEstoque = $('#estoque_seguranca').parent().parent();
  divHiddenProduto.hide();
  divHiddenQtd.hide();
  divHiddenEstoque.hide();

  var idFornecedor = $('#id_fornecedores').val();

  if(idFornecedor != ""){
      $.ajax({
          headers:{'X-CSRF-TOKEN':token},
          url:'/get-fornecedor-categoria',
          data:{"idFornecedor": idFornecedor},
          method:'POST',
        }).done(function(ret) {
          $('#categoria_fornecedor').val(parseInt(ret)).trigger('change.select2');
          $('#categoria_fornecedor').trigger("change");
      });

    }


    $('#grupo_estoque').change(function(){

      var id = $(this).val();
      var obj = $(this);

      $.ajax({
          headers:{'X-CSRF-TOKEN':token},
          url:'/verifica-grupo-estoque',
          data:{"id":id},
          method:'POST',
        }).success(function(data) {
            if(data == 1){
              divHiddenProduto.fadeIn();
              divHiddenQtd.fadeIn();
              divHiddenEstoque.fadeIn();
            }else{
              divHiddenProduto.fadeOut();
              divHiddenQtd.fadeOut();
              divHiddenEstoque.fadeOut();
            }
        });
    });

    if( $('#FormFiltros').length ){

      $('#FormFiltros').on('submit', function(){

        $('#ModalSearch').modal('hide');
        $.blockUI();
        return true;

      });
    }

    //Inicializa o grupo de estoque corretamente
    if( $('#id').val() )
        $('#grupo_estoque').trigger('change');

    $('#categoria_fornecedor').change(function(){

        var id = $(this).val();
        var campos =  $('#id_fornecedores').val();

        // $.blockUI();

        $.ajax({
            headers:{'X-CSRF-TOKEN':token},
            url:'/get-fornecedor-categoria',
            data:{"id":id, "campos": campos},
            method:'POST',
          }).done(function(ret) {
            //   $.unblockUI();
              if(ret == 0) $('#div-fornecedor').html('<h4> Nenhum fornecedor com essa categoria');
              else $('#div-fornecedor').html(ret);

          });
    });

    $(".visualizarRegistro").click(function(){
        var id = $(this).attr('id');
        $.blockUI();
        $.ajax({
            headers:{'X-CSRF-TOKEN':token},
            url:'/compras-produtos-visualizar',
            data:{"id":id},
            method:'POST',
          }).done(function(ret) {
             $.unblockUI();
             $("#modalVisualizar").html(ret);
          });

      $('#ModalSearchVisualizar').modal();
    });

    $(".imgProd").click(function(){
      var cont = '<img src="'+$(this).attr('src')+'" style="width: 100%;" id="imgAtiva"/>';

      $("#ModalImgCont").html(cont);
      $("#ModalImg").modal();
      $("#ctImg").val($(this).attr('data-ct'));

    });

    $(".excluirImg").click(function(){
      var r = confirm("Excluir essa imagem?");

      if(r == true){
         $.blockUI();
        var idImagem = $(this).attr('id');
        $.ajax({
            headers:{'X-CSRF-TOKEN':token},
            url:'/compras-deletar-imagem',
            data:{"id":idImagem},
            method:'POST',
          }).done(function(ret) {
              $.unblockUI();
          });
          $(this).parent().remove();
      }
    });

    $(document).keyup(function(e){

      if($("#ModalImgCont").is(":visible")){
      	if(e.wich == 39 || e.keyCode == 39 || e.keyCode == 37 || e.wich == 37){
      		if(e.keyCode == 39) var proxImg = (parseInt($("#ctImg").val()) + 1);
          else var proxImg = ($("#ctImg").val() - 1);

          if(proxImg < 0) return false;
          if(proxImg > $(".imgProd").length) return false;

          $(".imgProd").each(function(){
              if($(this).attr('data-ct') == proxImg){
                  $("#imgAtiva").attr('src',$(this).attr('src'));
                  $("#ctImg").val($(this).attr('data-ct'));
              }
          });

      	}
      }
    });

    $(".divSeta").click(function(){
      if($(this).attr('data-dir') == 'd') var proxImg = (parseInt($("#ctImg").val()) + 1);
      else var proxImg = ($("#ctImg").val() - 1);

      if(proxImg < 0) return false;
      if(proxImg > $(".imgProd").length) return false;

      $(".imgProd").each(function(){
          if($(this).attr('data-ct') == proxImg){
              $("#imgAtiva").attr('src',$(this).attr('src'));
              $("#ctImg").val($(this).attr('data-ct'));
          }
      });
    });

});
