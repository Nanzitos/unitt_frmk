$(document).ready(function(){


  var token = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
        headers:{'X-CSRF-TOKEN':token},
        url:'/get-produtos-estoque',
        data:{"id":1},
        method:'POST',
    }).done(function(ret) {
        $('#id_produto').html(ret);

        $.unblockUI();

    });


  $("#id_produto").change(function(){

    var id = $(this).val();
    $.blockUI();

    $.ajax({
        headers:{'X-CSRF-TOKEN':token},
        url:'/atualiza-qtd-atual-estoque',
        data:{"id":id},
        method:'POST',
        dataType:'json'
    }).done(function(ret) {
        $('#qtd_atual').val(ret.qtd);
        $.unblockUI();
    });

  });

}); 
