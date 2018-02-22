<div class="modal bs-modal-sm fade" id="ModalSearch" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Filtrar Banners</h4>
        </div>
        <div class="modal-body">
          <p>Configure todos os filtros abaixo:</p>
          <form class="form-horizontal FiltroForm" id="FormBuscaPedidos" role="form" style="margin-top:20px;" method="GET" action="{{ url('fila-upload') }}">
            <input type="hidden" name="filtros" value="" /> <!-- Não remover, usado para executar os filtros -->
            <div class="form-group">
              <label class="col-sm-2 control-label">Marca</label>
              <div class="col-sm-10">
                <select name="id_marca" placeholder="Selecione uma marca" class="form-control">
                <option value='0' <?php echo (isset($_GET['id_marca']) && $_GET['id_marca'] && $_GET['id_marca'] == '0')?'selected="selected"':'';?>>Todas as marcas</option>
                @foreach(App\Marcas::all() AS $Marca)
                <option value="{{ $Marca->id }}" <?php echo (isset($_GET['id_marca']) && $_GET['id_marca'] && $_GET['id_marca'] == $Marca->id)?'selected="selected"':'';?>>{{ $Marca->nome }}</option>
                @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Parceiro</label>
              <div class="col-sm-10">
                <select name="id_parceiro" placeholder="Selecione um parceiro" class="form-control">
                <option value='0' <?php echo (isset($_GET['id_parceiro']) && $_GET['id_parceiro'] && $_GET['id_parceiro'] == '0')?'selected="selected"':'';?>>Todos os parceiros</option>
                @foreach(App\Parceiros::all() AS $Parceiro)
                <option value="{{ $Parceiro->id }}" <?php echo (isset($_GET['id_parceiro']) && $_GET['id_parceiro'] && $_GET['id_parceiro'] == $Parceiro->id)?'selected="selected"':'';?>>{{ $Parceiro->nome }}</option>
                @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Jump</label>
              <div class="col-sm-10">
                <select name="id_jump" placeholder="Selecione uma jump" class="form-control">
                <option value='0' <?php echo (isset($_GET['id_jump']) && $_GET['id_jump'] && $_GET['id_jump'] == '0')?'selected="selected"':'';?>>Todas as jumps</option>
                @foreach(App\JumpPages::all() AS $Jump)
                <option value="{{ $Jump->id }}" <?php echo (isset($_GET['id_jump']) && $_GET['id_jump'] && $_GET['id_jump'] == $Jump->id)?'selected="selected"':'';?>>{{ $Jump->nome }}</option>
                @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Status na Fila</label>
              <div class="col-sm-10">
                <select name="id_status" placeholder="Selecione um status..." class="form-control">
                <option value='0' <?php echo (isset($_GET['id_status']) && $_GET['id_status'] && $_GET['id_status'] == '0')?'selected="selected"':'';?>>Todos os Status</option>
                @foreach(App\FilaUploadBannersStatus::all() AS $status)
                <option value="{{ $status->id }}" <?php echo (isset($_GET['id_status']) && $_GET['id_status'] && $_GET['id_status'] == $status->id)?'selected="selected"':'';?>>{{ $status->nome }}</option>
                @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Periodo</label>
              <div class="col-sm-10">
                <input style="width:50%;" id="periodo" name="periodo" type="text" class="form-control drp" placeholder="Selecione o período" />  
              </div>
            </div>
          </div>
          <div class="modal-footer no-border">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Selecionar Campanhas</button>
          </div>
        </form>
      </div>
    </div>
  </div>