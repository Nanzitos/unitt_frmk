var EditorMirror;

$(document).ready(function(){

    var token = $('meta[name="csrf-token"]').attr('content');

    if( form ) {

        EditorMirror = CodeMirror(document.getElementById("codemirror"), {
            mode: "text/html",
            extraKeys: {"Ctrl-Space": "autocomplete"},
            value: $('#html').val(),
            lineNumbers: true,
            matchBrackets: true,
            showCursorWhenSelecting: true,
            autoComplete: true
        });

        $(document).on('keyup', function () {
            $('#html').val(EditorMirror.getValue());
        });


        $('#id_marca').on('change', function () {

            var id_marca = $(this).val();

            if (!id_marca)
                return false;

            $.blockUI();

            $.ajax({
                headers: {'X-CSRF-TOKEN': token},
                url: '/getPromocaoByIdMarca',
                data: {"id_marca": id_marca},
                method: 'POST',
                dataType: 'json'
            }).done(function (ret) {

                if (ret) {

                    var html = '<option value="0" selected="selected">Nenhum cupom</option>';

                    $.each(ret, function (key, val) {
                        html += '<option value="' + val.id + '">' + val.nome + '</option>';
                    });

                    $('#id_promocao').html(html);
                    $('.select2').select2();

                    if ($('#id').length) {
                        var value = $('#id_promocao').data('value');
                        $('#id_promocao').val(value);
                        $('.select2').select2();
                    }
                }

            });

            $.unblockUI();

        });

        if ($('#id').length) {
            $('#id_marca').trigger('change');
        }


        $('#SalvarVisualizar').on('click', function(){

            var id = $('#id').val();
            var html = $('#html').val();

            $.blockUI();

            $.ajax({
                headers: {'X-CSRF-TOKEN': token},
                url: '/saveTemplateEmailPreview',
                data: {'id':id,'html':html},
                method: 'POST',
                dataType: 'json'
            }).done(function (ret) {
                console.log(ret);
            });

            $.unblockUI();


        });


    } else {

        $('.IframePreviewButtons').on('mouseover', function(){

            var id     = $(this).attr('id');
            var iframe = $('#IframePreview'+id);

            iframe.zoomer({
                zoom: 1,
                width:262,
                height:262,
                loading_type:'spinner'
            });
            iframe.show();



        });
    }

});