<div class="modal bs-modal-sm fade" id="ModalSearch" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Filtrar Tasks</h4>
        </div>
        <div class="modal-body">
          <p>Selecione os filtros que deseja aplicar a lista de tasks.</p>
          <form class="form-horizontal FiltroForm" id="FormBuscaTasks" role="form" style="margin-top:20px;" method="GET" action="{{ url('minhas-tasks') }}">
            <input type="hidden" name="filtros" value="" /> <!-- Não remover, usado para executar os filtros -->

            <div class="form-group">
              <label class="col-sm-2 control-label">Redator</label>
              <div class="col-sm-10">
                <select name="id_redator" placeholder="Selecione um redator" class="form-control">
                <option value="">Selecione um redator</option>
                @foreach(App\Usuarios::where('id_grupo',7)->get() AS $Usuario)
                <option value="{{ $Usuario->id }}">{{ $Usuario->nome }}</option>
                @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Diretor de arte</label>
              <div class="col-sm-10">
                <select name="id_layout" placeholder="Selecione um DA" class="form-control">
                <option value="">Selecione um DA</option>
                @foreach(App\Usuarios::where('id_grupo',8)->get() AS $Usuario)
                <option value="{{ $Usuario->id }}">{{ $Usuario->nome }}</option>
                @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Frontend</label>
              <div class="col-sm-10">
                <select name="id_frontend" placeholder="Selecione um frontend" class="form-control">
                <option value="">Selecione um frontend</option>
                @foreach(App\Usuarios::where('id_grupo',5)->get() AS $Usuario)
                <option value="{{ $Usuario->id }}">{{ $Usuario->nome }}</option>
                @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Tecnico</label>
              <div class="col-sm-10">
                <select name="id_programador_tecnico" placeholder="Selecione um técnico" class="form-control">
                <option value="">Selecione um programador técnico</option>
                @foreach(App\Usuarios::where('id_grupo',6)->get() AS $Usuario)
                <option value="{{ $Usuario->id }}">{{ $Usuario->nome }}</option>
                @endforeach
                </select>
              </div>
            </div>

            <input type="hidden" name="area" value="{{ $TaskArea->id }}" />

        </div>
        <div class="modal-footer no-border">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-primary">Filtrar</button>
        </div>
        </form>
      </div>
    </div>
  </div>