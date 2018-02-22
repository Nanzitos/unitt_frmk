<div class="modal fade" id="popup-rightnow-filtro" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Filtrar Taxas e Custos</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal FiltroForm" id="FormFiltros" role="form" style="margin-top:20px;" method="GET" action="{{ url('rightnow-automatico') }}">
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
                    <label class="col-sm-2 control-label">Source</label>
                    <div class="col-sm-10">
                        <select name="source" placeholder="Selecione uma sarca" id="FiltroSource" class="form-control" style="width: 250px;">
                            <option value="">Selecione uma source</option>
                            <option value="conversao">Conversão de Boletos</option>
                            @foreach(App\Sources::all() AS $Source)
                            <option value="{{ $Source->utm_source }}">{{ $Source->utm_source }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Tipo</label>
                    <div class="col-sm-10">
                        <select name="tipo" placeholder="Selecione um tipo" id="FiltroTipo" class="form-control" style="width: 250px;" >
                            <option value="">Selecione um tipo</option>
                            <option value="1">Taxa Hard Input</option>
                            <option value="2">Função PHP</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Ativo</label>
                        <div class="col-sm-10">
                        <label class="switch m-b">
                            <input type="checkbox" name="ativo" id="ativo" checked>
                            <span><i class="handle"></i></span>
                        </label>
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