<?php

 $Imagens = (isset($Model->categorias) && $Model->categorias)?json_decode($Model->categorias):array();

  $ct = 1;
?>
<style type="text/css">
  .col-xs-2{ width: 800px; }

  .imgSlid{
    position: relative; width: 25%; float: left; margin: 20px;
  }
</style>

<div class="row">
  <div class="col-sm-12">
    <div class="card bg-white">
        <div class="card-header bg-primary">
            <div class="pull-left">Categorias</div>
            <div class="card-controls">
            </div>
        </div>
        <div class="card-block">          
          <div class="row" style="margin-top: 25px">
            <?php foreach($Imagens as $imagem){ ?>
                <div class="imgSlid" >
                  <img data-ct="<?php echo $ct; ?>" class="imgProd" src="<?php echo URL::to('/'); ?>/../../assets/images/selos/<?php echo $imagem->imagem ?>" style="width:100%; max-height: 150px;"/>
                  <div class="excluirImg" id="<?php echo $imagem->id; ?>" style="cursor: pointer; color: red; font-size: 15px; font-weight: bold; position: absolute; left: 10px; top: 4px;"> X </div>
                <div class="col-sm-12" style="margin-top: 15px;">
                  <label for="ulr_slider"> Nome </label>
                  <input type="text" name="Imgs[{{ $ct }}][nome]" class="form-control" style="padding: 5px;" value="{{ $imagem->nome }}" />                  
                </div>                
                <div class="col-sm-12" style="margin-top: 15px;">
                  <label for="ulr_slider"> Texto </label>
                 <textarea name="Imgs[{{ $ct }}][texto]" class="form-control" style=" padding: 5px;" ><?php echo trim($imagem->texto); ?></textarea>
                  <input type="hidden" name="Imgs[{{ $ct }}][id]" value="{{ $imagem->id }}" />                  
                </div>
                <div class="col-sm-12" style="margin-top: 15px;">
                  <label for="ulr_slider"> Imagem </label>
                  <input type="file" name="Imgs[{{ $ct }}][imagem]" class="form-control">                  
                </div>                  
              </div>                
            <?php $ct++; } ?>
          </div>          
        </div>
    </div>
  </div>
</div>

