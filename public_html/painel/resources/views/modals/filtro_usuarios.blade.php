<div class="modal bs-modal-sm fade" id="ModalSearch" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Filtrar Usuarios</h4>
        </div>
        <div class="modal-body">
          <p>Selecione os filtros que deseja aplicar a lista de produtos que estão no estoque.</p>
          <form class="form-horizontal FiltroForm" id="FormFiltros" role="form" style="margin-top:20px;" method="GET" action="{{ url('usuarios') }}">
            <input type="hidden" name="filtros" value="" /> <!-- Não remover, usado para executar os filtros -->
            <div class="form-group">
              <label class="col-sm-2 control-label">Nome</label>
              <div class="col-sm-10">
                <input type="text" name="nome" class="form-control filtros_fields" placeholder="Digite o nome" value="">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Grupo</label>
              <div class="col-sm-10">
                <select name="id_grupo" placeholder="Grupo" class="form-control">
                  <option value="">Selecione</option>
                  @foreach(App\GruposUsuarios::all() AS $grupo)
                  <option value="{{ $grupo->id }}">{{ $grupo->nome }}</option>
                 @endforeach

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
