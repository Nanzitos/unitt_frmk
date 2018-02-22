$(document).ready(function(){

	var token = $('meta[name="csrf-token"]').attr('content');

	$('#ToggleMenu').trigger('click');

	$('#open-rightnow').on('click', function() {
		$('#popup-rightnow').modal('show');
	});

	$('#open-rightnow-filtro').on('click', function() {
		$('#popup-rightnow-filtro').modal('show');
	});

	$('.regerar-rightnow').on('click', function () {
		swal({
			title: 'Você tem certeza?',
			text: 'Este processo irá regerar todas as bases do Right Now, isso pode levar alguns minutos!',
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#6FC080',
			confirmButtonText: 'Sim, regerar!',
			cancelButtonText: 'Não, cancelar!',
			closeOnConfirm: false,
			closeOnCancel: false
		}, function (isConfirm) {
			if (isConfirm) {
				window.location = '/rightnow-automatico-completo';
				swal({
					title: 'Aguarde!',
					text: '<div class="sk-rotating-plane center-block m-y-lg"></div><br>Dentro de alguns minutos a página irá atualizar automaticamente!',
					html: true
				});
			} else {
				swal('Cancelado :(', 'Processo cancelado!', 'error');
			}
		});
	});

	$("#CheckSourceAtualizarPai").on('change', function(){
		$('.CheckSourceAtualizar').prop('checked', $(this).prop('checked'));
	});

	$('#AtualizarSources').on('click', function(){

		id_source = new Array();

		$('.CheckSourceAtualizar:checked').each(function(){
			id_source.push($(this).val());
		});

		if( id_source.length == 0 ){
			notification('Nenhuma Source foi selecionada!.','warning','bottomRight',5000,'icon-error');
			return false;
		}

		swal({
			title: 'Você tem certeza?',
			text:  'Apenas as Sources selecionadas aparecerão no RightNow, as demais irão aparecer como "Diversos"!',
			type:  'warning',
			showCancelButton: true,
			closeOnConfirm: false,
			showLoaderOnConfirm: true,
		}, function (confirm) {

			if(confirm){

				$.blockUI();

				$.ajax({
					headers:{'X-CSRF-TOKEN':token},
					url:'/rightnow-automatico-config-source',
					data:{"ids_sources":id_source},
					method:'POST',
					dataType:'json'
				}).done(function(ret) {
					if(ret.response == true)
					{
						setTimeout(function () {
							swal('Sucesso :)', 'Sources atualizadas com sucesso!', 'success');
							$(location).attr('href', 'http://painel.the8co.com.br/custosrm');
						}, 2000);
					}else{
						setTimeout(function () {
							swal('Falha :(', 'Erro ao atualizar Sources!', 'error');
						}, 2000);
					}
				});

				$.unblockUI();
			}
		});
		return false;
	});

	setInterval(addProgress, 1);

	function addProgress()
	{
		var progressBarsc = $(".Slimcaps");
		var width_sc	  = progressBarsc.width();
		var max_sc 		  = progress_1.getAttribute("data-max");
		if(width_sc < max_sc)
		{
			width_sc += 1;
			progressBarsc.width(width_sc + '%');
		}

		var progressBarhc = $(".Haircaps");
		var width_hc 	  = progressBarhc.width();
		var max_hc        = progress_3.getAttribute("data-max");
		if(width_hc < max_hc)
		{
			width_hc += 1;
			progressBarhc.width(width_hc + '%');
		}

		var progressBarbc = $(".MyBeautyCaps");
		var width_bc      = progressBarbc.width();
		var max_bc 		  = progress_4.getAttribute("data-max");
		if(width_bc < max_bc)
		{
			width_bc += 1;
			progressBarbc.width(width_bc + '%');
		}

		var progressBarp4e = $(".Platinum4ever");
		var width_p4e      = progressBarp4e.width();
		var max_p4e 	   = progress_5.getAttribute("data-max");
		if(width_p4e < max_p4e)
		{
			width_p4e += 1;
			progressBarp4e.width(width_p4e + '%');
		}

		var progressBarby = $(".BeYoung");
		var width_by      = progressBarby.width();
		var max_by 		  = progress_6.getAttribute("data-max");
		if(width_by < max_by)
		{
			width_by += 1;
			progressBarby.width(width_by + '%');
		}

		var progressBarbr = $(".Burn");
		var width_br      = progressBarbr.width();
		var max_br 		  = progress_0.getAttribute("data-max");
		if(width_br < max_br)
		{
			width_br += 1;
			progressBarbr.width(width_br + '%');
		}

		var progressBarMeta = $(".meta");
		var width_meta      = progressBarMeta.width();
		var max_meta 		= progress_meta.getAttribute("data-max");
		if(width_meta < max_meta)
		{
			width_meta += 1;
			progressBarMeta.width(width_meta + '%');
		}
	}
});
