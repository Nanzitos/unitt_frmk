/**
 * Created by alvar on 06/10/2016.
 */



$(document).ready(function(){

    var token = $('meta[name="csrf-token"]').attr('content');

    //Seta para português
    moment.lang('pt-br')

    $('#dp').datepicker({
        format: 'yyyy-mm-dd',
        defaultDate: "+1w",
        startDate:'01/01/2013',
        inline:true,
        autoclose: true
    });

    $('#CarregarData').on('click', function() {
        dia = $('#dp').datepicker().val();
        $.ajax({
            headers: {'X-CSRF-TOKEN': token},
            url: '/regerar?data='+dia,
            method: 'GET',
            dataType: 'json'
        }).done(function (ret) {
            console.log("funcionou");
        });
    });

    $('.drp').daterangepicker({
      format: 'YYYY-MM-DD',
      opens: 'left',
      'locale':{
        applyLabel: 'Aplicar',
            cancelLabel: 'Cancelar',
            fromLabel: 'De',
            toLabel: 'Até'
      }

    }, 
    function(start, end, label) {

    });

});

/**
 * Created by alvar on 08/11/2016.
 */
