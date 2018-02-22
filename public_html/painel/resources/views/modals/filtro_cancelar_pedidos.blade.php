<div class="modal bs-modal-sm fade" id="ModalSearch" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Filtrar Pedidos em Triagem</h4>
        </div>
        <div class="modal-body">
          <p>Selecione os filtros que deseja aplicar a lista de pedidos.</p>
          <form class="form-horizontal FiltroForm" id="FormBuscaPedidos" role="form" style="margin-top:20px;" method="GET" action="{{ url('cancelamento-pedidos') }}">
            <input type="hidden" name="filtros" value="" /> <!-- Não remover, usado para executar os filtros -->
            <div class="form-group">
              <label class="col-sm-2 control-label">Id do Pedido</label>
              <div class="col-sm-10">
                <input type="text" name="id_pedido" class="form-control filtros_fields" placeholder="Id do pedido" value="<?php echo isset($_GET['id_pedido'])?$_GET['id_pedido']:'';?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Nome</label>
              <div class="col-sm-10">
                <input type="text" name="nome" class="form-control filtros_fields" placeholder="Nome do cliente" value="<?php echo isset($_GET['nome'])?$_GET['nome']:'';?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                <input type="text" name="email" class="form-control filtros_fields" placeholder="Email" value="<?php echo isset($_GET['email'])?$_GET['email']:'';?>">
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
              <label class="col-sm-2 control-label">Motivo Triagem</label>
              <div class="col-sm-10">
                <select name="motivo_triagem" placeholder="Motivo Triagem" class="form-control">
                  <option value="">Motivo</option>
                  <option value="cid_repetido">Cid Repetido</option>
                  <option value="holder_repetido">Holder Repetido</option>
                  <option value="telefone_repetido">Telefone Repetido</option>
                  <option value="email_repetido">Email Repetido</option>
                  <option value="cpf_repetido">CPF Repetido</option>
                  <option value="blacklist_cidade">Blacklist Cidade</option>
                  <option value="sem_motivo">Sem Motivo</option>
                </select>
              </div>
            </div>
             <div class="form-group">
              <label class="col-sm-2 control-label">Ordenar por</label>
              <div class="col-sm-10">
                <select name="ordenar" placeholder="Selecione" class="form-control">
                <option value="">Ordenar</option>
                <option value="alf">Alfabética</option>
                <option value="maior">CEP - Maior</option>
                <option value="menor">CEP - Menor</option>
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
