$(document).ready(function(){

    var token = $('meta[name="csrf-token"]').attr('content');

    $('#FormBuscaTasks').on('submit', function(){
      $('#ModalSearch').modal('hide');
      $.blockUI();
    });

	//Esconde o menu para aproveitar a tela.
	$('#ToggleMenu').trigger('click');

	/***********************
	| Registra a validação
	/***********************/

	var rules = {
     // no quoting necessary
     id_usuario: "required",
     id_marca: "required",
     id_categoria: "required",
     id_tipo: "required",
     descricao: "required",
     importancia: "required",
     id_prioridade: "required"
     
   }

	$('#NovaTaskForm').validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: true, // do not focus the last invalid input
        ignore: "",  // validate all fields including form hidden input
        rules: rules,

        invalidHandler: function (event, validator) { //display error alert on form submit              
            
        },

        errorPlacement: function (error, element) { // render error placement for each input type
        	
        },

        highlight: function (element) { // hightlight error inputs
        	$(element).parent().addClass('has-error');
        },

        unhighlight: function (element) { // revert the change done by hightlight
        	$(element).parent().removeClass('has-error');
            $(element).parent().addClass('has-success');
        },

        success: function (label, element) {
            var icon = $(element).parent('.input-icon').children('i');
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
            icon.removeClass("fa-warning").addClass("fa-check");
        },

        submitHandler: function (form) {
        	$('#NovaTaskModal').modal('hide');
        	$.blockUI();
        	
        	setTimeout(function(){
        		form.submit();
        	},200);
        }
    });

   /*
    * Deletar task
    */
    $('.DeletarTask').on('click', function(){

      var obj = $(this);

      swal({
        title: 'Você tem certeza?',
        text: 'Você poderá recuperar essa task no futuro.',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Sim, tenho certeza.',
        closeOnConfirm: true,
      }, function (confirm) {
          
        if(confirm){

          var id = obj.data('id-task');

          $.blockUI();

          $.ajax({
            headers:{'X-CSRF-TOKEN':token},
            url:'/apagarTask',
            data:{"id":id},
            method:'POST',
            dataType:'json'
          }).done(function(ret) {

              if(ret.response){
                  location.reload();
              }

          });
          
        }

      });

    });

    /*
     * Cancelamento task
     */
     $('#CancelarTask').on('click', function(){

    	swal({
	      title: 'Você tem certeza?',
	      text: 'Todos os dados digitados serão perdidos.',
	      type: 'warning',
	      showCancelButton: true,
	      confirmButtonColor: '#DD6B55',
	      confirmButtonText: 'Sim, tenho certeza.',
	      closeOnConfirm: true,
	    }, function (confirm) {
	      	
	    	if(confirm){

	    		$('#NovaTaskForm .form-control').each(function(key,val){
	    			$(this).val('');
	    			$('#NovaTaskModal').modal('hide');
	    		});
	    	}

	    });
    });

    /*
     * Se existir a navegação
     */
     if( $('#ChangeIdMarca').length ){

        $('#ChangeIdMarca').on('change', function(){

            if( $('#NovaTaskModal').is(':visible') ){
              return false;
            }

            $.blockUI();

            var obj_selected = $('#ChangeIdMarca option:selected');
            var id_default   = $('#ChangeIdMarca').data('default');
            var id_area_task = obj_selected.data('id-area-task');

            if(id_area_task===1){
              $('#NovaTaskModal').modal();
              $.unblockUI();
              $('#ChangeIdMarca').val(id_default).trigger('change');
            } else {
              window.location='minhas-tasks?area='+id_area_task;
            }

            return false;

        });

     }

     /*
      * Abre uma task para edição
      */
      if( $('#EditarTaskForm').length ){

        var rules = {};

        if($('#id_redator').length)
            rules.id_redator = "required";

        if($('#id_layout').length)
            rules.id_layout = "required";

        if($('#id_complexidade').length)
            rules.id_complexidade = "required";

        if($('#prazo').length)
            rules.prazo = "required";

        if($('#link_redacao').length)
            rules.link_redacao = "required";

        if($('#link_layout').length)
            rules.link_layout = "required";

        if($('#link_jpg').length)
            rules.link_jpg = "required";

        if($('#id_frontend').length)
            rules.id_frontend = "required";

        if($('#id_complexidade_frontend').length)
            rules.id_complexidade_frontend = "required";

        if($('#prazo_frontend').length)
            rules.prazo_frontend = "required";

        if($('#link_frontend').length)
            rules.link_frontend = "required";

        if($('#link_programacao_tecnica').length)
            rules.link_programacao_tecnica = "required";

        if($('#data_subida').length)
            rules.data_subida = "required";
          

        
        $('#EditarTaskForm').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: true, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            rules: rules,

            invalidHandler: function (event, validator) { //display error alert on form submit              
                
            },

            errorPlacement: function (error, element) { // render error placement for each input type
                
            },

            highlight: function (element) { // hightlight error inputs
                $(element).parent().addClass('has-error');
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element).parent().removeClass('has-error');
                $(element).parent().addClass('has-success');
            },

            success: function (label, element) {
                var icon = $(element).parent('.input-icon').children('i');
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                icon.removeClass("fa-warning").addClass("fa-check");
            },

            submitHandler: function (form) {
                
                $('#ModalVerTask').modal('hide');
                $.blockUI();

                setTimeout(function(){
                    form.submit();
                },200);
            }
        });


        $('.AbrirTask').on('click', function(e){

            e.preventDefault();

            $.blockUI();

            var id = $(this).data('id');

            var Titulo                  = $('#TaskTitulo');
            var Usuario                 = $('#TaskSolicitante');
            var Marca                   = $('#TaskMarca');
            var Categoria               = $('#TaskCategoria');
            var Tipo                    = $('#TaskTipo');
            var Prioridade              = $('#TaskPrioridade');
            var Descricao               = $('#TaskDescricao');
            var Importancia             = $('#TaskImportancia');
            var Redator                 = $('#TaskRedator');
            var DiretorArte             = $('#TaskDiretorArte');
            var LinkJPG                 = $('#TaskLinkJpg');
            var LinkPSD                 = $('#TaskLinkPSD');
            var LinkRedacao             = $('#TaskLinkRedacao');
            var Complexidade            = $('#TaskComplexidade');
            var Prazo                   = $('#TaskPrazo');
            var AprovadoPorEm           = $('#TaskAprovadoPorEm');
            var Frontend                = $('#TaskFrontend');
            var FrontendPrazo           = $('#TaskFrontendPrazo');
            var ProgramadorTecnico      = $('#TaskProgramadorTecnico');
            var FrontendLink            = $('#TaskLinkFrontEnd');
            var ProgramacaoTecnicaLink  = $('#TaskLinkProgramacaoTecnica');
            var FrontendAprovadoPorEm   = $('#TaskAprovadoPorEmFrontend');
            var DataSubida              = $('#TaskDataSubida');
            var DataSubidaPrevista      = $('#TaskDataSubidaPrevista');
            var DataAnalisePrevista1    = $('#TaskDataAnalisePrevista1');
            var DataAnalisePrevista2    = $('#TaskDataAnalisePrevista2');
            var LinkAnalise1            = $('#TaskLinkAnalise1');
            var LinkAnalise2            = $('#TaskLinkAnalise2');
            var Resultado               = $('#TaskResultado');


            $.ajax({
              headers:{'X-CSRF-TOKEN':token},
              url:'/getTaskById',
              data:{"id":id},
              method:'POST',
              dataType:'json'
            }).done(function(ret) {

                $('#id_task').val(ret.id);
                //$('#id_area').val(ret.id_area);
                
                var html = '';

                $('#TaskTitulo').html('(#'+ret.id+') '+ret.Título);
                
                $.each(ret, function(key,val){

                  /*html+='<li class="col-sm-4" style="height:86px;">';
                    html+='<a>';
                      html+='<div class="notification-icon">';
                        html+='<div class="circle-icon bg-info text-white">';
                          html+='<i class="icon-user"></i>';
                        html+='</div>';
                      html+='</div>';
                      html+='<span class="notification-message" style="line-height:15px;">';
                        html+=key+'<br />';
                        html+='<b>'+val+'</b>';
                      html+='</span>';
                    html+='</a>';
                  html+='</li>';*/


                  html+='<tr>';
                    html+='<td width="20%">'+key+'</td>';
                    html+='<td>'+val+'</td>';
                  html+='</tr>';

                });

                $('.tasks-infos').html(html);

                if($('#VoltarTask').length && ret.id_area_origem)
                  $('#VoltarTask').attr('data-to',ret.id_area_origem);

                /*if(Titulo.length && ret.id)
                    Titulo.html('#'+ret.id);
                
                if(Usuario.length && ret.usuario)
                    Usuario.html(ret.usuario.nome+' '+ret.usuario.sobrenome);
                
                if(Marca.length && ret.marca)
                    Marca.html(ret.marca.nome);
                
                if(Categoria.length && ret.categoria)
                    Categoria.html(ret.categoria.titulo);
                
                if(Tipo.length && ret.tipo)
                    Tipo.html(ret.tipo.titulo);
                
                if(Prioridade.length && ret.prioridade)
                    Prioridade.html(ret.prioridade.titulo);

                if(Descricao.length && ret.descricao)
                    Descricao.html(ret.descricao.replace(/\n/g, "<br />"));

                if(Importancia.length && ret.importancia)
                    Importancia.html(ret.importancia.replace(/\n/g, "<br />"));

                if(Redator.length && ret.redator)
                    Redator.html(ret.redator.nome+' '+ret.redator.sobrenome);

                if(LinkRedacao.length && ret.link_redacao)
                    LinkRedacao.attr('href', ret.link_redacao);

                if(DiretorArte.length && ret.da)
                    DiretorArte.html(ret.da.nome+' '+ret.da.sobrenome);

                if(LinkJPG.length && ret.link_jpg)
                    LinkJPG.attr('href', ret.link_jpg);

                if(LinkPSD.length && ret.link_layout)
                    LinkPSD.attr('href', ret.link_layout);

                if(Complexidade.length && ret.complexidade)
                    Complexidade.html(ret.complexidade.titulo);

                if(Prazo.length && ret.prazo)
                    Prazo.html(ret.prazo);

                if(AprovadoPorEm.length && ret.aprovado_conceito_por)
                    AprovadoPorEm.html(ret.aprovado_conceito_por.nome+' '+ret.aprovado_conceito_por.sobrenome+' - '+ret.aprovado_conceito_em);

                if(Frontend.length && ret.frontend)
                  Frontend.html(ret.frontend.nome+' '+ret.frontend.sobrenome);

                if(ProgramadorTecnico.length && ret.programadorTecnico)
                  ProgramadorTecnico.html(ret.programadorTecnico.nome+' '+ret.programadorTecnico.sobrenome);

                if(FrontendPrazo.length && ret.prazo_frontend)
                  FrontendPrazo.html(ret.prazo_frontend);

                if(FrontendAprovadoPorEm.length && ret.aprovado_frontend_por)
                    FrontendAprovadoPorEm.html(ret.aprovado_frontend_por.nome+' '+ret.aprovado_frontend_por.sobrenome+' - '+ret.aprovado_frontend_em);

                if(FrontendLink.length && ret.link_frontend)
                    FrontendLink.attr('href', ret.link_frontend);

                if(DataSubida.length && ret.data_subida)
                    DataSubida.html(ret.data_subida);

                if(DataSubidaPrevista.length && ret.data_subida_prevista)
                    DataSubidaPrevista.html(ret.data_subida_prevista);

                if(DataAnalisePrevista1.length && ret.data_analise1_prevista)
                    DataAnalisePrevista1.html(ret.data_analise1_prevista);

                if(DataAnalisePrevista2.length && ret.data_analise2_prevista)
                    DataAnalisePrevista2.html(ret.data_analise2_prevista);

                if(ProgramacaoTecnicaLink.length && ret.link_programacao_tecnica)
                    ProgramacaoTecnicaLink.attr('href', ret.link_programacao_tecnica);

                if(LinkAnalise1.length && ret.link_analise1)
                    LinkAnalise1.attr('href', ret.link_analise1);

                if(LinkAnalise2.length && ret.link_analise2)
                    LinkAnalise2.attr('href', ret.link_analise2);

                if(Resultado.length && ret.resultado)
                    Resultado.html(ret.resultado.titulo);*/



                /*
                 * Preenche os campos em caso de reprovação
                 */
                 /*if( $('#link_redacao').length )
                    $('#link_redacao').val(ret.link_redacao);

                 if( $('#link_layout').length )
                    $('#link_layout').val(ret.link_layout);

                 if( $('#link_jpg').length )
                    $('#link_jpg').val(ret.link_jpg);

                 if( $('#link_programacao_tecnica').length )
                    $('#link_programacao_tecnica').val(ret.link_programacao_tecnica);*/




                $.unblockUI();
                $('#ModalVerTask').modal();
                $('.datepicker').datepicker();


            });



        });

      }     

      /*
       * Voltar task
       */
      if( $('#VoltarTask').length ){

        $('#VoltarTask').on('click', function(){

            var id = $('#id_task').val();
            var to = $(this).data('to');

            swal({
              title: 'Você tem certeza?',
              text: 'A task retornara para o estágio anterior.',
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#DD6B55',
              confirmButtonText: 'Sim, tenho certeza.',
              closeOnConfirm: true,
            }, function (confirm) {
                
                if(confirm){

                    $('#ModalVerTask').modal('hide');
                    $.blockUI();

                    $.ajax({
                      headers:{'X-CSRF-TOKEN':token},
                      url:'/voltarTask',
                      data:{"id":id,"to":to},
                      method:'POST',
                      dataType:'json'
                    }).done(function(ret) {

                        if(ret.response){
                            location.reload();
                        }

                    });

                }

            });

        });

      }

      /*
       * ApagarTask
       */
       if( $('#ApagarTask').length ){

        $('#ApagarTask').on('click', function(){

            var id = $('#id_task').val();

            swal({
              title: 'Você tem certeza?',
              text: 'A task será removida de todas as listas.',
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#DD6B55',
              confirmButtonText: 'Sim, tenho certeza.',
              closeOnConfirm: true,
            }, function (confirm) {
                
                if(confirm){

                    $('#ModalVerTask').modal('hide');
                    $.blockUI();

                    $.ajax({
                      headers:{'X-CSRF-TOKEN':token},
                      url:'/apagarTask',
                      data:{"id":id},
                      method:'POST',
                      dataType:'json'
                    }).done(function(ret) {

                        if(ret.response){
                            location.reload();
                        }

                    });

                }

            });

        });

       }

      /*
       * Reprovar Redação
       */
      if( $('#ReprovarRedacao').length ){

        $('#ReprovarRedacao').on('click', function(){

          var ReprovarTxt = $('#ReprovarRedacaoTxt');
          var id          = $('#id_task').val();

          if( !ReprovarTxt.val() ){
            ReprovarTxt.parent().parent().addClass('has-error');
          } else {

            ReprovarTxt.parent().parent().removeClass('has-error');

            swal({
                title: 'Você tem certeza?',
                text: 'A task será movida para redação.',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Sim, tenho certeza.',
                closeOnConfirm: true,
              }, function (confirm) {
                  
                  if(confirm){

                      $('.modal').modal('hide');
                      $.blockUI();

                      $.ajax({
                        headers:{'X-CSRF-TOKEN':token},
                        url:'/reprovarTask',
                        data:{"id":id,"para":'redacao',"motivo":ReprovarTxt.val()},
                        method:'POST',
                        dataType:'json'
                      }).done(function(ret) {

                          if(ret.response){
                              window.location=ret.location;
                          }

                      });

                  }

              });

          }

          return false;

        });

      }

      /*
      * Reprovar Layout
      */
      if( $('#ReprovarLayout').length ){

        $('#ReprovarLayout').on('click', function(){

          var ReprovarTxt = $('#ReprovarLayoutTxt');
          var id          = $('#id_task').val();

          if( !ReprovarTxt.val() ){
            ReprovarTxt.parent().parent().addClass('has-error');
          } else {

            ReprovarTxt.parent().parent().removeClass('has-error');

            swal({
                title: 'Você tem certeza?',
                text: 'A task será movida para criação.',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Sim, tenho certeza.',
                closeOnConfirm: true,
              }, function (confirm) {
                  
                  if(confirm){

                      $('.modal').modal('hide');
                      $.blockUI();

                      $.ajax({
                        headers:{'X-CSRF-TOKEN':token},
                        url:'/reprovarTask',
                        data:{"id":id,"para":'layout',"motivo":ReprovarTxt.val()},
                        method:'POST',
                        dataType:'json'
                      }).done(function(ret) {

                          if(ret.response){
                              window.location=ret.location;
                          }

                      });

                  }

              });

          }

          return false;

        });

      }

      /*
      * Reprovar Frontend
      */
      if( $('#ReprovarFrontend').length ){

        $('#ReprovarFrontend').on('click', function(){

          var ReprovarTxt = $('#ReprovarFrontendTxt');
          var id          = $('#id_task').val();

          if( !ReprovarTxt.val() ){
            ReprovarTxt.parent().parent().addClass('has-error');
          } else {

            ReprovarTxt.parent().parent().removeClass('has-error');

            swal({
                title: 'Você tem certeza?',
                text: 'A task será movida para programação frontend.',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Sim, tenho certeza.',
                closeOnConfirm: true,
              }, function (confirm) {
                  
                  if(confirm){

                      $('.modal').modal('hide');
                      $.blockUI();

                      $.ajax({
                        headers:{'X-CSRF-TOKEN':token},
                        url:'/reprovarTask',
                        data:{"id":id,"para":'frontend',"motivo":ReprovarTxt.val()},
                        method:'POST',
                        dataType:'json'
                      }).done(function(ret) {

                          if(ret.response){
                              window.location=ret.location;
                          }

                      });

                  }

              });

          }

          return false;

        });

      }

    /*
      * Reprovar Programacao Tecnica
      */
      if( $('#ReprovarProgramacaoTecnica').length ){

        $('#ReprovarProgramacaoTecnica').on('click', function(){

          var ReprovarTxt = $('#ReprovarProgramacaoTecnicaTxt');
          var id          = $('#id_task').val();

          if( !ReprovarTxt.val() ){
            ReprovarTxt.parent().parent().addClass('has-error');
          } else {

            ReprovarTxt.parent().parent().removeClass('has-error');

            swal({
                title: 'Você tem certeza?',
                text: 'A task será movida para programação técnica.',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Sim, tenho certeza.',
                closeOnConfirm: true,
              }, function (confirm) {
                  
                  if(confirm){

                      $('.modal').modal('hide');
                      $.blockUI();

                      $.ajax({
                        headers:{'X-CSRF-TOKEN':token},
                        url:'/reprovarTask',
                        data:{"id":id,"para":'programacao_tecnica',"motivo":ReprovarTxt.val()},
                        method:'POST',
                        dataType:'json'
                      }).done(function(ret) {

                          if(ret.response){
                              window.location=ret.location;
                          }

                      });

                  }

              });

          }

          return false;

        });

      }

      /*
      * Reprovar Frontend
      */
      if( $('#ReprovarCriacao').length ){

        $('#ReprovarCriacao').on('click', function(){

          var ReprovarTxt = $('#ReprovarCriacaoTxt');
          var id          = $('#id_task').val();

          if( !ReprovarTxt.val() ){
            ReprovarTxt.parent().parent().addClass('has-error');
          } else {

            ReprovarTxt.parent().parent().removeClass('has-error');

            swal({
                title: 'Você tem certeza?',
                text: 'A task será movida para prioridade de criação.',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Sim, tenho certeza.',
                closeOnConfirm: true,
              }, function (confirm) {
                  
                  if(confirm){

                      $('.modal').modal('hide');
                      $.blockUI();

                      $.ajax({
                        headers:{'X-CSRF-TOKEN':token},
                        url:'/reprovarTask',
                        data:{"id":id,"para":'prioridade_criacao',"motivo":ReprovarTxt.val()},
                        method:'POST',
                        dataType:'json'
                      }).done(function(ret) {

                          if(ret.response){
                              window.location=ret.location;
                          }

                      });

                  }

              });

          }

          return false;

        });

      }

      /*
      * Reprovar Programacao
      */
      if( $('#ReprovarProgramacao').length ){

        $('#ReprovarProgramacao').on('click', function(){

          var ReprovarTxt = $('#ReprovarProgramacaoTxt');
          var id          = $('#id_task').val();

          if( !ReprovarTxt.val() ){
            ReprovarTxt.parent().parent().addClass('has-error');
          } else {

            ReprovarTxt.parent().parent().removeClass('has-error');

            swal({
                title: 'Você tem certeza?',
                text: 'A task será movida para prioridade de programação.',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Sim, tenho certeza.',
                closeOnConfirm: true,
              }, function (confirm) {
                  
                  if(confirm){

                      $('.modal').modal('hide');
                      $.blockUI();

                      $.ajax({
                        headers:{'X-CSRF-TOKEN':token},
                        url:'/reprovarTask',
                        data:{"id":id,"para":'prioridade_programacao',"motivo":ReprovarTxt.val()},
                        method:'POST',
                        dataType:'json'
                      }).done(function(ret) {

                          if(ret.response){
                              window.location=ret.location;
                          }

                      });

                  }

              });

          }

          return false;

        });

      }

    /*
     * Definição dos padrões de acordo com as seleções
     */
     if( $('#id_frontend').length ){

        var id_area_old = $('#id_area').val();

        $('#id_frontend').on('change', function(){

          if( $(this).val() == '0' || $(this).val() == '' ){
            $('#id_area').val(11);
          } else {
            $('#id_area').val(id_area_old);
          }

        });
     }

     var primeira_area_padrao = 7;

     if( $('#id_redator').length ){

        $('#id_redator').on('change', function(){

          if( $(this).val() == '0' || $(this).val() == '' ){
            $('#id_area').val(4);
          } else {
            $('#id_area').val(3);
          }

        });
     }

     if( $('#id_layout').length ){

        $('#id_layout').on('change', function(){

          if( $(this).val() == '0' || $(this).val() == '' ){
            $('#id_area').val(primeira_area_padrao);
          } else {
            if( $('#id_redator').val() == '0' || $('#id_redator') == '' ){
              $('#id_area').val(4);
            }
          }

        });
     }

     $(document).on('blur', '.SugestaoPrioridade', function(){

        var id  = $(this).data('id');
        var val = $(this).val(); 

        $.ajax({
              headers:{'X-CSRF-TOKEN':token},
              url:'sugestao-prioridade',
              data:{"id":id,'sugestao':val},
              method:'POST',
              dataType:'json'
            }).done(function(ret) {

              if(ret.response){
                notification('Sugestão de prioridade salva com sucesso!','success','bottomRight',3000,'icon-success');          
              } else {
                notification('Ocorreu um erro ao salvar a sugestão de prioridade.','error','bottomRight',3000,'icon-success');          
              }
        });

     });


    /*
     * Sucesso na criação da task
     */
     if( $_GET['sucesso'] )
     	notification('Task adicionada com sucesso.','success','bottomRight',5000,'icon-success');

     if( $_GET['mov'] )
      notification('Task movida com sucesso para fila '+$_GET['mov']+'.','information','bottomRight',5000,'icon-info');

     if( $_GET['reprov'] )
      notification('Task reprovada para fila '+$_GET['reprov']+'.','error','bottomRight',5000,'icon-close');


    /*
     * Editar Task com Modal Aberto
     */
    var editarStatus = 0;

    $(document).on('click','.EditarTaskAberta', function(){

        if( !editarStatus ){
          $('.TituloNatural').hide();
          $('.TituloEditavel').show();  
          $('.EditarTaskAberta').val('Salvar Edição');
          $('.EditarTaskAberta').removeClass('btn-primary');
          $('.EditarTaskAberta').addClass('btn-warning');
          editarStatus = 1;
        
        } else {

          $('.TituloNatural').show();
          $('.TituloEditavel').hide();  
          $('.EditarTaskAberta').val('Editar Task');
          $('.EditarTaskAberta').addClass('btn-primary');
          $('.EditarTaskAberta').removeClass('btn-warning');
          editarStatus = 0;

          var id   = $('#id_task').val();
          var data = {};

          $.each($('.FormEditavelTask'), function(key,val){
            var fieldName = $(this).attr('name');
            data[fieldName] = $(this).val();
          });

          $.ajax({
              headers:{'X-CSRF-TOKEN':token},
              url:'salvar-task-modal',
              data:{"id":id,'data':data},
              method:'POST',
              dataType:'json'
            }).done(function(ret) {

              $.each($('.FormEditavelTask'), function(key,val){
                var obj = $(this);
                var newValue = obj.val();
                obj.parent().parent().find('.TituloNatural').html(newValue);
              });
              
        });


        }
        

    });

});