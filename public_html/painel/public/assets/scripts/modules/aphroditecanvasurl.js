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

	$(document).on('click','.RemoverCanvas', function(){
		$(this).parent().parent().parent().remove();
	});

	$('#AdicionarCanvas').on('click', function(){

		var html = '';

		$.blockUI();

        $.ajax({
           headers:{'X-CSRF-TOKEN':token},
           url:'/canvas/allCanvas',
           data:{"a":"a"},
           method:'POST',
           dataType:'json'
         }).done(function(canvas) {

         	html+='<div class="card-block alert alert-warning RowCanvas">';
			  html+='<div class="row">';
			    html+='<div class="col-sm-4">';
			      html+='<select name="canvas[]" class="form-control select2" style="width:300px;">';
			      html+='<option value="">Selecione um canvas A:</option>';
			      
			      $.each(canvas, function(key,val){
			      	html+='<option value="'+val.id+'">('+val.id+') '+val.nome+'</option>';
			      });
			      
			      html+='</select>';
			    html+='</div>';
			    html+='<div class="col-sm-4">';
			      html+='<select name="canvas_b[]" class="form-control select2" style="width:300px;">';
			      html+='<option value="">Selecione um canvas B:</option>';

			      $.each(canvas, function(key,val){
			      	html+='<option value="'+val.id+'">('+val.id+') '+val.nome+'</option>';
			      });

			      html+='</select>';
			    html+='</div>';
			    html+='<div class="col-sm-4">';
			      html+='<button type="button" class="btn btn-danger btn-sm btn-icon mr5 RemoverCanvas">';
			        html+='<i class="icon-close"></i>';
			        html+='<span>Remover</span>';
			      html+='</button>';
			    html+='</div>';
			  html+='</div>';
			html+='</div>';

			$('#AllCanvas').append(html);
			$('.select2').select2();  
			$.unblockUI();
			

         });

	});

});