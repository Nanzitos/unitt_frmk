$(document).ready(function(){

    var token = $('meta[name="csrf-token"]').attr('content');

    moment.lang('pt-br')

      $('.drp').daterangepicker({
          format: 'YYYY-MM',
          'locale':{
              applyLabel: 'Aplicar',
              cancelLabel: 'Cancelar',
              fromLabel: 'De',
              toLabel: 'Até'
          }
      });

       $( "#formap" ).submit(function( event ) {
         var estados = [];
         $('.chkestado').each(function() {
           if($(this).is(':checked'))
            estados.push("'"+$(this).val()+"'");
        });
        var sources = [];
        $('.chksource').each(function() {
          if($(this).is(':checked'))
            sources.push("'"+$(this).val()+"'");
        });
        var marcas = [];
        $('.chkmarca').each(function() {
          if($(this).is(':checked'))
            marcas.push($(this).val());
        });
        console.log(marcas);
        $('#marca').val(marcas);
        $('#source').val(sources);
        $('#estado').val(estados);
        //event.preventDefault();
      });

      $( "#consulta" ).click(function() {
        $( "#formap" ).submit();
      });

      $("#btnbase").on('click', function()
      {
        $("#formbase").submit();
      });

      $("#btntela").on('click', function()
      {
        alert("Em construção...");
      });

        /*$.ajax({
            headers:{'X-CSRF-TOKEN':token},
            url:'/recompras?options='+opt,
            method:'GET',
            dataType: 'json'
        }).done(function(ret) {
            console.log("OK");
        });
        $('#opt').val(opt);
        $('#fil').val(filtros);
        $('#formap').submit();
        console.log(filtros);
    });
    */

    $('.checkbox').on('change', function() {
        $('input[type="checkbox"]').parent().css('background', 'white');
        $('input[type="checkbox"]:checked').parent().css('background', 'MediumSpringGreen');
      });


    $('#allestado').on('click', function(){
        if($(this).prop('checked')){
            $('.chkestado').prop('checked', true);
        } else {
            $('.chkestado').prop('checked', false);
        }
    });

    $('#allsource').on('click', function(){
        if($(this).prop('checked')){
            $('.chksource').prop('checked', true);
        } else {
            $('.chksource').prop('checked', false);
        }
    });

    $('#allmarca').on('click', function(){
        if($(this).prop('checked')){
            $('.chkmarca').prop('checked', true);
        } else {
            $('.chkmarca').prop('checked', false);
        }
    });



    /*
    $('.deschecado').each(function(e) {
      $('.deschecado').on('click', function(d) {
          $(this).addClass('checado');
          $(this).removeClass('deschecado');
          console.log("Eu sei if");
    })});

  $('.checado').each(function(e) {
      $('.checado').on('change', function(d) {
        alert("OIIII");
        $(this).removeClass('checado');
        $(this).addClass('deschecado');
      })});
*/

    /*var classname = document.getElementsByClassName("checkbox");

    var myFunction = function() {
      var checkid = this.getAttribute("id");
      if(document.getElementById(checkid).checked == 1){
        var lbl = document.getElementById("lbl"+checkid);
        lbl.style.background = "red";
      }
    };

    for (var i = 0; i < classname.length; i++) {
      classname[i].addEventListener('click', myFunction, false);
    }
*/

});/**
 * Created by Alvaro on 20/03/2017.
 */
