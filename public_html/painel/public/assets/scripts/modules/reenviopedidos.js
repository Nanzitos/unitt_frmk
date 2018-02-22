$(document).ready(function(){

    $('#ConsultarPedidos').on('click', function(){

        var id_pedidos =  $('.id-pedidos').val();

        if(id_pedidos != '')
        {
            $(location).attr('href', 'relatorio-reenvio-pedidos?id_pedidos='+id_pedidos);
        }
        else
        {
            notification('Nenhum id de pedido inserido!','warning','bottomRight',5000,'icon-error');
            return false;
        }

    });

    $('#input-tags').selectize({
        delimiter: ',',
        persist: false,
        create: function (input)
        {
            if(!isNaN(input))
            {
                return {
                    value: input,
                    text: input
                };
            }else{
                notification('Insira apenas id de pedidos!','warning','bottomRight',5000,'icon-error');
                return {
                    value: '',
                    text: input
                };
            }            
        }
    });

});
