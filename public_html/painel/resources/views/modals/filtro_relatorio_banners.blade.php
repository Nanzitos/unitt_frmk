<div class="modal bs-modal-sm fade" id="ModalSearch" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Filtrar Banners</h4>
        </div>
        <div class="modal-body">
          <p>Selecione os filtros que deseja aplicar ao relatório.</p>
          <form class="form-horizontal FiltroForm" id="FormBuscaPedidos" role="form" style="margin-top:20px;" method="GET" action="{{ url('relatorios/banners') }}">
            <input type="hidden" name="filtros" value="" /> <!-- Não remover, usado para executar os filtros -->
            <div class="form-group">
              <label class="col-sm-2 control-label">Marca</label>
              <div class="col-sm-10">
                <select name="id_marca" placeholder="Selecione uma marca" class="form-control">
                <option value="all" <?php echo (isset($_GET['id_marca']) && $_GET['id_marca'] && $_GET['id_marca'] == "all")?'selected="selected"':'';?>>Todas as marcas</option>
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
                <option value="all" <?php echo (isset($_GET['id_parceiro']) && $_GET['id_parceiro'] && $_GET['id_parceiro'] == "all")?'selected="selected"':'';?>>Todos os parceiros</option>
                @foreach(App\Parceiros::all() AS $Parceiro)
                <option value="{{ $Parceiro->id }}" <?php echo (isset($_GET['id_parceiro']) && $_GET['id_parceiro'] && $_GET['id_parceiro'] == $Parceiro->id)?'selected="selected"':'';?>>{{ $Parceiro->nome }}</option>
                @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Modalidade</label>
              <div class="col-sm-10">
                <select name="modalidade" placeholder="Selecione uma modalidade" class="form-control">
                <option value="all" <?php echo (isset($_GET['modalidade']) && $_GET['modalidade'] && $_GET['modalidade'] == "all")?'selected="selected"':'';?>>Todas as modalidades</option>
                <option value="desktop" <?php echo (isset($_GET['modalidade']) && $_GET['modalidade'] && $_GET['modalidade'] == "desktop")?'selected="selected"':'';?>>Desktop</option>
                <option value="mobile" <?php echo (isset($_GET['modalidade']) && $_GET['modalidade'] && $_GET['modalidade'] == "mobile")?'selected="selected"':'';?>>Mobile</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">MSN</label>
              <div class="col-sm-10">
                <select name="msn" placeholder="Selecione uma opção" class="form-control">
                <option value="all" <?php echo (isset($_GET['msn']) && $_GET['msn'] && $_GET['msn'] == "all")?'selected="selected"':'';?>>Todos os banners</option>
                <option value="somente" <?php echo (isset($_GET['msn']) && $_GET['msn'] && $_GET['msn'] == "somente")?'selected="selected"':'';?>>Somente banners de MSN</option>
                <option value="nenhum" <?php echo (isset($_GET['msn']) && $_GET['msn'] && $_GET['msn'] == "nenhum")?'selected="selected"':'';?>>Nenhum banner de MSN</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Mínimo Impressões</label>
              <div class="col-sm-10">
                <select name="impressions" placeholder="Mínimo Impressões" class="form-control">
                <option value="0" <?php echo (isset($_GET['impressions']) && $_GET['impressions'] && $_GET['impressions'] == "0")?'selected="selected"':'';?>>Inexistente</option>
                <option value="10" <?php echo (isset($_GET['impressions']) && $_GET['impressions'] && $_GET['impressions'] == "10")?'selected="selected"':'';?>>10 impressões</option>
                <option value="100" <?php echo (isset($_GET['impressions']) && $_GET['impressions'] && $_GET['impressions'] == "100")?'selected="selected"':'';?>>100 impressões</option>
                <option value="1000" <?php echo (isset($_GET['impressions']) && $_GET['impressions'] && $_GET['impressions'] == "1000")?'selected="selected"':'';?>>1000 impressões</option>
                <option value="10000" <?php echo (isset($_GET['impressions']) && $_GET['impressions'] && $_GET['impressions'] == "10000")?'selected="selected"':'';?>>10000 impressões</option>
                <option value="100000" <?php echo (isset($_GET['impressions']) && $_GET['impressions'] && $_GET['impressions'] == "100000")?'selected="selected"':'';?>>100000 impressões</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Mínimo Conversões</label>
              <div class="col-sm-10">
                <select name="conversions" placeholder="Mínimo Conversões" class="form-control">
                <option value="0" <?php echo (isset($_GET['conversions']) && $_GET['conversions'] && $_GET['conversions'] == "0")?'selected="selected"':'';?>>Inexistente</option>
                <option value="1" <?php echo (isset($_GET['conversions']) && $_GET['conversions'] && $_GET['conversions'] == "1")?'selected="selected"':'';?>>1 conversão</option>
                <option value="2" <?php echo (isset($_GET['conversions']) && $_GET['conversions'] && $_GET['conversions'] == "2")?'selected="selected"':'';?>>2 conversões</option>
                <option value="3" <?php echo (isset($_GET['conversions']) && $_GET['conversions'] && $_GET['conversions'] == "3")?'selected="selected"':'';?>>3 conversões</option>
                <option value="4" <?php echo (isset($_GET['conversions']) && $_GET['conversions'] && $_GET['conversions'] == "4")?'selected="selected"':'';?>>4 conversões</option>
                <option value="5" <?php echo (isset($_GET['conversions']) && $_GET['conversions'] && $_GET['conversions'] == "5")?'selected="selected"':'';?>>5 conversões</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Indexação de Data</label>
              <div class="col-sm-10">
                <select name="data_index" placeholder="Indexação de Data" class="form-control">
                <option value="0" <?php echo (isset($_GET['data_index']) && $_GET['data_index'] && $_GET['data_index'] == "0")?'selected="selected"':'';?>>Criado Em</option>
                <option value="1" <?php echo (isset($_GET['data_index']) && $_GET['data_index'] && $_GET['data_index'] == "1")?'selected="selected"':'';?>>Performou Em</option>
                </select>
              </div>
            </div>
        </div>
        <div class="modal-footer no-border">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
        </form>
      </div>
    </div>
  </div>