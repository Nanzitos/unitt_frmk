$(document).ready(function(){

	var token = $('meta[name="csrf-token"]').attr('content');

	$('#ToggleMenu').trigger('click'); //Fecha o menu para obter mais espaço na tela

	/*
	* Inicializa o range
	*/

	//Seta para português
	moment.lang('pt-br');

	$('.drp').daterangepicker({
	    format: 'YYYY-MM-DD',
	    opens: 'left',
	    'locale':{
	    	applyLabel: 'Aplicar',
            cancelLabel: 'Cancelar',
            fromLabel: 'De',
            toLabel: 'Até'
	    }

	}, 
	function(start, end, label) {

	});

    $('#Periodo').on('click', function(){

        $.blockUI();

        var de  = document.getElementsByName('daterangepicker_start')[0].value;
        var ate = document.getElementsByName('daterangepicker_end')[0].value;
        var id_marca = $('#id_marca').val();
     
        $('#ModalSearch').modal('toggle'); 

        $.ajax({
          headers:{'X-CSRF-TOKEN':token},
          url:'/novoconversaodeboletos',
          data:{"de":de,"ate":ate,"id_marca":id_marca},
          method:'POST',
          dataType:'json'
        }).done(function(ret) {

            if(ret.response){

                console.log('mah rodooou');
                var data = ret.data;
                var html = '';

                html+='<table class="table table-striped table-bordered table-hover table-condensed responsive m-b-0" style="text-align:center;">';
                html+='<tbody>'; 
                    html+='<tr>';
                    html+='<th colspan="8">Resumo</th>';
                    html+='</tr>';                               
                    html+='<tr>';
                        html+='<th colspan="8">Conversão de Boletos com Televendas</th>';
                    html+='</tr>';
                    html+='<tr>';
                        html+='<th style="text-align:center;">Mídias</th>';
                        html+='<th style="text-align:center;">Aprovados</th>';
                        html+='<th style="text-align:center;">Gerados</th>';
                        html+='<th style="text-align:center;">Conversão</th>';
                        html+='<th style="text-align:center;">Receita</th>';
                        html+='<th style="text-align:center;">Conversão Receita</th>';
                        html+='<th style="text-align:center;">Ticket Médio</th>';
                        html+='<th style="text-align:center;">Share</th>';

                    html+='</tr>';
                    
                $.each(data['Resumo']['ComTelevendas'], function(key,val){
                
                    html+='<tr>';
                        html+='<td>'+key+'</td>';
                        html+='<td>'+val['Aprovados']+'</td>';
                        html+='<td>'+val['Gerados']+'</td>';
                        html+='<td>'+val['Conversao']+' %</td>';
                        html+='<td>R$ '+val['Receita']+'</td>';
                        html+='<td>'+val['ConversaoRev']+' %</td>';
                        html+='<td>R$ '+val['TicketMedio']+'</td>';
                        html+='<td>'+val['Share']+' %</td>';                         
                    html+='</tr>';
                    
                });

                    html+='<tr>'; 
                        html+='<td colspan="8">   </td>';       
                    html+='</tr>';
                    html+='<tr>';
                        html+='<th colspan="8">Conversão de Boletos sem Televendas</th>';
                    html+='</tr>';
                    html+='<tr>';
                        html+='<th style="text-align:center;">Mídias</th>';
                        html+='<th style="text-align:center;">Aprovados</th>';
                        html+='<th style="text-align:center;">Gerados</th>';
                        html+='<th style="text-align:center;">Conversão</th>';
                        html+='<th style="text-align:center;">Receita</th>';
                        html+='<th style="text-align:center;">Conversão Receita</th>';
                        html+='<th style="text-align:center;">Ticket Médio</th>';
                        html+='<th style="text-align:center;">Share</th>';
                    html+='</tr>';
                    
                $.each(data['Resumo']['SemTelevendas'], function(key,val){
                
                    html+='<tr>';
                        html+='<td>'+key+'</td>';
                        html+='<td>'+val['Aprovados']+'</td>';
                        html+='<td>'+val['Gerados']+'</td>';
                        html+='<td>'+val['Conversao']+' %</td>';
                        html+='<td>R$ '+val['Receita']+'</td>';
                        html+='<td>'+val['ConversaoRev']+' %</td>';
                        html+='<td>R$ '+val['TicketMedio']+'</td>';
                        html+='<td>'+val['Share']+' %</td>';                     
                    html+='</tr>';
                    
                });
                
                html+='</tbody>';
                html+='</table>';
                html+='<br>';

                $.each(data['Relatorio'], function(key,val){

                    html+='<table class="table table-striped table-bordered table-hover table-condensed responsive m-b-0" style="text-align:center;">';
                    
                        html+='<tbody>'; 
                            html+='<tr>';
                            html+='<th colspan="6">Source: '+key+'</th>';
                            html+='</tr>';                               
                            html+='<tr>';
                                html+='<th colspan="6">Conversão de Boletos sem Duplicados</th>';
                            html+='</tr>';
                            html+='<tr>';
                                html+='<th style="text-align:center;">Boletos</th>';
                                html+='<th style="text-align:center;">Quantidade</th>';
                                html+='<th style="text-align:center;">Conversão</th>';
                                html+='<th style="text-align:center;">Receita</th>';
                                html+='<th style="text-align:center;">Conversão Receita</th>';
                                html+='<th style="text-align:center;">Ticket Médio</th>';
                            html+='</tr>';
                            html+='<tr>';
                                html+='<td>Aprovados</td>';
                                html+='<td>'+val['SemDuplicados']['Pagos']['Pedidos']+'</td>';
                                html+='<td>'+val['SemDuplicados']['Pagos']['Conversao']+' %</td>';
                                html+='<td>R$ '+val['SemDuplicados']['Pagos']['Receita']+'</td>';
                                html+='<td>'+val['SemDuplicados']['Pagos']['ConversaoRev']+' %</td>';
                                html+='<td>R$ '+val['SemDuplicados']['Pagos']['TicketMedio']+'</td>';
                            html+='</tr>';
                            html+='<tr>';
                                html+='<td>Aguardando pagamento</td>';
                                html+='<td>'+val['SemDuplicados']['Pendentes']['Pedidos']+'</td>';
                                html+='<td>'+val['SemDuplicados']['Pendentes']['Conversao']+' %</td>';
                                html+='<td>R$ '+val['SemDuplicados']['Pendentes']['Receita']+'</td>';
                                html+='<td>'+val['SemDuplicados']['Pendentes']['ConversaoRev']+' %</td>';
                                html+='<td>R$ '+val['SemDuplicados']['Pendentes']['TicketMedio']+'</td>';
                            html+='</tr>';
                            html+='<tr>';
                                html+='<td>Cancelados</td>';
                                html+='<td>'+val['SemDuplicados']['Cancelados']['Pedidos']+'</td>';
                                html+='<td>'+val['SemDuplicados']['Cancelados']['Conversao']+' %</td>';
                                html+='<td>R$ '+val['SemDuplicados']['Cancelados']['Receita']+'</td>';
                                html+='<td>'+val['SemDuplicados']['Cancelados']['ConversaoRev']+' %</td>';
                                html+='<td>R$ '+val['SemDuplicados']['Cancelados']['TicketMedio']+'</td>';
                            html+='</tr>';
                            html+='<tr>';
                                html+='<td>Total</td>';
                                html+='<td>'+val['SemDuplicados']['Total']['Pedidos']+'</td>';
                                html+='<td>'+val['SemDuplicados']['Total']['Conversao']+'</td>';
                                html+='<td>R$ '+val['SemDuplicados']['Total']['Receita']+'</td>';
                                html+='<td>'+val['SemDuplicados']['Total']['ConversaoRev']+'</td>';
                                html+='<td>R$ '+val['SemDuplicados']['Total']['TicketMedio']+'</td>';
                            html+='</tr>';                        
                            html+='<tr>'; 
                                html+='<td colspan="6">   </td>';       
                            html+='</tr>';
                        html+='</tbody>';
                        html+='<tbody>';                                
                            html+='<tr>';
                                html+='<th colspan="6">Conversão de Boletos com Duplicados</th>';
                            html+='</tr>';
                            html+='<tr>';
                                html+='<th style="text-align:center;">Boletos</th>';
                                html+='<th style="text-align:center;">Quantidade</th>';
                                html+='<th style="text-align:center;">Conversão</th>';
                                html+='<th style="text-align:center;">Receita</th>';
                                html+='<th style="text-align:center;">Conversão Receita</th>';
                                html+='<th style="text-align:center;">Ticket Médio</th>';
                            html+='</tr>';
                            html+='<tr>';
                                html+='<td>Aprovados</td>';
                                html+='<td>'+val['ComDuplicados']['Pagos']['Pedidos']+'</td>';
                                html+='<td>'+val['ComDuplicados']['Pagos']['Conversao']+' %</td>';
                                html+='<td>R$ '+val['ComDuplicados']['Pagos']['Receita']+'</td>';
                                html+='<td>'+val['ComDuplicados']['Pagos']['ConversaoRev']+' %</td>';
                                html+='<td>R$ '+val['ComDuplicados']['Pagos']['TicketMedio']+'</td>';
                            html+='</tr>';
                            html+='<tr>';
                                html+='<td>Aguardando pagamento</td>';
                                html+='<td>'+val['ComDuplicados']['Pendentes']['Pedidos']+'</td>';
                                html+='<td>'+val['ComDuplicados']['Pendentes']['Conversao']+' %</td>';
                                html+='<td>R$ '+val['ComDuplicados']['Pendentes']['Receita']+'</td>';
                                html+='<td>'+val['ComDuplicados']['Pendentes']['ConversaoRev']+' %</td>';
                                html+='<td>R$ '+val['ComDuplicados']['Pendentes']['TicketMedio']+'</td>';
                            html+='</tr>';
                            html+='<tr>';
                                html+='<td>Cancelados</td>';
                                html+='<td>'+val['ComDuplicados']['Cancelados']['Pedidos']+'</td>';
                                html+='<td>'+val['ComDuplicados']['Cancelados']['Conversao']+' %</td>';
                                html+='<td>R$ '+val['ComDuplicados']['Cancelados']['Receita']+'</td>';
                                html+='<td>'+val['ComDuplicados']['Cancelados']['ConversaoRev']+' %</td>';
                                html+='<td>R$ '+val['ComDuplicados']['Cancelados']['TicketMedio']+'</td>';
                            html+='</tr>';
                            html+='<tr>';
                                html+='<td>Total</td>';
                                html+='<td>'+val['ComDuplicados']['Total']['Pedidos']+'</td>';
                                html+='<td>'+val['ComDuplicados']['Total']['Conversao']+'</td>';
                                html+='<td>R$ '+val['ComDuplicados']['Total']['Receita']+'</td>';
                                html+='<td>'+val['ComDuplicados']['Total']['ConversaoRev']+'</td>';
                                html+='<td>R$ '+val['ComDuplicados']['Total']['TicketMedio']+'</td>';
                            html+='</tr>';                        
                        html+='</tbody>';
                    html+='</table>';
                    html+='<br>';

                  $('#RangeCustomizado').html(html);

                });
            } else {
                notification('Não há pedidos no banco para a marca e período selecionados.','error','bottomRight',5000,'icon-error');
            }

            $.unblockUI();
            

        });

       

    });
});