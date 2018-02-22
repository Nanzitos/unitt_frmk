<div class="modal fade" id="ModalSearch" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Filtrar Campanhas Facebook</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal FiltroForm" id="FormFiltros" role="form" style="margin-top:20px;" method="GET" action="{{ url('edicao-facebid') }}">
                <input type="hidden" name="filtros" value="" />
                <div class="form-group">
                    <label class="col-sm-2 control-label">Marca</label>
                    <div class="col-sm-10">
                        <select name="id_marca" placeholder="Selecione uma marca" id="FiltroMarcas" class="form-control" style="width: 250px;">
                            <option value="">Selecione uma marca</option>
                            <option value="0">Todas as Marcas</option>
                            @foreach(App\Marcas::all() AS $Marca)
                            <option value="{{ $Marca->id }}">{{ $Marca->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Carregar RT?</label>
                    <div class="col-sm-10">
                        <select name="carregar" placeholder="Carregar Retargeting?" id="FiltroMarcas" class="form-control" style="width: 250px;">
                            <option value="0" selected>Não</option>
                            <option value="1">Sim</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-10">
                        <select name="status" placeholder="Selecione um status" id="FiltroMarcas" class="form-control" style="width: 250px;">
                            <option value="ACTIVE" selected>Active</option>
                            <option value="PAUSED">Paused</option>
                        </select>
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
</div>