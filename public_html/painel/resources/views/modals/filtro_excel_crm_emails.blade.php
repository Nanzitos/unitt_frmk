<div class="modal bs-modal-sm fade" id="ModalSearch" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Filtrar Exportação</h4>
        </div>
        <div class="modal-body">
          <p>Selecione os filtros que deseja aplicar ao excel de e-mails.</p>
          <form class="form-horizontal FiltroForm" id="FormExcelCrmEmails" role="form" style="margin-top:20px;" method="GET" action="{{ url('crm-base-emails') }}">
            <input type="hidden" name="filtros" value="" /> <!-- Não remover, usado para executar os filtros -->
            <div class="form-group">
              <label class="col-sm-2 control-label">Marca</label>
              <div class="col-sm-10">
                <select name="id_marca" placeholder="Selecione uma marca" class="form-control">
                <option value="">Selecione uma marca</option>
                @foreach(App\Marcas::all() AS $Marca)
                <option value="{{ $Marca->id }}">{{ $Marca->nome }}</option>
                @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Categoria</label>
              <div class="col-sm-10">
                <select name="id_categoria" placeholder="Selecione uma categoria" class="form-control">
                <option value="">Selecione uma categoria</option>
                @foreach(App\CrmCategorias::all() AS $Categoria)
                <option value="{{ $Categoria->id }}">{{ $Categoria->nome }}</option>
                @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Válido?</label>
              <div class="col-sm-10">
                <select name="valido" placeholder="E-mails válidos?" class="form-control">
                  <option value="">Todos</option>
                  <option value="1">Válidos</option>
                  <option value="0">Inválidos</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Número de envios</label>
              <div class="col-sm-10">
                <input type="text" name="num_envios" class="form-control filtros_fields" placeholder="Número de envios" value="<?php echo isset($_GET['num_envios'])?$_GET['num_envios']:'';?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">De</label>
              <div class="col-sm-10">
                <input type="text" name="de" class="form-control filtros_fields datepicker" placeholder="De" value="{{ date('d/m/Y', strtotime('-1 day')) }}">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Até</label>
              <div class="col-sm-10">
                <input type="text" name="ate" class="form-control filtros_fields datepicker" placeholder="Até" value="{{ date('d/m/Y') }}">
              </div>
            </div>
        </div>
        <div class="modal-footer no-border">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-primary">Exportar Excel</button>
        </div>
        </form>
      </div>
    </div>
  </div>