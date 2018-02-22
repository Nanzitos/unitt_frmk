<div class="modal bs-modal-sm fade" id="ModalBackofficeCancelados" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Boleto | Interagir</h4>
        </div>
        <div class="modal-body">
          
          <p>Disponibilize as informações abaixo de forma completa.</p>
          
          <input type="hidden" id="BackofficeIdPedido" value="" />

          <div class="table-responsive" style="margin-bottom:20px;">
            <table class="table table-bordered table-striped m-b-0">
              <tbody>
                <tr>
                  <td width="17%">Marca</td>
                  <td id="PedidoMarca">Aguarde...</td>
                </tr>
                <tr>
                  <td width="17%">Kit</td>
                  <td id="PedidoKit">Aguarde...</td>
                </tr>
                <tr>
                  <td>Data da compra</td>
                  <td id="PedidoData">Aguarde...</td>
                </tr>
                <tr>
                  <td>Pagamento</td>
                  <td id="PedidoPagamento">Aguarde...</td>
                </tr>
                <tr>
                  <td>Nome</td>
                  <td id="PedidoNome">Aguarde...</td>
                </tr>
                <tr>
                  <td>Telefone</td>
                  <td id="PedidoTelefone">Aguarde...</td>
                </tr>
                <tr>
                  <td>E-mail</td>
                  <td id="PedidoEmail">Aguarde...</td>
                </tr>
                <tr>
                  <td style="line-height:30px;">Agendar para:</td>
                  <td><input type="text" class="form-control" id="PedidoAgendar" /></td>
                </tr>
              </tbody>
            </table>
        </div>
          
          @if($Area->url == 'backoffice/dia-seguinte')
          <!-- FOLLOW UP -->
          <button type="button" class="btn btn-info btn-sm btn-icon mr5 backofficebuttons" data-acao="follow_up">
            <i class="icon-speech"></i>
            <span>Follow Up</span>
          </button>
          @endif
          
          <!-- SEM CONTATO -->
          <button type="button" class="btn btn-info btn-sm btn-icon mr5 backofficebuttons" data-acao="sem_contato">
            <i class="icon-call-end"></i>
            <span id="PedidoSemContato"></span>
          </button>

          <!-- BOLETO PAGO -->
          <button type="button" class="btn btn-info btn-sm btn-icon mr5 backofficebuttons" data-acao="ja_pago">
            <i class="icon-check"></i>
            <span>Boleto já pago</span>
          </button>

          <!-- DESISTENCIA -->
          <button type="button" class="btn btn-danger btn-sm btn-icon mr5 backofficebuttons" data-acao="desistencia">
            <i class="icon-ban"></i>
            <span>Desistência</span>
          </button>

          <!-- TELEFONE NÃO EXISTE -->
          <button type="button" class="btn btn-danger btn-sm btn-icon mr5 backofficebuttons" data-acao="telefone_nao_existe">
            <i class="icon-target"></i>
            <span>Telefone não existe</span>
          </button>

          <!-- COMPRA JÁ REALIZADA -->
          <button type="button" class="btn btn-danger btn-sm btn-icon mr5 backofficebuttons" data-acao="compra_ja_realizada">
            <i class="icon-target"></i>
            <span>Compra já realizada</span>
          </button>

          <!-- OUTROS -->
          <button type="button" class="btn btn-danger btn-sm btn-icon mr5 backofficebuttons" data-acao="outros">
            <i class="icon-target"></i>
            <span>Outros</span>
          </button>
          
          <div class="form-group" style="margin-top:15px; margin-bottom:140px !important;">
            <div class="col-sm-12">
              <textarea id="BackofficeDescricao" rows="7" class="form-control" placeholder="Descreva de forma breve"></textarea>
            </div>
          </div>

        </div>
        <div class="modal-footer no-border">
          <button type="button" class="btn btn-warning" id="GerarNovoBoleto">Gerar novo boleto</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary" id="BackofficeSalvar">Salvar</button>
        </div>
        </form>
      </div>
    </div>
  </div>