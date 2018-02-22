<div class="modal bs-modal-sm fade" id="ModalSearch" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Filtrar Tasks Dashboard</h4>
        </div>
        <div class="modal-body">
          <p>Selecione os filtros que deseja aplicar ao dashboard.</p>
          <form class="form-horizontal FiltroForm" id="FormBuscaURLs" role="form" style="margin-top:20px;" method="GET" action="{{ url('tasks-dashboard') }}">
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
              <label class="col-sm-2 control-label">Responsável</label>
              <div class="col-sm-10">
                <select name="id_usuario" placeholder="Selecione uma marca" id="FiltroUsuario" class="form-control">
                <option value="">Selecione um responsável</option>
                @foreach(App\Usuarios::all() AS $Usuario)
                <option value="{{ $Usuario->id }}">{{ $Usuario->nome.' '.$Usuario->sobrenome }}</option>
                @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Categoria</label>
              <div class="col-sm-10">
                <select name="id_categoria" placeholder="Selecione uma marca" id="FiltroTaskCategoria" class="form-control">
                <option value="">Selecione uma categoria</option>
                @foreach(App\TasksCategorias::all() AS $TaskCategoria)
                <option value="{{ $TaskCategoria->id }}">{{ $TaskCategoria->titulo }}</option>
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