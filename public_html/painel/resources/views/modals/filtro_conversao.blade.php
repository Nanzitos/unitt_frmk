 <!-- Não Remover // Herança de filtros para JS -->
<textarea style="display:none;" id="FiltrosJs">{{ json_encode($filtros_js) }}</textarea>

<div class="modal bs-modal-sm fade" id="ModalSearch" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Configurar</h4>
        </div>
        <div class="modal-body">
          <p>Configure os parâmetros do relatório.</p>
            <div class="form-group">
              <label class="col-sm-2 control-label">Marca</label>
              <div class="col-sm-10">
                <select id="id_marca" name="id_marca" placeholder="Selecione uma marca" class="form-control">
                <option value="all">Todas as marcas</option>
                @foreach(App\Marcas::all() AS $Marca)
                <option value="{{ $Marca->id }}" <?php echo (isset($_GET['id_marca']) && $_GET['id_marca'] && $_GET['id_marca'] == $Marca->id)?'selected="selected"':'';?>>{{ $Marca->nome }}</option>
                @endforeach
                </select>
              </div>
              <br></br>
              <label class="col-sm-2 control-label">Período</label>
              <div class="col-sm-10">
                <input id="de" name="de" type="text" name="reservation" class="form-control drp" placeholder="Selecione o período" />  
              </div>
            </div>
        <div class="modal-footer no-border">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
          <button name="Periodo" id="Periodo" type="button" class="btn btn-primary">Gerar Conversão</button>
        </div>
      </div>
    </div>
  </div>


  <div class="col-sm-8" style="padding-top:15px;">Selecione o período da Consulta:</div>
<div class="row">
  
</div>