$(document).ready(function()
{   
    var token = $('meta[name="csrf-token"]').attr('content');

    $('#ToggleMenu').trigger('click');

    $('#dp').datepicker({
        format: 'yyyy-mm-dd',
        defaultDate: "+1w",
        startDate:'01/01/2013',
        inline:true,
        autoclose: true
    });

   	$(document).on('click', '#baixarDesempenhoFB', function(){

        var data = $('#dp').val();

        if (!data)
        {
            notification('Selecione um dia!','error','bottomRight',3000,'icon-error');
            return false;
        }

        $(location).attr('href', 'desempenho-facebook/baixarDesempenhoFB?data='+data);

   	});

    $(document).on('click', '#regerarDesempenhpFB', function(){

        var data = $('#dp').val();

        if (!data)
        {
            notification('Selecione um dia!','error','bottomRight',3000,'icon-error');
            return false;
        }

        $(location).attr('href', 'desempenho-facebook/regerarDesempenhpFB?data='+data);

    });
});