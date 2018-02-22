<div class="modal bs-modal-sm fade" id="ModalSearch" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Filtrar Campanhas</h4>
            </div>
            <div class="modal-body">
                <p>Selecione os filtros que deseja aplicar a lista de campanhas.</p>
                <form class="form-horizontal FiltroForm" id="FormFiltros" role="form" style="margin-top:20px;">
                    <input type="hidden" name="filtros" value="" /> <!-- Não remover, usado para executar os filtros -->
                    <input type="hidden" name="outnow"  value="" />
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Contém nome da campanha</label>
                        <div class="col-sm-10">
                            <input id="nome" type="text" name="nome" class="form-control filtros_fields" placeholder="Digite o nome da campanha" value="">
                        </div>
                    </div>
                    E
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Contém nome da campanha</label>
                        <div class="col-sm-10">
                            <input id="nome2" type="text" name="nome2" class="form-control filtros_fields" placeholder="Digite o nome da campanha (opcional)" value="">
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