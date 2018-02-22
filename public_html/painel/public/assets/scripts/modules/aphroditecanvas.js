var EditorMirror;
var EditorMirrorCss;
var img_path = '';
var css_url  = '';

$(document).ready(function(){

	var token = $('meta[name="csrf-token"]').attr('content');

	EditorMirror = CodeMirror(document.getElementById("codemirror"), {
	  mode: "text/html",
	  extraKeys: {"Ctrl-Space": "autocomplete"},
	  value: $('#html').val(),
	  lineNumbers: true,
	  matchBrackets: true,
	  showCursorWhenSelecting: true,
	  autoComplete:true
	});

	EditorMirrorCss = CodeMirror(document.getElementById("codemirror-css"), {
	  mode: "text/html",
	  extraKeys: {"Ctrl-Space": "autocomplete"},
	  value: $('#css').val(),
	  lineNumbers: true,
	  matchBrackets: true,
	  showCursorWhenSelecting: true,
	  autoComplete:true
	});

	$(document).on('keyup', function(){
    	$('#html').val(EditorMirror.getValue());
    	$('#css').val(EditorMirrorCss.getValue());
    });

    $('#id_dispositivo').on('change', function(){

        /** SET THE PATHS **/
        css_url  = '';
        img_path = '';

        var id_dispositivo = $(this).val();  //1 Desktop 2 Mobile
        var id_marca       = $('#id_marca').val();

        $.ajax({
          headers:{'X-CSRF-TOKEN':token},
          url:'/marcas/getTemaAtivo',
          data:{"id_marca":id_marca},
          method:'POST',
          dataType:'json'
        }).done(function(ret) {

            if(ret){

              css_url  = ret.css_web;
              img_path = ret.img_path;

              if( id_dispositivo === '2' ){
                css_url = ret.css_mobile;
              }

            }

        });

    });

    $('#id_dispositivo').trigger('change');

	$('#OpenHtmlPreview').on('click', function(){

		var htmlText = $('#html').val();

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

	$('#AtivarVersao').on('click', function(){

		var id = $(this).data('id');

		swal({
	      title: 'Você tem certeza?',
	      text: 'Ao selecionar esse canvas como ativo, ele será alterado em todos os lugares que o contém.',
	      type: 'warning',
	      showCancelButton: true,
	      confirmButtonColor: '#DD6B55',
	      confirmButtonText: 'Sim, tenho certeza.',
	      closeOnConfirm: true,
	    }, function (confirm) {

	    	if(confirm){

	    		$.blockUI();

	    		$.ajax({
		          headers:{'X-CSRF-TOKEN':token},
		          url:'/setCanvas',
		          data:{"id":id},
		          method:'POST',
		          dataType:'json'
		        }).done(function(ret) {

		            if(ret.response){
		            	swal({
					      title: 'Sucesso!',
					      text: 'Canva atualizado como ativo!',
					      type: 'success'
					    });
		            }

		        });

		        $.unblockUI();

	    	}

	    });



	});



});
