$(document).ready(function(){

  var token   = $('meta[name="csrf-token"]').attr('content');  

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
            url:'/painel/public/sliders-deletar-imagem',
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
