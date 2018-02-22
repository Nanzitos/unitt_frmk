var EditorMirror;
var css_url  = '';
var img_path = '';

$(document).ready(function(){

     var token   = $('meta[name="csrf-token"]').attr('content');

    if( $('#codemirror').length ){

      EditorMirror = CodeMirror(document.getElementById("codemirror"), {
        mode: "text/html",
        extraKeys: {"Ctrl-Space": "autocomplete"},
        value: $('#teste_ab').val(),
        lineNumbers: true,
        matchBrackets: true,
        showCursorWhenSelecting: true,
        autoComplete:true
      });

    }

    $(document).on('keyup', function(){
        $('#teste_ab').val(EditorMirror.getValue());
    });

    /**
    * inputSelects
    *
    * Atualiza o valor dos selects
    */
    var inputSelects = function()
    {
        var id_marca = $('#id_marca').val();

        $.blockUI({'message':'<br />Atualizando canvas, aguarde...<br /><br />'});

        $.ajax({
           headers:{'X-CSRF-TOKEN':token},
           url:'/canvas/allCanvasByMarca',
           data:{"id_marca":id_marca},
           method:'POST',
           dataType:'json'
         }).done(function(ret) {

              var html = '<option value="0">Selecione um canvas A:</option>';


              $.each(ret, function(key,val){
                html+='<option value="'+val.id+'">'+val.nome+'</option>';
              });

              $('.ChangeTemplateCanvas').html(html);
              $('.CanvasB').html(html.replace('Selecione um canvas A:','Selecione um canvas B:'));

              setTimeout(function(){

                $.each($('.ChangeTemplateCanvas'), function(key,val){

                    var id_canvas = $(this).attr('id');

                    $.each($(this).find('option'), function(keyOpt,option){
                      if(option.value==id_canvas){
                        option.setAttribute("selected","selected");
                      }
                    });

                    if(!id_canvas){
                      id_canvas = 0;
                    }

               });

                $.each($('.CanvasB'), function(key,val){

                    var id_canvas = $(this).attr('id');

                    $.each($(this).find('option'), function(keyOpt,option){
                      if(option.value==id_canvas){
                        option.setAttribute("selected","selected");
                      }
                    });

                    if(!id_canvas){
                      id_canvas = 0;
                    }

               });

                $('.ChangeTemplateCanvas').select2();
                $('.CanvasB').select2();

                $.unblockUI();
              },500);



         });


    }

    $('#id_dispositivo').on('change', function(){

        /** SET THE PATHS **/
        css_url  = '';
        img_path = '';

        var id_dispositivo = $(this).val();  //1 Desktop 2 Mobile
        var id_marca       = $('#id_marca').val();

        $.ajax({
          headers:{'X-CSRF-TOKEN':token},
          url:'/marcas/getTemaAtivo',
          data:{"id_marca":id_marca,"id_dispositivo":id_dispositivo},
          method:'POST',
          dataType:'json'
        }).done(function(ret) {

            if(ret){

              css_url  = ret.desktop.css_path;
              img_path = ret.desktop.img_path;

              if( id_dispositivo === 2 ){
                css_url  = ret.mobile.css_path;
                img_path = ret.mobile.img_path;
              }

              $('.ChangeTemplateCanvas').trigger('change');

            }

        });

     });

     $('#url').on('blur', function(){

      var obj     = $(this);
      var id_tema = $('#id_tema').val();
      var url     = obj.val();

      if(!id_tema){

        swal({
          title: 'Ops! Algo está errado.',
          text: 'Você precisa selecionar um tema antes de definir a URL.',
          type: 'warning',
          showCancelButton: false,
          confirmButtonColor: '#DD6B55',
          confirmButtonText: 'Ok! entendi.',
          closeOnConfirm: true,
        }, function (confirm) {
          $('#id_tema').data('select2').open();
        });

        obj.val('');

        return false;

      }

      $.blockUI();

      $.ajax({
         headers:{'X-CSRF-TOKEN':token},
         url:'/aphroditeurl/checkURL',
         data:{"url":url,"id_tema":id_tema},
         method:'POST',
         dataType:'json'
       }).done(function(ret) {

        if(ret.response){

          swal({
            title: 'Ops! A URL selecionada, já existe pro tema cadastrado.',
            text: 'Verifique para não criar duas URLs iguais.',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Ok! entendi.',
            closeOnConfirm: true,
          }, function (confirm) {

          });

        }

        $.unblockUI();

       });

     });

     /*
      * startSortable
      */
      if( $('.sortable-list').length ){
       /* $('.sortable-list').sortable({
          placeholder: 'ui-state-highlight',
          connectWith: '.connectedSortable',
          stop:function(e,ui)
          {
            $('.ChangeTemplateCanvas').trigger('change');
          }
        });*/
      }

    /*
    * getTemplate
    */
    $(document).on('change', '.ChangeTemplateCanvas', function(){

        var obj = $(this);
        var id  = obj.val();
        var id_marca = parseInt($('#id_marca').val());

        /*if(!id || !id_marca){
          swal({
            title: 'Ops! Algo está errado.',
            text: 'Você não pode selecionar canvas sem dizer a qual marca a URL pertence.',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Ok! entendi.',
            closeOnConfirm: true,
          }, function (confirm) {
            $('#id_marca').data('select2').open();
          });

          return false;
        }*/

        $.blockUI();

        obj.attr('data-canvas-id',id);

        $.ajax({
          headers:{'X-CSRF-TOKEN':token},
          url:'/canvas/getById',
          data:{"id":id,"id_marca":id_marca},
          method:'POST'
        }).done(function(ret) {

            var html='<html lang="pt-br">';
                html+='<head>';
                  html+='<meta charset="UTF-8">';
                  html+='<meta http-equiv="X-UA-Compatible" content="IE=edge">';
                  html+='<link rel="stylesheet" type="text/css" href="'+css_url+'" />';
                html+='</head>';
                html+='<body>';
                html+=ret;
                html+='</body>';
                html+='</html>';

            var iframe        = obj.parent().next().next();
            var txtarea       = iframe.next().val(html);
            var doc           = iframe[0].contentWindow.document;
                doc.open();
                doc.write(txtarea.val());
                doc.close();



            setTimeout(function(){

              //Set iframe = section
              iframe.attr('height', iframe.contents().find('section').css('height'));

              //Fix images urls
              /*var imgs = iframe.contents().find('img');

              $.each(imgs, function(key,val){
                var src = $(this).attr('src');
                console.log(src);
                var img_src = img_path+src;
                //$(this).attr('src',img_src);
              });*/

            },300);

        });

        $.unblockUI();

        return false;

    });

    $('.AddCanvas').on('click', function(){


        var html='<li style="position:relative;">';
              html+='<div style="position:absolute; right:10px;">';
                html+='<select name="canvas[]" data-canvas-id="" class="form-control select2 ChangeTemplateCanvas" style="width:300px;">';
                  html+='<option value="">Selecione um canvas A:</option>';
                html+='</select>';
              html+='</div>';
              html+='<div style="position:absolute; right:10px; top:55px;">';
                html+='<select name="canvas_b[]" data-canvas-id="" class="form-control select2 CanvasB" style="width:300px;">';
                  html+='<option value="">Selecione um canvas B:</option>';
                html+='</select>';
              html+='</div>';
              html+='<iframe width="100%" height="auto" style="border:0px; height:300px !important;"></iframe>';
              html+='<textarea style="display:none;" class="TxtCanvas"></textarea>';

              html+='<button type="button" class="btn btn-danger btn-sm btn-icon mr5" style="position:absolute; top:95px; right:10px;">';
                html+='<i class="icon-close"></i>';
                html+='<span>Remover canvas</span>';
              html+='</button>';

            html+='</li>';

        $('.sortable-list').append(html);
        inputSelects();

    });

    $(document).on('click','.RemoverCanvas', function(){

        var obj = $(this).parent();

        swal({
            title: 'Você tem certeza?',
            text: 'Deseja realmente remover o canvas selecionado? Essa ação não poderá ser desfeita.',
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Sim, remova.',
            closeOnConfirm: true,
          }, function (confirm) {

              if(confirm){
                obj.remove();
              }

          });

        return false;

    });

    $('.OpenHtmlPreview').on('click', function(){

        var htmlText = '';

        $.each($('.TxtCanvas'), function(key,val){
            htmlText+=$(this).val();
        });


        var html='<html lang="pt-br">';
                html+='<head>';
                  html+='<meta charset="UTF-8">';
                  html+='<meta http-equiv="X-UA-Compatible" content="IE=edge">';
                  html+='<link rel="stylesheet" type="text/css" href="'+css_url+'" />';
                html+='</head>';
                html+='<body>';
                html+=htmlText;
                html+='</body>';
                html+='</html>';

            var iframe        = $('#IframePreviewHtml');
            var doc           = iframe[0].contentWindow.document;
                doc.open();
                doc.write(html);
                doc.close();


        setTimeout(function(){

          //Set iframe = section
          iframe.attr('height', iframe.contents().find('section').css('height'));

          //Fix images urls
          var imgs = iframe.contents().find('img');

          $.each(imgs, function(key,val){
            var src = $(this).attr('src');
            var img_src = img_path+src;
            $(this).attr('src',img_src);
          });

        },300);

        $('#ModalHtmlPreview').modal('show');

    });

    if($('#id').length){
      $('#id_marca').trigger('change');
      $('#id_dispositivo').trigger('change');
    }

    if(!$('#FiltroMarcas').length){
      inputSelects();
    }


    if( $('#FiltroMarcas').length ){

      $('#FiltroMarcas').on('change', function(){

        var id_marca = $(this).val();

          $('#FiltroTemas').html('<option value="">Aguarde...</option>');

          $.ajax({
             headers:{'X-CSRF-TOKEN':token},
             url:'/aphroditeurl/getTemaByMarca',
             data:{"id_marca":id_marca},
             method:'POST',
             dataType:'json'
           }).done(function(ret) {

                var html = '<option value="0">Selecione um tema:</option>';

                $.each(ret, function(key,val){
                  html+='<option value="'+val.id+'">'+val.nome+'</option>';
                });

                $('#FiltroTemas').html(html);

           });

      });

      $('#FormBuscaURLs').on('submit', function(){

        $('#ModalSearch').modal('hide');
        $.blockUI();
        return true;

      });

    }

});
