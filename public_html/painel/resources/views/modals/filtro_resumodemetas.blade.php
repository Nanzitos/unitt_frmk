<div class="modal bs-modal-sm fade" id="ModalSearch" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Filtrar Custos Hard Input</h4>
			</div>
			<div class="modal-body">
				<p>Selecione os filtros que deseja aplicar a lista de custos.</p>
				<form class="form-horizontal FiltroForm" id="FormBuscaPedidos" role="form" style="margin-top:10px;" method="GET" action="{{ url('custosrm') }}">
					<input type="hidden" name="filtros" value="" /> <!-- Não remover, usado para executar os filtros -->
					<div class="form-group">
						<label class="col-sm-2 control-label">Marca</label>
						<div class="col-sm-10">
							<select name="id_marca" placeholder="Selecione uma marca" class="form-control" style="width:50%;">
								<option value="">Selecione uma marca</option>
								@foreach(App\Marcas::all() AS $Marca)
								<option value="{{ $Marca->id }}">{{ $Marca->nome }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Data</label>
						<div class="col-sm-10">
                			<input type="text" name="reservation" id="dp" class="form-control" placeholder="Selecione um dia" style="width:50%;" />
                		</div>
        			</div>
				</div>
				<div class="modal-footer no-border">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					<button type="submit" class="btn btn-primary">Filtrar</button>
				</div>
			</form>
		</div>
	</div>
</div>