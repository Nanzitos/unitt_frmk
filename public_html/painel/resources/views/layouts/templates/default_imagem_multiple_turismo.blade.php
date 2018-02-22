<?php
//print_r($Model->imagens); exit;
 $Imagens = (isset($Model->imagens_turismo) && $Model->imagens_turismo)? (array) ($Model->imagens_turismo):array();

  $ct = 0;
?>
<style type="text/css">
  .col-xs-2{ width: 800px; }
</style>

<div class="row">
  <div class="col-sm-12">
    <div class="card bg-white">
        <div class="card-header bg-primary">
            <div class="pull-left">Upload de imagens</div>
            <div class="card-controls">
            </div>
        </div>
        <div class="card-block">
          <div class="row ImagensRow">
            <div class="col-sm-12">
              <div style="width:100%;" class="row" style="margin-bottom:10px;">
                <div class="col-xs-2">
                    <input type="file" name="Imagens[{{ $ct }}][imagem_turismo][]" class="form-control" multiple>
                </div>
              </div>
            </div>
          </div>
          <div class="row" style="margin-top: 25px">
            <?php foreach($Imagens as $Imagem){
                    foreach($Imagem as $imagem){
                      if($imagem->cover == 1){
                        $border = " border: 2px solid black;";
                      }else{
                        $border = "";
                      }?>
                <div style="position: relative; width: 200px; height: 150px; float: left; margin:10px 20px;" >
                  <img data-ct="<?php echo $ct; ?>" data-id="<?php echo $imagem['id'] ?>" class="imgProd" src="<?php echo URL::to('/'); ?>/../../assets/<?php echo $imagem[$nomeCampo] ?>" style="width:100%; max-height: 150px; {{$border}}"/>
                  <div class="excluirImg" id="<?php echo $imagem['id']; ?>" style="cursor: pointer; color: red; font-size: 15px; font-weight: bold; position: absolute; left: 10px; top: 4px;"> X </div>

                </div>
            <?php  }$ct++;} ?>
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
