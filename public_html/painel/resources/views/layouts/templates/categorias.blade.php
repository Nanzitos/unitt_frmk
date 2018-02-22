<?php 
  
  $Categorias = (isset($Model->categorias) && $Model->categorias)?json_decode($Model->categorias):array(); 
 // print_r($Categorias); exit;
  $ct = 0;
?>
<div class="row">
  <div class="col-sm-12">
    <div class="card bg-white">
          <div class="card-header bg-primary">
            <div class="pull-left">Categorias</div>
            <div class="card-controls">
            </div>
          </div>
          <div class="card-block">
            @if(isset($Categorias))
            @foreach($Categorias AS $categoria)
            <div class="row ImagensRow">
              <div class="col-sm-12">
                <div class="row" style="margin-bottom:10px;">
                  <div class="col-xs-2">
                    <input type="text" name="Categorias[{{ $ct }}][nome]" class="form-control nome" placeholder="Nome" value="{{ $categoria->nome }}">
                  </div>
                  <div class="col-xs-4">
                    <input type="text" name="Categorias[{{ $ct }}][texto]" class="form-control nome" placeholder="Texto" value="{{ $categoria->texto }}">
                  </div>                 
                  <div class="col-xs-4">
                    <input type="text" name="Categorias[{{ $ct }}][imagem]" class="form-control" placeholder="Url da Imagem" value="{{ $categoria->imagem }}">    
                  </div>                  
                </div>
              </div>
            </div>
            <?php $ct++;?>
            @endforeach
           
            @endif
          </div>
        </div>
  </div>
</div>