<div class="modal bs-modal-sm fade" id="popup-rm-bate" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" style="padding: 0;border: 0;">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="margin: 5px 5px 0;font-size: 40px;">×</span></button>
			</div>
			<div class="modal-body">
	            <div class="table-responsive">
	              	<table class="table table-striped table-bordered table-hover table-condensed responsive m-b-0" data-sortable>
	                	<thead>
	                  		<tr>
	                    		<th><b>Meio de pagamento</b></th>
	                    		<th><b>Banco de Dados Mysql</b></th>
	                    		<th><b>Resumo de Metas</b></th>
	                    		<th><b>Diferça RM</b></th>
	                  		</tr>
	                	</thead>
	                	<tbody>
	                		<tr>
	                    		<td><b>Cartão de Crédito</b></td>
	                    		<td id="cc_mysql"></td>
	                    		<td id="cc_rm"></td>
	                    		<td id="cc_dif"></td>
	                  		</tr>
	                  		<tr>
	                    		<td><b>Boleto Bancário</b></td>
	                    		<td id="boleto_mysql"></td>
	                    		<td id="boleto_rm"></td>
	                    		<td id="boleto_dif"></td>
	                  		</tr>
	                  		<tr>
	                    		<td><b>Triagem</b></td>
	                    		<td id="triagem_mysql"></td>
	                    		<td id="triagem_rm"></td>
	                    		<td id="triagem_dif">0.00%</td>
	                  		</tr>
	                  		<tr style="border-top: solid;">
	                    		<td><b>Total (sem triagem)</b></td>
	                    		<td id="total_mysql"></td>
	                    		<td id="total_rm"></td>
	                    		<td id="total_dif"></td>
	                  		</tr>
	                	</tbody>
	              	</table>
	              	<div style="text-align: right; margin-top: 15px;">
	              		<button type="button" id="bateResumoMetasEnviaEmail" class="btn btn-primary">Enviar email</button>
	              	</div>
				</div>
			</div>
		</div>
	</div>
</