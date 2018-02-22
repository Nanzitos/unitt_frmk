<div class="modal bs-modal-sm fade" id="ModalSearch" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Filtrar Pedidos</h4>
        </div>
        <div class="modal-body">
          <p>Selecione os filtros que deseja aplicar a lista de pedidos.</p>
          <form class="form-horizontal FiltroForm" id="FormBuscaPedidos" role="form" style="margin-top:20px;" method="GET" action="{{ url('pedidos') }}">
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
              <label class="col-sm-2 control-label">Nome</label>
              <div class="col-sm-10">
                <input type="text" name="nome" class="form-control filtros_fields" placeholder="Nome do cliente" value="<?php echo isset($_GET['nome'])?$_GET['nome']:'';?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Número do pedido</label>
              <div class="col-sm-10">
                <input type="text" name="numero_pedido" class="form-control filtros_fields" placeholder="Número do pedido" value="<?php echo isset($_GET['numero_pedido'])?$_GET['numero_pedido']:'';?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">CPF</label>
              <div class="col-sm-10">
                <input type="text" name="cpf" class="form-control cpf filtros_fields" placeholder="CPF" value="<?php echo isset($_GET['cpf'])?$_GET['cpf']:'';?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">E-mail</label>
              <div class="col-sm-10">
                <input type="text" name="email" class="form-control filtros_fields" placeholder="E-mail" value="<?php echo isset($_GET['email'])?$_GET['email']:'';?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">CEP</label>
              <div class="col-sm-10">
                <input type="text" name="cep" class="form-control cep filtros_fields" placeholder="CEP" value="<?php echo isset($_GET['cep'])?$_GET['cep']:'';?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Status</label>
              <div class="col-sm-10">
                <select name="status" placeholder="Selecione um status" class="form-control">
                <option value="">Selecione um status</option>
                <option value="0">Tentativa de compra</option>
                @foreach(App\PedidosStatus::all() AS $PedidoStatus)
                <option value="{{ $PedidoStatus->id }}">{{ str_replace('_',' ',$PedidoStatus->status) }}</option>
                @endforeach
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