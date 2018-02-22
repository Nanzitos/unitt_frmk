$(document).ready(function(){

	$('#AtualizarCampanhas').on('click', function(){
		$.blockUI();
	});

	$('#FormBuscaCampanhas').on('submit', function(){
		$('#ModalSearch').modal('hide');
		$.blockUI();
	});

	$('#enviarForm').on('click', function(){

        var id_marca    = $('#id_marca').val();
        var id_parceiro = $('#id_parceiro').val();
        var id_jump     = $('#id_jump').val();

        if(id_marca == 0){
        	notification('O campo Marca é obrigatório!','error','bottomRight',5000,'icon-error');
            return false;

        } else if (id_parceiro == 0) {
        	notification('O campo Parceiro é obrigatório!','error','bottomRight',5000,'icon-error');
            return false;

        } else if (id_jump == 0) {
        	notification('O campo Jump-page é obrigatório!','error','bottomRight',5000,'icon-error');
            return false;
            
        } else {
        	$('#enviarForm').submit();
            notification('Campanha salva com sucesso!','success','bottomRight',5000,'icon-success');
        }

    });

});