<?php
  //print_r($arrayModel); exit;
 //$Imagem = (isset($Model->imagem) && $Model->imagem)?$Model->imagem:array();
 //print_r($nomeCampo); exit;
 // $ct = 0;
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
                    <input type="file" name="{{$nomeCampo}}" id="{{$nomeCampo}}" class="form-control">
                </div>
              </div>
            </div>
          </div>
          <div class="row" style="margin-top: 25px">
            <?php if(isset($arrayModel[$nomeCampo])){ ?>
                <div style="position: relative; width: 25%; float: left; margin-right: 20px;" >
                  <img class="imgProd" src="<?php echo URL::to('/'); ?>/../../assets/<?php echo $arrayModel[$nomeCampo] ?>" style="width:100%; max-height: 150px;"/>                  
                </div>
            <?php } ?>
          </div>          
        </div>
    </div>
  </div>
</div>

