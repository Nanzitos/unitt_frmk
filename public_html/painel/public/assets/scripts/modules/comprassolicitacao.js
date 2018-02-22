
$(document).ready(function(){
  var token = $('meta[name="csrf-token"]').attr('content');

  var testa = $("#id_fornecedor").val();
  if(testa != 0){
    var id = testa;
    var id_solicitacao = $("#id_solicitacao").val();
    $.blockUI();

    $.ajax({
        headers:{'X-CSRF-TOKEN':token},
        url:'/compras-produto-fornecedor',
        data:{"id":id, "id_solicitacao":id_solicitacao},
        method:'POST',
      }).done(function(ret) {
          $.unblockUI();
          $('#selecioneProd').hide();
          $('#divRetornoProd').show();
          if(ret == 'nao') $('#divRetornoProd').html('<h4> Nenhum produto com esse fornecedor');
          else $('#divRetornoProd').html(ret);
      });
  }

  $('input').keypress(function (e) {
        var code = null;
        code = (e.keyCode ? e.keyCode : e.which);
        return (code == 13) ? false : true;
   });

  $(".money").maskMoney();

       $(document).on('click', '.ActionButton', function(){

          var ct_field = 0;

          var obj           = $(this);
          var objId         = obj.attr('id');
          var action        = obj.attr('data-action');
          var example       = obj.parent().parent();
          var content       = obj.parent().parent().parent();
          var divContent   	= obj.parent().parent().next();
          var type          = obj.data('type');

          var valorTotal    = $("#valorTotal").val();
          $('.valorParcelas').val('');
          $('.ParcelasRow').remove();

          if( type == 'parcelas' ){

            if( action == 'add' ){

              if(valorTotal == 0 || valorTotal == ''){
                alert('Favor preencher o campo Valor total');
                return false;
              }

            	var totalCampos = $("#qtdParcelas").val();

            	if(totalCampos != '' && totalCampos != 0){
            //		ct_field = $('.ParcelasRow').length;
            		valorParcela = (parseFloat(valorTotal) / parseFloat(totalCampos)).toFixed(2);

            		if(totalCampos > ct_field){
	            		while(ct_field < totalCampos){
	            			html= '<div class="row ParcelasRow">';
					            html+= '<div class="col-sm-12">';
					              html+= '<div class="row" style="margin-bottom:10px;">';
					              	html+= '<div class="col-xs-2">';
					                  html+= '<input type="text" name="Parcelas['+ct_field+'][data]" class="form-control data" placeholder="Data">';
					                html+= '</div>';
					                html+= '<div class="col-xs-2">';
                            html+= "<span class='input-group-addon' style='width:15%; float:left; height: 34px; line-height: 20px; padding: 6px 6px !important;'>R$</span>";
					                  html+= '<input style="width:85%;" type="text" name="Parcelas['+ct_field+'][valor]" id="parcela-'+ct_field+'" class="form-control valorParcelas money" placeholder="Valor" value="'+valorParcela+'" onChange="atualizaValoresParcelas('+ct_field+')">';
					                html+= '</div>';
					              html+= '</div>';
					            html+= '</div>';
				            html+= '</div>';
			              content.append(html);
			              ct_field++;
	            		}
	            	}else{
	            		while(ct_field > totalCampos){
	            			divContent.remove();
	            			divContent   	= obj.parent().parent().next();
	            			ct_field--;

	            			$('.valorParcelas').each(function(){
	            				$(this).val(valorParcela);
	            			});
	            		}
	            	}
            	}

            	defineMasks();

            }

          }else if( type == 'entregas'){
          	if( action == 'add' ){

            	var totalCampos = obj.parent().parent().find('input').val();
              var idCampo = obj.parent().parent().find('input').attr('id').split('-')[1];
              var idProduto = obj.attr('data-idPedido');
              var ctParcela = objId.split('-')[1];
              var qtd       = $("#qtd-"+idProduto).val();

              if(qtd == 0 || qtd == ''){
                alert('Favor preencher o campo quantidade');
                return false;
              }

            	if(totalCampos != '' && totalCampos != 0){
            		ct_field = $('.EntregasRow-'+idProduto).length;

            		qtdTotal = (parseFloat(qtd) / parseFloat(totalCampos)).toFixed(0);

            		if(totalCampos > ct_field){
	            		while(ct_field < totalCampos){
	            			html= '<div class="row EntregasRow-'+idProduto+'">';
					            html+= '<div class="col-sm-12">';
					              html+= '<div class="row" style="margin-bottom:10px;">';
					              	html+= '<div class="col-xs-2">';
					                  html+= '<input type="text" name="Entregas['+ctParcela+']['+ct_field+'][data]" class="form-control data" placeholder="Data">';
					                html+= '</div>';

					                html+= '<div class="col-xs-2">';
					                  html+= '<input type="text" name="Entregas['+ctParcela+']['+ct_field+'][qtd]" id="entrega-'+ct_field+'" class="form-control qtdEntregas-'+idProduto+'" placeholder="Quantidade" value="'+qtdTotal+'" onChange="atualizaQtdEntregas('+ct_field+', '+idProduto+')">';
					                html+= '</div>';
					              html+= '</div>';
					            html+= '</div>';
				            html+= '</div>';
			              content.append(html);
			              ct_field++;
	            		}
	            	}else{
	            		while(ct_field > totalCampos){
	            			divContent.remove();
	            			divContent   	= obj.parent().parent().next();
	            			ct_field--;

	            			$('.qtdEntregas').each(function(){
	            				$(this).val(qtdTotal);
	            			});
	            		}
	            	}
            	}
              $('.qtdEntregas-'+idProduto).each(function(){
                $(this).val(qtdTotal);
              });
            	defineMasks();

            }
          }else if( type == 'email'){
            if(action == 'add'){
              ct_field = $('.EmailRow').length+1;

              html='<div class="row EmailRow">';
                html+='<div class="col-sm-12">';
                  html+='<div class="row" style="margin-bottom:10px;">';
                    html+='<div class="col-xs-4">';
                      html+='<input type="text" name="Email['+ct_field+'][email]" class="form-control" placeholder="Email">';
                    html+='</div>';
                    html+='<div class="col-xs-2">';
                      html+='<button type="button" data-action="add" class="btn btn-success btn-round btn-icon-icon mr5 ActionButton" data-type="email">';
                        html+='<i class="icon-plus"></i>';
                    html+='</button>';
                    html+='</div>';
                  html+='</div>';
                html+='</div>';
              html+='</div>';

              content.append(html);
              ct_field++;

              obj.removeClass('btn-success');
              obj.addClass('btn-danger');
              obj.find('i').removeClass('icon-plus');
              obj.find('i').addClass('icon-close');
              obj.attr('data-action','del');
              defineMasks();
            }else{
              if($('.EmailRow').length > 1){
                obj.parent().parent().remove();
              }
            }

          }
          return false;

        });
   // }

    $(".visualizarRegistro").click(function(){
        var id = $(this).attr('id');

        $.blockUI();

        $.ajax({
            headers:{'X-CSRF-TOKEN':token},
            url:'/compras-solicitacao-visualizar',
            data:{"id":id},
            method:'POST',
          }).done(function(ret) {
             $.unblockUI();
             $("#modalVisualizar").html(ret);
          });


      $('#ModalSearchVisualizar').modal();


    });

    if( $('#FormFiltros').length ){

      $('#FormFiltros').on('submit', function(){

        $('#ModalSearch').modal('hide');
        $.blockUI();
        return true;

      });
    }

    $(document).on('change', '.qtdProd', function(){

      var qtd = $(this).val();
      var cotacao = $(this).parent().next().find('input').val();

      var total = (parseFloat(qtd) * parseFloat(cotacao));

      $(this).parent().next().next().find('input').val(total.toFixed(2));
      atualizaValorTotal();


    });

    $(document).on('click', '.btnAprova', function(){
      var idBtn = $(this).attr('id');
      var nota = $("#motivo").val();
      var id = $("#idSolicitacao").val();
      var status;

      if(nota == ''){
        alert("Favor preencher a nota da aprovação");
        return false;
      }

      if(idBtn == 'aprovada'){
        var r = confirm("Aprovar Solicitação?");
        if(r == true){
            status = 2;
        }else return false;
      }else{
        var r = confirm("Reprovar Solicitação?");
        if(r == true){
          status = 3;
        }else return false;
      }

      $.ajax({
            headers:{'X-CSRF-TOKEN':token},
            url:'/compras-solicitacao-aprovar',
            data:{"id":id, "status": status, "nota": nota},
            method:'POST',
          }).done(function(ret) {
              $.unblockUI();
              alert("Solicitacao "+ idBtn +" com sucesso!");
              $('#ModalSearchVisualizar').modal('hide');
              location.reload();
          });

    });

    $('#id_fornecedor').change(function(){

        var id = $(this).val();

        $.blockUI();

        $.ajax({
            headers:{'X-CSRF-TOKEN':token},
            url:'/compras-produto-fornecedor',
            data:{"id":id},
            method:'POST',
          }).done(function(ret) {
              $.unblockUI();
              $('#selecioneProd').hide();
              $('#divRetornoProd').show();
              if(ret == 'nao') $('#divRetornoProd').html('<h4> Nenhum produto com esse fornecedor');
              else $('#divRetornoProd').html(ret);
          });
    });


    $(document).on('change', '.mesProdSolicitacao', function(){
      var obj = $(this);
      var mes = obj.val();
      var id  = obj.attr('id');
      var idProduto = id.split("-")[1];
      var ano = obj.parent().parent().find("input").val();

      $.ajax({
          headers:{'X-CSRF-TOKEN':token},
          url:'/compras-calcula-estimativa-compras',
          data:{"mes":mes, "ano":ano, "idProduto": idProduto},
          method:'POST',
        }).done(function(ret) {

            if(ret == "estimativa"){
              alert("Nao existe nenhuma estimativa cadastrada para esse produto");
              return false;
            }
            $("#estimativa_compras-"+idProduto).val(ret);
            $("#qtd-"+idProduto).val(ret);
            $(".qtdProd").trigger('change');
            atualizaValorTotal();
        });

    });

    $("#FormContent").submit(function(){
      var cont = 1;
      $('.form-control').each(function(){
          if(!$(this).is(':visible') && !$(this).hasClass("idProdSolicitacao")){
            $(this).remove('');
          }
          if($(this).val() == ''){
             cont++;
          }
          if(cont > 1){
            return false;
          }
      });
    });
});

function mostraCamposProduto(id, obj){

  if(obj.checked){
    $('#camposProduto-'+id).show();
    $('#prodAtivo-'+id).val('yes');
  }else{
    $('#camposProduto-'+id).hide();
    $('#prodAtivo-'+id).val('no');
  }

  atualizaValorTotal();

}

function atualizaValorTotal(){
  var valor = 0;
  $('.valorProd').each(function(){
      if($(this).val() != '' && $(this).is(':visible')){
        valor = parseFloat(valor) + parseFloat($(this).val());
      }
  });

  if(isNaN(valor)) { return false; }

  $('#valorTotal').val(valor.toFixed(2));

}

function atualizaValoresParcelas(ct){

    	var totalCampos = $("#qtdParcelas").val();
    	var valorTotal    = $("#valorTotal").val();
    	var count = 0;

      if(valorTotal == 0 || valorTotal == '' || valorTotal == 'undefined'){
        alert('Você ainda não preencheu o valor da solicitação');
        return false;
      }

    	valorParcela = (parseFloat(valorTotal) / (parseFloat(totalCampos) - 1));

    	$('.valorParcelas').each(function(){
    		ct_campo = this.id.split('-')[1];

    		if(count <= ct){
    			valorTotal = (parseFloat(valorTotal) - parseFloat($(this).val()));
    			totalCampos--;
    			valorParcela = (parseFloat(valorTotal) / (parseFloat(totalCampos)));
    			count++;
    		}else{
    			$(this).val(valorParcela.toFixed(2));
    		}

	    });
}

  function atualizaQtdEntregas(ct, idCampo){
  	var totalCampos = $("#qtdEntregas-"+idCampo).val();
  	var valorTotal    = $("#qtd-"+idCampo).val();

  	var count = 0;
    valorQtd = (parseFloat(valorTotal) / (parseFloat(totalCampos) - 1));

    $('.EntregasRow-'+idCampo+' :input').each(function(){
      if($(this).hasClass("qtdEntregas-"+idCampo)){
      	ct_campo = this.id.split('-')[1];

      	if(count <= ct){
      			valorTotal = (parseFloat(valorTotal) - parseFloat($(this).val()));
      			totalCampos--;
      			valorQtd = (parseFloat(valorTotal) / (parseFloat(totalCampos)));
      			count++;
    		}else{
    			$(this).val(valorQtd.toFixed(0));
    		}
      }
    });
}
