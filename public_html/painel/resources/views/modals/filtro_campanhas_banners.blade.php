<div class="modal bs-modal-sm fade" id="ModalSearch" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Filtrar Banners</h4>
        </div>

        <textarea style="display:none;" id="FiltrosJs">{{ json_encode($filtros_js) }}</textarea>

        <div class="modal-body">
          <p>Configure todos os filtros abaixo:</p>
          <form class="form-horizontal FiltroForm" id="FormPerformanceBanners" style="margin-top:20px;" method="POST" action="{{ url('getperformance') }}">
            <input type="hidden" name="filtros" id="filtros" value="" /> <!-- Não remover, usado para executar os filtros -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="campanhas" id="campanhas" /> 
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
              <label class="col-sm-2 control-label">Status de Operação</label>
              <div class="col-sm-10">
                <select name="id_status_parceiro" placeholder="Selecione um status..." class="form-control">
                <option value="" <?php echo (isset($_GET['id_status_parceiro']) && $_GET['id_status_parceiro'] && $_GET['id_status_parceiro'] == '')?'selected="selected"':'';?>>Selecione um status...</option>
                <option value="1" <?php echo (isset($_GET['id_status_parceiro']) && $_GET['id_status_parceiro'] && $_GET['id_status_parceiro'] == '0')?'selected="selected"':'';?>>Ativo</option>
                <option value="0" <?php echo (isset($_GET['id_status_parceiro']) && $_GET['id_status_parceiro'] && $_GET['id_status_parceiro'] == '1')?'selected="selected"':'';?>>Inativo</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Periodo</label>
              <div class="col-sm-10">
                <input style="width:50%;" id="periodo" name="periodo" type="text" class="form-control drp per" placeholder="Selecione o período" />  
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-2 control-label">Ordenar Por</label>
              <div class="col-sm-10">
                <select name="ordenar" placeholder="Selecione um parâmetro..." class="form-control">
                <option value='fila_upload_banners.criado_em' <?php echo (isset($_GET['ordenar']) && $_GET['ordenar'] && $_GET['ordenar'] == 'criado_em')?'selected="selected"':'';?>>Data de Criação</option>
                <option value="base.impressions" <?php echo (isset($_GET['ordenar']) && $_GET['ordenar'] && $_GET['ordenar'] == 'impressoes')?'selected="selected"':'';?>>Impressões</option>
                <option value="base.clicks"     <?php echo (isset($_GET['ordenar']) && $_GET['ordenar'] && $_GET['ordenar'] == 'clicks')?'selected="selected"':'';?>>Clicks</option>
                <option value="base.conversions" <?php echo (isset($_GET['ordenar']) && $_GET['ordenar'] && $_GET['ordenar'] == 'conversoes')?'selected="selected"':'';?>>Conversões</option>
                <option value="base.mongo_conversions" <?php echo (isset($_GET['ordenar']) && $_GET['ordenar'] && $_GET['ordenar'] == 'mongo_conversoes')?'selected="selected"':'';?>>Conversões do Mongo</option>
                <option value="base.spend"      <?php echo (isset($_GET['ordenar']) && $_GET['ordenar'] && $_GET['ordenar'] == 'custo')?'selected="selected"':'';?>>Custo</option>]
                <option value="base.ctr" <?php echo (isset($_GET['ordenar']) && $_GET['ordenar'] && $_GET['ordenar'] == 'ctr')?'selected="selected"':'';?>>CTR</option>
                <option value="base.taxa_conversao" <?php echo (isset($_GET['ordenar']) && $_GET['ordenar'] && $_GET['ordenar'] == 'taxa_conversao')?'selected="selected"':'';?>>Taxa de Conversão</option>
                <option value="base.cpa" <?php echo (isset($_GET['ordenar']) && $_GET['ordenar'] && $_GET['ordenar'] == 'cpa')?'selected="selected"':'';?>>CPA</option>
                <option value="base.receita" <?php echo (isset($_GET['ordenar']) && $_GET['ordenar'] && $_GET['ordenar'] == 'receita')?'selected="selected"':'';?>>Receita</option>
                </select>
              </div>
            </div>
            <div class="row FiltroRow">
            <div class="col-sm-10">
              <div class="row" style="margin-bottom:10px;margin-left:135px">
                <div class="col-xs-2" style="min-width:225px;margin-right:10px">
                  <select name="campos[0]" id="filtro" class="form-control" style="min-width:210px;">
                    <option value="">Métrica</option>
                    <option value="base.impressions" <?php echo (isset($_GET['campos[0]']) && $_GET['campos[0]'] && $_GET['campos[0]'] == 'impressoes')?'selected="selected"':'';?>>Impressões</option>
                    <option value="base.clicks" <?php echo (isset($_GET['campos[0]']) && $_GET['campos[0]'] && $_GET['campos[0]'] == 'clicks')?'selected="selected"':'';?>>Clicks</option>
                    <option value="base.conversions" <?php echo (isset($_GET['campos[0]']) && $_GET['campos[0]'] && $_GET['campos[0]'] == 'conversoes')?'selected="selected"':'';?>>Conversões</option>
                    <option value="base.spend" <?php echo (isset($_GET['campos[0]']) && $_GET['campos[0]'] && $_GET['campos[0]'] == 'custo')?'selected="selected"':'';?>>Custo</option>
                    <option value="base.ctr" <?php echo (isset($_GET['campos[0]']) && $_GET['campos[0]'] && $_GET['campos[0]'] == 'ctr')?'selected="selected"':'';?>>CTR</option>
                    <option value="base.conversion_rate" <?php echo (isset($_GET['campos[0]']) && $_GET['campos[0]'] && $_GET['campos[0]'] == 'taxa_conversao')?'selected="selected"':'';?>>Taxa de Conversão</option>
                    <option value="base.cpa" <?php echo (isset($_GET['campos[0]']) && $_GET['campos[0]'] && $_GET['campos[0]'] == 'cpa')?'selected="selected"':'';?>>CPA</option>
                    <option value="base.receita" <?php echo (isset($_GET['campos[0]']) && $_GET['campos[0]'] && $_GET['campos[0]'] == 'receita')?'selected="selected"':'';?>>Receita</option>
                  </select>
                </div>
                <div class="col-xs-2" style="margin-right: 10px;">
                  <select name="operador[0]" id="operador" class="form-control" style="min-width:100px;">
                    <option value="">Operador</option>
                    <option value="=" <?php echo (isset($_GET['operador[0]']) && $_GET['operador[0]'] && $_GET['operador[0]'] == '=')?'selected="selected"':'';?>>=</option>
                    <option value="!=" <?php echo (isset($_GET['operador[0]']) && $_GET['operador[0]'] && $_GET['operador[0]'] == '!=')?'selected="selected"':'';?>>!=</option>
                    <option value=">" <?php echo (isset($_GET['operador[0]']) && $_GET['operador[0]'] && $_GET['operador[0]'] == '>')?'selected="selected"':'';?>>></option>
                    <option value=">=" <?php echo (isset($_GET['operador[0]']) && $_GET['operador[0]'] && $_GET['operador[0]'] == '>=')?'selected="selected"':'';?>>>=</option>
                    <option value="<" <?php echo (isset($_GET['operador[0]']) && $_GET['operador[0]'] && $_GET['operador[0]'] == '<')?'selected="selected"':'';?>><</option>
                    <option value="<=" <?php echo (isset($_GET['operador[0]']) && $_GET['operador[0]'] && $_GET['operador[0]'] == '<=')?'selected="selected"':'';?>><=</option>
                  </select>
                </div>
                <div class="col-xs-2">
                  <input type="text" name="valor[0]" class="form-control float_number" placeholder="Valor" autocomplete="on">
                </div>
                <div class="col-xs-2">
                  <button type="button" data-action="add" id="valor" class="btn btn-success btn-round btn-icon-icon mr5 ActionButton" data-type="filtros">
                    <i class="icon-plus"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          </div>
          <div class="modal-footer no-border">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary SelecionarCampanhas">Selecionar Campanhas</button>
          </div>
        </form>
      </div>
    </div>
  </div>