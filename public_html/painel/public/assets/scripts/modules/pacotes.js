$(document).ready(function(){

  var token = $('meta[name="csrf-token"]').attr('content');


  $('#enviar').on('click', function(){

        var sel = true;

        $.blockUI();

        $.each($('.sel'), function(key,val){

            if($(this).val() == "")
            {   
                sel = false;
            }
        }); 

        $.unblockUI();

        if(sel) {
            $('#formUpload').submit();
            notification('Pacote enviado com sucesso! Aguarde o recarregamento da página...','success','bottomRight',5000,'icon-success');
        
        } else {
            notification('Os campos Marca, Parceiro e Jump Page são obrigatórios!','error','bottomRight',5000,'icon-error');
            return false;
        }

        return false;

    });

});



