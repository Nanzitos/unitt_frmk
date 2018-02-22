$(document).ready(function(){

  $('.drp').daterangepicker({
   format: 'YYYY-MM-DD',
   startDate: '2017-03-01',
   endDate: '2017-04-01'
 });

  var token = $('meta[name="csrf-token"]').attr('content');

     $("#enviarXml").click(function(){
        $.blockUI();
        var html = "";
        var ct_field = 0;
        var block = "";
        $.ajax({
              headers:{'X-CSRF-TOKEN':token},
              url:'../compras-upload-xml',
              data: new FormData($("#xmlForm")[0]),
              async:false,
              type:'post',
              processData: false,
              contentType: false,
              success:function(data){
                $.unblockUI();
                ret = jQuery.parseJSON(data);
                if(ret.response){
                  $('#divInfosNota').fadeIn();
                  $('#infosProd').fadeIn();
                  $('#id_fornecedor').val(ret.fornecedor);
                  $('#nfe_numero').val(ret.nfe_numero[0]);
                  $('#data_emissao').val(ret.data_emissao[0]);
                  $('#tipo').val(ret.tipo_nf[0]);
                  $('#nome_xml_nota').val(ret.xml_nota);
                  $('#categoria_nota').val(ret.categoria_nota);
                  $('#nota_relacionada').val(ret.nota_relacionada);

                  if(ret.categoria_nota == 2) block = "checked='checked' onclick='return false;'";

                  $.each(ret.prod, function () {
                      html= '<div class="row">';
                        html+= '<div class="col-sm-12">';
                          html+= '<div class="row" style="margin-bottom:10px;">';
                            html+= '<div class="col-xs-4">';
                              html+= '<label> Nome Produto </label>';
                              html+= '<input type="text" name="Produto['+ct_field+'][nome_produto]" class="form-control" value="'+this.nomeProduto[0]+'">';
                            html+= '</div>';
                            html+= '<div class="col-xs-2">';
                              html+= '<label> Quantidade </label>';
                              html+= '<input type="text" name="Produto['+ct_field+'][qtd]" class="form-control" value="'+this.qtd[0]+'">';
                            html+= '</div>';
                            html+= '<div class="col-xs-2">';
                              html+= '<label> Valor </label>';
                              html+= '<input type="text" name="Produto['+ct_field+'][valor]" class="form-control" value="'+this.valor[0]+'">';
                            html+= '</div>';
                            html+= '<div class="col-xs-2">';
                              html+= '<label> Movimentar Estoque </label>';
                              html+= '<input type="checkbox" '+ block +' name="Produto['+ct_field+'][estoque]" class="form-control">';
                            html+= '</div>';
                          html+= '</div>';
                        html+= '</div>';
                        html+= '<input type="hidden" name="Produto['+ct_field+'][id_produto]" id="codProdFornecedor['+ct_field+']" value="'+this.idProd+'" />';
                      html+= '</div>';
                      $("#infosProd").append(html);
                      ct_field++;
                  });
                }
              },
            });
      });

      $("#tipoNota").on('change', function(){

        var obj = $(this);
        var label;

        if(obj.val() == '' || obj.val() == 'undefined'){
          $('#infosHide').hide();
          return false;
        }

        if(obj.val() == 1) label = "Pedido de compra referente a essa nota";
        else label = "Nota de venda referente a essa nota";

        $.ajax({
                headers:{'X-CSRF-TOKEN':token},
                url:'/get-nota-relacionada',
                data:{"tipo":obj.val()},
                method:'POST',
              }).done(function(ret) {
                  $("#notaRelacionada").html(ret);
                  $("#labelNotaRelacionada").html(label);
                  $('#infosHide').fadeIn();

                  if($("#nota_relacionada").val() !== undefined){
                     $("#notaRelacionada").val($("#nota_relacionada").val()).trigger('change');
                     //$("#notaRelacionada").select2();
                  }
                  $(".select2").css("width", "auto");
              });
      });

      $("#tipoNota").trigger("change");

      $("#gerar-relatorio").click(function(){
        var urlParams = location.search ? location.search.substring(1).split("&")+"&gerar=relatorio" : "gerar=relatorio";
        if(urlParams != 'gerar=relatorio') urlParams = urlParams.replace(/,/g,"&");
        window.location.href = "compras-nfes?"+urlParams;
        return false;
      });
});
