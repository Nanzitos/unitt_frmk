<div class="modal bs-modal-sm fade" id="ImportarKits" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Importar Kits</h4>
        </div>
        <div class="modal-body">
          <p>Selecione um arquivo CSV e clique em importar.</p>
          <form class="form-horizontal ImportForm" id="ImportForm" role="form" style="margin-top:20px;" method="GET" action="{{ url('kits') }}" enctype="multipart/form-data">

            <div class="form-group">
              <label class="col-sm-2 control-label">Arquivo</label>
              <div class="col-sm-10">
                <input type="file" id="inputImport" name="arquivo" class="form-control" placeholder="Selecione o arquivo" accept=".csv" value="">
              </div>
            </div>

        </div>
        <div class="modal-footer no-border">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-primary">Importar</button>
        </div>
        </form>
      </div>
    </div>
  </div>
