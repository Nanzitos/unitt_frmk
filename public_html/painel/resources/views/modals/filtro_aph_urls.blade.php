<div class="modal bs-modal-sm fade" id="ModalSearch" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Filtrar URLs</h4>
        </div>
        <div class="modal-body">
          <p>Selecione os filtros que deseja aplicar a lista de urls.</p>
          <form class="form-horizontal FiltroForm" id="FormBuscaURLs" role="form" style="margin-top:20px;" method="GET" action="{{ url('aphrodite-urls') }}">
            <input type="hidden" name="filtros" value="" /> <!-- Não remover, usado para executar os filtros -->
            <div class="form-group">
              <label class="col-sm-2 control-label">Marca</label>
              <div class="col-sm-10">
                <select name="id_marca" placeholder="Selecione uma marca" id="FiltroMarcas" class="form-control">
                <option value="">Selecione uma marca</option>
                @foreach(App\Marcas::all() AS $Marca)
                <option value="{{ $Marca->id }}">{{ $Marca->nome }}</option>
                @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Tema</label>
              <div class="col-sm-10">
                <select name="id_tema" placeholder="Selecione um tema" id="FiltroTemas" class="form-control">
                <option value="">Selecione uma marca primeiro</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Dispositivo</label>
              <div class="col-sm-10">
                <select name="id_dispositivo" placeholder="Selecione um dispositivo" class="form-control">
                <option value="">Selecione um dispositivo</option>
                @foreach(App\AphroditeDispositivos::all() AS $Dispositivo)
                <option value="{{ $Dispositivo->id }}">{{ $Dispositivo->nome }}</option>
                @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">URL</label>
              <div class="col-sm-10">
                <input type="text" name="url" class="form-control filtros_fields" placeholder="Digite a URL" value="">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">URL Destino</label>
              <div class="col-sm-10">
                <input type="text" name="url_destino" class="form-control filtros_fields" placeholder="Digite a URL" value="">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Status</label>
              <div class="col-sm-10">
                <select name="status" placeholder="Selecione um status" class="form-control">
                <option value="1">Ativo</option>
                <option value="0">Inativo</option>
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