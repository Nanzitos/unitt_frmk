<div class="modal bs-modal-sm fade" id="ModalSearch" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Filtrar Pedidos em Triagem</h4>
        </div>
        <div class="modal-body">
          <p>Selecione os filtros que deseja aplicar a lista de pedidos.</p>
          <form class="form-horizontal FiltroForm" id="FormBuscaPedidos" role="form" style="margin-top:20px;" method="GET" action="{{ url('regras-triagem') }}">
            <input type="hidden" name="filtros" value="" /> <!-- Não remover, usado para executar os filtros -->
            <div class="form-group">
              <label class="col-sm-2 control-label">Nome</label>
              <div class="col-sm-10">
                <input type="text" name="nome" class="form-control filtros_fields" placeholder="Nome do cliente" value="<?php echo isset($_GET['nome'])?$_GET['nome']:'';?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Sobrenome</label>
              <div class="col-sm-10">
                <input type="text" name="sobrenome" class="form-control filtros_fields" placeholder="Sobrenome do cliente" value="<?php echo isset($_GET['sobrenome'])?$_GET['sobrenome']:'';?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                <input type="text" name="email" class="form-control filtros_fields" placeholder="Email do cliente" value="<?php echo isset($_GET['email'])?$_GET['email']:'';?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Cpf</label>
              <div class="col-sm-10">
                <input type="text" name="cpf" class="form-control filtros_fields" placeholder="Cpf do cliente" value="<?php echo isset($_GET['cpf'])?$_GET['cpf']:'';?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Cidade</label>
              <div class="col-sm-10">
                <input type="text" name="cidade" class="form-control cidade filtros_fields" placeholder="Cidade" value="<?php echo isset($_GET['cidade'])?$_GET['cidade']:'';?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">CEP</label>
              <div class="col-sm-10">
                <input type="text" name="cep" class="form-control cep filtros_fields" placeholder="CEP" value="<?php echo isset($_GET['cep'])?$_GET['cep']:'';?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Estado</label>
              <div class="col-sm-10">
                <input type="text" name="estado" class="form-control filtros_fields" placeholder="Estado" value="<?php echo isset($_GET['estado'])?$_GET['estado']:'';?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Telefone</label>
              <div class="col-sm-10">
                <input type="text" name="telefone" class="form-control filtros_fields" placeholder="Telefone" value="<?php echo isset($_GET['telefone'])?$_GET['telefone']:'';?>">
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
