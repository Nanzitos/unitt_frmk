$(document).ready(function(){

	/**
     * AtualizarFotoPerfil
     *
     * Atualiza a foto do perfil do usuário
     *
     */

     $('#AlterarFoto').on('click', function(){
     	$('#FieldFotoPerfil').trigger('click');
     });

     $('#FieldFotoPerfil').on('change', function(){

     	var val = $(this).val();

     	switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
	        case 'jpg':
	            $.blockUI();
	            $('#FormFotoPerfil').submit();
	            break;
	        default:
	            $(this).val('');
	            swal('Ops!', 'Você deve selecionar um arquivo JPG.', 'warning');
	            break;
	    }

     });

     /**
     * Verifica parametros do $_GET na URL
     *
     */
     $(window).on('load', function () {
          
          if(r = $_GET.r){

               msg      = 'Registro atualizado com sucesso.';
               type     = 'success';
               position = 'bottomRight';

               if(r == '0'){
                    msg  = 'Ops! não foi possível atualizar as informações.';
                    type = 'error';
               }

               
             if($('body').hasClass('page-loaded')){
               notification(msg,type,position);
             }
               
          }
     });

     runValidator($('#PerfilForm')); //Inicia a validação.

});