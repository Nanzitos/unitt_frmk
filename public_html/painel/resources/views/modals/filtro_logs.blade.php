<div class="modal bs-modal-sm fade" id="ModalSearch" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Filtrar Logs</h4>
        </div>
        <div class="modal-body">
          <p>Selecione os filtros que deseja aplicar a lista de logs.</p>
          <form class="form-horizontal FiltroForm" id="FormFiltros" role="form" style="margin-top:20px;" method="GET" action="{{ url('logs') }}">
            <input type="hidden" name="filtros" value="" /> <!-- Não remover, usado para executar os filtros -->
            <div class="form-group">
              <label class="col-sm-2 control-label">Area</label>
              <div class="col-sm-10">
                <select name="id_area" placeholder="Selecione uma area" id="FiltroAreas" class="form-control">
                <option value="">Selecione uma area</option>
                @foreach(App\Areas::all() AS $Area)
                <option value="{{ $Area->id }}">{{ $Area->titulo }}</option>
                @endforeach
                </select>
              </div>
            </div>            
            <div class="form-group">
              <label class="col-sm-2 control-label">Tipo Operacao</label>
              <div class="col-sm-10">
                <select name="id_tipo_log" placeholder="Tipo operacao" class="form-control">
                <option value="">Selecione uma tipo</option>
                @foreach(App\TipoLog::all() AS $Tipo)
                <option value="{{ $Tipo->id }}">{{ $Tipo->tipo_log }}</option>
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