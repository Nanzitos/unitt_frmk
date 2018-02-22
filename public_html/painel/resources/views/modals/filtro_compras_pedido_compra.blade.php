<div class="modal bs-modal-sm fade" id="ModalSearch" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Filtrar Pedido de Compra</h4>
        </div>
        <div class="modal-body">
          <p>Selecione os filtros que deseja aplicar a lista de nfes.</p>
          <form class="form-horizontal FiltroForm" id="FormFiltros" role="form" style="margin-top:20px;" method="GET" action="{{ url('compras-pedido-compra') }}">
            <input type="hidden" name="filtros" value="" /> <!-- Não remover, usado para executar os filtros -->
            <div class="form-group">
              <label class="col-sm-2 control-label">Fornecedor</label>
              <div class="col-sm-10">
                <select name="id_fornecedor" placeholder="Selecione uma marca" id="FiltroFornecedor" class="form-control">
                <option value="">Selecione um fornecedor</option>
                @foreach(App\ComprasFornecedores::all() AS $Marca)
                <option value="{{ $Marca->id }}">{{ $Marca->nome_fantasia }}</option>
                @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Produto</label>
              <div class="col-sm-10">
                <select name="id_produto" placeholder="Selecione um produto" id="FiltroProduto" class="form-control">
                <option value="">Selecione um produto</option>
                @foreach(App\ComprasProdutos::all() AS $Marca)
                <option value="{{ $Marca->id }}">{{ $Marca->nome }}</option>
                @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Status</label>
              <div class="col-sm-10">
                <select name="categoria_nota" class="form-control">
                <option value="1">Em andamento</option>
                <option value="2">Finalizado</option>
                <option value="3">Cancelado</option>
                </select>
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
