<?php

 $Imagens = (isset($Model->imagens) && $Model->imagens)?json_decode($Model->imagens):array();

  $ct = 0;
?>
<style type="text/css">
  .col-xs-2{ width: 800px; }
</style>

<div class="row">
  <div class="col-sm-12">
    <div class="card bg-white">
        <div class="card-header bg-primary">
            <div class="pull-left">Registros</div>
            <div class="card-controls">
            </div>
        </div>
        <div class="card-block">
          <div class="row ImagensRow">
            <div class="col-sm-12">
              <div style="width:100%;" class="row" style="margin-bottom:10px;">
                <div class="col-xs-2">
                    <input type="file" name="Imagens[{{ $ct }}][imagem][]" class="form-control" multiple>
                </div>
              </div>
            </div>
          </div>
          <div class="row" style="margin-top: 25px">
            <?php foreach($Imagens as $imagem){ ?>
                <div style="position: relative; width: 25%; float: left; margin-right: 20px;" >
                  <img data-ct="<?php echo $ct; ?>" class="imgProd" src="https://static.the8co.com.br/compras/produtos/<?php echo $imagem->imagem ?>" style="width:100%; max-height: 150px;"/>
                  <div class="excluirImg" id="<?php echo $imagem->id; ?>" style="cursor: pointer; color: red; font-size: 15px; font-weight: bold; position: absolute; left: 10px; top: 4px;"> X </div>
                </div>
            <?php $ct++; } ?>
          </div>
          <input type="hidden" id="ctImg" />
        </div>
    </div>
  </div>
</div>
<div class="modal bs-modal-sm fade" id="ModalImg" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Imagens Produtos</h4>
      </div>
      <div id="ModalImgCont"></div>
      <div class="divSeta" data-dir="e" style="position: absolute; left: 1%; top: 50%; width: 4%; font-size: 60px; color: red; cursor: pointer;"> < </div>
      <div class="divSeta" data-dir="d" style="position: absolute; left: 95%; top: 50%; width: 4%; font-size: 60px; color: red; cursor: pointer;"> > </div>
    </div>
  </div>
</div>
