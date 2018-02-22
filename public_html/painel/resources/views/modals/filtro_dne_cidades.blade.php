<div class="modal bs-modal-sm fade" id="ModalSearch" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Filtrar Cidades</h4>
        </div>
        <div class="modal-body">
          <p>Selecione os filtros que deseja aplicar a lista de cidades.</p>
          <form class="form-horizontal FiltroForm" id="FormBuscaCidades" role="form" style="margin-top:20px;" method="GET" action="{{ url('dne-cidades') }}">
            <input type="hidden" name="filtros" value="" /> <!-- Não remover, usado para executar os filtros -->
            <div class="form-group">
              <label class="col-sm-2 control-label">Marca</label>
              <div class="col-sm-10">
                <select name="UFE_SG" placeholder="Selecione um estado" class="form-control">
                <option value="">Selecione um estado</option>
                @foreach(App\DneEstados::all() AS $Estado)
                <option value="{{ $Estado->UFE_SG }}">{{ $Estado->UFE_SG }}</option>
                @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Nome</label>
              <div class="col-sm-10">
                <input type="text" name="nome" class="form-control filtros_fields" placeholder="Nome da cidade" value="<?php echo isset($_GET['nome'])?$_GET['nome']:'';?>">
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