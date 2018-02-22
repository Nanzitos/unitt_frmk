<div class="modal bs-modal-sm fade" id="ModalSearch" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Filtrar Campanhas</h4>
        </div>
        <div class="modal-body">
          <p>Selecione os filtros que deseja aplicar a lista de campanhas.</p>
          <form class="form-horizontal FiltroForm" id="FormBuscaCampanhas" role="form" style="margin-top:20px;" method="GET" action="{{ url('campanhas-parceiros') }}">
            <input type="hidden" name="filtros" value="" /> <!-- Não remover, usado para executar os filtros -->
            
            <div class="form-group">
              <label class="col-sm-2 control-label">Parceiro</label>
              <div class="col-sm-10">
                <select name="id_parceiro" placeholder="Selecione um parceiro" class="form-control">
                <option value="">Selecione um parceiro</option>
                @foreach(App\Parceiros::all() AS $Parceiro)
                <option value="{{ $Parceiro->id }}">{{ $Parceiro->nome }}</option>
                @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Marca</label>
              <div class="col-sm-10">
                <select name="id_marca" placeholder="Selecione uma marca" class="form-control">
                <option value="">Selecione um parceiro</option>
                @foreach(App\Marcas::all() AS $Marca)
                <option value="{{ $Marca->id }}">{{ $Marca->nome }}</option>
                @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Interesse</label>
              <div class="col-sm-10">
                <select name="id_interesse" placeholder="Selecione uma interesse" class="form-control">
                <option value="">Selecione um interesse</option>
                @foreach(App\Interesses::all() AS $Interesse)
                <option value="{{ $Interesse->id }}">{{ $Interesse->titulo }}</option>
                @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Jumps</label>
              <div class="col-sm-10">
                <select name="id_jump" placeholder="Selecione uma jump" class="form-control">
                <option value="">Selecione uma jump</option>
                <option value="nenhuma">Nenhuma jump relacionada</option>
                @foreach(App\JumpPages::all() AS $JumpPage)
                <option value="{{ $JumpPage->id }}">{{ $JumpPage->nome }}</option>
                @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Status</label>
              <div class="col-sm-10">
                <select name="ativo" placeholder="Selecione" class="form-control">
                <option value="">Selecione</option>
                <option value="1">Ativo</option>
                <option value="0">Inativo</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Ligada</label>
              <div class="col-sm-10">
                <select name="ligada" placeholder="Selecione" class="form-control">
                <option value="">Selecione</option>
                <option value="1">Ligada</option>
                <option value="0">Desligada</option>
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